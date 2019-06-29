<?php
defined('SECRET_KEY') or die('No direct access allowed.');
require_once 'app/components/Controller.class.php';

class MainController extends Controller
{
    public function actionIndex()
    {
        require_once 'app/model/gallery.php';
        return true;
    }
}


?>