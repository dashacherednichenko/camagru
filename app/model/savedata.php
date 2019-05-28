<?php
function saveData($email, $password, $newemail, $newlogin, $newpass){
    echo
    require_once "app/config/setup.php";
//    echo $password;
    $pdo = createConnection ();
    $login_usr = 'SELECT id, email, password, username, activation FROM users WHERE activation = "1"';
    foreach ($pdo->query($login_usr) as $row) {
        if ($row['email'] == $email) {
            $id = $row['id'];
            if(password_verify($password, $row['password']) == TRUE)
            {
                if($email != $newemail)
                {
                    $change_mail = "UPDATE users SET email = '".$newemail."' WHERE id='$id'";
                    $pdo->query($change_mail);
                    $_SESSION['email'] = $newemail;
                    echo 'new email';
                }
                if ($row['username'] != $newlogin){
                    $change_login = "UPDATE users SET username = '".$newlogin."' WHERE id='$id'";
                    $pdo->query($change_login);
                    $_SESSION['login'] = $newlogin;
                    echo 'new login';
                }
                if ($newpass != '' && !password_verify($newpass, $row['password']))
                {
                    $newPass = password_hash(trim($newpass), PASSWORD_DEFAULT);
                    $change_pass = "UPDATE users SET password = '".$newPass."' WHERE id='$id'";
                    $pdo->query($change_pass);
                    echo 'password change!';
                }
                echo 'OK';
                return (1);
            }
            else {
//                echo "wrong password";
                return (-1);
            }
//            $code = md5($row['id']).md5($user_mail);
//            $subject = "Do U forger your password?";
//            $message = "Hello! Your login:    ".$row['username']."\n
//            To recover your password on the CAMAGRU, please click on the link below:
//            ".HOST."/camagru/app/view/templates/recovery.php?id=".$row['id']."&code=".$code."\n";
//            mail($user_mail, $subject, $message, "Content-type:text/plain;    Charset=windows-1251\r\n");
//            return (1);
        }
    }
}
?>