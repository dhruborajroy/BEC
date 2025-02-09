<?php 
define('SECURE_ACCESS', true);
include("header.php");
$name="";
$image="";
$name_bn="";
$short_form="";
$public_view="";
$id="";
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
    $res=mysqli_query($con,"select * from `depts_lab_list` where id='$id'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $name=$row['name'];
        $image=$row['image'];
        $name_bn=$row['name_bn'];
        $short_form=$row['short_form'];
        $public_view=$row['public_view'];
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
    $short_form=get_safe_value($_POST['short_form']);
    $public_view=get_safe_value($_POST['public_view']);
    
    $user_id=$_SESSION['ADMIN_ID'];
    $added_on=time();
    $ref_id=uniqid();
   if($id==''){
        $image=time();
        $sql="INSERT INTO `depts_lab_list` ( `name`, `image`, `name_bn`, `short_form`, `public_view`, `status`) VALUES 
                                ( '$name', ' $image', '$name_bn', '$short_form', '$public_view', '1')";
        if(mysqli_query($con,$sql)){
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'success',
                'body'=>'Data Inserted',
                'title'=>'Success',
            );
            redirect('./departments');
        }else{
            echo $sql;
        }
    }else{
        $updated_on=time();
        $image=time();
        $sql="UPDATE `depts_lab_list` SET  `name` = '$name', `image` = '$image', `name_bn` = '$name_bn', `short_form` = '$short_form', `public_view` = '$public_view' WHERE `depts_lab_list`.`id` = '$id'";
        if(mysqli_query($con,$sql)){
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'success',
                'body'=>'Data Inserted',
                'title'=>'Success',
            );
            redirect('./departments');
        }else{
            echo $sql;
        }
    }
    // echo $sql;
    // redirect('../pdfreports/notice?notice_id='.$id);
    // redirect('./notices');
}

?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Departments</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Departments </li>
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
                                <label>Name</label>
                                <input type="text" required placeholder="Civil Engineering" class="form-control" name="name" id="name"
                                    value="<?php echo $name?>">
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Name in Bengali(বাংলায় নাম) </label>
                                <input type="text" required placeholder="" class="form-control" name="name_bn" id="name_bn"
                                    value="<?php echo $name_bn?>">
                            </div>
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Short Form</label>
                                <input type="text" required placeholder="" class="form-control" name="short_form" id="short_form"
                                    value="<?php echo $short_form?>">
                            </div>
                            <div class="col-12-xxxl col-lg-12 col-12 form-group">
                            <label for="visibility">Visibility</label>
                            <select name="public_view" id="public_view" class="form-control select2">
                                <option value="1" <?php echo $public_view == '1' ? 'selected' : ''; ?>>Public</option>
                                <option value="0" <?php echo $public_view == '0' ? 'selected' : ''; ?>>Private</option>
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
