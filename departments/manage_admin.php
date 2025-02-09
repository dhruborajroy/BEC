<?php 
define('SECURE_ACCESS', true);
include('header.php');
$id="";
$name='';
$email='';
$phoneNumber='';
$password='';
$image='';
$msg="";
$required="required='required'";
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
    $res=mysqli_query($con,"select * from admin where id='$id'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $name=$row['name'];
        $image=$row['image'];
        $email=$row['email'];
        $phoneNumber=$row['phoneNumber'];
        $password=$row['password'];
        $required="";
    }else{
        redirect("index");
    }
}
if(isset($_POST['submit'])  && isset($_POST['csrf_token']) ){
    // if($_POST['csrf_token']!=$_SESSION['csrf_token']){
    //     die("You don't have permission to access that location");
    // }
    $name=get_safe_value($_POST['name']);
    $email=get_safe_value($_POST['email']);
    $phoneNumber=get_safe_value($_POST['phoneNumber']);
    if ($_POST['password']!=="") {
        $password=get_safe_value($_POST['password']);
        $password=password_hash($password,PASSWORD_DEFAULT);
    }
   if($id==''){
        $swl="select * from admin where email='$email'";
        $ress=mysqli_query($con,$swl);
        if(mysqli_num_rows($ress)>0){
            $msg='<div class="alert alert-danger" role="alert">
                    <span class="error" style="font-size:20px"> Admin already added.</span>
                </div>';
        }else{
            $info=getimagesize($_FILES['image']['tmp_name']);
            if(isset($info['mime'])){
                if($info['mime']=="image/jpeg"){
                    $img=imagecreatefromjpeg($_FILES['image']['tmp_name']);
                }elseif($info['mime']=="image/png"){
                    $img=imagecreatefrompng($_FILES['image']['tmp_name']);
                }else{
                    $msg= "Only select jpg or png image";
                }
                if(isset($img)){
                    $output_image=time().'.jpg';
                    imagejpeg($img,UPLOAD_ADMIN_IMAGE.$output_image,IMAGE_DECRESE_PERCENT);
                    $sql="INSERT INTO `admin` (`name`, `email`,`phoneNumber`,`password`,`image`,`last_notification`,`status`) VALUES ('$name', '$email', '$phoneNumber', '$password','$output_image','0', 1)";
                    mysqli_query($con,$sql);
                    $_SESSION['INSERT']=1;
                    redirect('./index.php');
                }
            }else{
                $msg= "Only select jpg or png image";
            }
        }
    }else{
        if($_FILES['image']['name']!=''){
            $info=getimagesize($_FILES['image']['tmp_name']);
            if(isset($info['mime'])){
                if($info['mime']=="image/jpeg"){
                    $img=imagecreatefromjpeg($_FILES['image']['tmp_name']);
                }elseif($info['mime']=="image/png"){
                    $img=imagecreatefrompng($_FILES['image']['tmp_name']);
                }else{
                    $msg= "Only select jpg or png image";
                }
                if(isset($img)){
                    $output_image=time().'.jpg';
                    imagejpeg($img,UPLOAD_ADMIN_IMAGE.$output_image,IMAGE_DECRESE_PERCENT);
                    echo $sql="update `admin` set  `name`='$name', `email`='$email', `phoneNumber`='$phoneNumber', `password`='$password', `image`='$output_image' where id='$id'";
                    mysqli_query($con,$sql);    
                    $_SESSION['UPDATE']=1;
                    // redirect('./authors.php');
                    $_SESSION['INSERT']=1;
                    // redirect('./authors.php');
                }
            }else{
                echo $sql="update `admin` set  `name`='$name', `email`='$email', `phoneNumber`='$phoneNumber', `password`='$password' where id='$id'";
                mysqli_query($con,$sql);    
                $_SESSION['UPDATE']=1;
                // redirect('./authors.php');
            }
        }
    }
    // echo $sql;
}
?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
    </div>
    <!-- Breadcubs Area End Here -->

    <!-- Add Class Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Add New Depertment</h3>
                    <br>
                    <?php echo $msg?>
                </div>
            </div>
            <form class="new-added-form" id="validate" method="post" enctype="multipart/form-data">
                <?php echo form_csrf()?>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Admin Name *</label>
                        <input type="text" placeholder="Enter Admin name" value="<?php echo $name?>" name="name"
                            id="name" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Email*</label>
                        <input type="email" placeholder="Enter Admin email" value="<?php echo $email?>" name="email"
                            id="email" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Phone Number*</label>
                        <input type="text" placeholder="Enter Phone Number" value="<?php echo $phoneNumber?>" name="phoneNumber"
                            id="phoneNumber" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Password*</label>
                        <input type="password" name="password"
                            id="password" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Confirm Password*</label>
                        <input type="password" 
                            id="confirmPassword" class="form-control">
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <div class="col-sm-12 img-body">
                            <div class="center">
                                <div class="form-input">
                                    <div class="preview">
                                        <img id="image_preview" <?php if($image!=''){
                                                    echo 'src="http://'.ADMIN_IMAGE.$image.'"';}
                                                    ?> style="width:200px;height: 200px">
                                    </div>
                                    <label for="file_ip_1">Upload Image</label>
                                    <input type="file" name="image" id="file_ip_1" accept="image/*"
                                        onchange="showPreview(event);" <?php echo $required?>>
                                </div>
                            </div>
                            <script type="text/javascript">
                            function showPreview(event) {
                                if (event.target.files.length > 0) {
                                    var src = URL.createObjectURL(event.target.files[0]);
                                    var preview = document.getElementById("image_preview");
                                    preview.src = src;
                                    preview.style.display = "block";
                                }
                            }
                            </script>
                        </div>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button name="submit" type="submit"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Add Class Area End Here -->
    <?php include('footer.php');?>