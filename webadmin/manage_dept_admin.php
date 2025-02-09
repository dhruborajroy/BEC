<?php 
define('SECURE_ACCESS', true);
include("header.php");
$required='required';
$msg="";
$id="";
$name="";
$dept_id="";
$email="";
$phoneNumber="";   
if(isset($_GET['id']) && $_GET['id']!==""){
	$id=get_safe_value($_GET['id']);
    $swl="select * from `dept_admin` where md5(id)='$id'";
    $res=mysqli_query($con,$swl);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $name=$row['name'];
        $dept_id=$row['dept_id'];
        $email=$row['email'];
        $phoneNumber=$row['phoneNumber'];        
        $required='';
    }else{
        $_SESSION['TOASTR_MSG']=array(
           'type'=>'error',
           'body'=>'You don\'t have the permission to access the location!',    
           'title'=>'Error',
        );
        redirect("index.php");
    }
}
if(isset($_POST['submit'])){
	$name=get_safe_value($_POST['name']);
	$dept_id=get_safe_value($_POST['dept_id']);
	$email=get_safe_value($_POST['email']);
	$phoneNumber=get_safe_value($_POST['phoneNumber']);
    $added_on=time();
    if($id==''){
        $random_password=uniqid();
        $password=password_hash($random_password,PASSWORD_DEFAULT);
        echo $sql="INSERT INTO `dept_admin` ( `name`, `dept_id`, `email`, `phoneNumber`, `password`, `status`) VALUES 
                                        ( '$name', '$dept_id', '$email', '$phoneNumber','$password',  '1')";
        if(mysqli_query($con,$sql)){
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'success',
                'body'=>'Data Inserted',
                'title'=>'Success',
            );
            send_email($email,"Your account has been created. Your password is <b>".$random_password." </b>. Please login and change your password. Login to ".FRONT_SITE_PATH."/departments\/","Account Created");
            redirect('dept_admin');
        }
    }else{
        $sql="UPDATE `dept_admin` SET `name` = '$name', `dept_id` = '$dept_id', `email` = '$email', `phoneNumber` = '$phoneNumber' WHERE  md5(id)='$id'";
        if(mysqli_query($con,$sql)){
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'success',
                'body'=>'Data Updated',
                'title'=>'Success',
            );
            redirect('dept_admin');
        }
    }
}
?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Manage Department Admin</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Department Admin </li>
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
                            <?php echo $msg?>
                        </div>
                    </div>
                    <form id="validate" class="new-added-form" method="post"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Name</label>
                                    <input type="text" placeholder="" class="form-control" name="name" id="name"
                                        value="<?php echo $name?>">
                                </div>
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Email</label>
                                    <input type="text" placeholder="" class="form-control" name="email" id="email"
                                        value="<?php echo $email?>">
                                </div>
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Phone Number</label>
                                    <input type="text" placeholder="" class="form-control" name="phoneNumber" id="phoneNumber"
                                        value="<?php echo $phoneNumber?>">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                    <label>Department *</label>
                                    <select class="form-control select2" name="dept_id" required>
                                            <?php
                                            $res=mysqli_query($con,"SELECT * FROM `depts_lab_list` where status='1'");
                                            while($row=mysqli_fetch_assoc($res)){
                                                if($row['short_form']==$dept_id){
                                                echo "<option selected='selected' value=".$row['short_form'].">".$row['name']." (".$row['short_form'].")</option>";
                                                }else{
                                                echo "<option value=".$row['short_form'].">".$row['name']." (".$row['short_form'].")</option>";
                                                }                                                        
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="col-12 form-group mg-t-8">
                                    <input type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark"
                                        name="submit">
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Notice Area End Here -->
    </div>
    <?php include("footer.php")?>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>

    <script>
            ClassicEditor
                    .create( document.querySelector( '#editor' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
    </script>