<?php
if (!$_SESSION['email'] || $_SESSION['email'] == NULL) {
    header("Location: /camagru/account");
}
else {
?>
<div id="container">
    <div id="main_container">
        <div id = "photo_container">
            <div class="app">
                <a href="#" id="start-camera" class="visible">Click here to start.</a><br>
                <video id="camera-stream"></video>
                <img id="snap">

                <p id="error-msg"></p>

                <div class="controls">
                    <a href="#" id="delete-photo" title="Delete Photo" class="disabled">delete</a>
                    <a href="#" id="take-photo" title="Take Photo">Take Photo</a>
                    <a href="#" id="save-photo" download="my-photo.png" title="Save Photo" class="disabled">Save Photo</a>
                </div>
                <canvas></canvas>
            </div>
        </div>
        <div id = "superposable_img">
            <form action="snapchat/photo">
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
                        echo '<div class = "block_mini_img_filter"><label><input name="superposable" type="radio" value="'.$directory.'/'.$file.'"><img src="'.$directory.'/'.$file.'" class="mini_img_filter" title="'.$file.'" /></label></div>';
                        $i++;
                    }
                }
                closedir($dir);
                ?>
                <input type="submit" value="Photo">
            </form>
        </div>
    </div>
</div>
<?php
}
?>
