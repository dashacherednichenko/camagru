<?php
if (!$_SESSION['email'] || $_SESSION['email'] == NULL) {
    header("Location: /camagru/account");
}
else {
?>
<div id="container">
    <div id="main_container">
        <div id = "photo_container">
            <div id="photos_published">
                <div id="photos_published_carusel">
                    <?php
                    require_once 'app/model/showUserPhoto.php';
                    showUserPhotos($_SESSION['email']);
                    ?>
                </div>
            </div>
            <div class="app">
                <a href="#" id="start-camera" class="visible">Click here to start.</a><br>
                <div id="camera-stream-div" title="click to start">
                    <div id='camera-stream-div-photo' onclick="startVideo()">
                        <video id="camera-stream"></video>
                    </div>
                    <div id="layout">
                        <img src="" id="layout_img">
                    </div>
                </div>
                <p id="error-msg"></p>
                <div class="controls" id="take-photo-div">
                    <a href="#" id="take-photo" title="Take Photo" class="disabled" hidden>Take Photo</a>
                    <!--                    <a href="#" id="save-photo" download="my-photo.png" title="Save Photo" class="disabled">Publish</a>-->
                </div>
                <div id="notSavedPhotosDiv">
                <?php
                if (isset($_SESSION['photo']) && $_SESSION['photo'] != NULL && file_exists($_SESSION['photo'])) {
                    ?>
                    <h2 id="h_notsaved" hidden>Not saved and published photo!</h2>
                    <img id="snap" src="<?php echo $_SESSION['photo']?>" class="visible" style="display:inline-block;">
                    <div class="controls" id="saveDelete" hidden>
                        <form method="post" action="snapchat/deletetmpphoto" id="delete-photo-form">
                            <input type="submit"  id="delete-photo" title="Delete Photo" class="disabled" value="Delete">
                        </form>
                        <form method="post" action="snapchat/publishphoto" id="publish-photo-form">
                            <input type="submit"  id="save-photo" title="Save Photo" class="disabled" value="Publish">
                        </form>
                        <!--                    <a href="#" id="save-photo" download="my-photo.png" title="Save Photo" class="disabled">Publish</a>-->
                    </div>
                    <?php
                }
                else {
                    ?>
                    <img id="snap" src=""/>
                    <?php
                }
                ?>
                </div>
                <canvas></canvas>
            </div>
        </div>
        <div id = "superposable_img">
            <form action="snapchat/photo" method="post">
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
                <input name="maskLeft" value="" hidden id="maskLeft">
                <input name="maskTop" value="" hidden id="maskTop">
                <input name="videoLeft" value="" hidden id="videoLeft">
                <input name="videoTop" value="" hidden id="videoTop">
                <input name="maskWidth" value="" hidden id="maskWidth">
                <input name="maskHeight" value="" hidden id="maskHeight">
                <input name="userPhoto" value="" hidden id="userPhoto">
                <input name="userEmail" value="" hidden id="userEmail">
                <input type="submit" value="<?php echo $_SESSION['email']?>" id="formSnapButton">
            </form>
        </div>
    </div>
</div>
<?php
}
?>
