<?php

include_once('../m/M_SQL.php');

class C_linkStorageUser extends C_Base
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
        $mUsers = M_Users::Instance()->GetUser();

        $links = M_linkStorage::Instance();
        $allLinks = $links->Allmy($mUsers['login']);

        $this -> content = $this -> Template('v/V_MyPage.php', array('links' => $allLinks));
    }

    public function action_edit_links()
    {

        $links_id = $this->params[2];
        var_dump($links_id);


        $this -> content = $this -> Template('v/V_EditLink.php', array());
    }

    public function action_logout()
    {
        $mUsers = M_Users::Instance();
        $mUsers -> ClearSessions();
        $mUsers -> Logout();
        $this->redirect('/');
    }
}