<?php 
session_start();
session_regenerate_id();
require('../inc/constant.inc.php');
require('../inc/connection.inc.php');
require('../inc/function.inc.php');
require_once("../inc/smtp/class.phpmailer.php");
if(!isset($_SESSION['DEPT_ADMIN_LOGIN'])){
   redirect('login.php');
   die;
}
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Barishal Engineering College | Developed by Dhrubo</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
      <!-- Normalize CSS -->
      <link rel="stylesheet" href="../webadmin/css/normalize.css">
      <!-- Main CSS -->
      <link rel="stylesheet" href="../webadmin/css/main.css">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="../webadmin/css/bootstrap.min.css">
      <!-- Fontawesome CSS -->
      <link rel="stylesheet" href="../webadmin/css/all.min.css">
      <!-- Flaticon CSS -->
      <link rel="stylesheet" href="../webadmin/fonts/flaticon.css">
      <!-- Full Calender CSS -->
      <link rel="stylesheet" href="../webadmin/css/fullcalendar.min.css">
      <!-- Animate CSS -->
      <link rel="stylesheet" href="../webadmin/css/animate.min.css">
      <!-- Select 2 CSS -->
      <link rel="stylesheet" href="../webadmin/css/select2.min.css">
      <!-- Data Table CSS -->
      <link rel="stylesheet" href="../webadmin/css/jquery.dataTables.min.css">
      <!-- Date Picker CSS -->
      <link rel="stylesheet" href="../webadmin/css/datepicker.min.css">

      <!-- Toastr CSS -->
      <link rel="stylesheet" href="../webadmin/css/toastr.min.css">
      <link rel="stylesheet" href="../webadmin/css/style.css">
      <link rel="stylesheet" href="../webadmin/css/custom.css">
      <link rel="stylesheet" href="../webadmin/css/summernote/summernote-bs5.min.css">
      <!-- Modernize js -->
      <script src="../webadmin/js/modernizr-3.6.0.min.js"></script>
   </head>
   <body>
      <!-- Preloader Start Here -->
      <!-- <div id="preloader"></div> -->
      <!-- Preloader End Here -->
      <div id="wrapper" class="wrapper bg-ash">
      <!-- Header Menu Area Start Here -->
      <div class="navbar navbar-expand-md header-menu-one bg-light">
         <div class="nav-bar-header-one">
            <div class="header-logo">
               <a href="/"target="_blank">
                  <img src="../images/logo.png" alt="logo" width="172px">
               </a>
            </div>
            <div class="toggle-button sidebar-toggle">
               <button type="button" class="item-link">
               <span class="btn-icon-wrap">
               <span></span>
               <span></span>
               <span></span>
               </span>
               </button>
            </div>
         </div>
         <div class="d-md-none mobile-nav-bar">
            <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse"
               data-target="#mobile-navbar" aria-expanded="false">
            <i class="far fa-arrow-alt-circle-down"></i>
            </button>
            <button type="button" class="navbar-toggler sidebar-toggle-mobile">
            <i class="fas fa-bars"></i>
            </button>
         </div>
         <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
            <ul class="navbar-nav">               
            </ul>
            <?php 
               $uid=$_SESSION['DEPT_ADMIN_ID']; 
               $sql="select * from `dept_admin` where id='$uid'";
               $row=mysqli_fetch_assoc(mysqli_query($con,$sql));
               $dept_id=$row['dept_id'];
               ?>
            <ul class="navbar-nav">
               <li class="navbar-item dropdown header-admin">
                  <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                     aria-expanded="false">
                     <div class="admin-title">
                        <h5 class="item-title"><?php echo $row['name']?></h5>
                        <span>Admin</span>
                     </div>
                     <div class="admin-img">
                     </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                     <div class="item-header">
                        <h6 class="item-title">Welcome <?php echo $row['name']?></h6>
                     </div>
                     <div class="item-content">
                        <ul class="settings-list">
                           <li><a href="profile.php"><i class="flaticon-user"></i>My Profile</a></li>
                           <li><a href="change_password.php"><i class="flaticon-user"></i>Change Password</a></li>
                           <li><a href="logout.php"><i class="flaticon-turn-off"></i>Log Out</a></li>
                        </ul>
                     </div>
                  </div>
               </li>
               <li class="navbar-item dropdown header-language">
               </li>
            </ul>
         </div>
      </div>
      <!-- Header Menu Area End Here -->
      <!-- Page Area Start Here -->
      <div class="dashboard-page-one">
      <!-- Sidebar Area Start Here -->
      <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
         <div class="mobile-sidebar-header d-md-none">
            <div class="header-logo">
               <a href="index.php"><img src="../images/logo.png" alt="logo"></a>
            </div>
         </div>
         <div class="sidebar-menu-content">
            <ul class="nav nav-sidebar-menu sidebar-toggle-view">
               <li class="nav-item">
                  <a href="index" class="nav-link ">
                     <i class="flaticon-dashboard"></i>
                     <span>Dashboard</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="sliders" class="nav-link ">
                     <i class="flaticon-menu-1"></i>
                     <span>Sliders</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="course_teachers" class="nav-link ">
                     <i class="flaticon-couple"></i>
                     <span>Course Teachers</span>
                  </a>
               </li>
               <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="flaticon-calendar"></i><span>Services & Requests </span></a>
                  <ul class="nav sub-group-menu ">
                  <li class="nav-item">
                        <a href="service_requests"
                           class="nav-link "><i
                           class="fas fa-briefcase"></i>Services Request</a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Students</span></a>
                  <ul class="nav sub-group-menu ">
                     <li class="nav-item">
                        <a href="students"
                           class="nav-link "><i
                           class="fas fa-angle-right"></i>All Students</a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item">
                  <a href="about_us_contents" class="nav-link ">
                     <i class="flaticon-dashboard"></i>
                     <span>About Us Contents</span>
                  </a>
               </li>
               <li class="nav-item sidebar-nav-item">
                     <a href="#" class="nav-link"><i class="flaticon-script"></i><span>Notices</span></a>
                     <ul class="nav sub-group-menu ">
                        <li class="nav-item">
                           <a href="notices.php"
                                 class="nav-link "><i
                                    class="fas fa-angle-right"></i>All
                                 Notices</a>
                        </li>
                        <li class="nav-item">
                           <a href="manage_notice.php"
                                 class="nav-link "><i
                                    class="fas fa-angle-right"></i>Add new notice</a>
                        </li>
                        <li class="nav-item">
                           <a href="upload_notice.php"
                                 class="nav-link "><i
                                    class="fas fa-angle-right"></i>Upload notice</a>
                        </li>
                     </ul>
               </li>
               <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="flaticon-user"></i><span>Faculty & Staffs</span></a>
                  <ul class="nav sub-group-menu ">
                  <li class="nav-item">
                        <a href="people"
                           class="nav-link "><i
                           class="fas fa-angle-right"></i>All
                           People</a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="flaticon-planet-earth"></i><span>News</span></a>
                  <ul class="nav sub-group-menu ">
                  <li class="nav-item">
                        <a href="news"
                           class="nav-link "><i
                           class="fas fa-angle-right"></i>All
                           News</a>
                     </li>
                     <li class="nav-item">
                        <a href="manage_news"
                           class="nav-link "><i
                           class="fas fa-angle-right"></i>
                           Add News</a>
                     </li>
                  </ul>
               </li>
               <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Testimonials</span></a>
                  <ul class="nav sub-group-menu ">
                  <li class="nav-item">
                        <a href="testimonials"
                           class="nav-link "><i
                           class="fas fa-angle-right"></i>All
                           testimonials</a>
                     </li>
                  </ul>
               </li>
            </ul>
         </div>
      </div>
      <!-- Sidebar Area End Here -->