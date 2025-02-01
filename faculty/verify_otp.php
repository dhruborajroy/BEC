<?php
session_start();
define('SECURE_ACCESS', true);
include('../inc/function.inc.php');
include('../inc/connection.inc.php');
include('../inc/constant.inc.php');
require_once("../inc/smtp/class.phpmailer.php");

if (!isset($_SESSION['OTP_USER_ID'])) {
    header("Location: login.php");
    exit();
}

$msg = "";
if (isset($_POST['verify'])) {
    $otp = mysqli_real_escape_string($con, $_POST['otp']);
    $user_id = $_SESSION['OTP_USER_ID'];
    $email = $_SESSION['OTP_USER_EMAIL'];

    // Check OTP
    $query = "SELECT * FROM otp_verification WHERE user_id='$user_id' AND email='$email' AND otp_code='$otp' AND expires_at >= NOW()";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // OTP is valid
        $_SESSION['USER_LOGIN'] = true;
        $_SESSION['USER_ID'] = $user_id;
        $_SESSION['USER_EMAIL'] = $email;
        $_SESSION['USER_NAME'] = $_SESSION['OTP_USER_NAME'] ;

        // Delete OTP after successful verification
        mysqli_query($con, "DELETE FROM otp_verification WHERE user_id='$user_id'");

        redirect("index.php");
        exit();
    } else {
        $msg = '<div class="alert alert-danger" role="alert">
					Invalid or expired OTP.
				</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

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
                            <a href="#">
                                <img src="../images/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <?php echo $msg?>
                            <form method="post">
                                <div class="form-group">
                                    <label>Enter OTP</label>
                                    <input class="au-input au-input--full"  type="text" name="otp" required>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="verify">Verify</button>
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
