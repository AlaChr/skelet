<?php

/**
 * Description of User
 *
 * @author OOASU
 */
//fields table: id, nameuser, password, email, salt, hash_key, createdata, status, access
class User {
    
    static $can;
    
    public static function saveUser(){
        if ($_POST) {
        $nameuser = $_POST['user'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        
        $salt = uniqid(rand(), 1);
                
        $password = md5(md5($pass).$salt);
        $checknameuser = Validation::validation_inputdata($nameuser,5,20);
        $checkemaildata = Validation::validation_inputdata($email,5,20);
        $checkemail = Validation::validation_email($email);
                      
        if (!is_string($checknameuser)&&!is_string($checkemaildata)&&!is_string($checkemail)){
            $con = self::$can = DB::connectDB();
            $res_sort = $con->prepare("SELECT nameuser FROM user WHERE nameuser = :nameuser");
            $res_sort->bindValue(':nameuser', $nameuser, PDO::PARAM_STR);
            $res_sort->execute();
            $result_sort = $res_sort->fetch(PDO::FETCH_ASSOC);
            if (!is_array($result_sort)) {
                $res = $con->prepare("INSERT INTO user VALUES (NULL,:nameuser,'$password',:email,'$salt', null, now(), null, 0, 'quest')");
                $res->bindValue(':nameuser', $nameuser, PDO::PARAM_STR);
                $res->bindValue(':email', $email, PDO::PARAM_STR);
                $res->execute();
            }
            else {echo 'Пользователь с таким логином существует';}
        }  
        }
    }
    
    public static function authorizationUser() {
        if ($_POST) {
            $nameuser = $_POST['user'];
            $pass = $_POST['password'];
                    
            $checkhss = Validation::validation_inputdata($nameuser,5,20);
            if (!is_string($checkhss)){
                $con = self::$can = DB::connectDB();
                $res = $con->prepare("SELECT * FROM user WHERE nameuser = :nameuser");
                $res->bindValue('nameuser', $nameuser, PDO::PARAM_STR);
                $res->execute();
                $result = $res->fetch(PDO::FETCH_ASSOC); 
                if (is_array($result) && $result['password']==md5(md5($pass).$result['salt'])) {
                
                $_SESSION['iduser'] = $result['nameuser'];
                echo "Приветствуем вас на сайте '$nameuser'";
                }
            
            }
        }
    } 
    
    public static function unlogUser() {
        
        unset($_SESSION['iduser']);
        
    }
    
    
}
