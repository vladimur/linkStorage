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

    public function AllMy($login)
    {
        $login = trim(htmlspecialchars($login));
        $query = "SELECT * FROM links WHERE author='$login'";
        $result = $this -> msql -> Select($query);
        $arr = $result;
        for($i = 0; $i < count($arr) - 1;$i++) {
            if ($arr[$i]['user'] == $login) $qwe[] = $arr[$i];
        }
        return $arr;
    }

    public function Get($id)
    {
        $id = (int)$id;
        if ($id < 0) return false;
        $t = "SELECT * FROM links WHERE id = '%d'";
        $query = sprintf($t, $id);
        $result = $this -> msql -> Select($query);
        return $result[0];
    }

    public function Edit($id_link, $title, $content)
    {

        $title = trim(htmlspecialchars($title));
        $content = trim(htmlspecialchars($content));
        $id = (int)$id_link;
        if ($id < 0) return false;

        if ($title == '' || $content == '') return false;

        $links = array();
        $links['title'] = $title;
        $links['content'] = $content;

        $t = "id = '%d'";
        $where = sprintf($t, $id);
        $this -> msql -> Update('links', $links, $where);
        return true;
    }

    public function Delete($id_link)
    {
        $id = (int)$id_link;
        if ($id < 0) return false;

        $t = "id = '%d'";
        $where = sprintf($t, $id);
        $this -> msql -> Delete('links', $where);
        return true;
    }



    // чо происходит ?
    public function Add($title, $content, $user)
    {
        $title = trim(htmlspecialchars($title));
        $content = trim(htmlspecialchars($content));

        if ($title == '' || $content =='') return false;

        $link = array();
        $link['title'] = $title;
        $link['content'] = $content;
        $link['user'] = $_COOKIE['greeting'];
        date_default_timezone_set('Asia/Novosibirsk');
        $link['data'] = date("Y-m-d H:i:s");
        $link['user'] = $user;

        $this -> msql -> Insert('links', $link);
        return true;
    }

}