<?php
defined('SECRET_KEY') or die('No direct access allowed.');
require_once 'app/controllers/CommentController.php';

function print_com ($pdo, $id){
    $comments = array();
    $arr_comments = 'SELECT * FROM comments WHERE photo = '.$id.' ORDER BY id DESC';
    $result = $pdo->query($arr_comments);

    $count = 0;
    foreach($pdo->query($arr_comments) as $row)
    {
        $find_login =  $pdo->prepare('SELECT users.username, author
                FROM users
                LEFT JOIN comments ON comments.author = users.id
                WHERE comments.author = ?;');
        $find_login->execute([$row['author']]);
        $res = $find_login->fetch(PDO::FETCH_LAZY);
        $row['author'] = $res['username'];
        $comments[] = new CommentController($row);
        $count++;
    }
    foreach($comments as $c){
        echo $c->commentmarkup();
    }
};