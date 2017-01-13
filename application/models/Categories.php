<?php

class Application_Model_Categories extends Zend_Db_Table {

    protected $_name = 'categories';

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

    public static function getByParent($id) {
        if (empty($id))
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('parent_id = ?', $id);

        return $table->fetchAll($select);
    }

    public static function getList()
    {
        $table = new self();
        $select = $table->select()
                        ->order('name ASC');

        return $table->fetchAll($select);

    }
}
