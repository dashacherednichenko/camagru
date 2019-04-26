<?php
?>
<div id="container">
    <div id="main_container">
        <form action="controllers/login.php" method="post" id="form_login">
            <label for="email">E-mail: </label><input type="text" name="email" id="email"><br>
            <label for="password">Password: </label><input type="password" name="password" id="password"><br>
            <input type="submit"  name="submit" value="Login"/>
            <p class="regtext"><a href= "create">Not register yet?</a></p>
        </form>
    </div>
</div>
