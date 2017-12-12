<?php
if (empty($_POST['log'])||empty($_POST['pass'])){
    header('Location: ../view/v_log_pas.php');
    exit;
}

require "M_Users.php";
require "../model/BD.php";
$user=M_Users::Instance();
$user_log=$user->GetByLogin($_POST['log']);
//var_dump($user_log);
if (!empty($user_log)){
  if($user->Login($_POST['log'], $_POST['pass'])){

     header('Location: ../index.php');
      die();
  }
}
//if ($user->Login($_POST['log'], $_POST['pass'])){

//}

/*if ($rez==null){
    header('Location: ../index.php');
    exit;
}
else{
    var_dump($rez);
}*/
//создать сессию и записать в базу
?>