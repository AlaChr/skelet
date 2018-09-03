<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//Подключение файла Router
define('ROOT', dirname(__FILE__));

require_once (ROOT.'/components/Router.php');
require_once (ROOT.'/components/validation.php');
require_once (ROOT.'/components/DB_connect.php');
require_once (ROOT.'/components/Pagination.php');
require_once (ROOT.'/components/resize_image.php');
require_once (ROOT.'/models/User.php');
require_once (ROOT.'/models/Forum.php');




   
session_start();
$router = new Router();
$router->run();
?>