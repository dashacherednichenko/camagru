<?php
require_once "model/clearSession.php";
clearSession();
?>
<div id="container">
        <div id="main_container">
            <p>Enter the email address associated with your Camagru account.</p>
            <form action="controllers/sendpassword.php" method="post" id="">
                <label for="email">E-mail: </label><input type="email" name="email" id="email" required><br>
                <input type="submit"  name="submit" value="Send"/>
            </form>
        </div>

</div>
