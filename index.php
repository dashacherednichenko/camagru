<?php
    session_start();
    $route = $_GET['route'];
    require 'view/templates/header.php';
    switch ($route){
        case '':
            require 'view/templates/main.php';
            break;
        case 'login':
            require 'view/templates/welcome.php';
            break;
        case 'create':
            require 'view/templates/create_usr.php';
            break;
        case 'logout':
            require 'controllers/logout.php';
            break;
        default :
            require 'view/templates/404error.php';
            break;
    }
    require 'view/templates/footer.php';
    switch ($route){
        case 'create':
            require 'view/templates/scripts_register.php';
            break;
        default :
            require 'view/templates/scripts.php';
            break;
    }

?>