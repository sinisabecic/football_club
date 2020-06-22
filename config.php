<?php
/**
 * Created by Visual Studio Code.
 * User: sinisa
 * Date: 11.6.2020.
 * Time: 10.58
 */

if(!defined('DB_SERVER')){
    define('DB_SERVER', 'localhost');
}
if(!defined('DB_USERNAME')){
    define('DB_USERNAME', 'root');
}
if(!defined('DB_PASSWORD')){
    define('DB_PASSWORD', '');
}
if(!defined('DB_DATABASE')){
    define('DB_DATABASE', 'fudbalski_klub');
}
if(!defined('DB_PORT')){
    define('DB_PORT', 3306);
}
if(!defined('BASE_URL')){
    define('BASE_URL', $_SERVER['SERVER_NAME']);
}
