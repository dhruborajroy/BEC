<?php
session_start();
define('SECURE_ACCESS', true);
include('../inc/function.inc.php');
include('../inc/connection.inc.php');
include('../inc/constant.inc.php');
require_once("../inc/smtp/class.phpmailer.php");
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        // Handle Forgot Password Request
        $email = trim($_POST['email']);

        // Check if email exists
        $query = "SELECT id FROM people WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            // Generate unique token
            $token = bin2hex(random_bytes(50));
            $exp_time = date("Y-m-d H:i:s", strtotime("+1 hour"));

            // Insert/update token in the database
            $query = "INSERT INTO password_resets (email, token, exp_time) VALUES ('$email', '$token', '$exp_time')
                      ON DUPLICATE KEY UPDATE token='$token', exp_time='$exp_time'";
            mysqli_query($con, $query);

            // Send reset email
            $reset_link = FRONT_SITE_PATH."/faculty/forgot_password.php?token=$token";
            $message="Click the link to reset your password: ".$reset_link;
            if (send_email($email,$message,"Password Reset")) {
                $_SESSION['TOASTR_MSG']=array(
                    'type'=>'success',
                    'body'=>'Password reset link sent to your email.',    
                    'title'=>'Success',
                );
                $message = "Password reset link sent to your email.";
            } else {
                $_SESSION['TOASTR_MSG']=array(
                    'type'=>'error',
                    'body'=>'Failed to send email.',    
                    'title'=>'Error',
                );
                $message = "Failed to send email.";
            }
        } else {
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'error',
                'body'=>'Email not found.',    
                'title'=>'Error',
            );
            $message = "Email not found.";
        }
    } elseif (isset($_POST['password'], $_POST['token'])) {
        // Handle Password Reset
        $token = $_POST['token'];
        $new_password = ($_POST['password']); // Hash the password

        // Check token validity
        $query = "SELECT email FROM password_resets WHERE token='$token' AND exp_time > NOW()";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $email = $row['email'];
            $password=password_hash($new_password,PASSWORD_DEFAULT);
            if(mysqli_query($con, "UPDATE people SET password='$password' WHERE email='$email'")){
                mysqli_query($con, "DELETE FROM password_resets WHERE email='$email'");
                $message = "Password has been reset. <a href='login.php'>Login</a>";
                $_SESSION['TOASTR_MSG']=array(
                    'type'=>'success',                
                    'body'=>'Password Updated. Please login using new password.',
                    'title'=>'Success',
                );
                redirect("../login");
            }
        } else {
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'error',
                'body'=>'Invalid or expired token.',
                'title'=>'Error',
            );
            $message = "Invalid or expired token.";
        }
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta name="description" content="au theme template"> -->
    <meta name="author" content="Dhrubo">
    <!-- <meta name="keywords" content="au theme template"> -->

    <!-- Title Page-->
    <title>Login</title>

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

    <!-- Main CSS-->
    <link href="../students/css/theme.css" rel="stylesheet" media="all">

</head>
<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="/"><img src="../images/bec-bg-white.jpg" alt="bec logo"></a>
                        </div>
                        <div class="login-form">
                            <?php if (!isset($_GET['token'])): ?>
                                <form method="post">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input class="au-input au-input--full" type="email" name="email" placeholder="Enter your email" required>
                                    </div>
                                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Submit</button>
                                    <p style="color: red;"><?php echo $message; ?></p>
                                </form>
                            <?php else: ?>
                                <form method="post">
                                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input class="au-input au-input--full" type="password" name="password" required placeholder="Enter New Password">
                                    </div>
                                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Reset Password</button>
                                    <p style="color: red;"><?php echo $message; ?></p>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery JS-->
    <script src="../students/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../students/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../students/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="../students/vendor/slick/slick.min.js">
    </script>
    <script src="../students/vendor/wow/wow.min.js"></script>
    <script src="../students/vendor/animsition/animsition.min.js"></script>
    <script src="../students/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../students/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../students/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../students/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../students/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../students/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="../students/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="../students/js/main.js"></script>

</body>

</html>

<?php
if (isset($_SESSION['TOASTR_MSG'])) {
    $type = $_SESSION['TOASTR_MSG']['type']; // success, error, info, warning
    $body = $_SESSION['TOASTR_MSG']['body'];
    $title = $_SESSION['TOASTR_MSG']['title'];

    echo "<script>
        $(document).ready(function() {
            toastr.$type('$body', '$title');
        });
    </script>";

    // Clear Toastr message after displaying
    unset($_SESSION['TOASTR_MSG']);
}
?>
