<?php include('header.php');
$id="";
$short_form='';
$name='';
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
    $res=mysqli_query($con,"select * from `publications` where id='$id'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $short_form=$row['short_form'];
        $name=$row['name'];
    }else{
        redirect("index.php");
    }
}
if(isset($_POST['submit']) && isset($_POST['csrf_token']) ){
    if($_POST['csrf_token']!=$_SESSION['csrf_token']){
        die("You don't have permission to access that location");
    }
    // pr($_POST);
	$short_form=get_safe_value($_POST['short_form']);
	$name=get_safe_value($_POST['name']);
   if($id==''){
        $swl="select * from publications where name='$name'";
        $ress=mysqli_query($con,$swl);
        if(mysqli_num_rows($ress)>0){
            $msg='<div class="alert alert-danger" role="alert">
                    <span class="error" style="font-size:20px"> Publications already added.</span>
                </div>';
        }else{
            $id=uniqid();
            $sql="INSERT INTO `publications` (`id`,`name`, `short_form`,`status`) VALUES ('$id', '$name', '$short_form', 1)";
            mysqli_query($con,$sql);
            $_SESSION['INSERT']=1;
            redirect('./publications.php');
        }
    }else{
        $sql="update `publications` set  `name`='$name', `short_form`='$short_form' where id='$id'";
        mysqli_query($con,$sql);    
        $_SESSION['UPDATE']=1;
        redirect('./publications.php');
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
                    <h3>Add New Publication</h3>
                </div>
            </div>
            <form class="new-added-form" id="validate" method="post">
                <?php echo form_csrf()?>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Publication Name *</label>
                        <input type="text" placeholder="Enter Publication name" value="<?php echo $name?>" id="name"
                            name="name" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Short Form of Publication</label>
                        <input type="text" placeholder="Enter value of Short Form" value="<?php echo $short_form?>"
                            name="short_form" id="short_form" class="form-control">
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