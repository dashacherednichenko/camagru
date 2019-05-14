<?php
    session_start();
    define('ROOTPATH', dirname(__FILE__));
    define('HOST', 'http://localhost:8888');
    require_once 'app/lib/Dev.php';
    require_once 'app/components/Router.class.php';
    $router = new Router();
    $router->run();

//
//    $route = $_GET['route'];
//    require 'view/templates/header.php';
//    switch ($route){
//        case '':
//            require 'view/templates/main.php';
//            break;
//        case 'login':
//            require 'view/templates/welcome.php';
//            break;
//        case 'sendpassword':
//            require 'view/templates/forgetpassword.php';
//            break;
//        case 'create':
//            require 'view/templates/create_usr.php';
//            break;
//        case 'snapchat':
//            require 'view/templates/snapchat.php';
//            break;
//        default :
//            require 'view/templates/404error.php';
//            break;
//    }
//    require 'view/templates/footer.php';
//    switch ($route){
//        case 'create':
//            require 'view/templates/scripts_register.php';
//            break;
//        case 'snapchat':
//            require 'view/templates/scripts_snapchat.php';
//            break;
//        default :
//            require 'view/templates/scripts.php';
//            break;
//    }

?>