<?php
defined('SECRET_KEY') or die('No direct access allowed.');
require_once "app/config/setup.php";
$pdo = createConnection ();
?>
<div id="container">
    <?php
    if (isset($_SESSION['error_login']) && $_SESSION['error_login'] !== NULL) {
        ?>
        <div id="error_user">
            ERROR <br>
            Не існує користувача з e-mail <b>"<?php echo $_SESSION['error_login']?>"</b>, або не вірний пароль!
        </div>
        <?php
    }
    if (isset($_SESSION['error_activation']) && $_SESSION['error_activation'] !== NULL) {
        ?>
        <div id="error_user">
            ERROR <br>
            Користувач з e-mail <b>"<?php echo $_SESSION['error_activation']?>"</b> не активований!
        </div>
        <?php
    }
    if (!(isset($_SESSION['email'])) || $_SESSION['email'] == NULL) {
    ?>
    <div id="main_container">
        <form action="account/auth" method="post" id="form_login">
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
            <p>Username: <?php echo $_SESSION['login']?>
                <br>
            </p>
            <div class="notifications">
                &#9998; Notifications about new comments
                <input type="checkbox" onchange="changeNotification()"
                       <?php
                       $test = AccountController::checknotification($pdo);
                        ?>
                       id="notifications" name="notifications" value="" />
                <label for="notifications" id="notifications_label">
                    <?php
                    if($test == 1)
                        echo 'yes=)';
                    else
                        echo 'no =(';
                    ?>
                </label>
            </div>
            <p>E-mail: <?php echo $_SESSION['email']?></p>
            <p class="regtext"><a href = "change-data">&#9998; Do you want to change your data?</a></p>
            <p class="regtext"><a href = "delete-account"  onclick='return confirm("do you  REALLY want to DELETE your account??? =(")'>&#9760; &#9940;Do you want to delete your account? &#9940; &#9760;</a></p>
            <h2>My photos</h2>
            <?php
                require_once 'app/model/showUserPhoto.php';
                showUserPhotos($_SESSION['email'], $pdo);
            ?>
        </div>
        <?php
    }
    ?>
</div>