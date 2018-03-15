<?php
include_once ROOT.'/models/User.php';
 
class UserController {   
    
    
    public function actionIndex()
    {
        
        echo 'класс User';
    }
    
    public function actionRegistration()
    {
       $as = User::saveUser();
       
        include ROOT.'/views/user/registration.php';
        
        
        
    }
    /**
    * Description of User
    *
    * @author OOASU
    */
    public function actionAuthorization()
    {
        $as = User::authorizationUser();
        
        include ROOT.'/views/user/authorization.php';
        
    }
     public function actionUnlog()
    {
        $as = User::unlogUser();
        
        include ROOT.'/views/user/authorization.php';
        
    }       
            
}
