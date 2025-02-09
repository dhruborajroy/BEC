<?php 
define('SECURE_ACCESS', true);
include("header.php");
$id="";
$title="";
$user_id="";
$details="";
$added_on="";
$swl="select * from `about_us` where (id)='1'";
$res=mysqli_query($con,$swl);
if(mysqli_num_rows($res)>0){
    $row=mysqli_fetch_assoc($res);
    $title=$row['title'];
    $details=$row['details'];
    $added_on=$row['added_on'];
}else{
    $_SESSION['TOASTR_MSG']=array(
        'type'=>'error',
        'body'=>'You don\'t have the permission to access the location!',    
        'title'=>'Error',
    );
    // redirect("index.php");
}
if(isset($_POST['submit'])){
	$title=get_safe_value($_POST['title']);
	$details=get_safe_value($_POST['details']);
    $user_id=$_SESSION['ADMIN_ID'];
    $updated_on=time();
    $sql="update `about_us` set  `title`='$title', `details`='$details',`updated_on`='$updated_on',`added_by`='$user_id' where (id)='1'";
    if(mysqli_query($con,$sql)){
        $_SESSION['TOASTR_MSG']=array(
            'type'=>'success',                
            'body'=>'Data Updated',
            'title'=>'Success',
        );
        redirect('./about_us');
    }else{
        echo $sql;
    }
}

?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>About Us</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>About Us </li>
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
                            <h3>About Us</h3>
                        </div>
                    </div>
                    <form id="validate" class="new-added-form" method="post">
                        <div class="row">
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Title</label>
                                <input type="text" required placeholder="" class="form-control" name="title" id="title"
                                    value="<?php echo $title?>">
                            </div>
                            <div class="col-12-xxxl col-lg-12 col-12 ">
                                <label>Details</label>
                                <textarea name="details" class="full_input" id="editor" cols="30" rows="10"><?php echo $details?></textarea>
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <input type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark"
                                    name="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Notice Area End Here -->
    </div>
    <?php include("footer.php")?>