<?php 
define('SECURE_ACCESS', true);
session_start();
include('../inc/connection.inc.php');
include('../inc/constant.inc.php');
include('../inc/function.inc.php');
isFaculty();
unset($_SESSION['FACULTY_LOGIN']);
unset($_SESSION['FACULTY_ID']);
unset($_SESSION['FACULTY_EMAIL']);
redirect('login.php');
?>