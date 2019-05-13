<?php
function saveNewPass($id, $postcode, $pass){
    require_once "app/config/setup.php";
    $pdo = createConnection ();
    $id_usr = $pdo->prepare('SELECT id, password, email FROM users WHERE id = ?');
    $id_usr->execute([$id]);
    $result = $id_usr->fetch(PDO::FETCH_LAZY);
    $code = md5($result['id']).md5($result['email']);
    if ($code == $postcode) {
        $newPass = md5(md5(trim($pass)));
        $change_pass = "UPDATE users SET password = '".$newPass."' WHERE id='$id'";
//    print_r($change_pass);
        $pdo->query($change_pass);
        return ("<div id='container'><div id='main_container'><p>Your password changed! Now you can enter the site with new password!</p><br> <a href='/camagru/account'>Login</a></div></div>");
    }
    else {
        return ("Error!!! <a href='/camagru/'>Main page</a>");
    }
//    return $code;
}
