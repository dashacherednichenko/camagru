<?php
defined('SECRET_KEY') or die('No direct access allowed.');
function addUser($email, $username, $password){
    require_once "app/config/setup.php";
    $pdo = createConnection ();
    $check_usr = 'SELECT email FROM users';
    $count = 0;
    foreach ($pdo->query($check_usr) as $row) {
        if ($row['email'] == $email)
            $count++;
    }
    if ($count == 0) {
        $sql = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
        $user_data = $pdo->prepare($sql);
        $user_data->bindParam(":email", $email);
        $user_data->bindParam(":username", $username);
        $user_data->bindParam(":password", $password);
        $user_data->execute();


        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_LAZY);
        $activation = md5($result['id']).md5($email);
        $subject = "Confirm your registration";
        $message = "Hello! Thanks for your registration.\nYour login:    ".$username.".\n
        Click next link  ".HOST."/camagru/app/model/activation.php?id=".$result['id'] ."&login=".$username."&code=".$activation ."\n to activate your account.\n";
        mail($email, $subject, $message, "Content-Transfer-Encoding: 7bit; Content-Type: text/html; charset=utf-8\r\n");
        return (1);
    }
    else
        return (0);
};
?>