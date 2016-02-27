<?php

abstract class C_Base extends C_Controller
{
    protected $title;
    protected $content;
    protected $needLogin;
    protected $user;

    function __construct()
    {
        $this->needLogin = false;
        $this->user = M_Users::Instance() -> GetUser();
    }

    protected function before()
    {
        if($this -> needLogin && $this -> user === null)
            $this -> redirect('/user/login');

        $this->title = 'LinkStorage';
        $this->content = '';
    }

    public function render()
    {
        $vars = array('title' => $this -> title, 'content' => $this -> content);
        $page = $this -> Template('v/V_Main.php', $vars);
        echo $page;
    }
}