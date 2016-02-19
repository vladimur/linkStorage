<?php

    include_once('../m/M_SQL.php');

    class C_linkStorageAnon extends C_Base
    {

        function __construct()
        {		
            parent::__construct();
        }

        public function before()
        {
            $this->needLogin = true;
            parent::before();
        }
        
        public function action_index()
        {
            $links = M_linkStorage::Instance();
            $allLinks = $links->AllMy('user');
            $this -> content = $this -> Template('v/V_Index.php', array( 'links' => $allLinks ));
        }
    }