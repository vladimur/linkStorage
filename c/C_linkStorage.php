<?php

    include_once('../m/M_SQL.php');

    class C_linkStorage extends C_Base
    {

        function __construct()
        {		
            parent::__construct();
        }

        public function before()
        {
            // $this->needLogin = true; 
            // раскоментировать, чтобы закрыть доступ ко всем страницам данного
            // контроллера
            parent::before();
        }
        
        public function action_index()
        {
            $this -> content = $this -> Template('v/V_Index.php', array());
        }
    }