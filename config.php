<?php

function __autoload($classname)
{
    switch($classname[0]) {
        case 'C':
            if (file_exists("c/$classname.php")) include_once("c/$classname.php");
            break;
        case 'M':
            if (file_exists("m/$classname.php")) include_once("m/$classname.php");
            break;
    }
}

define('BASE_URL', '/project/');
define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', 'mysql');
define('MYSQL_DB', '');