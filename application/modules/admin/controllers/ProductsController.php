<?php
require_once 'AbstractAdminController.php';
class Admin_ProductsController extends AbstractAdminController
{
    public function indexAction() {
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
        if(!$this->getRequest()->isPost()){
            return;
        }
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $name = $adapter->getFileName();
        while(file_exists(UPLOAD_IMAGES_PATH.'/'.$name)){
            $name = $adapter->set();
        }
        $adapter->setDestination(UPLOAD_IMAGES_PATH);

        if (!$adapter->receive()) {
            $messages = $adapter->getMessages();
            echo implode("\n", $messages);
        }
    }


}