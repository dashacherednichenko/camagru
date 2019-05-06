<?php
function auth($user_mail, $password)
{
    require_once "../config/setup.php";
    $pdo = createConnection ();
    $login_usr = 'SELECT email, password, username, activation FROM users';
    foreach ($pdo->query($login_usr) as $row) {
//        print_r($row);
        if ($row['email'] == $user_mail && $row['password'] == $password && $row['activation'] == 1) {
            return ($row['username']);
        }
        if ($row['email'] == $user_mail && $row['password'] == $password && $row['activation'] == 0) {
            return (-1);
        }
    }
    return (NULL);
}

?>
