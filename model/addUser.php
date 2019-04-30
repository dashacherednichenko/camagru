<?php
function addUser($email, $username, $password){
    require_once "../config/setup.php";
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

//        $result3 = $pdo->query("SELECT id FROM users WHERE email=".$email);
//        print_r($result3);

//        $stmt->execute(array($email));
//        $name = $stmt->fetchColumn();
//        print_r($name);

        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
//        $myrow3 = $stmt->fetch(PDO::FETCH_LAZY);
        while ($row1 = $stmt->fetch(PDO::FETCH_LAZY))
        {
//            echo $row1[0] . "\n";
//            echo $row1['id'] . "\n";
//            echo $row1->id . "\n";
        }
//        print_r($myrow3);
//        foreach ($pdo->query($result3) as $row1) {
//           print_r($row1);
//        }

        $activation = md5($row1['id']).md5($email);
//        print_r($activation);
        $subject = "Confirm your registration";
        $message = "Hello! Thanks for your registration.\nYour login:    ".$username."\n
        Click next link  http://localhost:8100/camagru/activation.php?login=".$username ."&code=".$activation ."\n to activate your account.\n";
        mail($email, $subject, $message, "Content-type:text/plain;    Charset=windows-1251\r\n");

        echo    "Вам на E-mail выслано письмо с cсылкой, для подтверждения регистрации.    Внимание! Ссылка действительна 1 час. <a href=''>Main page</a>";

        return (1);
    }
    else
        return (0);
};
?>