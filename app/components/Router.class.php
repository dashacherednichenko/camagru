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
                $controllerFile = 'app/controllers/'.$controllerName.'.php';
                if (file_exists($controllerFile)) {
                    include_once ($controllerFile);
                    $actionName = 'action'.ucfirst(array_shift($segments));
                    if(method_exists($controllerName, $actionName)) {
                        $controllerObject = new $controllerName;
                        $result = $controllerObject->$actionName();
                        if ($result != null){
                            break;
                        }
                    }
                    else {
                        echo "not found ". $actionName;
                    }
                }
                else {
                    echo "not found ". $controllerFile;
                }
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