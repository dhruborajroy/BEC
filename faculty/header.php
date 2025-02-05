<?php
session_start();
if (!defined('SECURE_ACCESS')) {
    die("You don't have permission to access the location");
}
require('../inc/constant.inc.php');
require('../inc/connection.inc.php');
require('../inc/function.inc.php');

if(!isset($_SESSION['FACULTY_LOGIN'])){
    redirect("login");
    die;
}
$faculty_id=$_SESSION[ 'FACULTY_ID'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Dhruboraj Roy - http://thedhrubo.xyz">
    <meta name="keywords" content="Barishal Engineering College Teacher's Portal">

    <!-- Title Page-->
    <title>BEC Teacher's Portal</title>

    <!-- Fontfaces CSS-->
    <link href="../students/css/font-face.css" rel="stylesheet" media="all">
    <link href="../students/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../students/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../students/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../students/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../students/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../students/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../students/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../students/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../students/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../students/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../students/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

    <!-- Main CSS-->
    <link href="../students/css/theme.css" rel="stylesheet" media="all">
    <style>
        a, a:link, a:visited {
            text-decoration: none;
        }
    </style>
</head>
<!-- animsition -->
<body class="">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="/">
                            <img src="../images/logo.png" alt="logo" style="max-width: 50%;"/>
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <!-- Mobile View -->

                        <li>
                            <a href="index">
                                <i class="fas fa-chart-bar"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="attendance_data">
                                <i class="fas  fa-certificate"></i>Attendance Data</a>
                        </li>
                        <li>
                            <a href="attendance">
                                <i class="fas fa-calendar-alt"></i>Attendance</a>
                        </li>
                        <li>
                            <a href="profile">
                                <i class="fas fa-user"></i>Profile</a>
                        </li>
                        <li>
                            <a href="edit_profile">
                                <i class="fas fa-user"></i>Edit Profile</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="/">
                    <img src="../images/logo.png" alt="BEC Logo" style="max-width: 100% !important;"/>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <!-- Desktop View -->

                        <li>
                            <a href="index">
                                <i class="fas fa-chart-bar"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="attendance">
                                <i class="fas fa-calendar-alt"></i>Attendance</a>
                        </li>
                        <li>
                            <a href="attendance_data">
                                <i class="fas  fa-certificate"></i>Attendance Data</a>
                        </li>
                        <li>
                            <a href="profile">
                                <i class="fas fa-user"></i>Profile</a>
                        </li>
                        <li>
                            <a href="edit_profile">
                                <i class="fas fa-user"></i>Edit Profile</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                            </form>
                            <div class="header-button">
                            <div class="noti-wrap">
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="../images/teachers/<?php echo $_SESSION['FACULTY_IMAGE']?>" alt="<?php echo $_SESSION['FACULTY_NAME']?>" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_SESSION['FACULTY_NAME']?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="../images/teachers/<?php echo $_SESSION['FACULTY_IMAGE']?>" alt="<?php echo $_SESSION['FACULTY_NAME']?>" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $_SESSION['FACULTY_NAME']?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $_SESSION['FACULTY_EMAIL']?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="profile">
                                                        <i class="zmdi zmdi-account"></i>Profile</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="change_password">
                                                        <i class="zmdi zmdi-settings"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->