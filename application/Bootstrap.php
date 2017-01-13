<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
    }
    protected function _initViewHelpers() {
        $view = new Zend_View();
        $view->headTitle('SocialZone')->setSeparator(' - ');
    }

    protected function _initResourceAutoloader()
    {
        $autoloader = new Zend_Loader_Autoloader_Resource(array(
            'basePath'  => APPLICATION_PATH,
            'namespace' => 'Application',
            'resourceTypes' => array(
                    'model' => array(
                            'path' => 'models/',
                            'namespace' => 'Model_',
                    ),
                    'model_db' => array(
                        'path' => 'models/db',
                        'namespace' => 'Model_Db_'
                    )
            )
        ));

        return $autoloader;
    }
}
