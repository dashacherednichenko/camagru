<?php
defined('SECRET_KEY') or die('No direct access allowed.');
require_once "app/config/setup.php";
require_once 'app/lib/Pagination.php';
require_once 'app/view/templates/header.php';
require_once 'app/view/templates/main.php';
require_once 'app/model/printcomments.php';
require_once 'app/model/like.php';
$pagination = new Pagination();
(!isset($_GET['page'])) ? $_page = 0 : $_page = (int)$_GET['page'];
$_page > 0? $_page-- : $_page = 0;
$_max_item = 6;
$_offset = $_max_item * $_page;
$pdo = createConnection ();
$login_usr = 'SELECT email, username, activation, id FROM users';
$photos = 'SELECT id, filename, author, date FROM photos ORDER BY date DESC limit '. $_max_item . ' offset '. $_offset;
$_all_photos = 'SELECT * FROM photos ORDER BY date DESC';
$comments = 'SELECT * FROM comments ORDER BY id ASC';
if (isset($_SESSION['email']) && $_SESSION['email'] !== NULL){
    foreach ($pdo->query($photos) as $row) {
        $id = $row['id'];
        echo "<div class='gallery_photo'>
        <div class='gallery_photo_frame'>
        <img src=" . $row['filename'] . " class='gallery_photos'>
        </div>
        <div class='likes_block active'>
            <img src='public/images/comment.png' title='comment' onclick='show_comments(" . $row['id'] . ")'>
            <div class='likes_miniblock'><img src='public/images/like_red.png' title='like' class='".activelike($row['id'], $pdo)."' id='likeimg".$row['id']."' onclick='submitLikeForm(".$row['id'].")'>
            <form class='addLikeForm' id='addLikeForm".$row['id']."' onsubmit='like(this, ".$id.");return false' style='display: none'>
                        <input name='photo' value='". $row['id'] ."' hidden id='photo'>
                        <input name='author' value='". $_SESSION['email'] ."' hidden id='author'>
                        <input type='submit' id='submit". $row['id'] ."'  hidden value='Send' />
            </form>
            <span class='likesspan' id='span". $row['id'] ."'>";
            CommentController::countLike($row['id'], $pdo);
            echo "</span></div>
        <span class='date'>" . $row['date'] . "</span>
        </div>
        <div class='comments_block' id='photo" . $row['id'] . "' style='display:none'>
            <button class='button_close' id='close_one_click". $row['id'] ."' onclick='close_window(". $row['id'] .")'>X</button>
            <div class='addCommentContainer'>
                <form class='addCommentForm' id='addCommentForm' onsubmit='addcomments(this);return false'>
                    <div>
                        <label for='comment'>Add your comment</label>
                        <textarea name='comment' id='comment' rows='5' required placeholder='max 300 characters'></textarea><br>
                        <input name='photo' value='". $row['id'] ."' hidden id='photo'>
                        <input name='author' value='". $_SESSION['email'] ."' hidden id='author'>
                        <input type='submit' id='submit' value='Send' />
                    </div>
                </form>
            </div>";
        print_com($pdo, $row['id']);
//        echo "<span>".$i."<span>";
        echo "</div>
    </div>";
    }

}
else {
    foreach ($pdo->query($photos) as $row) {
        echo "<div class='gallery_photo'><div class='gallery_photo_frame'><img src=" . $row['filename'] . " class='gallery_photos'></div>
    <div class='likes_block nonactive'>
    <div class='likes_miniblock'><img src='public/images/like_red.png' title='like' >
    <span class='likesspan' id='span". $row['id'] ."'>";
            CommentController::countLike($row['id'], $pdo);
            echo "</span></div>
    <span class='date'>" . $row['date'] . "</span>
    </div>
    </div>";
    }
}
?>
<?php
$_js_function = 'load_gallery';
?>
<div class="pagination">
<?php
$pagination->btn_primary($_all_photos, $_page, $_max_item, $_js_function, $pdo);
?>
</div>
</div>
</div>
<div id="side_bar">
</div>
</div>
<?php
require_once 'app/view/templates/footer.php';
require_once 'app/view/templates/scripts/scripts_gallery.php';
?>
