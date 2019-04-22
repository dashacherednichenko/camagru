<?php
function createConnection ()
{
    require_once 'database.php';
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    return $pdo;
}
?>