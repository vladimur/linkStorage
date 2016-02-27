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
        // $this->needLogin = true;
        parent::before();
    }

    public function action_index()
    {
        $links = M_linkStorage::Instance();
        $allLinks = $links->All();

        foreach($allLinks as $key => $link)
        {
            if ($link['status'] == 'private') {
                unset($allLinks[$key]);
            }
        }

        $this -> content = $this -> Template('v/V_Index.php', array( 'links' => $allLinks ));
    }

    public function action_registration()
    {
        if ($_POST['e-mail']) {
            $mUser = M_Users::Instance();

            if ($mUser->Registration($_POST['login'], $_POST['password'], $_POST['first_name'], $_POST['last_name'], $_POST['e-mail']))
            {
                $error = false;
            } else {
                $error = true;
            }
        }

        $this -> content = $this -> Template('v/V_Registration.php', array("error" => $error));
    }
}