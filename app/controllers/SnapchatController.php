<?php
class SnapchatController{
    public function actionPage()
    {
    require_once 'app/view/templates/header.php';
    require_once 'app/view/templates/snapchat.php';
    require_once 'app/view/templates/footer.php';
    require_once 'app/view/templates/scripts_snapchat.php';
    return true;
    }
}
?>