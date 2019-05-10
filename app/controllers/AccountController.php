<?php
//print_r($_POST);
class AccountController
{
    public function actionLogin()
    {
        require_once 'app/view/templates/header.php';
        require_once 'app/view/templates/welcome.php';
        require_once 'app/view/templates/footer.php';
        require_once 'app/view/templates/scripts.php';
        return true;
    }

    public function actionLogout()
    {
        if ($_SESSION['email'] &&  $_SESSION['email'] !== NULL){
            $_SESSION['email'] = NULL;
            $_SESSION['login'] = NULL;
        }
        header("Location: /camagru/");
    }

    public function actionAuth()
    {
        require_once 'app/model/auth.php';
        return true;
    }

    public function actionRegister()
    {
        require_once 'app/view/templates/header.php';
        require_once "app/view/templates/create_usr.php";
        require_once 'app/view/templates/footer.php';
        require_once 'app/view/templates/scripts.php';
        return true;
    }
}

//require_once "../model/auth.php";
//session_start();
//if ($_POST['submit'] == 'Login') {
//    $password = md5(md5(trim($_POST['password'])));
//    if (($login = auth($_POST['email'], $password)) != NULL && $login != -1){
//        $_SESSION['error_user'] = NULL;
//        $_SESSION['error_login'] = NULL;
//        $_SESSION['error_activation'] = NULL;
//        $_SESSION['email'] = $_POST['email'];
//        $_SESSION['login'] = $login;
//        header("Location: /camagru/");
//    }
//    else if ($login == NULL){
//        $_SESSION['error_login'] = $_POST['email'];
//        header("Location: /camagru/login");
//    }
//    else {
//        $_SESSION['error_activation'] = $_POST['email'];
//        header("Location: /camagru/login");
//    }
//}
//else {
//    header("Location: /camagru/login");
//}

?>