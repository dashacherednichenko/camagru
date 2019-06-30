<?php
defined('SECRET_KEY') or die('No direct access allowed.');
require_once 'app/components/Controller.class.php';

class AccountController extends Controller
{
    public function actionLogin()
    {
        require_once 'app/view/templates/header.php';
        require_once 'app/view/templates/welcome.php';
        require_once 'app/view/templates/footer.php';
        require_once 'app/view/templates/scripts/scripts.php';
        return true;
    }

    public function actionLogout()
    {
        if ($_SESSION['email'] &&  $_SESSION['email'] !== NULL){
            require_once 'app/model/clearSession.php';
            clearSession();
        }
        header("Location: /camagru/");
    }

    public function actionAuth()
    {
        require_once 'app/model/auth.php';
        if (isset($_POST['submit']) && $_POST['submit'] == 'Login') {
            $password = $_POST['password'];
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
        require_once 'app/view/templates/scripts/scripts_register.php';
        return true;
    }

    public function actionAdduser()
    {
        require_once "app/model/addUser.php";
        if (isset($_POST['submit']) && $_POST['submit'] == 'Register') {
            $errors = array();
            if (isset($_POST['email']) && !empty($_POST['email'])){

            }
            else
                $errors[] = "Заполните 'E-mail'!";

            if(isset($_POST['username']) && !empty($_POST['username'])){
                if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['username']))
                    $errors[] = "Логін має містити лише літери англійської абетки та цифри";
                if (strlen($_POST['username']) < 3 or strlen($_POST['username']) > 20)
                    $errors[] = "Логин должен быть не меньше 3-х символов и не больше 20";
            }
            else
                $errors[] = "Заполните 'Username'!";

            if (isset($_POST['password']) && !empty($_POST['password'])){

            }
            else
                $errors[] = "Заполните 'Password'!";
        }
        if (isset($errors) && count($errors) == 0) {
            $hash_pass = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
            if (addUser($_POST['email'], $_POST['username'], $hash_pass) == 1) {
                require_once "app/view/templates/header.php";
                echo    "<div id='container'><div id='main_container'>An e-mail with a link has been sent to your e-mail to confirm the registration. 
                        <a href='/camagru/'>Main page</a></div></div>";
                require_once "app/view/templates/footer.php";
                $_SESSION['error_login'] = NULL;
            }
            else {
                $_SESSION['error_user'] = $_POST['email'];
                header("Location: /camagru/create");
            }
        }
        else
            header("Location: /camagru/create");
        return true;
    }

    public function actionForgetpassword()
    {
        require_once 'app/view/templates/header.php';
        require_once "app/view/templates/forgetpassword.php";
        require_once 'app/view/templates/footer.php';
        require_once 'app/view/templates/scripts/scripts.php';
        return true;
    }

    public function actionSendpassword()
    {
        require_once "app/model/clearSession.php";
        require_once "app/model/checkEmail.php";
        clearSession();
        if (checkEmail($_POST['email']) == 1) {
            require_once "app/view/templates/header.php";
            echo "<div id='container'><div id='main_container'>A link has been sent to your e-mail. <a href='/camagru/'>Main page</a></div></div>";
            require_once "app/view/templates/footer.php";
        }
        else {
            require_once "app/view/templates/header.php";
            echo "<div id='container'><div id='main_container'>incorrect e-mail or no active user. <a href='/camagru/'>Main page</a></div></div>";
            require_once "app/view/templates/footer.php";
        }
        return true;
    }

    public function actionChangepassword()
    {
        require_once "app/view/templates/header.php";
        require_once "app/model/newpassword.php";
        echo saveNewPass($_POST['id'], $_POST['code'], $_POST['password']);
        require_once "app/view/templates/footer.php";
    }

    public function actionDeletephoto()
    {
        require_once "app/model/deletephoto.php";
        $idphoto = $_GET['id'];
        $emailusr = $_GET['email'];
        deletephoto($idphoto, $emailusr);
        header("Location: /camagru/account");
    }

    public function actionChangedata()
    {
        require_once 'app/view/templates/header.php';
        require_once "app/view/templates/changedata.php";
        require_once 'app/view/templates/footer.php';
        require_once 'app/view/templates/scripts/scripts_changedata.php';
        return true;
    }

    public function actionSavenewdata()
    {
        require_once "app/model/savedata.php";
        $password = trim($_POST['oldpassword']);
        if (isset($_POST['email']) && $_POST['email'] != NULL) {
            if (saveData($_SESSION['email'], $password, $_POST['email'], $_POST['username'], $_POST['password']) == -1) {
                echo "WRONG PASSWORD";
            }
            else
                echo "SUCCESS";
        }
//        }
//            header("Location: /camagru/account");
        return true;
    }

    public function actionChangenotice(){
        require_once "app/model/chandenotice.php";
        changeNotice($_SESSION['email']);
        return true;
    }

    public static function checknotification($pdo)
    {
        require_once "app/model/checkNotification.php";
        if (checkNotification($_SESSION['email'], $pdo) == 1)
            return true;
        else
            return 0;
    }

    public function actionDeleteaccount()
    {
        require_once "app/model/deleteaccount.php";
        deleteacc($_SESSION['email']);
        header("Location: /camagru/");
        return true;
    }
}

?>