<?php

class Application_Model_UserTypes extends Zend_Db_Table {

    protected $_name = 'user_types';

    public static function create(array $data) {
        $table = new self();
        $id = $table->insert($data);
        $cat = self::getById($id);

        return $cat;
    }

    public static function getById($id) {
        if (empty($id))
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('id = ?', $id);

        return $table->fetchRow($select);
    }

    public static function getList()
    {
        $table = new self();
        $select = $table->select();
        
        return $table->fetchAll($select);
    }
}
