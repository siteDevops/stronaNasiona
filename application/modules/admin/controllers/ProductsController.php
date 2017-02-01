<?php
require_once 'AbstractAdminController.php';

class Admin_ProductsController extends AbstractAdminController
{
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
        $adapter = new Zend_File_Transfer_Adapter_Http();


        $adapter->setDestination(UPLOAD_IMAGES_PATH);

        $name = md5($adapter->getFileName());

        while(file_exists(UPLOAD_IMAGES_PATH.'/'.$name)){
            $name = md5($name);
        }

        $adapter->addFilter('Rename', array('target' => UPLOAD_IMAGES_PATH . '/' . $name, 'overwrite' => true));
        if (!$adapter->receive()) {
            $messages = $adapter->getMessages();
            echo implode("\n", $messages);
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