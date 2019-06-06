<?php
defined('SECRET_KEY') or die('No direct access allowed.');
class Router
{
    protected $routes;
    protected $params;

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

    private function match(){
        $url = $this->getURI();
        $urlarray = explode('camagru/', $url);
        if (isset($urlarray[1]))
            $url = $urlarray[1];
        else
            $url = '';

        foreach ($this->routes as $uriPattern => $path){
            if (preg_match("~^$uriPattern$~", $url)
                || preg_match("~^$uriPattern\?(.*)+$~", $url)) {
                $this->params = $path;
                return true;
            }
        }
        return false;
    }

    public function run(){

        if ($this->match()) {
            $segments = explode('/', $this->params);
            $controllerName = ucfirst(array_shift($segments).'Controller');
            $controllerFile = 'app/controllers/'.$controllerName.'.php';
            if (file_exists($controllerFile)) {
                include_once ($controllerFile);
                $actionName = 'action'.ucfirst(array_shift($segments));
                if(method_exists($controllerName, $actionName)) {
                    $controllerObject = new $controllerName($this->params);
                    $controllerObject->$actionName();
                }
                else
                    echo "not found ". $actionName;
            }
            else
                echo "not found ". $controllerFile;
        }
        else {
            require_once 'app/view/templates/header.php';
            require_once 'app/view/templates/404error.php';
            require_once 'app/view/templates/footer.php';
        }
    }
}
?>