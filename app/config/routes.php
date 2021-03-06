<?php
defined('SECRET_KEY') or die('No direct access allowed.');
return array(
    'account/auth' => 'account/auth',
    'account/register' => 'account/adduser',
    'account/changepassword' => 'account/changepassword',
    'account/changenotice' => 'account/changenotice',
    'account/sendlink' => 'account/sendpassword',
    'account/deletephoto' => 'account/deletephoto',
    'account' => 'account/login',
    'comment/addcomment' => 'comment/addcomment',
    'comment/like' => 'comment/like',
    'save' => 'account/savenewdata',
    'change-data' => 'account/changedata',
    'delete-account' => 'account/deleteaccount',
    'logout' => 'account/logout',
    'create' => 'account/register',
    'sendpassword' => 'account/forgetpassword',
    'snapchat' => 'snapchat/page',
    'snapchat/photo' => 'snapchat/photo',
    'snapchat/downloadphoto' => 'snapchat/downloadphoto',
    'snapchat/publishphoto' => 'snapchat/publishphoto',
    'admin/deletedb' => 'admin/deletedb',
    'admin/rewritedb' => 'admin/rewritedb',
    'admin/auth' => 'admin/auth',
    'admin' => 'admin/page',
    '' => 'main/index',
);
?>
