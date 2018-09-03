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
            
            $PAGINATIONPAGE = $_SESSION['PAGINATION_PARAMETER'];
            if ($PAGINATIONPAGE==1){
                $holdlimit = 0;
            }
            else {
                $holdlimit = $PAGINATIONPAGE*10-10;
                 }
            $template = "SELECT forum_theme.id, forum_theme.name_theme, forum_theme.data_create, user.nameuser, forum_theme.count  FROM forum_theme, user WHERE forum_theme.id_author = user.id ORDER BY forum_theme.data_create DESC LIMIT $holdlimit,10";
            $res = self::$can->query($template);
            $result = $res->fetchall(PDO::FETCH_ASSOC);
            
            $template = "SELECT COUNT(*) FROM forum_theme";
            $count = self::$can->query($template);
            $count = implode($count->fetch(PDO::FETCH_ASSOC));
            
                        
            $url_page='forumtheme/p';
            $count_show_pages = 5;
            
            
        return array ($result, $count, $PAGINATIONPAGE, $count_show_pages, $url_page);
        }    
        
    }
    
    //запись новой темы форума
    public static function saveTheme() {
        if ($_POST) {
            $nametheme = $_POST['theme'];
            $nametheme = Validation::clear($nametheme);
            $checkhss = Validation::check_length($nametheme,5,100);
            
                        if (!empty($nametheme) && $checkhss && isset($_SESSION['iduser'])){
                            $con = self::$can = DB::connectDB();
                            
                            $nameuser = $_SESSION['iduser'];
                            $res = $con->prepare("SELECT id FROM user WHERE nameuser = :nameuser");
                            $res->bindValue(':nameuser', $nameuser, PDO::PARAM_STR);
                            $res->execute();
                            $id_author = implode($res->fetch(PDO::FETCH_ASSOC));
                            
                            $res = $con->prepare("INSERT INTO forum_theme VALUES (NULL,:nametheme, now(),:id_author,1,0)");
                            $res->bindValue(':nametheme', $nametheme, PDO::PARAM_STR);
                            $res->bindValue(':id_author', $id_author, PDO::PARAM_INT);
                            $res->execute();
                            
                //$result = Forum::viewTheme();
                //return $result;
            }
        }
    } 
    
      // вывод содержания темы форума
    public static function viewContent($id_theme){
        self::$id_theme=$id_theme;
        if (self::$can == FALSE) {
            $con = self::$can = DB::connectDB();
            // получаем количество записей в теме
            $count = $con->prepare("SELECT COUNT(*) FROM forum_comment WHERE id_theme = :id_theme");
            $count->bindValue(':id_theme', $id_theme, PDO::PARAM_INT);
            $count->execute();
            $count = implode($count->fetch(PDO::FETCH_ASSOC));
            
            // получаем данные о теме
            $template = $con->prepare("SELECT * FROM forum_theme WHERE id = :id_theme");
            $template->bindValue(':id_theme', $id_theme, PDO::PARAM_INT);
            $template->execute();
            $theme = $template->fetchall(PDO::FETCH_ASSOC);
            
            $PAGINATIONPAGE = $_SESSION['PAGINATION_PARAMETER'];
            if ($PAGINATIONPAGE==1){
                $holdlimit = 0;
            }
            else {
                $holdlimit = $PAGINATIONPAGE*10-10;
            }
            $res = $con->prepare("SELECT forum_comment.content,forum_comment.data_create, user.nameuser, user.path FROM forum_comment JOIN user ON forum_comment.id_author = user.id WHERE forum_comment.id_theme = :id_theme ORDER BY forum_comment.data_create DESC LIMIT $holdlimit,10");
            $res->bindValue(':id_theme', $id_theme, PDO::PARAM_INT);
            $res->execute();
            $result = $res->fetchall(PDO::FETCH_ASSOC);
            
            $url_page='forumcontent/'.$id_theme.'/p';
            $count_show_pages = 5;
            
            
        return array ($theme, $result, $count, $PAGINATIONPAGE, $count_show_pages, $url_page);
        }
     
    }
    
    //запись нового комментария в тему форума
    public static function saveContent() {
         if ($_POST) {
            $content = $_POST['content'];
            $content = Validation::clear($content);
                    if (!empty($content) && isset($_SESSION['iduser'])){
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
