<?php

//
// Менеджер пользователей
//
class M_Users {

  private static $instance;  // экземпляр класса
  private $dbh;        // драйвер БД
  private $sid;        // идентификатор текущей сессии
  private $uid;        // идентификатор текущего пользователя
  //private $onlineMap;      // карта пользователей online

  public static function getInstance() {
    if (self::$instance == NULL) {
      self::$instance = new M_Users();
    }

    return self::$instance;
  }

  public function __construct() {
    $this->dbh = DB::getInstance();
    $this->sid = NULL;
    $this->uid = NULL;
    $this->onlineMap = NULL;
  }

  public function clearSessions() {
    $min = date('Y-m-d H:i:s', time() - 60 * 20);
    $t = "time_last < '%s'";
    $where = sprintf($t, $min);
    $this->dbh->delete('sessions', $where);
  }

  public function login($login, $password, $remember = TRUE) {

    // вытаскиваем пользователя из БД
    $user = $this->getByLogin($login);
    if ($user == NULL) {
      return FALSE;
    }

    $id_user = $user['id_user'];

    // проверяем пароль
    if ($user['password'] != md5($password)) {
      if ($user['password'] != $password) {
        return FALSE;
      }
    }

    // запоминаем имя и md5(пароль)
    if ($remember) {
      $expire = time() + 3600 * 24 * 100;
      setcookie('login', $login, $expire);
      setcookie('password', md5($password), $expire);
    }

    // открываем сессию и запоминаем SID
    $this->sid = $this->openSession($id_user);

    var_dump($this->sid);

    return TRUE;
  }

  //
  // Выход
  //
  public function logout() {
    setcookie('login', '', time() - 1);
    setcookie('password', '', time() - 1);
    unset($_COOKIE['login']);
    unset($_COOKIE['password']);
    unset($_SESSION['sid']);
    $this->sid = NULL;
    $this->uid = NULL;
  }

  public function getUser($id_user = NULL) {
    // Если id_user не указан, берем его по текущей сессии.
    if ($id_user == NULL) {
      $id_user = $this->getUid();
    }
    if ($id_user == NULL) {
      return NULL;
    }

    // А теперь просто возвращаем пользователя по id_user.
    $query = "SELECT * FROM users WHERE id_user = '%d'";
    $query = sprintf($query, $id_user);
    $result = $this->dbh->select($query);
    return $result[0];
  }

  public function getByLogin($login) {
    $query = "SELECT * FROM users WHERE login = '%s'";
    $query = sprintf($query, mysqli_real_escape_string($login));
    $result = $this->dbh->select($query);
    return $result[0];
  }

  public function canUser($priv, $id_user = NULL) {
    if ($id_user == NULL) {
      $id_user = $this->getUserUid();
    }

    if ($id_user == NULL) {
      return FALSE;
    }

    $t = "SELECT count(*) as cnt FROM privs2roles p2r
			  LEFT JOIN users u ON u.id_role = p2r.id_role
			  LEFT JOIN privs p ON p.id_priv = p2r.id_priv 
			  WHERE u.id_user = '%d' AND p.name = '%s'";

    $query = sprintf($t, $id_user, $priv);
    $result = $this->dbh->select($query);

    return ($result[0]['cnt'] > 0);
  }

  public function isUserOnline($id_user) {
    if ($this->onlineMap == NULL) {
      $t = "SELECT DISTINCT id_user FROM sessions";
      $query = sprintf($t, $id_user);
      $result = $this->dbh->select($query);

      foreach ($result as $item) {
        $this->onlineMap[$item['id_user']] = TRUE;
      }
    }

    return ($this->onlineMap[$id_user] != NULL);
  }

  public function getUid() {
    // Проверка кеша.
    if ($this->uid != NULL) {
      return $this->uid;
    }
    // Берем по текущей сессии.
    $sid = $this->getSid();

    if ($sid == NULL) {
      return NULL;
    }

    $query = "SELECT user_id FROM sessions WHERE sid = '%s'";
    $query = sprintf($query, mysqli_real_escape_string($sid));
    $result = $this->dbh->select($query);

    // Если сессию не нашли - значит пользователь не авторизован.
    if (count($result) == 0) {
      return NULL;
    }

    // Если нашли - запоминм ее.
    $this->uid = $result[0]['user_id'];
    return $this->uid;
  }

  private function getSid() {
    // Проверка кеша.
    if ($this->sid != NULL) {
      return $this->sid;
    }

    // Ищем SID в сессии.
    $sid = $_SESSION['sid'];

    // Если нашли, попробуем обновить time_last в базе.
    // Заодно и проверим, есть ли сессия там.
    if ($sid != NULL) {
      $session = [];
      $session['time_last'] = date('Y-m-d H:i:s');
      $t = "sid = '%s'";
      $condition = sprintf($t, mysqli_real_escape_string($sid));
      $affected_rows = $this->dbh->update('sessions', $session, $condition);

      if ($affected_rows == 0) {
        $t = "SELECT count(*) FROM sessions WHERE sid = '%s'";
        $query = sprintf($t, mysqli_real_escape_string($sid));
        $result = $this->dbh->select($query);

        if ($result[0]['count(*)'] == 0) {
          $sid = NULL;
        }
      }
    }

    // Нет сессии? Ищем логин и md5(пароль) в куках.
    // Т.е. пробуем переподключиться.
    if ($sid == NULL && isset($_COOKIE['login'])) {
      $user = $this->getByLogin($_COOKIE['login']);

      if ($user != NULL && $user['password'] == $_COOKIE['password']) {
        $sid = $this->openSession($user['id']);
      }
    }

    // Запоминаем в кеш.
    if ($sid != NULL) {
      $this->sid = $sid;
    }

    // Возвращаем, наконец, SID.
    return $sid;
  }

  private function openSession($id_user) {
    // генерируем SID
    $sid = $this->generateStr(10);

    // вставляем SID в БД
    $now = date('Y-m-d H:i:s');
    $session = [];
    $session['user_id'] = $id_user;
    $session['sid'] = $sid;
    $session['time_start'] = $now;
    $session['time_last'] = $now;
    $this->dbh->insert('sessions', $session);

    // регистрируем сессию в PHP сессии
    $_SESSION['sid'] = $sid;
    // возвращаем SID
    return $sid;
  }

  private function generateStr($length = 10) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;

    while (strlen($code) < $length) {
      $code .= $chars[mt_rand(0, $clen)];
    }

    return $code;
  }
}
