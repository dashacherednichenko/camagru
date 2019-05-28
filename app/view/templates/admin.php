<div id="main_container">
    <h1>Admin panel</h1>
<?php
if (!(isset($_SESSION['admin'])) || $_SESSION['admin'] == NULL) {
    ?>
        <form action="admin/auth" method="post" id="form_adminlogin">
            <!--        <label for="email">E-mail: </label><input type="email" name="email" id="email" required><br>-->
            <label for="password">Password: </label><input type="password" name="password" id="password" required><br>
            <input type="submit" name="submit" value="Login"/>
            <!--        <p class="regtext"><a href= "sendpassword">Forget your password?</a></p>-->
        </form>
    <?php
}
else {
    ?>
    <h3>Hello, ADMIN!!!</h3>
    <ul class="admin_todo">
        <li>
            <a href='admin/deletedb' title='delete DB' onclick='return confirm("do you  REALLY want to DELETE all DATA BASE?! REALLY??? DELETE????")'>&#10008; Delete data-base?
        </li>
        <li>
            <a href='admin/rewritedb' title='rewrite DB' onclick='return confirm("do you want to rewrite DATA BASE?")'>&#9999; Rewrite data-base?
        </li>
    </ul>
    <?php
}
    ?>
</div>
