<?php
if (!$_SESSION['email'] || $_SESSION['email'] == NULL) {
    header("Location: /camagru/login");
}
else {
?>
<div id="container">
    <div id="main_container">
        <div>test</div>
        <div id="superposable_img">
        </div>
    </div>
</div>
<?php
}
?>
