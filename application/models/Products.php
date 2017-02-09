<?php

class Application_Model_Products extends Zend_Db_Table {

    protected $_name = 'products';

    public static function create(array $data) {
        $table = new self();
        $id = $table->insert($data);
        $product = self::getById($id);

        return $product;
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
        return $table->fetchAll($table->select());

    }
}
