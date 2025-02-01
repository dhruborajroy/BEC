<?php 
define('SECURE_ACCESS', true);
include("header.php");
$name="";
$image="";
$name_bn="";
$dept_id="";
$id="";
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
    $res=mysqli_query($con,"select * from `lab_list` where id='$id'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $name=$row['name'];
        $name_bn=$row['name_bn'];
        $dept_id=$row['dept_id'];
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
    $name_bn=get_safe_value($_POST['name_bn']);
    $dept_id=get_safe_value($_POST['dept_id']);
    
    $user_id=$_SESSION['ADMIN_ID'];
    $added_on=time();
    $ref_id=uniqid();
   if($id==''){
        $image=time();
        $sql="INSERT INTO `lab_list` ( `name`, `name_bn`, `dept_id`, `status`) VALUES 
                            ( '$name', '$name_bn', '$dept_id', '1')";
        if(mysqli_query($con,$sql)){
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'success',
                'body'=>'Data Inserted',
                'title'=>'Success',
            );
            redirect('./labs');
        }else{
            echo $sql;
        }
    }else{
        $updated_on=time();
        $image=time();
        $sql="UPDATE `lab_list` SET `name` = '$name', `name_bn` = '$name_bn', `dept_id` = '$dept_id' WHERE `lab_list`.`id` = '$id'";
        if(mysqli_query($con,$sql)){
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'success',
                'body'=>'Data Inserted',
                'title'=>'Success',
            );
            redirect('./labs');
        }else{
            echo $sql;
        }
    }
}

?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Labs</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Labs </li>
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
                            <h3>Create A lab</h3>
                        </div>
                    </div>
                    <form id="validate" class="new-added-form" method="post">
                        <div class="row">
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Name</label>
                                <input type="text" required placeholder="Civil Engineering" class="form-control" name="name" id="name"
                                    value="<?php echo $name?>">
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Name in Bengali(বাংলায় নাম) </label>
                                <input type="text" required placeholder="" class="form-control" name="name_bn" id="name_bn"
                                    value="<?php echo $name_bn?>">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                            <label>Department *</label>
                            <select class="form-control select2" name="dept_id" required>
                                    <?php
                                    $res=mysqli_query($con,"SELECT * FROM `depts_lab_list` where status='1'");
                                    while($row=mysqli_fetch_assoc($res)){
                                        if($row['short_form']==$dept_id){
                                        echo "<option selected='selected' value=".$row['id'].">".$row['name']." (".$row['short_form'].")</option>";
                                        }else{
                                        echo "<option value=".$row['id'].">".$row['name']." (".$row['short_form'].")</option>";
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
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Notice Area End Here -->
    </div>
    <?php include("footer.php")?>
