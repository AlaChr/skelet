<?php
//require_once (ROOT.'/components/resize_image.php');
/**
 * Description of User
 *
 * @author OOASU
 */
//fields table: id, nameuser, password, email, salt, hash_key, createdata, status, access, path
class User {
    
    static $can;
    
    public static function saveUser(){
    
    // обработка аватарки проверка что это картинка
    if ($_FILES){$result = Validation::check_img($_FILES['uploadfile']['tmp_name']);}  
    
    if (!empty($_FILES) && $result) {
    $uploaddir = './files/';
        
    //добавляем 'time' в имя на случай совпадения имен файлов
    $segments = explode('.',$_FILES['uploadfile']['name']);
    $seq = array_shift($segments).time();
    $newname = $seq.'.'.array_shift($segments);
    
    $uploadfile = $uploaddir.$newname;
    copy($_FILES['uploadfile']['tmp_name'], $uploadfile);
    resize($uploadfile,'',70);
    $uploadfile = substr($uploadfile, 1);
    }
    else {$uploadfile = NULL;}

    // обработка имя, пароль и емаил
    if ($_POST) {
        $nameuser = $_POST['user'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        
        $nameuser = Validation::clear($nameuser);
        $email = Validation::clear($email);
        $pass = Validation::clear($pass);
        
        $salt = uniqid(rand(), 1);
               
        $password = md5(md5($pass).$salt);
        $checknameuser = Validation::check_length($nameuser,5,20);
        $checkemaildata = Validation::check_length($email,5,20);
        $checkemail = Validation::validation_email($email);
                      
        if (!empty($nameuser)&&!empty($password)&&!empty($email)&&$checknameuser&&$checkemaildata&&$checkemail){
            $con = self::$can = DB::connectDB();
            $res_sort = $con->prepare("SELECT nameuser FROM user WHERE nameuser = :nameuser");
            $res_sort->bindValue(':nameuser', $nameuser, PDO::PARAM_STR);
            $res_sort->execute();
            $result_sort = $res_sort->fetch(PDO::FETCH_ASSOC);
            if (!is_array($result_sort)) {
                $res = $con->prepare("INSERT INTO user VALUES (NULL,:nameuser,'$password',:email,'$salt', null, now(), null, 0, 'quest', '$uploadfile')");
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
            
            $nameuser = Validation::clear($nameuser);
            $pass = Validation::clear($pass);            
            
            if (!empty($nameuser) && !empty($pass)){
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
