<?php
function deletephoto($idphoto, $email)
{
    require_once "app/config/setup.php";
    $pdo = createConnection ();
    $del = "DELETE FROM photos WHERE id = '$idphoto'";
    $pdo->exec($del);
}
?>
