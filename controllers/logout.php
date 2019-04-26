<?php
session_start();
if ( $_SESSION['login'] &&  $_SESSION['login'] !== NULL){
        $_SESSION['login'] = NULL;
        $_SESSION['password'] = NULL;
        $_SESSION['email'] = NULL;
    }
header("Location: /camagru/");
?>