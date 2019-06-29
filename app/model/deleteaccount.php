<?php
defined('SECRET_KEY') or die('No direct access allowed.');

function deleteacc($email){
    require_once "app/config/setup.php";
    require_once "app/model/clearSession.php";
    $pdo = createConnection();
    $find_id =  $pdo->prepare('SELECT users.id, users.email
                    FROM users
                    WHERE users.email = ?;');
    $find_id->execute([$email]);
    $res = $find_id->fetch(PDO::FETCH_LAZY);
    $id = $res['id'];
    print_r($res['id']);
    $delusr = "DELETE FROM users WHERE id = '$id'";
    $pdo->exec($delusr);
    $delphotos = "DELETE FROM photos WHERE author = '$id'";
    $pdo->exec($delphotos);
    $delcomments = "DELETE FROM comments WHERE author = '$id'";
    $pdo->exec($delcomments);
    clearSession();
}

?>