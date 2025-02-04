<?php 
session_start();
session_regenerate_id(true); // Prevent session fixation
define('SECURE_ACCESS', true);
include('../inc/function.inc.php');
include('../inc/connection.inc.php');
include('../inc/constant.inc.php');
require_once("../inc/smtp/class.phpmailer.php");

$msg = "";

if(isset($_SESSION['LIBRARIAN_LOGIN'])){
    redirect('index.php');
}

if(isset($_POST['submit'])){
    // Secure user input
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $password = trim($_POST['password']);
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $time = time();
    $limit = 3; // Max login attempts allowed
    $lockout_time = 900; // Lockout time (15 minutes)

    // Check failed login attempts
    $sql_attempts = "SELECT attempts, last_attempt FROM login_attempts WHERE ip_address='$ip_address'";
    $res_attempts = mysqli_query($con, $sql_attempts);
    if($res_attempts && mysqli_num_rows($res_attempts) > 0){
        $row_attempts = mysqli_fetch_assoc($res_attempts);
        if ($row_attempts['attempts'] >= $limit && ($time - $row_attempts['last_attempt']) < $lockout_time) {
            $msg = "Too many failed login attempts. Try again later.";
        } else {
            // Reset attempts if lockout time has passed
            if (($time - $row_attempts['last_attempt']) >= $lockout_time) {
                mysqli_query($con, "DELETE FROM login_attempts WHERE ip_address='$ip_address'");
            }
        }
    }

    if(empty($msg)){ // Proceed if no brute force detected
        $sql = "SELECT id, name, email, password, status FROM admin WHERE email='$email'";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) > 0){
            $row = mysqli_fetch_assoc($res);

            if($row['status'] != 1){
                $msg = "You haven't verified your email yet. Please verify your email.";
            } else {
                if(password_verify($password, $row['password'])){
                    $_SESSION['LIBRARIAN_LOGIN'] = true;
                    $_SESSION['LIBRARIAN_ID'] = $row['id'];
                    $_SESSION['LIBRARIAN_NAME'] = $row['name'];

                    // Log successful login
                    mysqli_query($con, "INSERT INTO login_logs (admin_id, email, ip_address, status, timestamp) 
                    VALUES ('{$row['id']}', '$email', '$ip_address', 'Success', NOW())");
                    // Reset failed login attempts
                    mysqli_query($con, "DELETE FROM login_attempts WHERE ip_address='$ip_address'");
                    // Send login notification emails
                    // sendLoginEmail($row['email']);
                    // sendLoginEmail("dhruborajroy3@gmail.com");
                    // send_email("dhruborajroy3@gmail.com","d","Login Information ".date('F j, Y \at h:i:s A'));
                    redirect('./index.php');
                    die();
                } else {
                    $msg = "Incorrect login details.";

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
            $msg = "Incorrect login details.";
        }
    }
}
?>

<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Library Management System || Barishal Engineering College</title>
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
    <link rel="stylesheet" href="fonts/flaticon.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="../webadmin/css/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../webadmin/css/style.css">
    <!-- Modernize js -->
    <script src="../webadmin/../webadmin/js/modernizr-3.6.0.min.js"></script>
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <!-- Login Page Start Here -->
    <div class="login-page-wrap">
        <div class="login-page-content">
            <div class="login-box">
                <div class="item-logo">
                    <img src="../images/bec.png" alt="logo" style="width: 350px;">
                </div>
                <form class="login-form" method="POST" id="validate">
                    <div class="col-md-12 text-center align-item-center btn-fill-lmd text-light bg-true-v">
                        Library Admin Login
                    </div>
                    <?php echo $msg?>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" placeholder="Enter Email" class="form-control" name="email">
                        <i class="far fa-envelope"></i>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" placeholder="Enter password" class="form-control" name="password">
                        <i class="fas fa-lock"></i>
                    </div>
                    <!-- <div class="form-group d-flex align-items-center justify-content-between">
                        <div class="form-check"></div>
                        <a href="forgotPassword.php" class="forgot-btn">Forgot Password?</a>
                    </div> -->
                    <div class="form-group">
                        <button type="submit" name="submit" class="login-btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Login Page End Here -->
    <!-- jquery-->
    <script src="../webadmin/js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="../webadmin/js/plugins.js"></script>
    <!-- Popper js -->
    <script src="../webadmin/js/popper.min.js"></script>
    <!-- validate JS -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../webadmin/js/bootstrap.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="../webadmin/js/jquery.scrollUp.min.js"></script>
    <!-- Custom Js -->
    <script src="../webadmin/js/main.js"></script>
    <script src="../webadmin/js/validation.php"></script>

</body>

</html>