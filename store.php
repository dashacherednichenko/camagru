<?php
var_dump($_POST);
require_once 'components/connection.php';
$pdo = new PDO($mysql, $user, $password);
$sql = "INSERT INTO users (full_name, email, username, password) VALUES (:full_name, :email, :username, :password)";
$user_data = $pdo->prepare($sql);
$user_data->bindParam(":full_name", $_POST['full_name']);
$user_data->bindParam(":email", $_POST['email']);
$user_data->bindParam(":username", $_POST['username']);
$user_data->bindParam(":password", $_POST['password']);
$user_data->execute();
//var_dump($pdo);
?>