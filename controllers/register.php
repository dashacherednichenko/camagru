<?php
    require_once "../model/addUser.php";
    session_start();
    if ($_POST['submit'] == 'Register') {
        $errors = array();
        if (isset($_POST['email']) && !empty($_POST['email'])){

        }
        else {
            $errors[] = "Заполните 'E-mail'!";
        }

        if(isset($_POST['username']) && !empty($_POST['username'])){
            if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['username'])) {
                $errors[] = "Логін має містити лише літери англійської абетки та цифри";
            }
            if (strlen($_POST['username']) < 3 or strlen($_POST['username']) > 20) {
                $errors[] = "Логин должен быть не меньше 3-х символов и не больше 20";
            }
        }
        else {
            $errors[] = "Заполните 'Username'!";
        }

        if (isset($_POST['password']) && !empty($_POST['password'])){

        }
        else {
            $errors[] = "Заполните 'Password'!";
        }
    }
    if (count($errors) == 0) {
        if (addUser($_POST['email'], $_POST['username'], $_POST['password']) == 1) {
            $_SESSION['error_user'] = NULL;
            $_SESSION['login'] =$_POST['username'];
            $_SESSION['password'] =$_POST['password'];
            $_SESSION['email'] =$_POST['email'];
            header("Location: /camagru/");
        }
        else {
            $_SESSION['error_user'] = $_POST['email'];
            header("Location: /camagru/create");
        }
    }
    else {


        header("Location: /camagru/create");
//        print "<div><b>При регистрации произошли следующие ошибки:</b><br>";
//        foreach ($errors AS $error) {
//            print $error . "<br>";
//        }
//        print("</div>");
    }
?>