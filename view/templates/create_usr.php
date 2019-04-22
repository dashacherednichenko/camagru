<?php
?>
<div id="container">
    <div id="main_container">
        <form action="controllers/register.php" method="post" id="form_register">
            <label for="email">E-mail: </label><input type="text" name="email" id="email"><br>
            <label for="username">Username: </label><input type="text" name="username" id="username"><br>
            <label for="password">Password: </label><input type="password" name="password" id="password"><br>
            <button type="submit">Register</button>
            <p class="regtext"><a href= "login">Already registered? Login!</a></p>
        </form>
    </div>
</div>
