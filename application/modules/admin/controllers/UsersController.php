<?php

require_once 'AbstractAdminController.php';

class Admin_UsersController extends AbstractAdminController {

    public function indexAction() {
        $this->forward('list');
    }

    public function listAction() {
        $order = array();
        if ($this->getRequest()->getParam('order')) {
            $order = array(
                'by' => $this->getRequest()->getParam('order'),
                'type' => 'ASC'
            );
        }
        if ($this->getRequest()->getParam('order_type')) {
            $order['type'] = $this->getRequest()->getParam('order_type');
        }

        $this->view->users = Application_Model_Users::getList(array(), $order);
        $this->view->order_type = $this->getRequest()->getParam('order_type');
    }

    public function listDeletedAction() {
        $order = array();
        if ($this->getRequest()->getParam('order')) {
            $order = array(
                'by' => $this->getRequest()->getParam('order'),
                'type' => 'ASC'
            );
        }
        if ($this->getRequest()->getParam('order_type')) {
            $order['type'] = $this->getRequest()->getParam('order_type');
        }

        $this->view->users = Application_Model_Users::getList(array('status' => 'deleted'), $order);
        $this->view->order_type = $this->getRequest()->getParam('order_type');
    }

    public function listBlockedAction() {
        $order = array();
        if ($this->getRequest()->getParam('order')) {
            $order = array(
                'by' => $this->getRequest()->getParam('order'),
                'type' => 'ASC'
            );
        }
        if ($this->getRequest()->getParam('order_type')) {
            $order['type'] = $this->getRequest()->getParam('order_type');
        }

        $this->view->users = Application_Model_Users::getList(array('status' => 'blocked'), $order);
        $this->view->order_type = $this->getRequest()->getParam('order_type');
    }

