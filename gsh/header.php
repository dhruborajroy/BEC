<?php 
if (!defined('SECURE_ACCESS')) {
  die("Direct access not allowed!");
}
require('../inc/constant.inc.php');
require('../inc/connection.inc.php');
require('../inc/function.inc.php');
$dept_id="gsh";
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
    <link rel="shortcut icon" href="../images/favicon.ico" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200&amp;display=swap" rel="stylesheet">

    <!-- CSS Global Compulsory (Do not remove)-->
    <link rel="stylesheet" href="../css/font-awesome/all.min.css" />
    <link rel="stylesheet" href="../css/flaticon/flaticon.css" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css" />

    <!-- Page CSS Implementing Plugins (Remove the plugin CSS here if site does not use that feature)-->
    <link rel="stylesheet" href="../css/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="../css/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="../css/swiper/swiper.min.css" />
    <link rel="stylesheet" href="../css/animate/animate.min.css"/>

    <!-- Template Style -->
    <link rel="stylesheet" href="../css/style.css" />
  </head>

  <body>
  <div class="topbar bg-dark py-3 d-none d-lg-flex">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="d-none d-lg-flex justify-content-end  text-center">
            <div class="social-icon">
              <ul class="social-icon">
                    <li>
                      <a href="http://bec.edu.bd" target="_blank" rel="noopener noreferrer">Main Website</a>
                    </li>
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
    <!--=================================Header -->
    <header class="header header-style-02 header-sticky">
      <div class="header-menu bg-light">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <nav class="navbar navbar-expand-lg">
                <!-- Navbar toggler START-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar toggler END-->
                <div class="col-sm-4">
                  <!-- logo -->
                  <a class="navbar-brand logo text-lg-center" href="./">
                    <img src="../images/bec-ce.png" alt="Logo">
                  </a>
                </div>
                <div class="col-sm-8">
                    <!-- Navbar START -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                          <a class="nav-link" href="./" role="button">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About<i class="fas fa-chevron-down fa-xs"></i>
                          </a>
                          <!-- Dropdown Menu -->
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="about-us">About Us</a></li>
                            <li><a class="dropdown-item" href="vision-mission">Vision & Mission</a></li>
                            <li><a class="dropdown-item" href="head-message">Message of the Head</a></li>
                            <!-- <li><a class="dropdown-item" href="booklet">Information Booklet</a></li> -->
                          </ul>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link  dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            People<i class="fas fa-chevron-down fa-xs"></i>
                          </a>
                          <!-- Dropdown Menu -->
                          <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="people?type=faculty">Faculty</a></li>
                              <li><a class="dropdown-item" href="people?type=officers">Officers</a></li>
                              <li><a class="dropdown-item" href="people?type=Staff">Staff</a></li>
                              <li><a class="dropdown-item" href="people?type=former-head">Former Head</a></li>
                              <li><a class="dropdown-item" href="people?type=former-faculty">Former Faculty</a></li>
                          </ul>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link  dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Research<i class="fas fa-chevron-down fa-xs"></i>
                          </a>
                          <!-- Dropdown Menu -->
                          <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="publication">Publication</a></li>
                              <li><a class="dropdown-item" href="research">Researches</a></li>
                          </ul>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Facilities<i class="fas fa-chevron-down fa-xs"></i>
                          </a>
                          <!-- Dropdown Menu -->
                          <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="labs">List of Laboratories</a></li>
                              <li><a class="dropdown-item" href="scholarships">Scholarships</a></li>
                          </ul>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="contact-us">Contact Us</a>
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
    </header>
    <!--=================================Header -->
