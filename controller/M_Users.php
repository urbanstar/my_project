<?php
//include_once('../model/BD.php');

//
// �������� �������������
//
class M_Users
{	
	private static $instance;	// ��������� ������
	private $msql;				// ������� ��
	private $sid;				// ������������� ������� ������
	private $uid;				// ������������� �������� ������������
	
	//
	// ��������� ���������� ������
	// ���������	- ��������� ������ MSQL
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Users();
			
		return self::$instance;
	}

	//
	// �����������
	//
	public function __construct()
	{
		$this->msql = BD::getInstance();
		//$this->sid = null;
		//$this->uid = null;
	}
	
	//
	// ������� �������������� ������
	// 
	public function ClearSessions()
	{
		$min = date('Y-m-d H:i:s', time() - 60 * 20); 			
		$t = "time_last < '%s'";
		$where = sprintf($t, $min);
		$this->msql->Delete('sessions', $where);
	}

	//
	// �����������
	// $login 		- �����
	// $password 	- ������
	// $remember 	- ����� �� ��������� � �����
	// ���������	- true ��� false
	//
	public function Login($login, $password, $remember = true)
	{
		// ����������� ������������ �� �� 
		$user = $this->GetByLogin($login);
//var_dump($user);
		if ($user == null)
			return false;
		
		$id_user = $user['id'];

			//var_dump($id_user);
		// ��������� ������
		//if ($user['password'] != md5($password))
           // if ($user['password'] != $password)
		//	return false;
				
		// ���������� ��� � md5(������)
		if ($remember)
		{
			$expire = time() + 3600 * 24 * 100;
			setcookie('login', $login, $expire);
			setcookie('password', md5($password), $expire);
		}
				
		// ��������� ������ � ���������� SID
		$this->sid = $this->OpenSession($id_user);

		var_dump($this->sid);
		
		return true;
	}
	
	//
	// �����
	//
	public function Logout()
	{
		setcookie('login', '', time() - 1);
		setcookie('password', '', time() - 1);
		unset($_COOKIE['login']);
		unset($_COOKIE['password']);
		unset($_SESSION['sid']);		
		$this->sid = null;
		$this->uid = null;
	}
						
	//
	// ��������� ������������
	// $id_user		- ���� �� ������, ����� ��������
	// ���������	- ������ ������������
	//
	public function Get($id_user = null)
	{	
		// ���� id_user �� ������, ����� ��� �� ������� ������.
		if ($id_user == null)
			$id_user = $this->GetUid();
			var_dump($id_user );
		if ($id_user == null)
			return null;
			
		// � ������ ������ ���������� ������������ �� id_user.
		$t = "SELECT * FROM users WHERE id_user = '%d'";
		$query = sprintf($t, $id_user);
		$result = $this->msql->select($query);
		return $result[0];		
	}
	
	//
	// �������� ������������ �� ������
	//
	public function GetByLogin($login)
    {   $t = "SELECT * FROM users WHERE login = '%s'";
        //$t = "SELECT * FROM users";
		$query = sprintf($t, mysql_real_escape_string($login));
		$result = $this->msql->select($query);
		//var_dump($result);
		return $result[0];
	}
			
	//
	// �������� ������� ����������
	// $priv 		- ��� ����������
	// $id_user		- ���� �� ������, ������, ��� ��������
	// ���������	- true ��� false
	//
	public function Can($priv, $id_user = null)
	{		
		// ������� ��������������
		return false;
	}

	//
	// �������� ���������� ������������
	// $id_user		- �������������
	// ���������	- true ���� online
	//
	public function IsOnline($id_user)
	{		
		// ������� ��������������
		return false;
	}
	
	//
	// ��������� id �������� ������������
	// ���������	- UID
	//
	public function GetUid()
	{	
		// �������� ����.
		if ($this->uid != null)
			return $this->uid;	

		// ����� �� ������� ������.
		$sid = $this->GetSid();
				
		if ($sid == null)
			return null;
			
		$t = "SELECT id_user FROM sessions WHERE sid = '%s'";
		$query = sprintf($t, mysql_real_escape_string($sid));
		$result = $this->msql->Select($query);
				
		// ���� ������ �� ����� - ������ ������������ �� �����������.
		if (count($result) == 0)
			return null;
			
		// ���� ����� - �������� ��.
		$this->uid = $result[0]['user_id'];
		return $this->uid;
	}

	//
	// ������� ���������� ������������� ������� ������
	// ���������	- SID
	//
	private function GetSid()
	{
		// �������� ����.
		if ($this->sid != null)
			return $this->sid;
	
		// ���� SID � ������.
		$sid = $_SESSION['sid'];
								
		// ���� �����, ��������� �������� time_last � ����. 
		// ������ � ��������, ���� �� ������ ���.
		if ($sid != null)
		{
			$session = array();
			$session['time_last'] = date('Y-m-d H:i:s'); 			
			$t = "sid = '%s'";
			$where = sprintf($t, mysql_real_escape_string($sid));
			$affected_rows = $this->msql->Update('sessions', $session, $where);

			if ($affected_rows == 0)
			{
				$t = "SELECT count(*) FROM sessions WHERE sid = '%s'";		
				$query = sprintf($t, mysql_real_escape_string($sid));
				$result = $this->msql->Select($query);
				
				if ($result[0]['count(*)'] == 0)
					$sid = null;			
			}			
		}		
		
		// ��� ������? ���� ����� � md5(������) � �����.
		// �.�. ������� ����������������.
		if ($sid == null && isset($_COOKIE['login']))
		{
			$user = $this->GetByLogin($_COOKIE['login']);
			
			if ($user != null && $user['password'] == $_COOKIE['password'])
				$sid = $this->OpenSession($user['id_user']);
		}
		
		// ���������� � ���.
		if ($sid != null)
			$this->sid = $sid;
		
		// ����������, �������, SID.
		return $sid;		
	}
	
	//
	// �������� ����� ������
	// ���������	- SID
	//
	private function OpenSession($id_user)
	{
		// ���������� SID
		$sid = $this->GenerateStr(10);

		// ��������� SID � ��
		$now = date('Y-m-d H:i:s'); 
		$session = array();
		$session['user_id'] = $id_user;
		$session['sid'] = $sid;
		$session['time_start'] = $now;
		$session['time_last'] = $now;
		$this->msql->insert('sessions', $session);

		// ������������ ������ � PHP ������
		$_SESSION['sid'] = $sid;
		// ���������� SID
		return $sid;	
	}

	//
	// ��������� ��������� ������������������
	// $length 		- �� �����
	// ���������	- ��������� ������
	//
	private function GenerateStr($length = 10) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  

		while (strlen($code) < $length) 
            $code .= $chars[mt_rand(0, $clen)];  

		return $code;
	}
}
