<?php
defined('SECRET_KEY') or die('No direct access allowed.');
require_once "app/model/clearSession.php";
clearSession();
?>
<div id="container">
        <div id="main_container">
            <p>Enter the email address associated with your Camagru account.</p>
            <form action="account/sendlink" method="post" id="">
                <label for="email">E-mail: </label><input type="email" name="email" id="email" required><br>
                <input type="submit"  name="submit" value="Send"/>
            </form>
        </div>

</div>
