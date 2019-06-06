<?php
defined('SECRET_KEY') or die('No direct access allowed.');
require_once 'app/components/Controller.class.php';

class AdminController extends Controller
{
    function __construct()
    {
    }

    public function actionPage()
    {
        require_once 'app/view/templates/header.php';
        require_once 'app/view/templates/admin.php';
        require_once 'app/view/templates/footer.php';
        require_once 'app/view/templates/scripts.php';
        return true;
    }

    public function actionAuth()
    {
        if (isset($_POST['submit']) && $_POST['submit'] == 'Login') {
            $password = $_POST['password'];
            if ($password == '12345')
            {
                $_SESSION['admin'] = 1;
                header("Location: /camagru/admin");
            }
        }
    }

    public function actionDeletedb()
    {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            require_once "app/model/deletedb.php";
            require_once 'app/model/clearSession.php';
            deletedb();
            clearSession();
            session_start();
            $_SESSION['admin'] = 1;
            header("Location: /camagru/admin");
        }
    }

    public function actionRewritedb()
    {
        require_once "app/model/rewritedb.php";
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
            firstfillingDB();
            header("Location: /camagru");
        }
    }
}
