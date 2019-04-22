<?php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <base href="/camagru/">
    <meta charset="UTF-8">
    <title>Camagru</title>
    <meta name="description" content="&#10148;&#10148;&#10148;SCHOOL-42 Camagru."/>
    <link rel="stylesheet" href="css/style.css">
    <link href="/camagru/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
<header>
    <a href="/camagru/">
        <img src="images/logo.png" class="logo_main">
    </a>
    <div id="user_login">
        <a href="login" id="login_href">
            <img src="images/login.png" class="header_icons">
        </a> <br>
        <div id="welcome_usr">
            <span id="hello_user"></span>
            <p><a href="logout.php">logout</a></p>
        </div>
    </div>
</header>