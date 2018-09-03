<?php

class Router
{
    private $routes;
    
    public function __construct() 
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include ($routesPath); //получает массив uri
        
    }
    
    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        
    }
    
    public function run() {
    $uri = $this->getURI();
    $valuefound = FALSE;        // для проверки наличия элемента в массиве
        
    foreach ($this->routes as $uriPattern => $path){
       
        if ((preg_match("~$uriPattern~", $uri))) {
            $template=$uri;
            $valuefound = TRUE;                    
            $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
            
            $segments = explode('/', $internalRoute);
            
            $controllerName = array_shift($segments).'Controller';
            
            $controllerName = ucfirst($controllerName);
            $actionName = 'action'.ucfirst(array_shift($segments));
                       
            // проверяем в конце массива число или нет
            $res = explode('/', $template);
            $checkfornum = end($res);               // для проверки в конце число
            $checkforpag = end($res);               // для проверки на параметр пагинации
            
            if (preg_match("~^p[0-9]+~", $checkforpag)) {
                $resultp = intval(preg_replace("~p~",'',$checkforpag));
                $_SESSION['PAGINATION_PARAMETER'] = $resultp;
                
                $checkfornum = prev($res);
                
            }
            if (preg_match("~^[0-9]+~", $checkfornum)) {
                $_SESSION['URI_PARAMETER'] = $checkfornum;
                $parameters[] = $checkfornum;
            }
            else {$parameters = $segments;}
            
            $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
            
            if (file_exists($controllerFile)) {
                include_once ($controllerFile);
            }
            
            $controllerObject = new $controllerName;
            $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
            
            if ($result != null) {
                break;
            }
        }
               
        }
        if ($valuefound == FALSE) {
            include_once (ROOT.'/views/index.php');
        }
    }
       
    
}
