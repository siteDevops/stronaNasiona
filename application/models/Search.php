<?php

class Application_Model_Search extends Zend_Db_Table {

    protected $_name = 'users';

    public static function create(array $data) {
		$table = new self();
		$id = $table->insert($data);
        $usr = self::getById($id);
		self::updateUID($id);

		return $usr;
	}

    public static function getByEmail($sEmail) {
        if (empty($sEmail))
            return false;

        $table = new self();
        return $table->fetchRow($table->select()->where('email = ?', $sEmail));
    }

    public static function getById($id) {
        if (empty($id))
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('id = ?', $id);

        return $table->fetchRow($select)->toArray();
    }

    public static function getByUsername($username) {
        if (empty($username))
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('username = ?', $username);

        return $table->fetchRow($select)->toArray();
    }

    public static function getByIdAndEmail($id, $sEmail) {
        if (empty($id) || empty($sEmail))
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('id = ?', $id)
                        ->where('email = ?', $sEmail);

        return $table->fetchRow($select);
    }

    public static function getList()
    {
        $table = new self();
        return $table->fetchAll($table->select());

    }
    public static function searchUsers($name, $limit = 10){
        if(!$name)
            return false;

        $table = new self();
        $select = $table->select()
                        ->where('first_name LIKE ?', $name.'%')
                        ->orWhere('last_name LIKE ?', $name.'%')
                        ->orWhere('username LIKE ?', $name.'%')
                        ->orWhere(new Zend_Db_Expr("CONCAT(first_name, ' ', last_name)").' LIKE ?', $name.'%')
                        ->orWhere(new Zend_Db_Expr("CONCAT(last_name, ' ', first_name)").' LIKE ?', $name.'%')
                        ->order("first_name ASC")
                        ->order("last_name ASC")
                        ->order("username ASC")
                        ->limit($limit);

        return $table->fetchAll($select)->toArray();

    }

    public static function updateUID($id){
		$usr = self::getById($id);
        $usr->uid = sprintf("%09d", $id);
        $usr->save();
    }
}
