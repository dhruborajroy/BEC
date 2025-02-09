<?php 
define('SECURE_ACCESS', true);
include("header.php");
$id="";
$name="";
$msg="";
$submenu_name="";
$required='required';
if(isset($_GET['id']) && $_GET['id']!==""){
	$id=get_safe_value($_GET['id']);
    $swl="select * from `menus` where md5(id)='$id'";
    $res=mysqli_query($con,$swl);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $name=$row['name'];
        $required='';
    }else{
        $_SESSION['TOASTR_MSG']=array(
           'type'=>'error',
           'body'=>'You don\'t have the permission to access the location!',    
           'title'=>'Error',
        );
        // redirect("index.php");
    }
}
if(isset($_POST['submit'])){
	$name=get_safe_value($_POST['name']);
    if(isset($_POST['submenu_name']) ){
	    $submenu_name=get_safe_value($_POST['submenu_name']);
    }
    if(isset($_POST['menu_id']) ){
	    $menu_id=get_safe_value($_POST['menu_id']);
    }
    $user_id=$_SESSION['ADMIN_ID'];
    $added_on=time();
    $id=uniqid();
    $sql="INSERT INTO `menus` (`id`, `name`, `status`) VALUES ('$id', '$name',   '1')";
    if(mysqli_query($con,$sql)){
        $_SESSION['TOASTR_MSG']=array(
            'type'=>'success',
            'body'=>'Data Inserted',
            'title'=>'Success',
        );
    // redirect('./sliders');
    }
}
if(isset($_POST['submenu_submit'])){
	$menu_id=get_safe_value($_POST['menu_id']);
	$submenu_name=get_safe_value($_POST['submenu_name']);
    $user_id=$_SESSION['ADMIN_ID'];
    $added_on=time();
    $id=uniqid();
    $sql="INSERT INTO `sub_menu` (`id`, `menu_id`, `name`, `status`) VALUES ('$id', '$menu_id', '$submenu_name',   '1')";
    if(mysqli_query($con,$sql)){
        $_SESSION['TOASTR_MSG']=array(
            'type'=>'success',
            'body'=>'Data Inserted',
            'title'=>'Success',
        );
    // redirect('./sliders');
    }
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
                            <h3>Create A Menu</h3>
                            <?php echo $msg?>
                        </div>
                    </div>
                    <form id="validate" class="new-added-form" method="post"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Menu Name</label>
                                    <input type="text" placeholder="" class="form-control" name="name" id="name"
                                        value="<?php echo $name?>">
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
            
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Create A Sub Menu</h3>
                            <?php echo $msg?>
                        </div>
                    </div>
                    <form id="validate" class="new-added-form" method="post"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                    <label>Menu Name *</label>
                                        <select class="form-control select2" name="menu_id">
                                            <option>Select Menu</option>
                                            <?php
                                            $res=mysqli_query($con,"SELECT * FROM `menus` where status='1'");
                                            while($row=mysqli_fetch_assoc($res)){
                                                if($row['id']==$menu_id){
                                                    echo "<option selected='selected' value=".$row['id'].">".$row['name']."</option>";
                                                }else{
                                                    echo "<option value=".$row['id'].">".$row['name']."</option>";
                                                }                                                        
                                            }
                                            ?>
                                        </select>
                                </div>
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Menu Name</label>
                                    <input type="text" placeholder="" class="form-control" name="submenu_name" id="submenu_name"
                                        value="<?php echo $submenu_name?>">
                                </div>
                                <div class="col-12 form-group mg-t-8">
                                    <input type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark"
                                        name="submenu_submit">
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