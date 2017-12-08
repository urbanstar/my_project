<?php
class Articles{
    private static $instance;
    private $bd;
    public static function getInstance(){
        if (self::$instance==null){
            self::$instance=new Articles();
        }
        return self::$instance;
    }
    public function __construct()
    {
        $this->bd=BD::getInstance();
    }
    public function getAll(){
        $query='SELECT id, name_article, text_article FROM article ORDER BY date_update LIMIT 3';
        return $this->bd->select($query);
    }
    public function getOne($id_articles){
        $query="SELECT * FROM article WHERE id='$id_articles'";
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
