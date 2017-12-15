<?php

class DB {

  private static $instance;

  private $dbh;

  public static function getInstance() {
    if (self::$instance == NULL) {
      self::$instance = new DB();
    }
    return self::$instance;
  }

  private function __construct() {

    $this->dbh = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) or die ('We can\'t access to DB');
    if (!$this->dbh) {
      printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
      exit;
    }

  }

  public function select($query) {

    $mysqli_result = $this->dbh->query($query);
    if ($mysqli_result) {
      $data = [];
      // Cycle through results
      while ($row = $mysqli_result->fetch_assos()) {
        $data[] = $row;
      }

      return !empty($data) ? $data : FALSE;
    }

    return [];
  }

  public function insert($table, $data) {
    if (!empty($data) && is_array($data)) {
      $columns = '';
      $values = '';
      $i = 0;

      foreach ($data as $key => $val) {
        $pre = ($i > 0) ? ', ' : '';
        $columns .= $pre . $key;
        $values .= $pre . "'" . $val . "'";
        $i++;
      }

      $query = "INSERT INTO " . $table . " (" . $columns . ") VALUES (" . $values . ")";
      $insert = $this->dbh->query($query);
      return $insert ? $this->dbh->insert_id : FALSE;
    }
    return FALSE;
  }

  public function update($table, $data, $conditions) {
    if (!empty($data) && is_array($data)) {
      $colvalSet = '';
      $whereSql = '';
      $i = 0;
      foreach ($data as $key => $val) {
        $pre = ($i > 0) ? ', ' : '';
        $colvalSet .= $pre . $key . "='" . $val . "'";
        $i++;
      }
      if (!empty($conditions) && is_array($conditions)) {
        $whereSql .= ' WHERE ';
        $i = 0;
        foreach ($conditions as $key => $value) {
          $pre = ($i > 0) ? ' AND ' : '';
          $whereSql .= $pre . $key . " = '" . $value . "'";
          $i++;
        }
      }
      $query = "UPDATE " . $table . " SET " . $colvalSet . $whereSql;
      $update = $this->dbh->query($query);
      return $update ? $this->dbh->affected_rows : FALSE;
    }
    return FALSE;
  }

  public function delete($table, $conditions) {
    $whereSql = '';
    if (!empty($conditions) && is_array($conditions)) {
      $whereSql .= ' WHERE ';
      $i = 0;
      foreach ($conditions as $key => $value) {
        $pre = ($i > 0) ? ' AND ' : '';
        $whereSql .= $pre . $key . " = '" . $value . "'";
        $i++;
      }
    }
    $query = "DELETE FROM " . $table . $whereSql;
    $delete = $this->db->query($query);
    return $delete ? TRUE : FALSE;
  }

}
