<?php

class Application_Model_Services extends Zend_Db_Table {

    protected $_name = 'services';

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

        return $table->fetchRow($select);
    }

    public static function getList()
    {
        $table = new self();
        $select = $table->select()
                        ->order('name ASC');

        return $table->fetchAll($select);
    }
    
    public static function getByCategory($category)
    {
        if(empty($category))
            return false;
        
        $table = new self();
        $select = $table->select();
        
        $getCategory = Application_Model_Categories::getById($category);
        
        while ($getCategory){
            $select->orWhere('category_id =?', $getCategory->id);
            $getCategory = Application_Model_Categories::getById($getCategory->parent_id);
        }
        
        $select->orWhere('category_id = 0');
        
        $select->order('name ASC');
        return $table->fetchAll($select);
    }
}
