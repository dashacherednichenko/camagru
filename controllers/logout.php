<?php
session_start();
if ( $_SESSION['email'] &&  $_SESSION['email'] !== NULL){
        $_SESSION['email'] = NULL;
        $_SESSION['login'] = NULL;
    }
header("Location: /camagru/");
?>