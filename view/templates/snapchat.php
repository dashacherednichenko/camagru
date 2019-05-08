<?php
if (!$_SESSION['email'] || $_SESSION['email'] == NULL) {
    header("Location: /camagru/login");
}
else {
?>
<div id="container">
    <div id="main_container">
        <div id = "photo_container"></div>
        <div id = "superposable_img">
            <?php
            $directory = "images/superposable_img";
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
                    echo '<div class = "block_mini_img_filter" ><img src="'.$directory.'/'.$file.'" class="mini_img_filter" title="'.$file.'" /></div>';
                    $i++;
                }
            }
            closedir($dir);
            ?>
        </div>
    </div>
</div>
<?php
}
?>
