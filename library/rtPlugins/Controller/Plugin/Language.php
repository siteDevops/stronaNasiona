<?php

class rtPlugins_Controller_Plugin_Language extends Zend_Controller_Plugin_Abstract
{

    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {
        $languages = array(
            'en' => 'en_US',
            'pl' => 'pl_PL',
            'de' => 'de_DE'
        );

        $domain = $_SERVER['SERVER_NAME'];
        $domain = explode('.', $domain);

        $lang = count($domain) ? $domain[0] : null;

        if (!in_array($lang, array_keys($languages))) {
            $lang = count($domain) ? $domain[count($domain) - 1] : null;
        }

        if (!in_array($lang, array_keys($languages))) {
            $lang = 'en';
        }

        define('APPLICATION_LANG', $lang);
        define('APPLICATION_LANG_LOCALE', $languages[$lang]);

        $sess = new Zend_Session_Namespace('application_lang');
        if (!isset($sess->lang)) {
            $sess->lang = $lang;
        }
    }

    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        $module = $request->getModuleName();//nazwa modułu
        
        
        $languages = array('en' => 'en_US', 'pl' => 'pl_PL');
        $sess = new Zend_Session_Namespace('application_lang');
        $lang = in_array($sess->lang, array_keys($languages)) ? $sess->lang : 'en';

        $translate = new Zend_Translate(
            array(
                'adapter' => 'csv',
                'content' => APPLICATION_PATH."/languages/".$module.'/'.$lang.'/translate.csv',
                'locale'  => $languages[$lang],
                'disableNotices' => true,
                'delimiter'      => ';',
                'enclosure'      => '"'
            )
        );

        if (Zend_Auth::getInstance()->getIdentity()
        && in_array(Zend_Auth::getInstance()->getIdentity()->lang, array_keys($languages))
        ) {
            $lang = Zend_Auth::getInstance()->getIdentity()->lang;
        }

        $translate->setLocale($languages[$lang]);

        Zend_Registry::set('Zend_Translate', $translate);
    }
}
?>
