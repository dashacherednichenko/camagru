<?php
function auth($user_mail, $password)
{
    require_once "../config/setup.php";
    $pdo = createConnection ();
    $login_usr = 'SELECT email, password, username FROM users';
    foreach ($pdo->query($login_usr) as $row) {
//        print_r($row);
        if ($row['email'] == $user_mail && $row['password'] == $password) {
            return ($row['username']);
        }
    }
    return (0);
}

?>
