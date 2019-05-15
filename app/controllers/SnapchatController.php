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
        $maskwidth = imagesx($funMask);
        $maskusrwidth = $_POST['maskWidth'];
        $maskheight = imagesy($funMask);
        $maskusrheight = $_POST['maskHeight'];
        $data = base64_decode($imagemy);
        $im = imagecreatefromstring($data);
        $left = explode('px', $_POST['maskLeft'])[0];
        $top = explode('px', $_POST['maskTop'])[0];
        imagecopyresampled ($im, $funMask, $left, $top, 0, 0, $maskusrwidth, $maskusrheight, $maskwidth, $maskheight);

//        imagecopymerge($im, $funMask, 0, 0, 0, 0, $maskusrwidth, $maskusrheight, 0);
        header('Content-Type: image/gif');
        imagepng($im);

        imagedestroy($im);
        imagedestroy($funMask);

//        echo "<img src=\"imagecopymerge\" alt=\"\" />";
// imagedestroy - освобождает память
//        imagedestroy($image);
//
//        imagedestroy($funMask);
//        echo $image;

//        $data = base64_encode($image);
//        $tag = '<img src="data:image/png;base64,'. $data.'" />';
//        echo $tag;
//        $src = 'data: image/png;base64,'.$image;
//        echo "<img src=\"$src\" alt=\"\" />";

    }
}
?>