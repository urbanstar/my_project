<?php

function __autoload($classname){
  include_once(__DIR__."/controller/$classname.php");
  include_once(__DIR__."/model/BD.php");
  include_once(__DIR__."/controller/M_Users.php");
}

define('BASE_URL','/');

define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB', 'blog_olga');
