<?php
defined('SECRET_KEY') or die('No direct access allowed.');
require_once 'app/controllers/CommentController.php';

//require_once "app/config/setup.php";
function print_com ($pdo, $id){
//    $pdo = createConnection ();
    $comments = array();
    $arr_comments = 'SELECT * FROM comments WHERE photo = '.$id.' ORDER BY id DESC';
    $result = $pdo->query($arr_comments);

    $count = 0;
    foreach($pdo->query($arr_comments) as $row)
    {
        $comments[] = new CommentController($row);
        $count++;
    }

    foreach($comments as $c){
        echo $c->commentmarkup();
    }
//    return $count;
};