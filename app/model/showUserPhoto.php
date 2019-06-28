<?php
defined('SECRET_KEY') or die('No direct access allowed.');
require_once 'app/controllers/CommentController.php';
function showUserPhotos($email, $pdo)
{
//        require_once "app/model/newpassword.php";
//    require_once "app/config/setup.php";
//    $pdo = createConnection ();
    $login_usr = 'SELECT email, username, activation, id FROM users';
    foreach ($pdo->query($login_usr) as $row) {
        if ($row['email'] == $email && $row['activation'] == 1) {
            $id = $row['id'];
//            echo $id;
            $photos = $pdo->prepare('SELECT filename, author, id, date FROM photos WHERE author = ? ORDER BY date DESC');
            $photos->execute([$id]);
            $count = 0;
            foreach ($photos as $rowphoto) {
                $count++;
                echo "<div class='gallery_photo'><div class='gallery_photo_frame'><img src=".$rowphoto['filename']." class='gallery_photos' id=".$rowphoto['id']."></div>
                    <div class='likes_block'>
                   <div class='likes_miniblock'><img src='public/images/like_red.png' title='like' >
                    <span class='likesspan' id='span". $rowphoto['id'] ."'>";
                            CommentController::countLike($rowphoto['id'], $pdo);
                            echo "</span></div>
                    <a href='account/deletephoto?id=$rowphoto[id]&email=$_SESSION[email]' title='delete photo' onclick='return confirm(\"Are you sure you want to delete this photo?\")'>
                        <img src='public/images/remove.png' title='remove'>
                    </a>
                    <span class='date'>".$rowphoto['date']."</span>
                    </div>
                    </div>";
            }
            if ($count == 0)
                echo "<h3>You have no photos yet =(</h3><br><a href='snapchat'>go to snapchat?</a>";
        }
    }


//echo $email;
return true;
}
?>