<?php
defined('SECRET_KEY') or die('No direct access allowed.');

function savePhoto($snap, $email)
{
    require_once "app/config/setup.php";
    $pdo = createConnection();
    date_default_timezone_set('Europe/Kiev');
    $login_usr = 'SELECT email, username, activation, id FROM users';
    foreach ($pdo->query($login_usr) as $row) {
        if ($row['email'] == $email && $row['activation'] == 1) {
            $id = $row['id'];
            $sql = "INSERT INTO photos (filename,filetype,date,author) VALUES (:filename,'png',:date, :author)";

            $imagemy = explode('base64,', $snap)[1];
            $data = base64_decode($imagemy);
            $im = imagecreatefromstring($data);
            $name = "public/images/tmp/". strtolower(md5($email).time()).".png";
            chmod("public/images/tmp/",0755);
            imagepng($im, $name, 0, NULL);

            $user_data = $pdo->prepare($sql);
            $user_data->bindParam(":filename", $name);
            $date = date("Y-m-d G:i:s");
            $user_data->bindParam(":date", $date);
            $user_data->bindParam(":author", $id);
            $user_data->execute();
        }
    }
}
?>



