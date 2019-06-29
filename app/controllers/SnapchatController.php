<?php
defined('SECRET_KEY') or die('No direct access allowed.');
require_once 'app/components/Controller.class.php';

class SnapchatController extends Controller
{
    public function actionPage()
    {
        require_once 'app/view/templates/header.php';
        require_once 'app/view/templates/snapchat.php';
        require_once 'app/view/templates/footer.php';
        require_once 'app/view/templates/scripts/scripts_snapchat.php';
        return true;
    }

    public function actionPhoto()
    {
        $img = $_POST['userPhoto'];
        $coef = $_POST['coeficient'];
        $imagemy = explode('base64,', $img)[1];
        $funMask = imagecreatefrompng($_POST['superposable']);
        $name = md5($_POST['userEmail']).time();
        $maskwidth = imagesx($funMask);
        $maskusrwidth = $_POST['maskWidth'] / $coef;
        $maskheight = imagesy($funMask);
        $maskusrheight = $_POST['maskHeight'] / $coef;
        $data = base64_decode($imagemy);
        $im = imagecreatefromstring($data);
        $left = ((explode('px', $_POST['maskLeft'])[0]) / $coef) ;
        $top = ((explode('px', $_POST['maskTop'])[0]) / $coef) ;
        imagecopyresampled ($im, $funMask, $left, $top, 0, 0, $maskusrwidth, $maskusrheight, $maskwidth, $maskheight);
        $save = "public/images/tmp/". strtolower($name) .".png";
        chmod("public/images/tmp/",0755);
        imagepng($im, $save, 0, NULL);
        $data = file_get_contents($save);
        $base64 = 'data:image/' . 'png' . ';base64,' . base64_encode($data);
        unlink($save);
        echo $base64;
        imagedestroy($im);
        imagedestroy($funMask);

    }


    public function actionPublishphoto(){
        require_once "app/model/savePhoto.php";
        savePhoto($_POST['snap'], $_SESSION['email']);
        header("Location: /camagru/");
        return true;
    }

    public function actionDownloadphoto(){
        $filePath  = $_FILES['downloadphoto']['tmp_name'];
        $errorCode = $_FILES['downloadphoto']['error'];
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

            $errorMessages = [
                UPLOAD_ERR_INI_SIZE   => 'ERROR: Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE  => 'ERROR: Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                UPLOAD_ERR_PARTIAL    => 'ERROR: Загружаемый файл был получен только частично.',
                UPLOAD_ERR_NO_FILE    => 'ERROR: Файл не был загружен.',
                UPLOAD_ERR_NO_TMP_DIR => 'ERROR: Отсутствует временная папка.',
                UPLOAD_ERR_CANT_WRITE => 'ERROR: Не удалось записать файл на диск.',
                UPLOAD_ERR_EXTENSION  => 'ERROR: PHP-расширение остановило загрузку файла.',
            ];
            $unknownMessage = 'ERROR: При загрузке файла произошла неизвестная ошибка.';
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
            die($outputMessage);
        }

        $fi = finfo_open(FILEINFO_MIME_TYPE);
        $mime = (string) finfo_file($fi, $filePath);
        if (strpos($mime, 'image') === false) die('ERROR: Можно загружать только изображения.');
        $image = getimagesize($filePath);

        $limitBytes  = 1024 * 1024 * 5;
        $limitWidth  = 2000;
        $limitHeight = 2000;

        if (filesize($filePath) > $limitBytes) die('ERROR: Размер изображения не должен превышать 5 Мбайт.');
        if ($image[1] > $limitHeight)          die('ERROR: Высота изображения не должна превышать 2000 точек.');
        if ($image[0] > $limitWidth)           die('ERROR: Ширина изображения не должна превышать 2000 точек.');

        $name = md5($_SESSION['email']).time();
        $extension = image_type_to_extension($image[2]);

        $format = str_replace('jpeg', 'jpg', $extension);

	    if ($_FILES['downloadphoto']['type'] == 'image/jpeg')
		    $src = imagecreatefromjpeg ($filePath);
	    else if ($_FILES['downloadphoto']['type'] == 'image/png')
		    $src = imagecreatefrompng ($filePath);
	    else if ($_FILES['downloadphoto']['type'] == 'image/gif')
		    $src = imagecreatefromgif ($filePath);
	    else if ($_FILES['downloadphoto']['type'] == 'image/jpg');
	    $w_src = imagesx($src);
	    $h_src = imagesy($src);
	    $w = 640;

		if ($w_src != $w)
		{
			$ratio = $w_src/$w;
			$w_dest = round($w_src/$ratio);
			$h_dest = round($h_src/$ratio);
			$dest = imagecreatetruecolor($w_dest, $h_dest);
			imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
			imagejpeg($dest, 'public/images/download/' . $name.".jpg", 75);
			imagedestroy($dest);
			imagedestroy($src);
		}
	    $path = 'public/images/download/' . $name. ".jpg";
	    $type = pathinfo($path, PATHINFO_EXTENSION);
	    $data = file_get_contents($path);
	    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        unlink('public/images/download/' . $name.".jpg");
	    echo $base64;
    }
}
?>