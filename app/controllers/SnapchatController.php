<?php

require_once 'app/components/Controller.class.php';

class SnapchatController extends Controller
{
    public function actionPage()
    {
        require_once 'app/view/templates/header.php';
        require_once 'app/view/templates/snapchat.php';
        require_once 'app/view/templates/footer.php';
        require_once 'app/view/templates/scripts_snapchat.php';
        return true;
    }

    public function actionPhoto()
    {
//        print_r($_POST);
        $img = $_POST['userPhoto'];
        $imagemy = explode('data:image/png;base64,', $img)[1];
        $funMask = imagecreatefrompng($_POST['superposable']);
        $name = md5($_POST['userEmail']).time();
        $maskwidth = imagesx($funMask);
        $maskusrwidth = $_POST['maskWidth'];
        $maskheight = imagesy($funMask);
        $maskusrheight = $_POST['maskHeight'];
        $data = base64_decode($imagemy);
        $im = imagecreatefromstring($data);
        $left = explode('px', $_POST['maskLeft'])[0];
        $top = explode('px', $_POST['maskTop'])[0];
        imagecopyresampled ($im, $funMask, $left, $top, 0, 0, $maskusrwidth, $maskusrheight, $maskwidth, $maskheight);

//        header('Content-Type: image/png');
//        imagepng($im);
        $save = "public/images/tmp/". strtolower($name) .".png";
//        echo $save;
        chmod($save,0755);
        imagepng($im, $save, 0, NULL);
        imagedestroy($im);
        imagedestroy($funMask);
        $_SESSION['photo'] = $save;
        header("Location: /camagru/snapchat");
    }
    public function actionDeletetmpphoto(){
        unlink($_SESSION['photo']);
        $_SESSION['photo'] = '';
        return true;
    }

    public function actionPublishphoto(){
        require_once "app/model/savePhoto.php";
        savePhoto($_SESSION['email']);
        $_SESSION['photo'] = '';
        header("Location: /camagru/");
        return true;
    }
}
?>