<?php
if (empty($_POST['log'])||empty($_POST['pass'])){
    header('Location: ../view/v_log_pas.php');
    exit;
}
//var_dump(__DIR__);
require "M_Users.php";
//require "../model/BD.php";
$user=M_Users::Instance();

//$rez=$user->getOne(array('0'=>$_POST['log'], '1'=>$_POST['pass']));
if ($user->Login($_POST['log'], $_POST['pass'])){

}

/*if ($rez==null){
    header('Location: ../index.php');
    exit;
}
else{
    var_dump($rez);
}*/
//создать сессию и записать в базу
?>