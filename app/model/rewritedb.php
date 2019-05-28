<?php
function firstfillingDB()
{
    require_once 'app/config/database.php';
    require_once 'app/model/savePhoto.php';
    require_once 'app/model/clearSession.php';
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec($DB . $USERS . $PHOTOS . $COMMENTS);
    } catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }
    $del = "DROP DATABASE IF EXISTS db_camagru;";
    $pdo->exec($del);
    clearSession();
    session_start();
    $_SESSION['admin'] = 1;
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec($DB . $USERS . $PHOTOS . $COMMENTS);
    $users = "INSERT INTO users (email, username, password, activation) VALUES
        ('dasha.cherednichenko@gmail.com', 'Dasha','".password_hash('Dasha1111', PASSWORD_DEFAULT)."','1'),
        ('info@climagroup.com.ua', 'Test','".password_hash('Test1111', PASSWORD_DEFAULT)."','1'),
        ('info2@climagroup.com.ua', 'Test2','".password_hash('Test2222', PASSWORD_DEFAULT)."','1'),
        ('info3@climagroup.com.ua', 'Test3','".password_hash('Test3333', PASSWORD_DEFAULT)."','1'),
        ('info4@climagroup.com.ua', 'Test4','".password_hash('Test4444', PASSWORD_DEFAULT)."','0')
        ;";
    $pdo->query($users);
    $photos = "INSERT INTO photos (filename,filesize,filetype,date,author) VALUES 
        ('public/images/tmp/test1.jpg','902 Кб','jpg','May 28, 2018, 7:54 pm', '1'),
        ('public/images/tmp/test2.jpg','902 Кб','jpg','May 18, 2018, 7:54 pm', '2'),
        ('public/images/tmp/test3.jpg','902 Кб','jpg','May 15, 2019, 7:54 pm', '1'),
        ('public/images/tmp/test4.jpg','902 Кб','jpg','May 12, 2017, 7:54 pm', '3'),
        ('public/images/tmp/test5.jpg','902 Кб','jpg','May 31, 2018, 7:54 pm', '1'),
        ('public/images/tmp/test6.jpg','902 Кб','jpg','May 28, 2018, 7:54 pm', '4'),
        ('public/images/tmp/test7.jpg','902 Кб','jpg','May 28, 2016, 7:54 pm', '2'),
        ('public/images/tmp/test8.jpg','902 Кб','jpg','May 03, 2018, 7:54 pm', '1'),
        ('public/images/tmp/test9.jpg','902 Кб','jpg','May 28, 2018, 7:54 pm', '4'),
        ('public/images/tmp/test10.png','902 Кб','png','May 01, 2018, 7:54 pm', '3'),
        ('public/images/tmp/test12.jpg','902 Кб','jpg','May 08, 2019, 7:54 pm', '1')
        ;";
    $pdo->query($photos);

}
?>
