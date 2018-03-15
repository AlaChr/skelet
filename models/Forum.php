<?php

/**
 * Description of User
 *
 * @author OOASU
 */

class Forum {
    
    static $can;
    static $id_theme;
    
    // вывод названия тем форума
    public static function viewTheme(){
        // проверка на повторное подключение
        if (self::$can == FALSE) {
            self::$can = DB::connectDB();
            $template = "SELECT forum_theme.id, forum_theme.name_theme, forum_theme.data_create, user.nameuser, forum_theme.count  FROM forum_theme, user WHERE forum_theme.id_author = user.id";
            $res = self::$can->query($template);
            $result = $res->fetchall(PDO::FETCH_ASSOC);
            return $result;
        }    
        
    }
    
    //запись новой темы форума
    public static function saveTheme() {
        if ($_POST) {
            $nametheme = $_POST['theme'];
            $checkhss = Validation::validation_inputdata($nametheme,5,100);
            
                        if (!is_string($checkhss) && isset($_SESSION['nameuser'])){
                            $con = self::$can = DB::connectDB();
                            
                            $nameuser = $_SESSION['nameuser'];
                            $res = $con->prepare("SELECT id FROM user WHERE nameuser = :nameuser");
                            $res->bindValue(':nameuser', $nameuser, PDO::PARAM_STR);
                            $res->execute();
                            $id_author = implode($res->fetch(PDO::FETCH_ASSOC));
                            
                            $res = $con->prepare("INSERT INTO forum_theme VALUES (NULL,:nametheme, now(),:id_author,1,0)");
                            $res->bindValue(':nametheme', $nametheme, PDO::PARAM_STR);
                            $res->bindValue(':id_author', $id_author, PDO::PARAM_INT);
                            $res->execute();
                            
                $result = Forum::viewTheme();
                return $result;
            }
        }
    } 
    
      // вывод содержания темы форума
    public static function viewContent($id_theme){
        self::$id_theme=$id_theme;
        if (self::$can == FALSE) {
            $con = self::$can = DB::connectDB();
            $res = $con->prepare("SELECT * FROM forum_comment WHERE id_theme = :id_theme");
            $res->bindValue(':id_theme', $id_theme, PDO::PARAM_INT);
            $res->execute();
            $result = $res->fetchall(PDO::FETCH_ASSOC);
        return $result;
        }
     
    }
    
    //запись нового комментария в тему форума
    public static function saveContent() {
         if ($_POST) {
            $content = $_POST['content'];
            
            $checkhss = Validation::validation_text($content);
            
                        if (!is_string($checkhss)&&isset($_SESSION['iduser'])){
                            $con = self::$can = DB::connectDB();
                            
                            $nameuser = $_SESSION['iduser'];
                            
                            $res = $con->prepare("SELECT id FROM user WHERE nameuser = :nameuser");
                            $res->bindValue(':nameuser', $nameuser, PDO::PARAM_STR);
                            $res->execute();
                            $id_author = implode($res->fetch(PDO::FETCH_ASSOC));
                            
                            $id_theme = $_SESSION['URI_PARAMETER'];
                            $res = $con->prepare("INSERT INTO forum_comment VALUES (NULL,'$id_author', :id_theme, now(), :content,1)");
                            $res->bindValue(':id_theme', $id_theme, PDO::PARAM_STR);
                            $res->bindValue(':content', $content, PDO::PARAM_STR);
                            $res->execute();
                            
               
            }
        }
    } 
    
    
}
