<?php

class M_Articles {

  private static $instance;

  private $db;

  public static function getInstance() {
    if (self::$instance == NULL) {
      self::$instance = new M_Articles();
    }
    return self::$instance;
  }

  public function __construct() {
    $this->db = DB::getInstance();
  }

  public function getAll() {
    $query = 'SELECT id, name_article, text_article FROM article ORDER BY date_update LIMIT 3';
    return $this->db->select($query);
  }

  public function getOne($id_articles) {
    $query = "SELECT * FROM article WHERE id=" . $id_articles;
    return $this->db->select($query);
  }

  public function add($table, $data) {
    $this->db->insert($table, $data);
    return TRUE;
  }

  public function edit($table, $data, $condition) {
    $this->db->update($table, $data, $condition);
    return TRUE;
  }

  public function delete($table, $condition) {
    $this->db->delete($table, $condition);
    return TRUE;
  }

}
