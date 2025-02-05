<?php 
define('SECURE_ACCESS', true);
include('header.php');
$msg = "";

if (isset($_POST['submit'])) {
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);
    
    // Validate password
    if (empty($password) || empty($cpassword)) {
        $msg = "<div class='alert alert-danger'>Both fields are required.</div>";
        $_SESSION['TOASTR_MSG']=array(
            'type'=>'error',
            'body'=>$msg,    
            'title'=>'Error',
         );
    } elseif ($password !== $cpassword) {
        $msg = "<div class='alert alert-danger'>Passwords do not match.</div>";
        $_SESSION['TOASTR_MSG']=array(
            'type'=>'error',
            'body'=>$msg,    
            'title'=>'Error',
         );
    } elseif (strlen($password) < 6) {
        $msg = "<div class='alert alert-danger'>Password must be at least 6 characters long.</div>";
        $_SESSION['TOASTR_MSG']=array(
            'type'=>'error',
            'body'=>$msg,    
            'title'=>'Error',
         );
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password
        $sql = "UPDATE `people` SET `password`='$hashed_password' WHERE `id`='$faculty_id'";
        
        if (mysqli_query($con, $sql)) {
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'success',
                'body'=>'Password Changed',
                'title'=>'Success',
            );
            // send_email($email, "Password Updated", "Your password has been changed successfully.");
            redirect("index.php");
        } else {
            $msg = "<div class='alert alert-danger'>Error updating password.</div>";
        }
    }
}
?>

<div class="main-content">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <strong>Change Password</strong>
            </div>
            <div class="card-body card-block">
                <form id="validate" class="login-form" method="POST">
                    <div class="form-group">
                        <?php echo $msg; ?>
                    </div>
                    <div class="form-group">
                        <label>Password(At Leasrt 6 Digit)</label>
                        <input type="password" placeholder="Enter password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" placeholder="Enter password again" class="form-control" name="cpassword" id="cpassword">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
