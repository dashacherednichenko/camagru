<?php
function activation($id, $code)
{
    require_once "../config/setup.php";
    $pdo = createConnection ();
    $id_usr = $pdo->prepare('SELECT id, email FROM users WHERE id = ?');
    $id_usr->execute([$id]);
    $result = $id_usr->fetch(PDO::FETCH_LAZY);
    $activation = md5($result['id']).md5($result['email']);
    if ($activation == $code) {
        $activate_user = "UPDATE users SET activation='1' WHERE id='$id'";
        $pdo->query($activate_user);
        require_once "../view/templates/header.php";
        echo "<div id='container'><div id='main_container'>Your e-mail confirmed! Now you can enter the site! <a href='/camagru/account'>LOGIN</a></div></div>";
        require_once "../view/templates/footer.php";
        return ($result['email']);
    }
    else {
        require_once "../view/templates/header.php";
        echo "<div id='container'><div id='main_container'>Error! Your e-mail NOT confirmed! <a href='/camagru/'>Main page</a></div></div>";
        require_once "../view/templates/footer.php";
        return (NULL);
    }

}


if (isset($_GET['code']))
    $code = $_GET['code'];
else
    exit("Error Link! No confirmation code!");
if (isset($_GET['id']))
    $id = $_GET['id'];
else
    exit("Error Link! No id!");
if (isset($_GET['login']))
    $login = $_GET['login'];
else
    exit("Error Link! No login!");


if (($email = activation($id, $code)) != NULL) {
            session_start();
            $_SESSION['error_activation'] = NULL;
            $_SESSION['error_user'] = NULL;
            $_SESSION['error_login'] = NULL;
}
else {
    header("Location: /camagru/");
}
?>