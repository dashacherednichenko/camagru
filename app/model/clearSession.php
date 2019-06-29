<?php
defined('SECRET_KEY') or die('No direct access allowed.');
function clearSession(){
    session_destroy();
}
?>
