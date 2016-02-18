<?php

    abstract class C_Base extends C_Controller    // Базовый контроллер сайта.
    {
        protected $title;		                  // заголовок страницы
        protected $content;		                  // содержание страницы
        protected $needLogin;                  	  // необходима ли авторизация
        protected $user;		                  // авторизованный пользователь || null

        function __construct()                    // Конструктор.
        {
            $this->needLogin = false;
            //$this->user = M_Users::Instance() -> GetUser();
        }

        protected function before()
        {
            if($this -> needLogin && $this -> user === null) 
                $this -> redirect('/user/login');
	
            $this->title = 'Блог';
            $this->content = '';
        }

        public function render()                 // Генерация базового шаблонаы
        {
            $vars = array('title' => $this -> title, 'content' => $this -> content);	
            $page = $this -> Template('v/V_Index.php', $vars);
            echo $page;
        }	
    }
