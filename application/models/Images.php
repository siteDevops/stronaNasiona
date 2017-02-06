<?php

class Application_Model_Images extends Zend_Db_Table {

    protected $_name = 'products_images';

    public static function create(array $data) {
        $table = new self();
        $id = $table->insert($data);
        
        self::updateSystemID($id);
        
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

    public static function getByEmail($email) {
        if (empty($email))
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('email = ?', $email);

        return $table->fetchRow($select);
    }
    
    public static function getByLogin($login) {
        if (empty($login))
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('login = ?', $login);

        return $table->fetchRow($select);
    }
    
    public static function getByType($type) {
        if (empty($type))
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('type = ?', $type);

        return $table->fetchRow($select);
    }


    public static function getList($params = array(), $order = array())
    {
        $table = new self();
        $select = $table->select()
                        ->from(array('u1' => 'users'), '*')
                        ->setIntegrityCheck(false)
                        ->joinLeft(array('u2' => 'users'), 'u1.deleted_by = u2.id', array('user_deleting_name' => new Zend_Db_Expr("CONCAT(u2.first_name, ' ', u2.last_name)")))
                        ->joinLeft(array('u3' => 'users'), 'u1.blocked_by = u3.id', array('user_blocking_name' => new Zend_Db_Expr("CONCAT(u3.first_name, ' ', u3.last_name)")))
                        ->joinLeft(array('u4' => 'users'), 'u1.report_by = u4.id', array('user_reporting_name' => new Zend_Db_Expr("CONCAT(u4.first_name, ' ', u4.last_name)")))
                        ->joinLeft(array('ut1' => 'user_types'), 'u1.type = ut1.id', array('user_type' => 'ut1.name'))
                        ->joinLeft(array('ut2' => 'user_types'), 'u2.type = ut2.id', array('user_deleting_type' => 'ut2.name'))
                        ->joinLeft(array('ut3' => 'user_types'), 'u3.type = ut3.id', array('user_blocking_type' => 'ut3.name'))
                        ->joinLeft(array('ut4' => 'user_types'), 'u4.type = ut4.id', array('user_reporting_type' => 'ut4.name'));

        if(count($params)){
            if(!empty($params['email'])){
                $select->where('u1.email =?', $params['email']);
            }
            if(!empty($params['type'])){
                $select->where('u1.type =?', $params['type']);
            }
            if(!empty($params['status'])){
                $select->where('u1.status =?', $params['status']);
            }
            
            if(!empty($params['date_register_from'])){
                $select->where('u1.date_register =?', $params['email']);
            }
            if(!empty($params['date_register_to'])){
                $select->where('u1.date_register =?', $params['email']);
            }
            
            
            if(!empty($params['first_name'])){
                $select->where('u1.first_name =?', $params['first_name']);
            }
            if(!empty($params['u1.last_name'])){
                $select->where('last_name =?', $params['last_name']);
            }
        }
        
        if(!empty($order['by'])){
            if($order['by'] == 'name'){
                $select->order('first_name '.$order['type'])
                        ->order('last_name '.$order['type']);
            }else{
                $select->order($order['by'].' '.$order['type']);
            }
        }else{
            $select->order('id DESC');
        }
        
        return $table->fetchAll($select);
    }
    
    public static function updateSystemID($id){
        $usr = self::getById($id);
        $usr->system_id = sprintf("%09d", $id);
        $usr->save();
    }
}
