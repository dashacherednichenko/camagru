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
            $send_comment = "INSERT INTO comments(comment,photo,author,date) VALUES (:comment, :photo, :author, :date)";
            $date = date("Y-m-d G:i:s");
            $arr['date'] = $date;
            $arr['comment'] =  $text;
            $user_data = $pdo->prepare($send_comment);
            $user_data->bindParam(":comment", $text);
            $user_data->bindParam(":photo", $_POST['photo']);
            $user_data->bindParam(":author", $author);
            $user_data->bindParam(":date", $date);
            $user_data->execute();
            $arr = array_map('stripslashes', $arr);
            $insertedComment = new CommentController($arr);
            echo $insertedComment->commentmarkup();

            $find_email =  $pdo->prepare('SELECT users.email, author, notifications 
                        FROM users 
                        LEFT JOIN photos ON photos.author = users.id
                        WHERE photos.id = ?;');
            $find_email->execute([$_POST['photo']]);
            $result = $find_email->fetch(PDO::FETCH_LAZY);
            if ($result['notifications'] == 1 && $result['email'] != $_POST['author']) {
//                echo $result['email'];
                $subject = "New comment - CAMAGRU";
                $message = "Hello, you have a new comment from user: ". $_POST['author']." \n";
                mail($result['email'], $subject, $message, "Content-type:text/plain;    Charset=windows-1251\r\n");
            }

//    } else {
//        /* Вывод сообщений об ошибке */
//        echo '{"status":0,"errors":' . json_encode($arr) . '}';
//    }
        }
    }
}