<?php
require_once 'AbstractAdminController.php';

class Admin_ProductsController extends AbstractAdminController
{
    private $_allowedExtensions = array('png', 'bmp', 'jpg', 'jpeg');

    public function init()
    {
        parent::init();


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

    }

    public function addAction()
    {
        if (!$this->getRequest()->isPost()) {
            return;
        }

        $this->view->msg = array();


        $filters = array(
            'namw'     => 'StringTrim',
            'describe' => 'StringTrim',
            'price' => 'Digits',
            'quantity' => 'Digits'
        );
        $validators = array(
            'name' => array(
                'allowEmpty' => false
            ),
            'quantity'   => array(
                'Digits',                // string
                new Zend_Validate_Int(), // object instance
                'allowEmpty' => false
            ),
            'price'   => array(
                'Digits',                // string
                new Zend_Validate_Int(), // object instance
                'allowEmpty' => false
            ),
        );


        $input = new Zend_Filter_Input($filters, $validators);
        $input->setData($this->getRequest()->getPost());

        var_dump($input->isValid());

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

                    $name = md5($fileInfo['name']) . '.' . $ext;

                    while (file_exists(UPLOAD_IMAGES_PATH . '/' . $name)) {
                        $name = md5($name);
                    }

                    $adapter->addFilter('Rename', $name, $fileInfo['name']);

                    if (!$adapter->receive($fileInfo['name'])) {

                        $this->view->msg[] = $adapter->getMessages();

                        return;

                    }else{
                        Application_Model_Images::create(array("name" => $name, "product_id" => $product_id));
                    }
                }
            }
        }

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