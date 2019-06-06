<?php
defined('SECRET_KEY') or die('No direct access allowed.');
ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug($string){
    var_dump($string);
    exit;
}
?>