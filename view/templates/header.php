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
<div class="wrapper">
    <header>
        <a href="/camagru/" title="go_to_main">
            <img src="images/logo.png" class="logo_main">
        </a>
        <div id="header_links">
            <?php
            if ($_SESSION['email'] && $_SESSION['email'] !== NULL) {
            ?>
            <div id="camera">
                <a href="snapchat" id="" title="make a photo">
                    <img src="images/camera.png" class="header_icons">
                </a> <br>
            </div>
                <?php
            }
            ?>
            <div id="user_login">
                <a href="login" id="login_href">
                    <img src="images/login.png" class="header_icons">
                </a>
                <?php
                if ($_SESSION['email'] && $_SESSION['email'] !== NULL) {
                ?>
                <div id="welcome_usr">
                    <span id="hello_user">Hello, <?php
                        echo $_SESSION['login'];
                        ?>
                     =)</span><br>
                </div>
                    <?php
                }
                ?>
            </div>
            <?php
            if ($_SESSION['email'] && $_SESSION['email'] !== NULL) {
                ?>
                <div id="div_logout">
                    <a href="logout" id="logout"><img src="images/exit.png" title="logout"></a>
                </div>
                <?php
            }
            ?>
        </div>
    </header>