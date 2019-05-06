<?php
require_once "../model/clearSession.php";
require_once "../model/checkEmail.php";
clearSession();
//print_r($_POST);
if (checkEmail($_POST['email']) == 1)
    echo    "A link has been sent to your e-mail. <a href='/camagru/'>Main page</a>";
else
    echo    "incorrect e-mail or no active user. <a href='/camagru/'>Main page</a>";
?>