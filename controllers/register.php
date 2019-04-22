<?php
    require "../model/addUser.php";
    addUser($_POST['email'], $_POST['username'], $_POST['password']);
    header("Location: /camagru/");
?>