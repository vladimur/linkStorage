<?php

    // Конттроллер страницы чтения.
//    include_once('M/M_Article.php');
//    include_once('M/M_Comment.php');
//    include_once('M/M_Users.php');

    class C_linkStorage extends C_Base
    {

        // Конструктор
        function __construct()
        {		
            parent::__construct();
        }

        public function before()
        {
            // $this->needLogin = true; 
            // раскоментируйте, чтобы закрыть доступ ко всем страницам данного 
            // контроллера
            parent::before();
        }
        
        public function action_index()
        {
//            if (!$_SESSION['online']) {
//                $mUsers = M_Users::Instance();
//                $mUsers -> ClearSessions();
//                $mUsers -> Logout();
//                $_SESSION['online'] = false;
//            }
            //echo 'dgfgfg';
            $this -> content = $this -> Template('v/V_Main.php', array());
        }
        

    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    