<?php
defined('SECRET_KEY') or die('No direct access allowed.');
//require_once "app/config/setup.php";
function print_com ($pdo){
//    $pdo = createConnection ();
    $comments = array();
    $arr_comments = 'SELECT * FROM comments ORDER BY id ASC';
    $result = $pdo->query($arr_comments);

//    while($row = $pdo->fetch($result))
//    {
//        $comments[] = new CommentController($row);
//    }

    foreach($comments as $c){
        echo $c->commentmarkup();
    }
};