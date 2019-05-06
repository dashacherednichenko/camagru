<?php
?>
<div id="container">
    <?php
    //session_start();
    if ($_SESSION['error_login'] && $_SESSION['error_login'] !== NULL) {
        ?>
        <div id="error_user">
            ERROR <br>
            Не існує користувача з e-mail <b>"<?php echo $_SESSION['error_login']?>"</b>, або не вірний пароль!
        </div>
        <?php
    }
    if ($_SESSION['error_activation'] && $_SESSION['error_activation'] !== NULL) {
        ?>
        <div id="error_user">
            ERROR <br>
            Користувач з e-mail <b>"<?php echo $_SESSION['error_activation']?>"</b> не активований!
        </div>
        <?php
    }
    if (!$_SESSION['email'] || $_SESSION['email'] == NULL) {
    ?>
    <div id="main_container">
        <form action="controllers/login.php" method="post" id="form_login">
            <label for="email">E-mail: </label><input type="email" name="email" id="email" required><br>
            <label for="password">Password: </label><input type="password" name="password" id="password" required><br>
            <input type="submit"  name="submit" value="Login"/>
            <p class="regtext"><a href= "create">Not register yet?</a></p>
            <p class="regtext"><a href= "sendpassword">Forget your password?</a></p>
        </form>
    </div>
        <?php
    }
    else {
        ?>
        <div id="main_container">
            <h1>My account</h1>
            <p>Username: <?php echo $_SESSION['login']?></p>
            <p>E-mail: <?php echo $_SESSION['email']?></p>
            <p class="regtext"><a href = "change-data">Do you want to change your data?</a></p>
            <?php

            ?>
        </div>
        <?php
    }
    ?>
</div>