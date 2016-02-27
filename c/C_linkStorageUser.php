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

    public function action_own_page()
    {
//        $mUsers = M_Users::Instance()->GetUser();
//
//        var_dump($mUsers);
//
//        $links = M_linkStorage::Instance();
//        $allLinks = $links->Allmy('user');
        $this -> content = $this -> Template('v/V_MyPage.php', array());
    }

}