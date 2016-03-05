<?php

include_once('../m/M_SQL.php');

class M_linkStorage
{
    private static $instance;
    private $msql;

    public function __construct()
    {
        $this -> msql = M_SQL::Instance();
    }

    public static function Instance()
    {
        if (self::$instance == null) self::$instance = new M_linkStorage();
        return self::$instance;
    }

    public function All()
    {
        $query = "SELECT * FROM links ORDER BY id";
        return $this -> msql -> Select($query);
    }

    public function AllMy( $login )
    {
        $login  = trim( htmlspecialchars( $login ) );
        $query  = "SELECT * FROM links WHERE author='$login'";
        $result = $this -> msql -> Select( $query );
        $arr    = $result;

        for( $i = 0; $i < count($arr) - 1;$i++ ) {
            if ( $arr[$i]['user'] == $login ) $qwe[] = $arr[$i];
        }
        return $arr;
    }

    public function Get( $id )
    {
        $id = (int)$id;
        if ( $id < 0 ) return false;
        $t      = "SELECT * FROM links WHERE id = '%d'";
        $query  = sprintf( $t, $id );
        $result = $this -> msql -> Select( $query );
        return $result[0];
    }

    public function Edit( $id_link, $title, $address, $content, $status )
    {

        $title   = trim( htmlspecialchars( $title ) );
        $address = trim( htmlspecialchars( $address ) );
        $content = trim( htmlspecialchars( $content ) );
        $status  = trim( htmlspecialchars( $status ) );

        $id = (int)$id_link;
        if ( $id < 0 ) return false;
        if ( $title == '' || $content == '' ) return false;

        $links = array();

        $links['name']        = $title;
        $links['address']     = $address;
        $links['description'] = $content;
        $links['status']      = $status;

        $t     =  "id = '%d'";
        $where =  sprintf( $t, $id );
        $this  -> msql -> Update( 'links', $links, $where );
        return true;
    }

    public function Delete( $id_link )
    {
        $id = (int)$id_link;
        if ( $id < 0 ) return false;

        $t     =  "id = '%d'";
        $where =  sprintf( $t, $id );
        $this  -> msql -> Delete( 'links', $where );
        return true;
    }

    public function Add( $title, $address, $content, $status, $user )
    {
        $title   = trim( htmlspecialchars( $title ) );
        $content = trim( htmlspecialchars( $content ) );
        $address = trim( htmlspecialchars( $address ) );
        $status  = trim( htmlspecialchars( $status ) );

        if ( $title == '' || $content =='' ) return false;

        $link = array();

        $link['name']        = $title;
        $link['description'] = $content;
        $link['author']      = $user;
        $link['address']     = $address;
        $link['status']      = $status;

        $this -> msql -> Insert( 'links', $link );
        return true;
    }

}