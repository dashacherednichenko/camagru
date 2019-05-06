<?php
//print_r($_POST);
require_once "../view/templates/header.php";
require_once "../config/setup.php";
$pdo = createConnection ();
$id_usr = $pdo->prepare('SELECT id, password, email FROM users WHERE id = ?');
$id = $_POST['id'];
$id_usr->execute([$id]);
$result = $id_usr->fetch(PDO::FETCH_LAZY);
$code = md5($result['id']).md5($result['email']);

if ($code == $_POST['code']) {
    $newPass = md5(md5(trim($_POST['password'])));
    $change_pass = "UPDATE users SET password = '".$newPass."' WHERE id='$id'";
//    print_r($change_pass);
    $pdo->query($change_pass);
    echo "<div id='container'><div id='main_container'><p>Your password changed! Now you can enter the site with new password!</p><br> <a href='/camagru/login'>Login</a></div></div>";
}
else {
    echo "Error!!! <a href='/camagru/'>Main page</a>";
}
require_once "../view/templates/footer.php";
?>