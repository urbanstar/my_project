<?php
//
// Базовый контроллер сайта.
//
abstract class C_Base extends C_Controller
{
	protected $title;		// заголовок страницы
	protected $content;		// содержание страницы
    protected $user='guest'; // кто вошел

	// Конструктор.
	function __construct()
	{

	   if (M_Users::Instance()->Get()){
	       $this->user=M_Users::Instance()->Get();
       };
        var_dump(M_Users::Instance()->Get());


	}
	
	protected function before()
	{
		$this->title = 'Мой сайт';
		$this->content = '';
	}
	
	//
	// Генерация базового шаблонаы
	//	
	public function render()
	{
		$vars = array('title' => $this->title, 'content' => $this->content, 'user'=>$this->user);
		$page = $this->template('view/v_main.php', $vars);
		echo $page;
	}	
}
