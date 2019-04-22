<?php
function addUser($email, $username, $password)
{
    require "../config/setup.php";
    $pdo = createConnection ();
    $sql = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
    $user_data = $pdo->prepare($sql);
    $user_data->bindParam(":email", $email);
    $user_data->bindParam(":username", $username);
    $user_data->bindParam(":password", $password);
    $user_data->execute();
};
?>