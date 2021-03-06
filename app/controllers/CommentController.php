<?php
defined('SECRET_KEY') or die('No direct access allowed.');
require_once 'app/components/Controller.class.php';

class CommentController
{
    private $data = array();

    function __construct($row)
    {
        $this->data = $row;
    }

    public function actionAddcomment()
    {
        require_once "app/model/comment.php";
        publishcomment();
    }

    public function actionLike()
    {
        require_once "app/model/like.php";
        addlike($_POST['photo'], $_POST['author']);
        return true;
    }

    public static function countLike($id, $pdo)
    {
        require_once "app/model/like.php";
        countLikes($id, $pdo);
        return true;
    }

    public function commentmarkup()
    {
        $d = &$this->data;
        $d['date'] = strtotime($d['date']);
        return '<div class="comment">
        <div class="name">'.$d['author'].': </div><p>'.$d['comment'].'</p>
        <div class="date" title="Added at '.date('H:i \o\n d M Y',$d['date']).'">'.date('d M Y',$d['date']).'</div>
        </div>';
    }


    public static function validate_comment($str)
    {
        if(mb_strlen($str,'utf8')<1)
            return false;
        if(mb_strlen($str,'utf8') > 300)
            return false;
        $str = nl2br(htmlspecialchars($str));
        $str = str_replace(array(chr(10),chr(13)),'',$str);
        return $str;
    }


}