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
        return (1);
    }
    else
        return (0);
};
?>