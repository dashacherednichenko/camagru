<?php
require_once 'app/components/Controller.class.php';

class AccountController extends Controller
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
        if (isset($_POST['submit']) && $_POST['submit'] == 'Login') {
            $password = md5(md5(trim($_POST['password'])));
            if (($login = auth($_POST['email'], $password)) != NULL && $login != -1){
                $_SESSION['error_user'] = NULL;
                $_SESSION['error_login'] = NULL;
                $_SESSION['error_activation'] = NULL;
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['login'] = $login;
                header("Location: /camagru/");
            }
            else if ($login == NULL){
                $_SESSION['error_login'] = $_POST['email'];
                header("Location: /camagru/account");
            }
            else {
                $_SESSION['error_activation'] = $_POST['email'];
                header("Location: /camagru/account");
            }
        }
        else {
            header("Location: /camagru/account");
        }
        return true;
    }

    public function actionRegister()
    {
        require_once 'app/view/templates/header.php';
        require_once "app/view/templates/create_usr.php";
        require_once 'app/view/templates/footer.php';
        require_once 'app/view/templates/scripts_register.php';
        return true;
    }

    public function actionAdduser()
    {
        require_once "app/model/addUser.php";
        if (isset($_POST['submit']) && $_POST['submit'] == 'Register') {
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
                $_SESSION['error_login'] = NULL;
            }
            else {
                $_SESSION['error_user'] = $_POST['email'];
                header("Location: /camagru/create");
            }
        }
        else {
            header("Location: /camagru/create");
        }
        return true;
    }

    public function actionForgetpassword()
    {
        require_once 'app/view/templates/header.php';
        require_once "app/view/templates/forgetpassword.php";
        require_once 'app/view/templates/footer.php';
        require_once 'app/view/templates/scripts.php';
        return true;
    }

    public function actionChangepassword()
    {
        require_once "app/view/templates/header.php";
        require_once "app/model/newpassword.php";
        echo saveNewPass($_POST['id'], $_POST['code'], $_POST['password']);
        require_once "app/view/templates/footer.php";
    }
}

//require_once "../model/auth.php";
//session_start();


?>