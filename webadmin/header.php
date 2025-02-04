<?php 
session_start();
session_regenerate_id();
require('../inc/constant.inc.php');
require('../inc/connection.inc.php');
require('../inc/function.inc.php');
require_once("../inc/smtp/class.phpmailer.php");
isAdmin();
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
      <link rel="stylesheet" href="css/normalize.css">
      <!-- Main CSS -->
      <link rel="stylesheet" href="css/main.css">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Fontawesome CSS -->
      <link rel="stylesheet" href="css/all.min.css">
      <!-- Flaticon CSS -->
      <link rel="stylesheet" href="fonts/flaticon.css">
      <!-- Full Calender CSS -->
      <link rel="stylesheet" href="css/fullcalendar.min.css">
      <!-- Animate CSS -->
      <link rel="stylesheet" href="css/animate.min.css">
      <!-- Select 2 CSS -->
      <link rel="stylesheet" href="css/select2.min.css">
      <!-- Data Table CSS -->
      <link rel="stylesheet" href="css/jquery.dataTables.min.css">
      <!-- Date Picker CSS -->
      <link rel="stylesheet" href="css/datepicker.min.css">
      <!-- font awesome -->
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/fontawesome.min.css" /> -->

      <!-- Toastr CSS -->
      <link rel="stylesheet" href="css/toastr.min.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/custom.css">
      <link rel="stylesheet" href="css/invoice.css">
      <link rel="stylesheet" href="css/summernote/summernote-bs5.min.css">
      <!-- Modernize js -->
      <script src="js/modernizr-3.6.0.min.js"></script>
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
               $uid=$_SESSION['ADMIN_ID']; 
               $sql="select * from `admin` where id='$uid'";
               $row=mysqli_fetch_assoc(mysqli_query($con,$sql));
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
                        <!-- <img src="<?php //echo STUDENT_IMAGE.$row['image']?>" alt="Admin"> -->
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
               <li class="navbar-item dropdown header-notification">
                  <?php
                     if(isset($_SESSION['LAST_NOTIFICATION'])){
                         $session=$_SESSION['LAST_NOTIFICATION'];
                     }else{
                         $session=time();
                     }
                     $sql="select count(id) as number from notice where added_on between ".$session." AND '".time()."'";
                     $res=mysqli_query($con,$sql);
                     $counter=mysqli_fetch_assoc($res);
                     ?>
                  <a class="navbar-nav-link dropdown-toggle" onclick="read_notification('<?php echo time()?>')"
                     role="button" data-toggle="dropdown" aria-expanded="false">
                     <i class="far fa-bell"></i>
                     <div class="item-title d-md-none text-16 mg-l-10">Notification</div>
                     <?php 
                        $number=$counter['number'];
                        if($number!=0){?>
                     <span id="counter">
                     <?php echo $number;?>
                     </span><?php } ?>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                     <div class="item-header">
                        <h6 class="item-title"><?php echo $number?> unread Notifiacations</h6>
                     </div>
                     <?php 
                        $sql="select * from notice where status=1 order by added_on desc limit 5";
                        $res=mysqli_query($con,$sql);
                        if(mysqli_num_rows($res)>0){
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                        ?>
                     <div class="item-content">
                        <div class="media">
                           <div class="item-icon bg-violet-blue">
                              <i class="fas fa-cogs"></i>
                           </div>
                           <a href="./pdfreports/notice.php?notice_id=<?php echo $row['id']?>">
                              <div class="media-body space-sm">
                                 <div class="post-title"><?php echo $row['title']?></div>
                                 <span><?php echo get_time_ago(intval($row['added_on']));?></span>
                              </div>
                           </a>
                        </div>
                     </div>
                     <?php 
                        $i++;
                        } } else { ?>
                     <tr>
                        <td colspan="5">No data found</td>
                     </tr>
                     <?php } ?>
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
                  <a href="about_us" class="nav-link">
                     <i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i>
                     <span>About Us</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="course_teachers" class="nav-link ">
                     <i class="flaticon-couple"></i>
                     <span>Course Teachers</span>
                  </a>
               </li>
               <!-- <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="flaticon-shopping-list"></i><span>Menus</span></a>
                  <ul class="nav sub-group-menu ">
                  <li class="nav-item">
                        <a href="menus"
                           class="nav-link "><i
                           class="fas fa-angle-right"></i>Menus</a>
                     </li>
                     <li class="nav-item">
                        <a href="manage_menus"
                           class="nav-link "><i
                           class="fas fa-angle-right"></i>Add New Menu</a>
                     </li>
                  </ul>
               </li> -->
               <li class="nav-item sidebar-nav-item">
                  <a href="#" class="nav-link"><i class="flaticon-open-book"></i><span>Departments & Labs</span></a>
                  <ul class="nav sub-group-menu ">
                  <li class="nav-item">
                        <a href="departments"
                           class="nav-link "><i
                           class="fas fa-angle-right"></i>Departments</a>
                     </li>
                     <li class="nav-item">
                        <a href="labs"
                           class="nav-link "><i
                           class="fas fa-angle-right"></i>Labs</a>
                     </li>
                  </ul>
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
                     <li class="nav-item">
                        <a href="manage_students"
                           class="nav-link "><i
                           class="fas fa-angle-right"></i>Add new Student</a>
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
                  <a href="#" class="nav-link"><i class="flaticon-settings"></i><span>General Info</span></a>
                  <ul class="nav sub-group-menu ">
                  <li class="nav-item">
                        <a href="bec_general_infos"
                           class="nav-link "><i
                           class="fas fa-angle-right"></i>All
                           BEC Gneral Infos</a>
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
                     <li class="nav-item">
                        <a href="manage_people"
                           class="nav-link "><i
                           class="fas fa-angle-right"></i>
                           Add people</a>
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
               <li class="nav-item">
                  <a href="referances" class="nav-link ">
                     <i class="flaticon-couple"></i>
                     <span>Referances</span>
                  </a>
               </li>
               <!-- library datas -->
                
               <!-- <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-open-book"></i><span>Books</span></a>
                            <ul class="nav sub-group-menu ">
                                <li class="nav-item">
                                    <a href="books" class="nav-link"><i
                                            class="fas fa-angle-right"></i>All
                                        Books</a>
                                </li>
                                <li class="nav-item">
                                    <a href="manage_books"
                                        class="nav-link "><i
                                            class="fas fa-angle-right"></i>Add new Book</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="book_issues" class="nav-link "><i
                                    class="flaticon-technological"></i><span>Issued Books</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="requested_books" class="nav-link "><i
                                    class="flaticon-dashboard"></i><span>Requested Books</span></a>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-planet-earth"></i><span>Publications</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="publications" class="nav-link "><i
                                            class="fas fa-angle-right"></i>All
                                        publications</a>
                                </li>
                                <li class="nav-item">
                                    <a href="manage_publications"
                                        class="nav-link "><i
                                            class="fas fa-angle-right"></i>Add new Publications</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-couple"></i><span>Authors</span></a>
                            <ul class="nav sub-group-menu">
                                <li class="nav-item">
                                    <a href="authors" class="nav-link"><i
                                            class="fas fa-angle-right"></i>All
                                        Authors</a>
                                </li>
                                <li class="nav-item">
                                    <a href="manage_author"
                                        class="nav-link "><i
                                            class="fas fa-angle-right"></i>Add new Author</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item sidebar-nav-item">
                            <a href="#" class="nav-link"><i class="flaticon-menu-1"></i><span>Departments and
                                    Batches</span></a>
                            <ul class="nav sub-group-menu ">
                                <li class="nav-item">
                                    <a href="depts" class=" nav-link "><i
                                            class="fas fa-angle-right"></i>All
                                        Departments</a>
                                </li>
                                <li class="nav-item">
                                    <a href="manageDepts"
                                        class="nav-link "><i
                                            class="fas fa-angle-right"></i>Add new Department</a>
                                </li>
                                <li class="nav-item">
                                    <a href="batches" class="nav-link "><i
                                            class="fas fa-angle-right"></i>All
                                        Batches</a>
                                </li>
                                <li class="nav-item">
                                    <a href="selfs"
                                        class="nav-link "><i
                                            class="fas fa-angle-right"></i>Book Selfs</a>
                                </li>
                            </ul>
                        </li> -->
            </ul>
         </div>
      </div>
      <!-- Sidebar Area End Here -->