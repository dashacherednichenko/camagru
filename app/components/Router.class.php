<?php
class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = 'app/config/routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

//    public function add($route, $params){
//
//    }
//
//    public function match(){
//
//    }

    public function run(){
        $url = $this->getURI();
        foreach ($this->routes as $uriPattern => $path){
            if (preg_match("~$uriPattern~", $url)) {
                $segments = explode('/', $path);
                $controllerName = ucfirst(array_shift($segments).'Controller');
                $actionName = 'action'.ucfirst(array_shift($segments));
                $controllerFile = 'app/controllers/'.$controllerName.'.php';
                if (file_exists($controllerFile)) {
                    include_once ($controllerFile);
                }

                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if ($result != null){
                    break;
                }

//                echo $controllerFile."\n";
//                echo $controllerName."\n";
//                echo $actionName."\n";
//                echo $path;
            }
//            else {
//                require_once 'app/view/templates/header.php';
//                require_once 'app/view/templates/404error.php';
//                require_once 'app/view/templates/footer.php';
//                require_once 'app/view/templates/scripts.php';
//            }
        }
    }
}
?>