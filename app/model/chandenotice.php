<?php
defined('SECRET_KEY') or die('No direct access allowed.');
function changeNotice($email){
    require_once "app/config/setup.php";
    $pdo = createConnection ();
    $login = 'SELECT id, email, password, username, activation, notifications FROM users';
    foreach ($pdo->query($login) as $row) {
        if ($row['email'] == $email) {
            $id = $row['id'];
        }
    };
     $id_usr = $pdo->prepare('SELECT id, email FROM users WHERE id = ?');
     $id_usr->execute([$id]);
     $result = $id_usr->fetch(PDO::FETCH_LAZY);
     $notice_user = "UPDATE users SET notifications='".$_GET['notice']."' WHERE id='$id'";
     $pdo->query( $notice_user);
//
//
//    print_r($_GET);
//    echo $email;

}