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
        $links    = M_linkStorage::Instance();
        $allLinks = $links -> All();

        foreach( $allLinks as $key => $link )
        {
            if ( $link['status'] == 'private' ) {
                unset( $allLinks[$key] );
            }
        }

        $this -> content = $this -> Template( 'v/V_Index.php', array( 'links' => $allLinks ) );
    }

    public function action_registration()
    {
        if ( $_POST['e-mail'] ) {
            $mUser = M_Users::Instance();

            if ($mUser -> Registration( $_POST['login'], $_POST['password'], $_POST['first_name'], $_POST['last_name'], $_POST['e-mail'] ) )
            {
                $error =  false;
                $this  -> redirect( "/" );
            } else {
                $error = true;
            }
        }

        $this -> content = $this -> Template( 'v/V_Registration.php', array( "error" => $error ) );
    }

    public function action_login()
    {
        $mUsers =  M_Users::Instance();
        $mUsers -> ClearSessions();
        $mUsers -> Logout();

        if ( !empty( $_POST['login'] ) )
        {
            if ( $mUsers -> Login( $_POST['login'], $_POST['password'], isset( $_POST['remember'] ) ) )
            {
                $_SESSION['online'] = true;
                $this -> redirect( "/user/own_page" );
                die();
            } else {
                    echo "    Something wrong :(    ";
            }
        }

        $this -> content = $this -> Template( 'v/V_Login.php', array() );
    }
}