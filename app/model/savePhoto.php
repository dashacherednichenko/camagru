<?php

function calcBytes($filesize){
    if($filesize > 1024)
    {
        $filesize = ($filesize/1024);
        if($filesize > 1024)
        {
            $filesize = ($filesize/1024);
            if($filesize > 1024)
            {
                $filesize = ($filesize/1024);
                $filesize = round($filesize, 1);
                return $filesize." ГБ";
            }
            else
            {
                $filesize = round($filesize, 1);
                return $filesize." MБ";
            }
        }
        else
        {
            $filesize = round($filesize, 1);
            return $filesize." Кб";
        }
    }
    else
    {
        $filesize = round($filesize, 1);
        return $filesize." байт";
    }
}

function savePhoto($email)
{
    require_once "app/config/setup.php";
    $pdo = createConnection();
//    echo $email;
    date_default_timezone_set('Europe/Kiev');
    $login_usr = 'SELECT email, username, activation, id FROM users';
    foreach ($pdo->query($login_usr) as $row) {
        if ($row['email'] == $email && $row['activation'] == 1) {
            $id = $row['id'];
            $sql = "INSERT INTO photos (filename,filesize,filetype,date,author) VALUES (:filename,:filesize,'png',:date, :author)";
            $user_data = $pdo->prepare($sql);
            $user_data->bindParam(":filename", $_SESSION['photo']);
            $filesize = calcBytes(filesize($_SESSION['photo']));
            $user_data->bindParam(":filesize", $filesize);
            $date = date("F j, Y, g:i a");
            $user_data->bindParam(":date", $date);
            $user_data->bindParam(":author", $id);
            $user_data->execute();
        }
    }
//    echo $id;
}
?>



