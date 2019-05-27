<?php
function deletedb()
{
    require_once "app/config/setup.php";
    $pdo = createConnection();
    $del = "DROP DATABASE IF EXISTS db_camagru;";
    $pdo->exec($del);
}