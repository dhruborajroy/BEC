<?php 
define('SECURE_ACCESS', true);
include("header.php");
$title="";
$user_id="";
$details="";
$added_on="";
$reference="";
$id="";
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
    $res=mysqli_query($con,"select * from `notice` where id='$id'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $details=$row['details'];
        $added_on=$row['added_on'];
        $reference=$row['reference'];
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
	$title=get_safe_value($_POST['title']);
	$reference=get_safe_value($_POST['reference']);
	$details=$_POST['details'];
    $user_id=$_SESSION['ADMIN_ID'];
    $added_on=time();
    $ref_id=uniqid();
   if($id==''){
        $id=uniqid();
        $sql="INSERT INTO `notice` (`id`, `title`, `details`,`reference`, `added_on`,`upload_status`,`updated_on`, `user_id`, `status`) VALUES 
                                    ('$id', '$title', '$details','$reference', '$added_on', '0','','$user_id', '1')";
        if(mysqli_query($con,$sql)){
            if(isset($_POST['referance_ids'])){
                for ($i = 0; $i <= count($_POST['referance_ids']) - 1; $i++) {
                    $referance_id = get_safe_value($_POST['referance_ids'][$i]);
                    $check_sql = "SELECT id FROM notice_referance WHERE notice_id = '$id' AND referance_id = '$referance_id'";
                    $check_result = mysqli_query($con, $check_sql);
                    
                    if (mysqli_num_rows($check_result) > 0) {
                        $update_sql = "UPDATE notice_referance SET status = 1 WHERE notice_id = '$id' AND referance_id = '$referance_id'";
                        mysqli_query($con, $update_sql);
                    } else {
                        $ref_id = uniqid(); 
                        $insert_sql = "INSERT INTO notice_referance (id, notice_id, referance_id, status) 
                                    VALUES ('$ref_id', '$id', '$referance_id', 1)";
                        mysqli_query($con, $insert_sql);
                    }
                }

                
            }
            if (isset($_POST['unreferance_ids'])) {
                for ($i = 0; $i <= count($_POST['unreferance_ids']) - 1; $i++) {
                    $unreferance_id = get_safe_value($_POST['unreferance_ids'][$i]);
                    $delete_sql = "DELETE FROM notice_referance WHERE notice_id = '$id' AND referance_id = '$unreferance_id'";
                    mysqli_query($con, $delete_sql);
                }
            }

            $_SESSION['TOASTR_MSG']=array(
                'type'=>'success',
                'body'=>'Data Inserted',
                'title'=>'Success',
            );
            // redirect('./notices');
        }else{
            echo $sql;
        }
    }else{
        $updated_on=time();
        $sql="update `notice` set  `title`='$title', `details`='$details',`reference`='$reference',`updated_on`='$updated_on' where id='$id'";
        if(mysqli_query($con,$sql)){
                if(isset($_POST['referance_ids'])){
                    for ($i = 0; $i <= count($_POST['referance_ids']) - 1; $i++) {
                        $referance_id = get_safe_value($_POST['referance_ids'][$i]);
                        
                        // Check if the record already exists
                        $check_sql = "SELECT id FROM notice_referance WHERE notice_id = '$id' AND referance_id = '$referance_id'";
                        $check_result = mysqli_query($con, $check_sql);
                        
                        if (mysqli_num_rows($check_result) > 0) {
                            // Record exists, perform UPDATE
                            $update_sql = "UPDATE notice_referance SET status = 1 WHERE notice_id = '$id' AND referance_id = '$referance_id'";
                            mysqli_query($con, $update_sql);
                        } else {
                            // Record does not exist, perform INSERT
                            $ref_id = uniqid(); // Generates a unique ID
                            $insert_sql = "INSERT INTO notice_referance (id, notice_id, referance_id, status) 
                                        VALUES ('$ref_id', '$id', '$referance_id', 1)";
                            mysqli_query($con, $insert_sql);
                        }
                    }

                }
                            
                // Handle unchecked checkboxes - delete records from notice_referance
                if (isset($_POST['unreferance_ids'])) {
                    for ($i = 0; $i <= count($_POST['unreferance_ids']) - 1; $i++) {
                        $unreferance_id = get_safe_value($_POST['unreferance_ids'][$i]);
                        
                        // Delete from notice_referance if the checkbox was unchecked
                        $delete_sql = "DELETE FROM notice_referance WHERE notice_id = '$id' AND referance_id = '$unreferance_id'";
                        mysqli_query($con, $delete_sql);
                    }
                }

            
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'success',
                'body'=>'Data Inserted',
                'title'=>'Success',
            );
            // redirect('./notices');
        }else{
            echo $sql;
        }
    }
    // echo $sql;
    redirect('../pdfreports/notice?notice_id='.$id);
    // redirect('./notices');
}

?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Notice board</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Notices </li>
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
                            <h3>Create A Notice</h3>
                        </div>
                    </div>
                    <form id="validate" class="new-added-form" method="post">
                        <div class="row">
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Reference No</label>
                                <input type="text" required placeholder="" class="form-control" name="reference" id="reference"
                                    value="<?php echo $reference?>">
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Title</label>
                                <input type="text" required placeholder="" class="form-control" name="title" id="title"
                                    value="<?php echo $title?>">
                            </div>
                            <div class="col-12-xxxl col-lg-12 col-12">
                                <label>Details</label>
                                <textarea name="details" class="full_input" id="editor" cols="30" rows="10"><?php echo $details?></textarea>
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                    <h3>Select References for Notice</h3>
                                    <?php 
                                        $sql="select * from referances order by priority asc";
                                        $referances_res=mysqli_query($con,$sql);
                                        while ($referances_row = mysqli_fetch_assoc($referances_res)) { ?>
                                        <div class="col-12-xxxl col-lg-12 col-12 form-group d-flex">
                                            <input type="checkbox" name="referance_ids[]" value="<?php echo $referances_row['id']; ?>">
                                            <label style="padding-left:30px"><?php echo htmlspecialchars($referances_row['name']); ?></label>
                                        </div>
                                    <?php } ?>
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