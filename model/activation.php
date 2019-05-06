<?php
function activation($login, $code)
{
    require_once "../config/setup.php";
    $pdo = createConnection ();
    $id_usr = $pdo->prepare('SELECT id, email FROM users WHERE username = ?');
    $id_usr->execute([$login]);
    $result = $id_usr->fetch(PDO::FETCH_LAZY);
//    echo $result['id'] . "\n";
//    echo $result['email'] . "\n";
    $activation = md5($result['id']).md5($result['email']);
//    echo $activation . "\n";
    if ($activation == $code) {
        $activate_user = "UPDATE users SET activation='1' WHERE username='$login'";
        $pdo->query($activate_user);
        echo "Your e-mail confirmed! Now you can enter the site! <a href='/camagru/'>Main page</a>";
        echo $result['email'];
        return ($result['email']);
    }
    else {
        echo "Error! Your e-mail NOT confirmed! <a href='/camagru/'>Main page</a>";
        return (NULL);
    }

}


//print_r($_GET);
if (isset($_GET['code']))
    $code = $_GET['code'];
else
    exit("Error Link! No confirmation code!");
if (isset($_GET['login']))
    $login = $_GET['login'];
else
    exit("Error Link! No login!");

if (($email = activation($login, $code)) != NULL) {
            session_start();
            $_SESSION['error_activation'] = NULL;
            $_SESSION['error_user'] = NULL;
            $_SESSION['error_login'] = NULL;
            $_SESSION['email'] = $email;
            $_SESSION['login'] = $login;
            header("Location: /camagru/");
}
else {
    header("Location: /camagru/");
}
?>