    public function updateSystemIdAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $users = Application_Model_Users::getList();
        foreach ($users as $user) {
            Application_Model_Users::updateSystemID($user->id);
        }
    }

    public function addAction() {
        $this->view->user_types = Application_Model_UserTypes::getList();
        if (!$this->getRequest()->isPost()) {
            return false;
        }

        $input = new Zend_Filter_Input(array(), array());
        $input->setDefaultEscapeFilter('StringTrim');
        $input->setData($this->getRequest()->getPost());

        $this->view->login = $input->login;
        $this->view->first_name = $input->first_name;
        $this->view->last_name = $input->last_name;
        $this->view->email = $input->email;
        $this->view->phone = $input->phone;
        $this->view->type = $input->type;
        $this->view->gender = $input->gender;
        $this->view->lang = $input->lang;

        $errors = array();
        if (empty($input->login)) {
            $errors['login'] = 'Login nie może być pusty';
        }
        if (Application_Model_Users::getByLogin($input->login)) {
            $errors['login'] = 'Login istnieje - podaj inny';
        }
        if (empty($input->first_name)) {
            $errors['first_name'] = 'Imię nie może być puste';
        }
        if (empty($input->last_name)) {
            $errors['last_name'] = 'Nazwisko nie może być puste';
        }
        if (empty($input->password)) {
            $errors['password'] = 'Hasło nie może być puste';
        }
        if (empty($input->email)) {
            $errors['email'] = 'Email nie może być pusty';
        }
        if (Application_Model_Users::getByEmail($input->email)) {
            $errors['email'] = 'Email istnieje - podaj inny';
        }
        if (!is_numeric($input->phone)) {
            $errors['phone'] = 'Numer telefonu jest nieprawidłowy';
        }

        if (count($errors)) {
            $this->view->errors = $errors;
            return;
        }

        $data = array(
            'login' => $input->login,
            'first_name' => $input->first_name,
            'last_name' => $input->last_name,
            'password' => hash('md5', PASSWORD_SOIL . $input->password),
            'type' => $input->type,
            'email' => $input->email,
            'phone' => $input->phone,
            'lang' => $input->lang,
            'gender' => $input->gender,
            'status' => 'active',
            'activation_key' => '0',
        );

        $user = Application_Model_Users::create($data);
        $this->redirect('/admin/users/edit/id/' . $user->id);
    }

    public function editAction() {
        $this->view->user_types = Application_Model_UserTypes::getList();
        $id = $this->getRequest()->getParam('id');

        if (!$id || !$user = Application_Model_Users::getById($id)) {
            $this->redirect('/admin/users/list');
        }

        $this->view->user = $user;

        if (!$this->getRequest()->isPost()) {
            return;
        }
        $input = new Zend_Filter_Input(array(), array());
        $input->setDefaultEscapeFilter('StringTrim');
        $input->setData($this->getRequest()->getPost());

        $this->view->user = array(
            'login' => $user->login,
            'first_name' => $input->first_name,
            'last_name' => $input->last_name,
            'email' => $input->email,
            'phone' => $input->phone,
            'type' => $input->type,
            'gender' => $input->gender,
            'lang' => $input->lang,
        );

        $errors = array();
        if (Application_Model_Users::getByLogin($input->login)) {
            $errors['login'] = 'Login istnieje - podaj inny';
        }
        if (empty($input->first_name)) {
            $errors['first_name'] = 'Imię nie może być puste';
        }
        if (empty($input->last_name)) {
            $errors['last_name'] = 'Nazwisko nie może być puste';
        }
        if (empty($input->email)) {
            $errors['email'] = 'Email nie może być pusty';
        }
        if (!is_numeric($input->phone)) {
            $errors['phone'] = 'Numer telefonu jest nieprawidłowy';
        }

        if (count($errors)) {
            $this->view->errors = $errors;
            return;
        }

        $user->first_name = $input->first_name;
        $user->last_name = $input->last_name;
        $user->new_email = $input->email;
        $user->type = $input->type;
        $user->phone = $input->phone;
        $user->lang = $input->lang;
        $user->gender = $input->gender;

        if (!empty($input->password)) {
            $user->password = hash('md5', PASSWORD_SOIL, $input->password);
        }

        $user->save();
    }

    public function deleteAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->getRequest()->getParam('id');
        $delete_reason = $this->getRequest()->getParam('reason');
        $date = date('Y-m-d H:i:s');

        if (is_array($id)) {
            foreach ($id as $id_to_delete) {
                if ($item = Application_Model_Users::getById($id_to_delete)) {
                    $item->date_deleted = $date;
                    $item->status = 'deleted';
                    $item->delete_reason = $delete_reason;
                    $item->save();
                }
            }
        } else {
            if ($id && $item = Application_Model_Users::getById($id)) {
                $item->date_deleted = $date;
                $item->status = 'deleted';
                $item->delete_reason = $delete_reason;
                $item->save();
            }
        }

        $this->redirect('/admin/users/list');
    }

    public function blockAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->getRequest()->getParam('id');
        $block_reason = $this->getRequest()->getParam('reason');
        $date = date('Y-m-d H:i:s');

        if (is_array($id)) {
            foreach ($id as $id_to_block) {
                if ($item = Application_Model_Users::getById($id_to_block)) {
                    if ($item->status != 'deleted') {
                        $item->date_blocked = $date;
                        $item->status = 'blocked';
                        $item->blocked_by = 1;
                        $item->blocked_reason = $block_reason;
                        $item->save();
                    }
                }
            }
        } else {
            if ($id && $item = Application_Model_Users::getById($id)) {
                if ($item->status != 'deleted') {
                    $item->date_blocked = $date;
                    $item->status = 'blocked';
                    $item->blocked_reason = $block_reason;
                    $item->save();
                }
            }
        }

        $this->redirect('/admin/users/list');
    }

    public function reportAction() {
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->getRequest()->getParam('id');
        $block_reason = $this->getRequest()->getParam('reason');
        $date = date('Y-m-d H:i:s');

        if (is_array($id)) {
            foreach ($id as $id_to_block) {
                if ($item = Application_Model_Users::getById($id_to_block)) {
                    $item->date_blocked = $date;
                    $item->is_blocked = 1;
                    $item->blocked_reason = $block_reason;
                    $item->save();
                }
            }
        } else {
            if ($id && $item = Application_Model_Users::getById($id)) {
                $item->date_blocked = $date;
                $item->is_blocked = 'blocked';
                $item->blocked_reason = $block_reason;
                $item->save();
            }
        }

        $this->redirect('/admin/users/list');
    }

}
