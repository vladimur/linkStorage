<?php

include_once('config.php');
session_start();

$info   = explode('/', $_GET['q']);
$params = array();

foreach ($info as $v) {
    if ($v != '') {
        $params[] = $v;
    }
}

$action = 'action_';
$action .= (isset($params[1])) ? $params[1] : 'index';




$controller = new C_Article();



/*switch ($params[0])
{
    case 'article':
        $controller = new C_Article();
        echo 'dfdf';
        break;
    default:
        $controller = new C_Article();
        echo 'dfdf';
}*/

$controller -> Request($action, $params);