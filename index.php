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
    case 'linkStorage':
        $controller = new C_linkStorageAnon();
        break;
    default:
        $controller = new C_linkStorageAnon();
}

$controller -> Request($action, $params);
