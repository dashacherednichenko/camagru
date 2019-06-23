<?php
defined('SECRET_KEY') or die('No direct access allowed.');

function publishcomment()
{
    require_once "app/config/setup.php";
    $pdo = createConnection();
//    print_r($_SESSION);
//    print_r($_POST);
    $arr = array();
    $text = CommentController::validate_comment($_POST['comment']);
    $login_usr = 'SELECT email, username, activation, id FROM users';
    foreach ($pdo->query($login_usr) as $row) {
        if ($row['email'] == $_POST['author'] && $row['activation'] == 1) {
            $author = $row['id'];
//    if ($validates) {
            $send_comment = "INSERT INTO comments(comment,photo,author,date) VALUES (:comment, :photo, :author, :date)";
            $date = date("Y-m-d G:i:s");
            $arr['dt'] = $date;
            $arr['comment'] =  $text;
            $user_data = $pdo->prepare($send_comment);
            $user_data->bindParam(":comment", $text);
            $user_data->bindParam(":photo", $_POST['photo']);
            $user_data->bindParam(":author", $author);
            $user_data->bindParam(":date", $date);
            $user_data->execute();
//
//        '" . $arr['comment'] . "',
//    '" . $arr['photo'] . "',
//    '" . $arr['author'] . "'

//        $pdo->query($send_comment);
//    $pdo_query("	INSERT INTO comments(name,url,email,body)
//    VALUES (
//    '".$arr['name']."',
//    '".$arr['url']."',
//    '".$arr['email']."',
//    '".$arr['body']."'
//    )");

//        $arr['dt'] = date('r', time());
//        $arr['id'] = mysql_insert_id();

            /*
            /	Данные в $arr подготовлены для запроса mysql,
            /	но нам нужно делать вывод на экран, поэтому
            /	готовим все элементы в массиве:
            /*/

            $arr = array_map('stripslashes', $arr);

            $insertedComment = new CommentController($arr);

            /* Вывод разметки только-что вставленного комментария: */

            echo json_encode(array('status' => 1, 'html' => $insertedComment->commentmarkup()));

//    } else {
//        /* Вывод сообщений об ошибке */
//        echo '{"status":0,"errors":' . json_encode($arr) . '}';
//    }
        }
    }
}