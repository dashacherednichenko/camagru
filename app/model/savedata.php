<?php
defined('SECRET_KEY') or die('No direct access allowed.');
function saveData($email, $password, $newemail, $newlogin, $newpass){
    require_once "app/config/setup.php";
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
                    echo 'new email - ';
                }
                if ($row['username'] != $newlogin){
                    $change_login = "UPDATE users SET username = '".$newlogin."' WHERE id='$id'";
                    $pdo->query($change_login);
                    $_SESSION['login'] = $newlogin;
                    echo 'new login - ';
                }
                if ($newpass != '' && !password_verify($newpass, $row['password']))
                {
                    $newPass = password_hash(trim($newpass), PASSWORD_DEFAULT);
                    $change_pass = "UPDATE users SET password = '".$newPass."' WHERE id='$id'";
                    $pdo->query($change_pass);
                    echo 'password change! - ';
                }
                return (1);
            }
            else {
                return (-1);
            }
        }
    }
}
?>