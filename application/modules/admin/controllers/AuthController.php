<?php

class Admin_AuthController extends Zend_Controller_Action {

    public function loginAction() {
        if (isset(Zend_Auth::getInstance()->getStorage()->read()->id) && Zend_Auth::getInstance()->getStorage()->read()->id > 0) {
            $this->view->sys_error = "403";
            $this->render('error/e403', null, true);
        }
        $translate = Zend_Registry::get('Zend_Translate');

        if (!$this->getRequest()->isPost())
            return;

        $input = new Zend_Filter_Input(array(), array());
        $input->setDefaultEscapeFilter('StringTrim');
        $input->setData($this->getRequest()->getPost());

        $login = $input->login;
        $password = $input->password;

        $errors = array();

        if (empty($login)) {
            $errors['login'] = $translate->_('Podaj login lub email');
        }

        if (empty($password)) {
            $errors['password'] = $translate->_('Podaj hasło');
        }

        if (count($errors)) {
            $this->view->errors = $errors;
            return;
        }

        // zmiana emaila na login
        $emailValidator = new Zend_Validate_EmailAddress();
        if ($emailValidator->isValid($login)) {
            $userByEmail = Application_Model_Users::getByEmail($login);

            if ($userByEmail && $userByEmail->email == $login)
                $login = $userByEmail->login;
        }

        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $adminAuthAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter, 'users', 'login', 'password');
        $adminAuthAdapter->setIdentity($login);
        $adminAuthAdapter->setCredential(hash('md5', PASSWORD_SOIL . $password));

        try {
            $auth = Zend_Auth::getInstance();
            $adminAuthResult = $auth->authenticate($adminAuthAdapter);

            if ($adminAuthResult->isValid()) {
                $user = $adminAuthAdapter->getResultRowObject(Application_Model_Auth::authFields());

                $error = "";

                if ($user->status != "active") {
                    $error = $translate->_('Konto nie jest aktywne');
                    if ($user->status == 'blocked') {
                        $error = $translate->_('Konto zablokowane');
                    }
                    if ($user->status == 'deleted') {
                        $error = $translate->_('Konto usunięte');
                    }
                    if ($error != "") {
                        $this->view->error_custom = $error;
                        Zend_Auth::getInstance()->clearIdentity();
                        return;
                    }
                }


                // add group info
                $user->group = 'user';

                $storage = $auth->getStorage();
                $storage->write($user);

                $user = Application_Model_Users::getById($user->id);
                $userAgent = new Zend_Http_UserAgent();
                $user->last_login_date = date('Y-m-d H:i:s');
                $user->last_login_ip = $this->getRequest()->getClientIp();
                $user->last_login_user_agent = $userAgent->getUserAgent();
                $user->save();

                // autologin
                if ($input->autologin) {
                    Application_Model_UsersAutologin::deleteById($user->id);
                    $hash = md5(uniqid(null, true));
                    $autologinEntry = array(
                        'hash' => $hash,
                        'user_id' => $user->id
                    );

                    Application_Model_UsersAutologin::create($autologinEntry);

                    $autloginCookie = join(",", array_values($autologinEntry));

                    $autloginCookie = openssl_encrypt($autloginCookie, "AES-256-CBC", SECRET_HASH);

                    setcookie("affiliate_autologin", $autloginCookie, time() + (3600 * 24 * 7), '/');
                }

                if (isset($input->back) && count(parse_url($input->back)) > 1) {
                    $this->_helper->redirector->gotoUrl($input->back);
                }

                $this->_helper->flashMessenger->addMessage($translate->_('Zalogowano'));

                $sAction = $this->getRequest()->getParam('action');
                $sController = $this->getRequest()->getParam('controller');
                if ($sAction == 'logout' || $sAction == 'login' || $sAction == "") {
                    $this->_helper->redirector->goTo('index', 'index');
                }
                $this->_redirect($_SERVER['REQUEST_URI']);
            } else {
                $errors['login'] = $translate->_('Błędny login i/lub hasło');
                $this->view->errors = $errors;
                return;
            }
        } catch (Zend_Auth_Adapter_Exception $e) {

            $errors['login'] = $translate->_('Wystąpiły nieoczekiwane błędy podczas autoryzacji');
            $this->view->errors = $errors;
            return;
        }
    }

    public function logoutAction() {
        $translate = Zend_Registry::get('Zend_Translate');
        $auth = Zend_Auth::getInstance();

        Application_Model_UsersAutologin::deleteById($auth->getIdentity()->id);
        setcookie('user_autologin', 0, time() - 3600, '/');

        $auth->clearIdentity();
//        Zend_Session::destroy();
        $this->_helper->flashMessenger->addMessage($translate->_('Nastąpiło poprawne wylogowanie'));
        $this->_helper->redirector->goToUrl('/admin/');
    }

}
