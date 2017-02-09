<?php
require_once 'AbstractAdminController.php';

class Admin_ProductsController extends AbstractAdminController
{
    private $_allowedExtensions = array('png', 'bmp', 'jpg', 'jpeg');
    private $_filters = array();
    private $_validators = array();

    public function init()
    {
        parent::init();

        $this->_filters = array(
            'name'     => 'StringTrim',
            'description'     => 'StringTrim',
            'price' => 'Digits',
            'quantity' => 'Digits'
        );
        $this->_validators = array(
            'name' => array(
                'allowEmpty' => false
            ),
            'description' => array(
                'allowEmpty' => true
            ),
            'quantity'   => array(
                'Digits',
                new Zend_Validate_Int(),
                'allowEmpty' => false
            ),
            'price'   => array(
                'Digits',
                new Zend_Validate_Int(),
                'allowEmpty' => false
            ),
            'category_id'   => array(
                'Digits',
                new Zend_Validate_Int(),
                'allowEmpty' => false
            ),
        );
    }

    public function indexAction()
    {
        $this->forward('list');
    }

    public function listAction()
    {
        $this->view->products = Application_Model_Products::getList();
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        if (!$id || !is_numeric($id) || !$product = Application_Model_Products::getById($id)) {
            //kieruj do listy
        }

        $this->view->images = Application_Model_Images::getByProductId($product->id);

        $this->view->name        = $product->name;
        $this->view->description = $product->description;
        $this->view->price       = $product->price;
        $this->view->quantity    = $product->quantity;
        $this->view->category_id = $product->category_id;

        if (!$this->getRequest()->isPost()) {
            return;
        }

        $input = new Zend_Filter_Input(array(), array());
        $input->setData($this->getRequest()->getPost());

        $product->name        = $input->name;
        $product->description = $input->description;
        $product->price       = $input->price;
        $product->quantity    = $input->quantity;
        $product->category_id = $input->category_id;

        $product->save();


        $this->redirect('/admin/products/edit/id/' . $product->id);
    }

    public function addAction()
    {
        if (!$this->getRequest()->isPost()) {
            return;
        }

        $this->view->msg = array();


        $input = new Zend_Filter_Input($this->_filters, $this->_validators);
        $input->setData($this->getRequest()->getPost());

        $this->view->name        = $input->name;
        $this->view->description = $input->description;
        $this->view->price       = $input->price;
        $this->view->quantity    = $input->quantity;
        $this->view->category_id = $input->category_id;

            return;
            $data = array(
                'name' => $input->name,
                'description' => $input->description,
                'quantity' => $input->quantity,
                'price' => $input->price,
                'category_id' => $input->category_id
            );

            $product = Application_Model_Products::create($data);

            $product_id = $product->id;


        $adapter = new Zend_File_Transfer_Adapter_Http();

        $adapter->setDestination(UPLOAD_IMAGES_PATH);

        $files  = $adapter->getFileInfo();
        foreach ($files as $file => $fileInfo) {

            if($adapter->isUploaded($file)) {

                if($adapter->isValid($file)) {
                    $ext = $this->_findexts($fileInfo['name']);
                    if (!in_array($ext, $this->_allowedExtensions)) {
                        $this->view->msg[] = "nieprawidłowe rozszerszenie";
                        return;
                    }

                    $name = md5($fileInfo['name']);

                    while (file_exists(UPLOAD_IMAGES_PATH . '/' . $name.'.'.$ext)) {
                        $name = md5($name);
                    }

                    $adapter->addFilter('Rename', $name.'.'.$ext, $fileInfo['name']);

                    if (!$adapter->receive($fileInfo['name'])) {

                        $this->view->msg[] = $adapter->getMessages();

                        return;

                    }else{
                        Application_Model_Images::create(array("name" => $name.'.'.$ext, "product_id" => $product_id));
                        $im = imagecreatefrompng(UPLOAD_IMAGES_PATH . '/' . $name.'.'.$ext);
                        $im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => 50, 'height' => 300]);
                        if ($im2 !== FALSE) {
                            imagepng($im2, UPLOAD_IMAGES_PATH . '/' . $name.'_22'.'.'.$ext);
                        }
                    }
                }
            }
        }

        $this->redirect('/admin/products/edit/id/' . $product_id);
    }

    protected function _findexts($filename)
    {
        $filename = strtolower($filename);
        $exts = explode(".", $filename);
        $n = count($exts) - 1;
        $exts = $exts[$n];
        return $exts;
    }


}