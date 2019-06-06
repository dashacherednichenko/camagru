<?php
defined('SECRET_KEY') or die('No direct access allowed.');
function clearSession(){
//    session_start();


    session_destroy();


//    $_SESSION['error_user'] = NULL;
//    $_SESSION['error_login'] = NULL;
//    $_SESSION['error_activation'] = NULL;
//    $_SESSION['email'] = NULL;
//    $_SESSION['login'] = NULL;
}
?>
