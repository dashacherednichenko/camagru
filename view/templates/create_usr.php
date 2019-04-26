<div id="container">
<?php
//session_start();
if ($_SESSION['error_user'] && $_SESSION['error_user'] !== NULL) {
    ?>
    <div id="error_user">
        ERROR <br>
        Користувач з e-mail <b>"<?php echo $_SESSION['error_user']?>"</b> вже існує!
    </div>
<?php
}
?>
    <div id="main_container">
        <form action="controllers/register.php" method="post" id="form_register">
            <label for="email">E-mail: </label>
            <input type="email" name="email" id="email" required><br>

            <label for="username">Username: </label>
            <input type="text" name="username" id="username" required
                   pattern="^[a-zA-Z0-9]{3,20}$" oninvalid="this.setCustomValidity
                   ('Логін має містити лише літери англійської абетки та цифри, довжина від 3 до 20 символів')"
                   oninput="setCustomValidity('')"><br>

            <label for="password">Password: </label>
            <input type="password" name="password" id="password" required
                   pattern="^[a-zA-Z0-9]{5,12}$" oninvalid="this.setCustomValidity
                   ('Пароль має містити лише літери англійської абетки та цифри, довжина від 5 до 12 символів')"
                   oninput="setCustomValidity('')" onkeyup='check();'><br>

            <label for="confirm_password">Confirm password: </label>
            <input type="password" name="confirm_password" id="confirm_password" required
                   pattern="^[a-zA-Z0-9]{5,12}$" onkeyup='check();'><br>
            <span id='message_error'></span><br>

            <input type="button"  name="submit" value="Register" id="register_button"/>
            <p class="regtext"><a href= "login">Already registered? Login!</a></p>
        </form>
    </div>
</div>
