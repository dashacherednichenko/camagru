<?php
defined('SECRET_KEY') or die('No direct access allowed.');
return array(
    'account/auth' => 'account/auth',
    'account/register' => 'account/adduser',
    'account/changepassword' => 'account/changepassword',
    'account/sendlink' => 'account/sendpassword',
    'account/deletephoto' => 'account/deletephoto',
    'account' => 'account/login',
    'save' => 'account/savenewdata',
    'change-data' => 'account/changedata',
    'logout' => 'account/logout',
    'create' => 'account/register',
    'sendpassword' => 'account/forgetpassword',
    'snapchat' => 'snapchat/page',
    'snapchat/photo' => 'snapchat/photo',
    'snapchat/downloadphoto' => 'snapchat/downloadphoto',
    'snapchat/deletetmpphoto' => 'snapchat/deletetmpphoto',
    'snapchat/publishphoto' => 'snapchat/publishphoto',
    'admin/deletedb' => 'admin/deletedb',
    'admin/rewritedb' => 'admin/rewritedb',
    'admin/auth' => 'admin/auth',
    'admin' => 'admin/page',
    '' => 'main/index',
);
?>
