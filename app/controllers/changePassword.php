<?php
require_once "../view/templates/header.php";
require_once "../model/newpassword.php";
echo saveNewPass($_POST['id'], $_POST['code'], $_POST['password']);
require_once "../view/templates/footer.php";
?>