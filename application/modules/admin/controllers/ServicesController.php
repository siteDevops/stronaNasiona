<?php
require_once 'AbstractAdminController.php';
class Admin_ServicesController extends AbstractAdminController
{
    public function listAction()
    {
        if($this->getRequest()->getParam('cid')){//id kategorii
            $this->view->services = Application_Model_Services::getByCategory( $this->getRequest()->getParam('cid') );
        }else{
            $this->view->services = Application_Model_Services::getList();
        }
    }

   
}