<?php
class DB {
    
    public static function connectDB (){
     
    include_once ROOT.'/config/DB_param.php';
    $con = new PDO($dsn, $user, $password);
   
    return $con;  
    }   
    
}


