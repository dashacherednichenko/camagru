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

    public function actionDownloadphoto(){
//        print_r($_FILES['downloadphoto']);
        $filePath  = $_FILES['downloadphoto']['tmp_name'];
//        print_r($filePath);
        $errorCode = $_FILES['downloadphoto']['error'];
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

            $errorMessages = [
                UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
                UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
                UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
            ];

            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;

            die($outputMessage);
        }

        $fi = finfo_open(FILEINFO_MIME_TYPE);
        $mime = (string) finfo_file($fi, $filePath);
        if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');
        $image = getimagesize($filePath);

        $limitBytes  = 1024 * 1024 * 5;
        $limitWidth  = 2000;
        $limitHeight = 2000;

        if (filesize($filePath) > $limitBytes) die('Размер изображения не должен превышать 5 Мбайт.');
        if ($image[1] > $limitHeight)          die('Высота изображения не должна превышать 2000 точек.');
        if ($image[0] > $limitWidth)           die('Ширина изображения не должна превышать 2000 точек.');

        $name = md5($_SESSION['email']).time();
        $extension = image_type_to_extension($image[2]);

        $format = str_replace('jpeg', 'jpg', $extension);

        if (!move_uploaded_file($filePath, 'public/images/download/' . $name . $format)) {
            die('При записи изображения на диск произошла ошибка.');
        }
        else {
            echo 'public/images/download/' . $name . $format;
//            $_SESSION['downloadphoto'] = 'public/images/download/' . $name . $format;
//            header("Location: /camagru/snapchat");
        }

    }
}
?>