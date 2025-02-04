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
    <!--begin::Meta Tag-->
    <meta charset="utf-8">
    <meta name="keywords" content="BEC, Barishal Engineering College" />
    <meta name="description" content="Barishal Engineering College (BEC) is an esteemed engineering institution affiliated with the University of Dhaka. Explore our programs, faculty, and admission details. বরিশাল ইঞ্জিনিয়ারিং কলেজটি ৮ একর জায়গার উপর বরিশাল বিভাগীয় শহর থেকে প্রায় ১৩ কিঃমিঃ পূর্বে বন্দর থানাধীন উত্তর দূর্গাপুরে বরিশাল-ভোলা মহাসড়কের পাশে অবস্থিত। অত্র কলেজটি ১৬ নভেম্বর ২০১৭ খ্রিঃ হতে ঢাকা বিশ্ববিদ্যালয়ের অধিভূক্ত হয়ে চলতি (২০১৭-১৮) সেশনে ছাত্র/ছাত্রী ভর্তির অনুমোদন প্রাপ্ত হয়েছে। দেশে প্রকৌশল শিক্ষা বিস্তারের লক্ষ্যে শিক্ষা মন্ত্রণালয়, কারিগরি ও মাদ্রাসা শিক্ষা বিভাগের নিয়ন্ত্রনাধীন কারিগরি শিক্ষা অধিদপ্তরের বাস্তবায়নাধীন  জুন ২০১৮ পর্যন্ত প্রকল্প মেয়াদে এর নির্মাণ ও পূর্ত কাজ সম্পন্ন হবে। উক্ত প্রতিষ্ঠানটির একাডেমিক কার্যক্রম  ঢাকা বিশ্ববিদ্যালয়ের ইঞ্জিনিয়ারিং এন্ড টেকনোলজি অনুষদের অধীনে পরিচালিত হবে । কলেজটিতে বর্তমানে দুইটি বিভাগে ছাত্র-ছাত্রী ভর্তি করা হবেঃ (১) ইলেকট্রিক্যাল এন্ড ইলেকট্রনিক্স ইঞ্জিনিয়ারিং (ইইই) বিভাগ (২) সিভিল ইঞ্জিনিয়ারিং (সিই)বিভাগ। প্রতি একাডেমিক সেশনে প্রতি বিভাগে ৬০ জন করে মোট ১২০ জন ছাত্র-ছাত্রী ভর্তি করা হবে। কলেজটিতে একটি প্রশাসনিক ভবন, চারটি একাডেমিক ভবন, একটি ৪০০ সিটের ছাত্রাবাস ও একটি ১০০ সিটের ছাত্রীনিবাস সহ শিক্ষক ও কর্মচারীদের জন্য আবাসিক ভবন রয়েছে। অত্র প্রতিষ্ঠানে সুবিশাল খেলার মাঠ, বিষয় ভিত্তিক বই সম্বলিত লাইব্রেরি, দ্রুত গতির ইন্টারনেট সুবিধা সহ আধুনিক কম্পিউটার ল্যাব এবং অত্যাধুনিক ল্যাব/ওয়ার্কশপসহ শিক্ষার আধুনিক সুযোগ সুবিধা রয়েছে। ভর্তিকৃত ছাত্র-ছাত্রীদের মধ্যে ৫০% ছাত্র/ছাত্রীকে সরকার নির্ধারিত হারে সেমিস্টার ভিত্তিক মেধা বৃত্তি প্রদান করা হয়">
    <meta name="title" content="Barishal Engineering College - An affiliated Engineering Collge of University of Dhaka">
    <!--end::Meta Tag-->
    <!--begin::OG Tag-->
    <meta name="robots" content="index, follow">  <!-- Allow Google to index -->
    <meta property="og:image" content="https://bec.edu.bd/images/logo.png"/>  
    <meta name="keywords" content="Barishal Engineering College, BEC, Engineering, University of Dhaka, Civil Engineering">
    <meta name="google-site-verification" content="XF4DcGpx9vAkGuDAMASo3H0JkhfQcJRSzW9UCwBTtUQ" />

    
    <meta property="og:locale" content="bn_BD"/>
    <meta property="og:type" content="portal"/>
    <meta property="og:title" content="Barishal Engineering College - An affiliated Engineering Collge of University of Dhaka"/>
    <meta property="og:url" content="https://bec.edu.bd"/>
    <meta property="og:site_name" content="Barishal Engineering College - An affiliated Engineering Collge of University of Dhaka"/>


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
                      <a href="https://bec.ac.bd" target="_blank" rel="noopener noreferrer">Old Website</a>
                    </li>
                    <li>                      
                      <a href="https://bec.edu.bd/library" target="_blank" rel="noopener noreferrer">Libray</a>
                    </li>
                    <li>
                      <a href="https://mail.google.com/a/bec.edu.bd" target="_blank" rel="noopener noreferrer">Webmail</a>
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
                      <a class="nav-link dropdown-toggle" href="index">Home</a>
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
                          <!-- <li><a class="dropdown-item" href="class-routine.php">Class Routine</a></li> -->
                          <!-- <li><a class="dropdown-item" href="syllabus.php">Syllabus</a></li> -->
                          <!-- <li><a class="dropdown-item" href="exam-schedule.php">Exam Schedule</a></li> -->
                          <!-- <li><a class="dropdown-item" href="academic-calender.php">Academic Calender</a></li> -->
                      </ul>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link  dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        People<i class="fas fa-chevron-down fa-xs"></i>
                      </a>
                      <!-- Dropdown Menu -->
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="faculties.php">Faculty</a></li>
                          <!-- <li><a class="dropdown-item" href="class-routine.php">Class Routine</a></li>
                          <li><a class="dropdown-item" href="syllabus.php">Syllabus</a></li>
                          <li><a class="dropdown-item" href="exam-schedule.php">Exam Schedule</a></li>
                          <li><a class="dropdown-item" href="academic-calender.php">Academic Calender</a></li> -->
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
