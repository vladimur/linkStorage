<?php

    include_once('config.php');
    session_start();

    $address = $_GET['q'];
    $address = explode('/', $address);



    $controller = 'C_';
    switch( $address[0] )
    {
        case 'link':
            $controller .= 'Link_Storage';
            break;

        default:
            $controller .= 'Link_Storage_def';
    }

    $action = 'action_';
    switch( $address[1] )
    {
        case 'all-links':
            $action .= 'get_all_links';
            break;

        default:
            $action .= 'index_def';
    }

    echo $controller, '<br>', $action;