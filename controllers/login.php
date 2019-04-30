<?php
print_r($_POST);
require_once "../model/auth.php";
session_start();
if ($_POST['submit'] == 'Login') {
    $password = md5(md5(trim($_POST['password'])));
    if (($login = auth($_POST['email'], $password)) != 0){
        $_SESSION['error_user'] = NULL;
        $_SESSION['error_login'] = NULL;
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['login'] = $login;
        header("Location: /camagru/");
    }
    else {
        $_SESSION['error_login'] = $_POST['email'];
        header("Location: /camagru/login");
    }
}
else {
    header("Location: /camagru/login");
}

?>