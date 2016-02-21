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

switch ($params[0])
{
    case 'anon':
        $controller = new C_linkStorageAnon();
        break;
    case 'user':
        $controller = new C_linkStorageUser();
        break;
    default:
        $controller = new C_linkStorageAnon();
}

$controller -> Request($action, $params);
