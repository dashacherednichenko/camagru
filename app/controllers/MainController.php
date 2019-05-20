<?php

require_once 'app/components/Controller.class.php';

class MainController extends Controller
{
    public function actionIndex()
    {
        require_once 'app/view/templates/header.php';
        require_once 'app/model/gallery.php';
        require_once 'app/view/templates/footer.php';
        require_once 'app/view/templates/scripts.php';
        return true;
    }

//    public function actionGallery()
//    {
//        echo "TEST";
//        return true;
//    }
}


?>