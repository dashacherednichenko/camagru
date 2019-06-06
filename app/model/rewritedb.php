<?php
defined('SECRET_KEY') or die('No direct access allowed.');
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
        ('public/images/tmp/test1.jpg','902 Кб','jpg','2018-10-23 10:37:22', '1'),
        ('public/images/tmp/test2.jpg','902 Кб','jpg','2019-05-23 10:37:22', '2'),
        ('public/images/tmp/test3.jpg','902 Кб','jpg','2018-01-23 10:37:22', '1'),
        ('public/images/tmp/test4.jpg','902 Кб','jpg','2012-10-21 10:37:22', '3'),
        ('public/images/tmp/test5.jpg','902 Кб','jpg','2008-10-30 10:37:22', '1'),
        ('public/images/tmp/test6.jpg','902 Кб','jpg','2004-10-01 10:37:22', '4'),
        ('public/images/tmp/test7.jpg','902 Кб','jpg','2008-10-23 10:37:22', '2'),
        ('public/images/tmp/test8.jpg','902 Кб','jpg','2005-10-22 10:37:22', '1'),
        ('public/images/tmp/test9.jpg','902 Кб','jpg','2008-10-23 10:37:22', '4'),
        ('public/images/tmp/test10.png','902 Кб','png','2006-10-23 10:37:22', '3'),
        ('public/images/tmp/test12.jpg','902 Кб','jpg','2007-10-23 10:37:22', '1')
        ;";
    $pdo->query($photos);

}
?>
