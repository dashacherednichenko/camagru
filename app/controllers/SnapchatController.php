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
        $img = $_POST['userPhoto'];
        $imagemy = explode('data:image/png;base64,', $img)[1];
        $funMask = imagecreatefrompng($_POST['superposable']);
        $wmW=imagesx($funMask);

// imagesy - получает высоту изображения
        $wmH=imagesy($funMask);
        $image=imagecreatetruecolor($wmW, $wmH);
        $data = base64_decode($imagemy);

        $im = imagecreatefromstring($data);

        $cx=300;
        $cy=300;
        imagecopyresampled ($im, $funMask, $cx, $cy, 0, 0, $wmW, $wmH, $wmW, $wmH);

        /* imagejpeg - создаёт JPEG-файл filename из изображения image
        * третий параметр - качество нового изображение
        * параметр является необязательным и имеет диапазон значений
        * от 0 (наихудшее качество, наименьший файл)
        * до 100 (наилучшее качество, наибольший файл)
        * По умолчанию используется значение по умолчанию IJG quality (около 75)
        */
//        print_r(imagejpeg($image,$img,90));

        imagecopymerge($im, $funMask, 10, 10, 0, 0, 100, 47, 75);
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


////        $im = imagecreatefromstring($data);


// imagecreatetruecolor - создаёт новое изображение true color
//        $image=imagecreatetruecolor($wmW, $wmH);
////        //print_r($funMask);
////        imagecopyresampled($im, $funMask, 0, 0, 0, 0, imagesx($im), imagesy($funMask));
//////        list($width, $height) = getimagesize($filename);
//////        $new_width = $width * $percent;
//////        $new_height = $height * $percent;
//        header ("Content-type: image/jpeg");
//        echo $data;
////        imagepng($funMask);
////        imagedestroy($funMask);
////        die();
////        var_dump($funMask);
////        print_r($img);
    }
}
?>