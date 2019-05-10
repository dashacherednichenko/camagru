<?php
function clearSession(){
//    session_start();
    $_SESSION['error_user'] = NULL;
    $_SESSION['error_login'] = NULL;
    $_SESSION['error_activation'] = NULL;
    $_SESSION['email'] = NULL;
    $_SESSION['login'] = NULL;
}
?>
