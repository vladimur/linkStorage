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
        $this -> needLogin = true;
        parent::before();
    }

    public function action_own_page()
    {
        $mUsers   = M_Users::Instance() -> GetUser();
        $links    = M_linkStorage::Instance();
        $allLinks = $links -> Allmy( $mUsers['login'] );

        $this -> content = $this -> Template( 'v/V_MyPage.php', array( 'links' => $allLinks ) );
    }

    public function action_edit_links()
    {

        $links_id = $this -> params[2];
        $links    = M_linkStorage::Instance();
        $Link     = $links -> Get($links_id);

        if ( $_POST['name'] ) {
            $success = $links -> Edit( $links_id, $_POST['name'], $_POST['address'], $_POST['description'], $_POST['status'] );
            $_SESSION['link_edit_success'] = $success;
            $this  -> redirect('/user/edit_links/' . $links_id);
        }

        $this -> content = $this -> Template( 'v/V_EditLink.php', array( 'link' => $Link, 'success' => $_SESSION['link_edit_success'] ) );

    }

    public function action_view_links()
    {

        $links_id = $this -> params[2];
        $links    = M_linkStorage::Instance();
        $Link     = $links -> Get($links_id);

        $this -> content = $this -> Template( 'v/V_viewLink.php', array( 'link' => $Link ) );

    }


    public function action_add_links()
    {
        $links = M_linkStorage::Instance();
        $user  = M_Users::Instance() -> GetUser();

        if ( $_POST['name'] ) {
            $success = $links -> Add( $_POST['name'], $_POST['address'], $_POST['description'], $_POST['status'], $user['first_name'] );
            $_SESSION['link_add_success'] = $success;
        }

        $this -> content = $this -> Template( 'v/V_AddLink.php', array() );

    }

    public function action_delete_links()
    {

        $links_id = $this -> params[2];
        $links    = M_linkStorage::Instance();
        $Link     = $links -> Delete($links_id);

        $this -> content = $this -> Template( 'v/V_deleteLink.php', array( 'success' => $Link ) );

    }

    public function action_my_profile()
    {
        $user =  M_Users::Instance() -> GetUser();
        $this -> content = $this -> Template( 'v/V_myProfile.php', array( 'user' => $user ) );

    }

    public function action_edit_my_profile()
    {
        $user_id = $this -> params[2];
        $user  = M_Users::Instance() -> GetUser($user_id);

        if ( $_POST['name'] ) {
            //$success = $user -> Edit( $links_id, $_POST['name'], $_POST['address'], $_POST['description'], $_POST['status'] );
            //$_SESSION['profile_edit_success'] = $success;
            $this  -> redirect('/user/edit_links/' . $user_id);
        }

        $this -> content = $this -> Template( 'v/V_editMyProfile.php', array( 'user' => $user, 'success' => $_SESSION['profile_edit_success'] ) );
    }

    public function action_logout()
    {
        $mUsers =  M_Users::Instance();
        $mUsers -> ClearSessions();
        $mUsers -> Logout();
        $this   -> redirect('/');
    }
}