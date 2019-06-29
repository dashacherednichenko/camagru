<?php
defined('SECRET_KEY') or die('No direct access allowed.');
function auth($user_mail, $password)
{
    require_once "app/config/setup.php";
    $pdo = createConnection ();
    $login_usr = 'SELECT email, password, username, activation FROM users';
    foreach ($pdo->query($login_usr) as $row) {
        if ($row['email'] == $user_mail && password_verify($password, $row['password']) && $row['activation'] == 1) {
            return ($row['username']);
        }
        if ($row['email'] == $user_mail && password_verify($password, $row['password']) && $row['activation'] == 0) {
            return (-1);
        }
    }
    return (NULL);
}

?>
