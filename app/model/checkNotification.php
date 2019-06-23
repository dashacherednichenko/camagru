<?php
defined('SECRET_KEY') or die('No direct access allowed.');
function checkNotification($user_mail, $pdo)
{
    $login_u = 'SELECT id, email, password, username, activation, notifications FROM users';
    foreach ($pdo->query($login_u) as $row) {
        if ($row['email'] == $user_mail) {
            if ($row['notifications'] == 1) {
                echo 'checked';
                return (1);
            }
            else {
                echo '';
                return (0);
            }
        }
    }
}