<?php 
define('SECURE_ACCESS', true);
include('header.php');
$id="";
$short_name='';
$msg="";
$name='';
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
    $res=mysqli_query($con,"select * from authors where id='$id'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $name=$row['name'];
        $short_name=$row['short_name'];
    }else{
        redirect("index.php");
    }
}
if(isset($_POST['submit'])  && isset($_POST['csrf_token']) ){
    if($_POST['csrf_token']!=$_SESSION['csrf_token']){
        die("You don't have permission to access that location");
    }
    $name=trim(get_safe_value($_POST['name']));
    $short_name=trim(get_safe_value($_POST['short_name']));
   if($id==''){
        $swl="select * from authors where name='$name'";
        $ress=mysqli_query($con,$swl);
        if(mysqli_num_rows($ress)>0){
            $msg='<div class="alert alert-danger" role="alert">
                    <span class="error" style="font-size:20px"> Author already added.</span>
                </div>';
        }else{
            $id=uniqid();
            $sql="INSERT INTO `authors` (`id`,`name`, `short_name`,`status`) VALUES ( '$id','$name', '$short_name', 1)";
            mysqli_query($con,$sql);
            $_SESSION['INSERT']=1;
            redirect('./authors.php');
        }
    }else{
        $sql="update `authors` set  `name`='$name', `short_name`='$short_name' where id='$id'";
        mysqli_query($con,$sql);    
        $_SESSION['UPDATE']=1;
        redirect('./authors.php');
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
            <form class="new-added-form" id="validate" method="post">
                <?php echo form_csrf()?>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Author Name *</label>
                        <input type="text" placeholder="Enter Author name" value="<?php echo $name?>" name="name"
                            id="name" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Short Form of Author</label>
                        <input type="text" placeholder="Short name of Author" value="<?php echo $short_name?>"
                            name="short_name" class="form-control" id="short_name">
                    </div>
                    <div class="col-md-6 form-group"></div>
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