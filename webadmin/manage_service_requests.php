<?php 
define('SECURE_ACCESS', true);
include("header.php");
$id="";
$student_id="";
$student_name="";
$reason="";
$type="";
$added_on="";
$msg="";
$required='required';
$service_name="";
$batch_name="";
$public_access="0";
$downloadable="0";
if(isset($_GET['id']) && $_GET['id']!==""){
	$id=get_safe_value($_GET['id']);
    $swl="select services_request.*,services.name as service_name ,students.name as student_name,students.reg_no,batch.name as batch_name from services_request,students,services,batch  where (services_request.id)='$id' and students.id=services_request.student_id and services_request.type=services.id and students.batch=batch.id";
    $res=mysqli_query($con,$swl);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $student_id=$row['student_id'];
        $student_name=$row['student_name'];
        $service_name=$row['service_name'];
        $batch_name=$row['batch_name'];
        $reason=$row['reason'];
        $type=$row['type'];
        $status=$row['status'];
        $public_access=$row['public_access'];
        $added_on=$row['added_on'];
        $public_access=$row['public_access'];
        $downloadable=$row['downloadable'];
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
	$status=get_safe_value($_POST['status']);
    if(isset($_POST['public_access'])){
        $public_access=get_safe_value($_POST['public_access']);
        if($public_access=='on'){
            $public_access="1";
        }
    }else{
        $public_access="0";
    }
    if(isset($_POST['downloadable'])){
            $downloadable="1";
    }else{
        $downloadable="0";
    }
    $added_on=time();
    $sql="UPDATE `services_request` SET `status` = '$status', `public_access` = '$public_access',`downloadable` = '$downloadable' WHERE `services_request`.`id` ='$id'";
    if(mysqli_query($con,$sql)){
        $_SESSION['TOASTR_MSG']=array(
            'type'=>'success',
            'body'=>'Data Updated',
            'title'=>'Success',
        );
        if($status=='Approved'){
            redirect("service_print.php?id=".$id);
        }else{ 
            redirect("service_requests.php");
        }
    }
}
?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Manage Sliders</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Slider </li>
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
                                    <label>Student Name</label>
                                    <input type="text" disabled placeholder="" class="form-control" name="title" id="title"
                                        value="<?php echo $student_name?>">
                                </div>
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Reason</label>
                                    <input type="text" disabled placeholder="" class="form-control" name="title" id="title"
                                        value="<?php echo $reason?>">
                                </div>
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Service Type</label>
                                    <input type="text" disabled placeholder="" class="form-control" name="title" id="title"
                                        value="<?php echo $service_name?>">
                                </div>
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Batch</label>
                                    <input type="text" disabled placeholder="" class="form-control" name="title" id="title"
                                        value="<?php echo $batch_name?>">
                                </div>
                                <div class="col-12-xxxl col-lg-6 col-12 form-group row">
                                    <div class="col-2-xxxl col-lg-2 col-12 form-group">
                                        <label>Public Access</label>
                                        <input class="form-control" name="public_access" <?php echo $public_access == '1' ? 'checked' : ''; ?> type="checkbox" >
                                    </div>
                                    <div class="col-2-xxxl col-lg-2 col-12 form-group">
                                        <label>Downloadable</label>
                                        <input class="form-control" name="downloadable" <?php echo $downloadable == '1' ? 'checked' : ''; ?> type="checkbox" >
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                    <label>Action *</label>
                                    <select class="select2" name="status" required>
                                        <option selected disabled>Please Select status </option>
                                        <?php
                                    $data=[
                                            'name'=>[
                                                'Approved',
                                                'Rejected',
                                                'Processing',
                                            ]
                                        ];
                                        $count=count($data['name']);
                                        for($i=0;$i<$count;$i++){
                                            if($data['name'][$i]==$status){
                                                echo "<option selected='selected' value=".$data['name'][$i].">".$data['name'][$i]."</option>";
                                            }else{
                                                echo "<option value=".$data['name'][$i].">".$data['name'][$i]."</option>";
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