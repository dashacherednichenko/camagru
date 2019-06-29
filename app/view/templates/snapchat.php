<?php
if (!$_SESSION['email'] || $_SESSION['email'] == NULL) {
    header("Location: /camagru/account");
}
else {
    require_once "app/config/setup.php";
    $pdo = createConnection ();
?>
<div id="container">
    <div id="main_container">
        <div id="notSavedPhotosDiv">
            <h2 id="h_notsaved" hidden>Not saved photo</h2>
        </div>
        <div id = "photo_container">
            <div class="app">
                <a href="#" id="start-camera" class="visible">Click here to start.</a><br>
                <div id="camera-stream-div">
                    <div id='camera-stream-div-photo' onclick="startVideo()" class="camera-stream-div-photo">
                        <video id="camera-stream"></video>
                        <div id='downloadphoto_img_div'>
                            <img src='' id="downloadphoto_img">
                        </div>
                    </div>
                    <div id="layout">
                        <img src='' id="layout_img">
                    </div>
                </div>
                <p id="error-msg"></p>
                <div class="controls" id="take-photo-div">
                    <a href="#" id="take-photo" title="Take Photo" class="disabled" hidden><img src="public/images/take photo.png" title="take photo"></a>
                    <!--                    <a href="#" id="save-photo" download="my-photo.png" title="Save Photo" class="disabled">Publish</a>-->
                </div>
                <div id="downloadphoto_div">
                    <h2>or download your own photo</h2>
                    <input name="downloadphoto" id="downloadphoto" type="file" onchange='downloadphoto()'>
                </div>
                <canvas></canvas>
            </div>
        </div>
        <div id = "superposable_img">
            <form action="snapchat/photo" method="post" id="make-photo-form" name="photoform">
                <?php
                $directory = "public/images/superposable_img";
                $allowed_types = array("jpg", "png", "gif");
                $photo = array();
                $ext = "";
                $title = "";
                $i = 0;
                $dir = @opendir($directory) or die("error with opening the directory !!!");
                while ($file = readdir($dir))
                {
                    if($file == "." || $file == "..") continue;
                    $photo = explode(".", $file);
                    $ext = strtolower(array_pop($photo));
                    if(in_array($ext,$allowed_types))
                    {
                        echo '<div class = "block_mini_img_filter"><label><input name="superposable" type="radio" value="'.$directory.'/'.$file.'" onclick="makePhotoButtonActiv(this)"><img src="'.$directory.'/'.$file.'" class="mini_img_filter" title="'.$file.'" /></label></div>';
                        $i++;
                    }
                }
                closedir($dir);
                ?>
                <input name="coeficient" value="" hidden id="coeficient">
                <input name="scale" value="" hidden id="scale">
                <input name="maskLeft" value="" hidden id="maskLeft">
                <input name="maskTop" value="" hidden id="maskTop">
                <input name="videoLeft" value="" hidden id="videoLeft">
                <input name="videoTop" value="" hidden id="videoTop">
                <input name="maskWidth" value="" hidden id="maskWidth">
                <input name="maskHeight" value="" hidden id="maskHeight">
                <input name="userPhoto" value="" hidden id="userPhoto">
                <input name="userEmail" value="<?php echo $_SESSION['email']?>" hidden id="userEmail">
                <input type="submit" value="<?php echo $_SESSION['email']?>" id="formSnapButton">
            </form>
        </div>
    </div>
</div>
<?php
}
?>
