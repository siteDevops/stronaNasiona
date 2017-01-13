<?php

class Application_Model_Auth extends Zend_Db_Table {

    public static function authFields() {
        return array(
            'id',
            'login',
            'first_name',
            'last_name',
            'status',
            'lang',
            'type',
        );
    }

}
