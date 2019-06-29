<?php
require_once "header.php";
if (isset($_GET['code']))
    $code = $_GET['code'];
else
    exit("Error Link! No confirmation code!");
if (isset($_GET['id']))
    $id = $_GET['id'];
else
    exit("Error Link! No id!");
if (isset($_GET['code']) && isset($_GET['id'])) {
    ?>
<div id="container">
    <div id="main_container">
        <p>Enter the new password to your Camagru account.</p>
        <form action="account/changepassword" method="post" id="form_register">
            <input type="hidden"  name="id" value="<?php echo $id?>"/>
            <input type="hidden"  name="code" value="<?php echo $code?>"/>
            <label for="password">New password: </label>
            <input type="password" name="password" id="password" required
                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" oninvalid="this.setCustomValidity
                   ('Пароль має містити мінімум вісім символов, як мінімум одна велика літера, одна маленька літера і одна цифра')"
                   oninput="setCustomValidity('')" onkeyup='check();'><br>
            <label for="confirm_password">Confirm password: </label>
            <input type="password" name="confirm_password" id="confirm_password" required
                   pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" onkeyup='check();'><br>
            <span id='message_error'></span><br>
            <input type="button"  name="submit" value="Change" id="register_button"/>
        </form>
    </div>
</div>
    <?php
}
require_once "footer.php";
require_once "scripts/scripts_register.php";
?>
