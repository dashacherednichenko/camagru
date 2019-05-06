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
        $hash_pass = md5(md5(trim($_POST['password'])));
        if (addUser($_POST['email'], $_POST['username'], $hash_pass) == 1) {
            echo    "An e-mail with a link has been sent to your e-mail to confirm the registration. <a href='/camagru/'>Main page</a>";
//            $_SESSION['error_user'] = NULL;
              $_SESSION['error_login'] = NULL;
//            $_SESSION['email'] = $_POST['email'];
//            $_SESSION['login'] = $_POST['username'];
//            header("Location: /camagru/");
        }
        else {
            $_SESSION['error_user'] = $_POST['email'];
            header("Location: /camagru/create");
        }
    }
    else {
        header("Location: /camagru/create");
    }
?>