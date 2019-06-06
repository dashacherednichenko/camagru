<?php
defined('SECRET_KEY') or die('No direct access allowed.');
function deletephoto($idphoto, $email)
{
    require_once "app/config/setup.php";
    $pdo = createConnection ();
    $del = "DELETE FROM photos WHERE id = '$idphoto'";
    $pdo->exec($del);
}
?>
