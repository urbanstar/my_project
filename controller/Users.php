<?php
class Users
{
    private static $instance;
    private $bd;
    public static function getInstance(){
        if (self::$instance==null){
            self::$instance=new Users();
        }
        return self::$instance;
    }
    public function __construct()
    {
        $this->bd=BD::getInstance();
    }
    public function getAll(){
        $query="SELECT * FROM users";
        return $this->bd->select($query);
    }
    public function getOne($object){
        $query="SELECT id, login FROM users WHERE login='$object[0]' AND password='$object[1]'";
        return $this->bd->select($query);
    }
    public function add($table, $object){
        $this->bd->insert($table, $object);
        return true;
    }
    public function edit($table, $object, $where){
        $this->bd->update($table, $object, $where);
        return true;
    }
    public function delete($table, $where){
        $this->bd->delete($table, $where);
        return true;
    }

}