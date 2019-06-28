<?php
defined('SECRET_KEY') or die('No direct access allowed.');

function addlike($photo, $email){
    require_once "app/config/setup.php";
    $pdo = createConnection();
    $find_idusr =  $pdo->prepare('SELECT users.id
                        FROM users
                        WHERE users.email = ?;');
    $find_idusr->execute([$email]);
    $res = $find_idusr->fetch(PDO::FETCH_LAZY);
    $author = $res['id'];
    $sql_users = "SELECT id, author from likes WHERE photo = ?";
    $users = $pdo->prepare($sql_users);
    $users->execute([$photo]);
//    $result_usr = $users->fetch(PDO::FETCH_LAZY);

    while ($row = $users->fetch(PDO::FETCH_LAZY)) {
//            print_r($row);
        if ($row['author'] == $author) {
            $delsql = $pdo->prepare("DELETE FROM likes WHERE id = ?");
            $delsql->execute([$row['id']]);
            countLikes($photo, $pdo);
            return true;
        }
    }


    $like = "INSERT INTO likes (photo, author) VALUES (:photo, :author)";
    $user_data = $pdo->prepare($like);

//    print_r($res);
    $user_data->bindParam(":photo", $photo);
    $user_data->bindParam(":author", $author);
    $user_data->execute();
//    activelike($photo, $pdo);
    countLikes($photo, $pdo);
    return true;
}
function activelike($photo, $pdo){
    $find_idusr =  $pdo->prepare('SELECT users.id
                        FROM users
                        WHERE users.email = ?;');
    $find_idusr->execute([$_SESSION['email']]);
    $res = $find_idusr->fetch(PDO::FETCH_LAZY);
    $author = $res['id'];
    $sql_users = "SELECT id, author from likes WHERE photo = ?";
    $users = $pdo->prepare($sql_users);
    $users->execute([$photo]);
//    $result_usr = $users->fetch(PDO::FETCH_LAZY);

    while ($row = $users->fetch(PDO::FETCH_LAZY)) {
//            print_r($row);
        if ($row['author'] == $author) {
            return 'active';
        }
    }

    return '';
};

function countLikes($photo, $pdo){
    $sql = "SELECT COUNT(*) FROM likes WHERE photo = ?;";
    $count = $pdo->prepare($sql);
    $count->execute([$photo]);
    $res = $count->fetch(PDO::FETCH_LAZY);
    $i = $res['COUNT(*)'];
    echo $i != '0' ? $i : '';
//    return -3;
}