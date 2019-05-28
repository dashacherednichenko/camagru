<div id="container">
    <div id="main_container">
    <?php
    //session_start();
    if (!(isset($_SESSION['email'])) || $_SESSION['email'] == NULL) {
        ?>
        <div id="error_user">
            ERROR <br>
            <a href="account">Увійдіть в свій обіковий запис</a>, або <a href="create">зереєструйтесь</a>!
        </div>
        <?php
    }
    else {
        ?>
            <form action="" method="post" id="form_register">
                <label for="email">E-mail: </label>
                <input type="email" name="email" id="email" required value="<?php echo $_SESSION['email']?>">
                <img src="/camagru/public/images/edit.png" class="edit">
                <br>
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" required
                       pattern="^[a-zA-Z0-9]{3,20}$" oninvalid="this.setCustomValidity
                   ('Логін має містити лише літери англійської абетки та цифри, довжина від 3 до 20 символів')"
                       oninput="setCustomValidity('')" value="<?php echo $_SESSION['login']?>">
                <img src="/camagru/public/images/edit.png" class="edit">
                <br>
                <p class="regtext">**to change your data you must enter your current password!</p>
                <label for="password">Password: </label>
                <input type="password" name="oldpassword" id="oldpassword" required>
                <img src="/camagru/public/images/edit.png" class="edit" id='edit' onclick="showPasswordDiv()">
                <br>
                <div class="hidden_div" hidden>
                    <p class="regtext">&#11015;&#11015;&#11015;Please, enter your new password and confirm it&#11015;&#11015;&#11015;</p>
                    <label for="password">New password: </label>
                    <input type="password" name="password" id="password"
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" oninvalid="this.setCustomValidity
                                   ('Пароль має містити мінімум вісім символов, як мінімум одна велика літера, одна маленька літера і одна цифра')"
                           oninput="setCustomValidity('')" onkeyup='check();'><br>

                    <label for="confirm_password">Confirm new password: </label>
                    <input type="password" name="confirm_password" id="confirm_password"
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" onkeyup='check();'><br>
                </div>
                <span id='message_error'></span><br>
                <p class="regtext">*If you will change your email, you should confirm your new address. We will send you a new link</p>
                <input type="submit" name="submit" value="Change" id="register_button"/>
            </form>
        <?php
    }
    ?>
    </div>
</div>