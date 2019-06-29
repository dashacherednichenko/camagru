<?php
defined('SECRET_KEY') or die('No direct access allowed.');

function publishcomment()
{
    require_once "app/config/setup.php";
    $pdo = createConnection();
    $arr = array();
    $text = CommentController::validate_comment($_POST['comment']);
    if ($text == false) {
        echo "<span class='comment_error'>your comment not validate!<span>";
        return false;
    }
    $login_usr = 'SELECT email, username, activation, id FROM users';
    foreach ($pdo->query($login_usr) as $row) {
        if ($row['email'] == $_POST['author'] && $row['activation'] == 1) {
            $author = $row['id'];
            $send_comment = "INSERT INTO comments(comment,photo,author,date) VALUES (:comment, :photo, :author, :date)";
            $date = date("Y-m-d G:i:s");
            $arr['date'] = $date;
            $find_login =  $pdo->prepare('SELECT users.username, users.email, author
                        FROM users
                        LEFT JOIN comments ON comments.author = users.id
                        WHERE users.email = ?;');
            $find_login->execute([$_POST['author']]);
            $res = $find_login->fetch(PDO::FETCH_LAZY);
            $arr['author'] = $res['username'];
            $arr['comment'] =  $text;
            $user_data = $pdo->prepare($send_comment);
            $user_data->bindParam(":comment", $text);
            $user_data->bindParam(":photo", $_POST['photo']);
            $user_data->bindParam(":author", $author);
            $user_data->bindParam(":date", $date);
            $user_data->execute();
            $arr = array_map('stripslashes', $arr);
            $insertedComment = new CommentController($arr);
            $find_email =  $pdo->prepare('SELECT users.username, users.email, author, notifications 
                        FROM users 
                        LEFT JOIN photos ON photos.author = users.id
                        WHERE photos.id = ?;');
            $find_email->execute([$_POST['photo']]);
            $result = $find_email->fetch(PDO::FETCH_LAZY);
            echo $insertedComment->commentmarkup();

            if ($result['notifications'] == 1 && $result['email'] != $_POST['author']) {
                $subject = "New comment - CAMAGRU";
                $message = "Hello, you have a new comment from user: ". $_POST['author']." \n";
                mail($result['email'], $subject, $message, "Content-type:text/plain;    Charset=windows-1251\r\n");
            }
        }
    }
}