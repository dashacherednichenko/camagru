<?php
defined('SECRET_KEY') or die('No direct access allowed.');
function deletedb()
{
    require_once "app/config/setup.php";
    $pdo = createConnection();
    $del = "DROP DATABASE IF EXISTS db_camagru;";
    $pdo->exec($del);
}