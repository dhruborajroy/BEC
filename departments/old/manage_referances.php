<?php 
define('SECURE_ACCESS', true);
include("header.php");
$id="";
$name="";
$msg="";
$required='required';
if(isset($_GET['id']) && $_GET['id']!==""){
	$id=get_safe_value($_GET['id']);
    $swl="select * from `referances` where id='$id'";
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
    $user_id=$_SESSION['ADMIN_ID'];
    if($id==''){
        $id=uniqid();
        $sql="INSERT INTO `referances` (`id`, `name`, `status`) VALUES ('$id', '$name',   '1')";
        if(mysqli_query($con,$sql)){
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'success',
                'body'=>'Data Inserted',
                'title'=>'Success',
            );
        redirect('./referances');
        }
    }else{
        $updated_on=time();
        $sql="update `referances` set  `name`='$name' where id='$id'";
        if(mysqli_query($con,$sql)){
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'success',
                'body'=>'Data updated',
                'title'=>'Success',
            );
            redirect('./referances');
        }else{
            echo $sql;
        }
    }
}
?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Referances  </h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Referances </li>
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
                            <h3>Create A Referances</h3>
                            <?php echo $msg?>
                        </div>
                    </div>
                    <form id="validate" class="new-added-form" method="post"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Referances Name</label>
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
        </div>
        <!-- Add Notice Area End Here -->
         
    </div>
    <?php include("footer.php")?>