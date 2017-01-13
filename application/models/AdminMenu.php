<?php

class Application_Model_AdminMenu extends Zend_Db_Table {

    protected $_name = 'admin_navigation';

    public static function create(array $data) {
        $table = new self();
        $id = $table->insert($data);
        $item = self::getById($id);

        return $item;
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
                        ->where('parent_id = ?', $id)
                        ->where('show_in_menu = 1')
//                        ->order('order_list ASC')
                        ->order(new Zend_Db_Expr('case when order_list is null then 1 else 0 end, order_list'))
                        ->order('id ASC');

        return $table->fetchAll($select);
    }
    
    public static function getByParentCount($id) {
        if (empty($id))
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('parent_id = ?', $id)
                        ->where('show_in_menu = 1')
//                        ->order('order_list ASC')
                        ->order(new Zend_Db_Expr('case when order_list is null then 1 else 0 end, order_list'))
                        ->order('id ASC');

        return $table->fetchAll($select)->count();
    }

    public static function getListGeneral($skipID = null)
    {
        $table = new self();
        $select = $table->select()
                        ->where('parent_id = 0')
                        ->where('show_in_menu = 1')
//                        ->order('order_list ASC')
                        ->order(new Zend_Db_Expr('case when order_list is null then 1 else 0 end, order_list'))
                        ->order('id ASC');

        
        if($skipID){
            $select->where("id !=? ", $skipID);
        }
        
        return $table->fetchAll($select);

    }

    public static function getListAll()
    {
        $table = new self();
        $select = $table->select()
//                        ->order('order_list ASC')
                        ->order(new Zend_Db_Expr('case when order_list is null then 1 else 0 end, order_list'))
                        ->order('id ASC');

        return $table->fetchAll($select);

    }
    
    public static function getByParams($params = array(), $skipID = null)
    {
        if(!count($params)){
            return false;
        }
        
        $table = new self();
        $select = $table->select();
        
        foreach($params as $param => $value){
            $select->where($param." = ".$value);
        }
        if($skipID){
            $select->where("id != ".$skipID );
        }
        return $table->fetchAll($select);
    }
    
    
}
