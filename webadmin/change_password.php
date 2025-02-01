<?php 
define('SECURE_ACCESS', true);
include('header.php');
$msg="";
if(isset($_POST['submit'])){
	$password=get_safe_value($_POST['password']);
    $password=password_hash($password,PASSWORD_DEFAULT);
   	$sql="update `admin` set `password`='$password' where `id`='$email'";
	if(mysqli_query($con,$sql)){
        $_SESSION['UPDATE']=true;
        send_email($email,"Password Updated","Password Changed");
        redirect("index.php");
    }
}
?>

<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Change Password</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Change Password</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <div class="row">
        <!-- Add Notice Area Start Here -->
        <div class="col-12-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Change Password</h3>
                        </div>
                    </div>
                    
                <form id="validate" class="login-form" method="POST">
                    <div class="form-group">
                        <?php echo $msg?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" placeholder="Enter password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="text" placeholder="Enter password again" class="form-control" name="cpassword" id="cpassword">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="login-btn">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- Add Notice Area End Here -->
    </div>
    <?php include("footer.php")?>