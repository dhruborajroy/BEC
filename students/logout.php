<?php 
define('SECURE_ACCESS', true);
session_start();
session_regenerate_id();
include('../inc/connection.inc.php');
include('../inc/constant.inc.php');
include('../inc/function.inc.php');
isUSER();
unset($_SESSION['USER_LOGIN']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_EMAIL']);
redirect('login.php');
?>