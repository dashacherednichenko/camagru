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
    $photos = "INSERT INTO photos (filename,filetype,date,author) VALUES 
        ('public/images/tmp/test1.jpg','jpg','2018-10-23 10:37:22', '1'),
        ('public/images/tmp/test2.jpg','jpg','2019-05-23 10:37:22', '2'),
        ('public/images/tmp/test3.jpg','jpg','2018-01-23 10:37:22', '1'),
        ('public/images/tmp/test4.jpg','jpg','2012-10-21 10:37:22', '3'),
        ('public/images/tmp/test5.jpg','jpg','2008-10-30 10:37:22', '1'),
        ('public/images/tmp/test6.jpg','jpg','2004-10-01 10:37:22', '4'),
        ('public/images/tmp/test7.jpg','jpg','2008-10-23 10:37:22', '2'),
        ('public/images/tmp/test8.jpg','jpg','2005-10-22 10:37:22', '1'),
        ('public/images/tmp/test9.jpg','jpg','2008-10-23 10:37:22', '4'),
        ('public/images/tmp/test10.png','png','2006-10-23 10:37:22', '3'),
        ('public/images/tmp/test12.jpg','jpg','2007-10-23 10:37:22', '1')
        ;";
    $pdo->query($photos);
    $comments = "INSERT INTO comments (comment, photo, author, date) VALUES
        ('Дуже круте фото1!', '1', '1', '2019-06-01 10:37:22'),
        ('Дуже круте фото2!', '2', '1', '2019-06-02 10:37:22'),
        ('Дуже круте фото3!', '3', '1', '2019-06-03 10:37:22'),
        ('Дуже круте фото4!', '4', '1', '2019-06-01 10:37:22'),
        ('Дуже круте фото5!', '5', '1', '2019-06-14 10:37:22'),
        ('Дуже круте фото6!', '6', '1', '2019-06-01 10:37:22'),
        ('Дуже круте фото7!', '7', '1', '2019-06-013 10:37:22'),
        ('Дуже круте фото8!', '8', '1', '2019-06-01 10:37:22'),
        ('Дуже круте фото9!', '9', '1', '2019-06-01 10:37:22'),
        ('Дуже круте фото10!', '10', '1', '2019-06-01 10:37:22'),
        ('Дуже круте фото11!', '11', '1', '2019-06-01 10:37:22'),
        ('LOL!', '1', '2', '2019-06-09 10:37:22'),
        ('LIKE!', '9', '4', '2019-06-10 10:37:22')
        ;";
    $pdo->query($comments);
}
?>
