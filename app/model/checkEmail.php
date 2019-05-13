<?php
function checkEmail($user_mail)
{
    require_once "../config/setup.php";
    $pdo = createConnection ();
    $login_usr = 'SELECT id, email, password, username, activation FROM users WHERE activation = "1"';
    foreach ($pdo->query($login_usr) as $row) {
        if ($row['email'] == $user_mail) {
            $code = md5($row['id']).md5($user_mail);
            $subject = "Do U forger your password?";
            $message = "Hello! Your login:    ".$row['username']."\n
            To recover your password on the CAMAGRU, please click on the link below:
            http://localhost:8100/camagru/app/view/templates/recovery.php?id=".$row['id']."&code=".$code."\n";
            mail($user_mail, $subject, $message, "Content-type:text/plain;    Charset=windows-1251\r\n");
            return (1);
        }
    }
    return (NULL);
}
?>
