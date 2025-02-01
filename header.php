<?php 
if (!defined('SECURE_ACCESS')) {
  die("Direct access not allowed!");
}
require('./inc/constant.inc.php');
require('./inc/connection.inc.php');
require('./inc/function.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="BEC, Barishal Engineering College" />
    <meta name="description" content="Barishal Engineering College - An affiliated Engineering Collge" />
    <meta name="author" content="Dhruboraj Roy(thedhrubo.xyz)" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Barishal Engineering College - An affiliated Engineering Collge</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200&amp;display=swap" rel="stylesheet">

    <!-- CSS Global Compulsory (Do not remove)-->
    <link rel="stylesheet" href="css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="css/flaticon/flaticon.css" />
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />

    <!-- Page CSS Implementing Plugins (Remove the plugin CSS here if site does not use that feature)-->
    <link rel="stylesheet" href="css/select2/select2.css" />
    <link rel="stylesheet" href="css/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="css/swiper/swiper.min.css" />
    <link rel="stylesheet" href="css/animate/animate.min.css"/>
    <link rel="stylesheet" href="http://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css"/>

    <!-- Template Style -->
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>

    <!--=================================
    Header -->
    <header class="header header-sticky">
      <div class="topbar bg-dark py-3 d-none d-lg-flex">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="d-none d-lg-flex justify-content-end  text-center">
                <div class="social-icon">
                  <ul class="social-icon">
                    <li>
                      <a href="http://bec.ac.bd" target="_blank" rel="noopener noreferrer">Old Website</a>
                    </li>
                    <li>
                      <a href="http://gmail.com" target="_blank" rel="noopener noreferrer">Webmail</a>
                    </li>
                    <li>                      
                      <a href="http://library.bec.edu.bd" target="_blank" rel="noopener noreferrer">Libray</a>
                    </li>
                    <li>
                      <a href="http://gmail.com" target="_blank" rel="noopener noreferrer">Webmail</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="header-main">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="d-lg-flex align-items-center">
                <!-- logo -->
                <a class="navbar-brand logo" href="index.php">
                  <img src="images/logo.png" alt="Logo">
                </a>
                <nav class="navbar navbar-expand-lg">

                <!-- Navbar toggler START-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar toggler END-->

                <!-- Navbar START -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                  <ul class="navbar-nav">
                    <li class="nav-item dropdown active">
                      <a class="nav-link dropdown-toggle" href="index" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About Us<i class="fas fa-chevron-down fa-xs"></i>
                      </a>
                      <!-- Dropdown Menu -->
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="history.php">History</a></li>
                        <!-- <li><a class="dropdown-item" href="infrastructure.php">Infrastructure</a></li> -->
                        <li><a class="dropdown-item" href="vision-mission.php">Vision and Mission</a></li>
                        <!-- <li><a class="dropdown-item" href="bec-organogram.php">Organogram</a></li> -->
                        <li><a class="dropdown-item" href="bec-at-glance.php">BEC at a Glance</a></li>
                        <li><a class="dropdown-item" href="bec-monogram.php">BEC Monogram</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Departments<i class="fas fa-chevron-down fa-xs"></i>
                      </a>
                      <!-- Dropdown Menu -->
                      <ul class="dropdown-menu">
                      <?php
                      $depts_lab_list_sql="SELECT * FROM `depts_lab_list` where public_view='1'";
                      $depts_lab_list_res=mysqli_query($con,$depts_lab_list_sql);
                      if(mysqli_num_rows($depts_lab_list_res)>0){
                      while($depts_lab_list_row=mysqli_fetch_assoc($depts_lab_list_res)){
                      ?>
                        <li><a class="dropdown-item" target="_blank" href="<?php echo strtolower($depts_lab_list_row['short_form'])?>">Department of <?php echo $depts_lab_list_row['name']?></a></li>
                      <?php 
                        } } else { ?>
                      <?php } ?>
                      </ul>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link  dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Academic<i class="fas fa-chevron-down fa-xs"></i>
                      </a>
                      <!-- Dropdown Menu -->
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="result.php">Results</a></li>
                          <!-- <li><a class="dropdown-item" href="class-routine.php">Class Routine</a></li>
                          <li><a class="dropdown-item" href="syllabus.php">Syllabus</a></li>
                          <li><a class="dropdown-item" href="exam-schedule.php">Exam Schedule</a></li>
                          <li><a class="dropdown-item" href="academic-calender.php">Academic Calender</a></li> -->
                      </ul>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link  dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        People<i class="fas fa-chevron-down fa-xs"></i>
                      </a>
                      <!-- Dropdown Menu -->
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="faculties.php">Faculty</a></li>
                          <li><a class="dropdown-item" href="class-routine.php">Class Routine</a></li>
                          <li><a class="dropdown-item" href="syllabus.php">Syllabus</a></li>
                          <li><a class="dropdown-item" href="exam-schedule.php">Exam Schedule</a></li>
                          <li><a class="dropdown-item" href="academic-calender.php">Academic Calender</a></li>
                      </ul>
                    </li>
                    <?php
                    $menu_res=mysqli_query($con,"select * from menus where status=1");
                    while($row=mysqli_fetch_assoc($menu_res)){
                    ?>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <?php echo $row['name'];
                          $menu_id=$row['id'];
                          $sub_menu_res=mysqli_query($con,"select * from sub_menu where status='1' and menu_id='$menu_id'");
                          if(mysqli_num_rows($sub_menu_res)>0){
                          ?>                          
                            <i class="fas fa-chevron-down fa-xs"></i>
                          <?php }?>
                        </a>
                        <?php
                        if(mysqli_num_rows($sub_menu_res)>0){
                        ?>
                          <!-- Dropdown Menu -->
                          <ul class="dropdown-menu">
                              <?php
                              while($sub_menu_rows=mysqli_fetch_assoc($sub_menu_res)){
                                echo '<li><a class="dropdown-item"  href="menu.php?id='.$menu_id.'&sub_menu='.$sub_menu_rows['id'].'">'.$sub_menu_rows['name'].'</a></li>';
                              }
                              ?>
                            </ul>
                        </li>
                      <?php }
                      }?>
                    <li class="nav-item dropdown">
                      <a class="nav-link " href="notice" role="button">Notices</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="contact-us.php">Contact Us</a>
                    </li>
                  </ul>
                </div>
                <!-- Navbar END-->
                </div>
              </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!--=================================Header -->
