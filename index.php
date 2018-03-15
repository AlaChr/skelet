<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//Подключение файла Router
define('ROOT', dirname(__FILE__));

require_once (ROOT.'/components/Router.php');
require_once (ROOT.'/components/validation.php');
require_once (ROOT.'/components/DB_connect.php');
require_once (ROOT.'/models/User.php');
require_once (ROOT.'/models/Forum.php');




   
session_start();
$router = new Router();
$router->run();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="css/style.css" >
<title>КалаCh</title>
</head>
<body>
<div id="headerInner">
  <div class="logo">
     <a>Логотип</a>
  </div>
</div>
<!-- начало wrapper -->
<div id="wrapper">
   
       <div id="content">
                 
          
       </div><!-- конец content -->
   </div><!-- конец middle -->
</div><!-- конец wrapper -->
</body>
</html>

<!-- https://habrahabr.ru/sandbox/89063/ -->


