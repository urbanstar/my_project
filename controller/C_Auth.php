<?php

class C_Auth extends C_Base
{

  public function __construct(){
    parent::__construct();
  }

  public function before(){
    parent::before();
  }

  public function action_login(){
    $mUsers = M_Users::getInstance();
    $mUsers->logout();

    if($this->isPost())
    {
      if($mUsers->login($_POST['login'], $_POST['password'], isset($_POST['remember'])))
        $this->redirect(BASE_URL);
    }
    $this->content = $this->template('v/v_login.php');
  }
}