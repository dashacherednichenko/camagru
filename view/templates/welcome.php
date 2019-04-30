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
    if (!$_SESSION['email'] || $_SESSION['email'] == NULL) {
    ?>
    <div id="main_container">
        <form action="controllers/login.php" method="post" id="form_login">
            <label for="email">E-mail: </label><input type="text" name="email" id="email"><br>
            <label for="password">Password: </label><input type="password" name="password" id="password"><br>
            <input type="submit"  name="submit" value="Login"/>
            <p class="regtext"><a href= "create">Not register yet?</a></p>
        </form>
    </div>
        <?php
    }
    else {
        ?>
        <div id="main_container">
            <h1>My account</h1>
        </div>
        <?php
    }
    ?>
</div>