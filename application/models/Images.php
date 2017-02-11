<?php

class Application_Model_Images extends Zend_Db_Table {

    protected $_name = 'products_images';

    public static function create(array $data) {
        $table = new self();
        $table->insert($data);
    }

    public static function getById($id) {
        if (empty($id))
            return false;

        $table = new self();
        $select = $table->select()
            ->where('id = ?', $id);

        return $table->fetchRow($select);
    }

    public static function getByProductId($id) {
        if (empty($id))
            return false;

        $table = new self();
        $select = $table->select()
            ->where('product_id = ?', $id);

        return $table->fetchAll($select);
    }

    public static function getList()
    {
        $table = new self();
        return $table->fetchAll($table->select());
    }
}
