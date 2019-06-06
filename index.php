<?php
    session_start();
    define('ROOTPATH', dirname(__FILE__));
	define('SECRET_KEY', 1);
    define('HOST', 'http://localhost:8100');
//    define('HOST', 'http://localhost:8888');
    require_once 'app/lib/Dev.php';
    require_once 'app/components/Router.class.php';
    $router = new Router();
    $router->run();
?>