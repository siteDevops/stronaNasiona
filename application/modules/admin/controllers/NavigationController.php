<?php
require_once 'AbstractAdminController.php';

class Admin_NavigationController extends AbstractAdminController {

    public function indexAction() {
        $this->forward('list');
    }

    public function listAction() {
        $this->view->navigation = Application_Model_AdminMenu::getListAll();
        $this->view->navigation2 = Application_Model_AdminMenu::getListAll();
    }

    public function addAction() {
        $this->view->parents = Application_Model_AdminMenu::getListGeneral();
        if (!$this->getRequest()->isPost()) {
            return false;
        }

        $input = new Zend_Filter_Input(array(), array());
        $input->setDefaultEscapeFilter('StringTrim');
        $input->setData($this->getRequest()->getPost());

        $data = array(
            'name' => $input->name,
            'link' => $input->link,
            'parent_id' => $input->parent_id,
            'show_in_menu' => $input->show_in_menu
        );

        $item = Application_Model_AdminMenu::create($data);
        $order = $input->order < 1 ? null : $input->order;
        self::setOrder($item->id, $order);
        $this->redirect('/admin/navigation/edit/id/'.$item->id);
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id');

        if (!$id || !$item = Application_Model_AdminMenu::getById($id)) {
            $this->redirect('/admin/navigation/');
        }


        if ($this->getRequest()->isPost()) {
            $input = new Zend_Filter_Input(array(), array());
            $input->setDefaultEscapeFilter('StringTrim');
            $input->setData($this->getRequest()->getPost());

            $item->name = $input->name;
            $item->link = $input->link;
            $item->parent_id = $input->parent_id;
            $item->show_in_menu = $input->show_in_menu;

            $item->save();
            $order = $input->order < 1 ? null : $input->order;
            $item = self::setOrder($id, $order, true);
        }

        $this->view->item = $item;
        $this->view->parents = Application_Model_AdminMenu::getListGeneral($id);
    }

    public function deleteAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->getRequest()->getParam('id');

        if (is_array($id)) {
            foreach ($id as $id_to_delete) {
                if ($item = Application_Model_AdminMenu::getById($id_to_delete)) {
                    $item->delete();
                }
            }
        } else {
            if (!$id || !$item = Application_Model_AdminMenu::getById($id)) {
                $this->redirect('/admin/navigation/');
            }
        }

        $item->delete();
        $this->redirect('/admin/navigation/');
    }

    private function setOrder($item_id, $order = null, $return_item = false) {
        $item = Application_Model_AdminMenu::getById($item_id);
        $criteria = array(
            'order_list' => $order,
            'parent_id' => $item->parent_id
        );
        if ($order && $orderedItems = Application_Model_AdminMenu::getByParams($criteria, $item->id)) {
            foreach ($orderedItems as $orderedItem) {
                $orderedItem->order_list = NULL;
                $orderedItem->save();
            }
        }
        $item->order_list = $order;
        $item->save();

        if ($return_item)
            return $item;
    }

    public function switchShowInMenuAction() {
        $id = $this->getRequest()->getParam('id');

        if (!$id || !$item = Application_Model_AdminMenu::getById($id)) {
            $this->redirect('/admin/navigation/');
        }

        if ($item->show_in_menu == 0)
            $item->show_in_menu = 1;
        else
            $item->show_in_menu = 0;

        $item->save();
        $this->redirect('/admin/navigation/');
    }

}
