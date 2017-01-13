<?php

class rtPlugins_View_Helper_AdminMenu extends Zend_View_Helper_Abstract {

    public $_active_id = null;
    public $_is_submenu = false;

    public function AdminMenu() {
        return $this;
    }
    
    public function getMenu() {
        $html = '';
        $controller = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
        $menu = Application_Model_AdminMenu::getListGeneral();
        
        foreach ($menu as $item) {
            $linkArr = explode('/', $item->link);
            $linkController = !empty($linkArr[0]) ? $linkArr[0] : $linkArr[1];
            
            if($controller == $linkController){
                $liClass='active';
                $this->_active_id = $item->id;
                $this->_is_submenu = Application_Model_AdminMenu::getByParentCount($item->id) > 0 ? true : false;
            }else{
                $liClass='';
            }  
            
            $html.='<li class="'.$liClass.'"><a href="/admin'.$item->link.'">'.$item->name.'</a></li>';
        }
        return $html;
    }
    
    public function getSubMenu() {
        if(is_null($this->_active_id)){
            return false;
        }
        $html = '';
        $controller = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
        $action = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
        $menu = Application_Model_AdminMenu::getByParent($this->_active_id);
        
        foreach ($menu as $item) {
            $linkArr = explode('/', $item->link);
            $linkController = !empty($linkArr[0]) ? $linkArr[0] : $linkArr[1];
            
            if(!empty($linkArr[0])){
                $linkAction = array_key_exists(1, $linkArr) ? $linkArr[1] : 'index';
            }else{
                $linkAction = array_key_exists(2, $linkArr) ? $linkArr[2] : 'index';
            }
            
            if($controller == $linkController && $action == $linkAction){
                $liClass='active';
            }else{
                $liClass='';
            }
            
            $html.='<li class="'.$liClass.'"><a href="/admin'.$item->link.'">'.$item->name.'</a></li>';
        }
        return $html;
    }
    

}

?>
