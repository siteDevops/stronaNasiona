<?php
class rtPlugins_Controller_Plugin_Permission extends Zend_Controller_Plugin_Abstract {
  
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
          
        $params = $request->getParams();
  
        $auth = Zend_Auth::getInstance();

        if ($params['module'] == 'admin' && !$auth->hasIdentity()) {
  
            $this->_request->setModuleName("admin");
            $this->_request->setControllerName("auth");
            $this->_request->setActionName("login");
        }
    }
}