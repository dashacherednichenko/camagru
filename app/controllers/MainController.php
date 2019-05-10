<?php
class MainController
{
    public function actionIndex()
    {
        require_once 'app/view/templates/header.php';
        require_once 'app/view/templates/main.php';
        require_once 'app/view/templates/footer.php';
        require_once 'app/view/templates/scripts.php';
        return true;
    }
}


?>