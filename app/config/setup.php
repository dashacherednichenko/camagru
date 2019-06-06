<?php
defined('SECRET_KEY') or die('No direct access allowed.');
function createConnection ()
{
    require_once 'database.php';
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec($DB . $USERS . $PHOTOS . $COMMENTS);
    } catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }
    return $pdo;
}
?>