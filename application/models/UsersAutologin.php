<?php

class Application_Model_UsersAutologin extends Zend_Db_Table {

    protected $_name = 'autologin_users';

    public static function create(array $data) {
        $table = new self();
        $id = $table->insert($data);
        
        $user = self::getById($id);
        
        return $user;
    }

    public static function getById($id) {
        if (empty($id))
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('id = ?', $id);

        return $table->fetchRow($select);
    }

    public static function deleteById($id) {
        if (empty($id))
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('id = ?', $id);

        $row = $table->delete($id);
    }

    public static function getByHash($hash) {
        if (empty($hash))
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('hash = ?', $hash);

        return $table->fetchRow($select);
    }
}