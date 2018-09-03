<?php
include_once ROOT.'/models/Forum.php';

 
class ForumController {   
    static $id;
    
    public function actionIndex()
    {
        $forumtheme = Forum::viewTheme();
        include ROOT.'/views/forum/index.php';
    }
    
    public function actionCreatetheme()
    {      
        
        Forum::saveTheme();
        $idp = 'p'.$_SESSION['PAGINATION_PARAMETER'];
        header("location:/forumtheme/$idp");
        
    }    
    
    public function actionContent($id)
    {            
        $forumcontent = Forum::viewContent($id);
        
       include ROOT.'/views/forum/themecontent.php';
    }
    
    public function actionCreatecontent()
    {      
       Forum::saveContent();
       $id = $_SESSION['URI_PARAMETER'];
       $idp = 'p'.$_SESSION['PAGINATION_PARAMETER'];
       header("location:/forumcontent/$id/$idp");
             
    }
            
}
