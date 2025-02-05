<?php 
session_start();
define('SECURE_ACCESS', true);
include('../inc/function.inc.php');
include('../inc/connection.inc.php');
include('../inc/constant.inc.php');
require_once("../inc/smtp/class.phpmailer.php");

$msg = "";

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $password = trim($_POST['password']);
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $time = time();
    $limit = 6; 
    $lockout_time = 900; 

    $sql_attempts = "SELECT attempts, last_attempt FROM login_attempts WHERE ip_address='$ip_address'";
    $res_attempts = mysqli_query($con, $sql_attempts);
    if($res_attempts && mysqli_num_rows($res_attempts) > 0){
        $row_attempts = mysqli_fetch_assoc($res_attempts);
        if ($row_attempts['attempts'] >= $limit && ($time - $row_attempts['last_attempt']) < $lockout_time) {
            $msg = '<div class="alert alert-danger" role="alert">
                    Too many failed login attempts. Try again later.</div>';
        } else {
            if (($time - $row_attempts['last_attempt']) >= $lockout_time) {
                mysqli_query($con, "DELETE FROM login_attempts WHERE ip_address='$ip_address'");
            }
        }
    }

    if(empty($msg)){ 
        $sql = "SELECT id, name, email, password, status FROM students WHERE email='$email'";
        $res = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) > 0){
            $row = mysqli_fetch_assoc($res);

            if($row['status'] != 1){
                $msg = '<div class="alert alert-danger" role="alert">
                    You haven\'t verified your email yet. Please verify your email.</div>';
            } else {
                if($password === $row['password']){ // Plain text password check
                    $_SESSION['USER_LOGIN'] = true;
                    $_SESSION['USER_ID'] = $row['id'];
                    $_SESSION['USER_EMAIL'] = $row['email'];
                    $_SESSION['USER_NAME'] = $row['name'];
                    header("Location: index.php");
                    exit();
                } else {
                    $msg = '<div class="alert alert-danger" role="alert">
                    Incorrect Login Details</div>';
                    // Track failed login attempts
                    mysqli_query($con, "INSERT INTO login_attempts (ip_address, attempts, last_attempt) 
                    VALUES ('$ip_address', 1, '$time') 
                    ON DUPLICATE KEY UPDATE attempts = attempts + 1, last_attempt = '$time'");
                    
                    // Log failed login
                    mysqli_query($con, "INSERT INTO login_logs (admin_id, email, ip_address, status, timestamp) 
                    VALUES (NULL, '$email', '$ip_address', 'Failed', NOW())");
                }
            }
        } else {
            $msg = '<div class="alert alert-danger" role="alert">
                        Incorrect login details.
                    </div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head><!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="BEC, Barishal Engineering College" />
    <meta name="description" content="Barishal Engineering College (BEC) is an esteemed engineering institution affiliated with the University of Dhaka. Explore our programs, faculty, and admission details. বরিশাল ইঞ্জিনিয়ারিং কলেজটি ৮ একর জায়গার উপর বরিশাল বিভাগীয় শহর থেকে প্রায় ১৩ কিঃমিঃ পূর্বে বন্দর থানাধীন উত্তর দূর্গাপুরে বরিশাল-ভোলা মহাসড়কের পাশে অবস্থিত। অত্র কলেজটি ১৬ নভেম্বর ২০১৭ খ্রিঃ হতে ঢাকা বিশ্ববিদ্যালয়ের অধিভূক্ত হয়ে চলতি (২০১৭-১৮) সেশনে ছাত্র/ছাত্রী ভর্তির অনুমোদন প্রাপ্ত হয়েছে। দেশে প্রকৌশল শিক্ষা বিস্তারের লক্ষ্যে শিক্ষা মন্ত্রণালয়, কারিগরি ও মাদ্রাসা শিক্ষা বিভাগের নিয়ন্ত্রনাধীন কারিগরি শিক্ষা অধিদপ্তরের বাস্তবায়নাধীন  জুন ২০১৮ পর্যন্ত প্রকল্প মেয়াদে এর নির্মাণ ও পূর্ত কাজ সম্পন্ন হবে। উক্ত প্রতিষ্ঠানটির একাডেমিক কার্যক্রম  ঢাকা বিশ্ববিদ্যালয়ের ইঞ্জিনিয়ারিং এন্ড টেকনোলজি অনুষদের অধীনে পরিচালিত হবে । কলেজটিতে বর্তমানে দুইটি বিভাগে ছাত্র-ছাত্রী ভর্তি করা হবেঃ (১) ইলেকট্রিক্যাল এন্ড ইলেকট্রনিক্স ইঞ্জিনিয়ারিং (ইইই) বিভাগ (২) সিভিল ইঞ্জিনিয়ারিং (সিই)বিভাগ। প্রতি একাডেমিক সেশনে প্রতি বিভাগে ৬০ জন করে মোট ১২০ জন ছাত্র-ছাত্রী ভর্তি করা হবে। কলেজটিতে একটি প্রশাসনিক ভবন, চারটি একাডেমিক ভবন, একটি ৪০০ সিটের ছাত্রাবাস ও একটি ১০০ সিটের ছাত্রীনিবাস সহ শিক্ষক ও কর্মচারীদের জন্য আবাসিক ভবন রয়েছে। অত্র প্রতিষ্ঠানে সুবিশাল খেলার মাঠ, বিষয় ভিত্তিক বই সম্বলিত লাইব্রেরি, দ্রুত গতির ইন্টারনেট সুবিধা সহ আধুনিক কম্পিউটার ল্যাব এবং অত্যাধুনিক ল্যাব/ওয়ার্কশপসহ শিক্ষার আধুনিক সুযোগ সুবিধা রয়েছে। ভর্তিকৃত ছাত্র-ছাত্রীদের মধ্যে ৫০% ছাত্র/ছাত্রীকে সরকার নির্ধারিত হারে সেমিস্টার ভিত্তিক মেধা বৃত্তি প্রদান করা হয়">
    <meta name="title" content="Barishal Engineering College - An affiliated Engineering Collge of University of Dhaka">
    <meta name="author" content="Dhrubo Raj Roy - Civil 04">

    <!-- Title Page-->
    <title>Students Login</title>
    
    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="/">
                                <img src="../images/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <?php echo $msg?>
                            <form method="post">
                                <span id="error"></span>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" required name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" required name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" name="submit" type="submit" onclick="submit()">sign in</button>
                            </form>
                            <!-- <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="#">Sign Up Here</a>
                                </p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
 <script>
    
    function submit(){
        jQuery('#error').html("");
        var email=jQuery('#email').val();
        var password=jQuery('#password').val();
        if(email==""){
            jQuery('#error').html("Please Enter Email");
        }elesif(password==""){
            jQuery('#error').html("Please Enter password");
        }else{
            jQuery('.au-btn').html("please wait...");
        }
    }
 </script>