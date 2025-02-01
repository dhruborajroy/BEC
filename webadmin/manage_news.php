<?php 
define('SECURE_ACCESS', true);
include("header.php");
$user_id="";
$details="";
$title="";
$image="";
$dept="";
$added_on="";
$id="";
$required="required";
if(isset($_GET['id']) && $_GET['id']!=""){
	$id=get_safe_value($_GET['id']);
    $res=mysqli_query($con,"select * from `news` where md5(id)='$id'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $image=$row['image'];
        $details=$row['details'];
        $dept=$row['dept'];
        $added_on=$row['added_on'];
        $required="";
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
	$title=get_safe_value($_POST['title']);
	$dept=get_safe_value($_POST['dept']);
	$details=$_POST['details'];
    $details = str_replace("'", "\'", $_POST['details']);  // Removes apostrophes
    $details = str_replace('"', '\"', $_POST['details']);  // Removes apostrophes
    $user_id=$_SESSION['ADMIN_ID'];
    $added_on=time();
    $ref_id=uniqid();
    if($id==''){
        $id=uniqid();
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
                $image=time().'.jpg';
                move_uploaded_file($_FILES['image']['tmp_name'],UPLOAD_NEWS_IMAGE.$image);
                $sql="INSERT INTO `news` (`id`, `image`, `title`, `details`, `dept`, `added_on`, `added_by`, `status`) VALUES 
                                        ('$id', '$image', '$title', '$details', '$dept', '$added_on', '$user_id', '1')";
                if(mysqli_query($con,$sql)){
                    $_SESSION['TOASTR_MSG']=array(
                        'type'=>'success',
                        'body'=>'Data Inserted',
                        'title'=>'Success',
                    );
                // redirect('./sliders');
                }
            }else{
                $msg= "Only select jpg or png image";
            }
        }
    }else{
        $updated_on=time();
        if($_FILES['image']['name']!=''){
            $info=getimagesize($_FILES['image']['tmp_name']);
        }
        if(isset($info['mime'])){
            if($info['mime']=="image/jpeg"){
                $img=imagecreatefromjpeg($_FILES['image']['tmp_name']);
            }elseif($info['mime']=="image/png"){
                $img=imagecreatefrompng($_FILES['image']['tmp_name']);
            }else{
                $msg= "Only select jpg or png image";
            }
            if(isset($img)){
                $image=time().'.jpg';
                move_uploaded_file($_FILES['image']['tmp_name'],UPLOAD_NEWS_IMAGE.$image);
                $sql="update `news` set `image`='$image',`title`='$title',`details`='$details',  `dept`='$dept',`added_by`='$user_id' where md5(id)='$id'";
                if(mysqli_query($con,$sql)){
                    $_SESSION['TOASTR_MSG']=array(
                        'type'=>'success',
                        'body'=>'Data Updated',
                        'title'=>'Success',
                    );
                    // redirect('./sliders');
                    
                }else{
                    $msg= "Only select jpg or png image";
                }
            }
        }else{
            $sql="update `news` set  `title`='$title',`details`='$details',  `dept`='$dept',`added_by`='$user_id' where md5(id)='$id'";
            if(mysqli_query($con,$sql)){
                $_SESSION['TOASTR_MSG']=array(
                    'type'=>'success',
                    'body'=>'Data Updated',
                    'title'=>'Success',
                );
            }
        }
    }
    // echo $sql;
    // redirect('../pdfreports/notice?notice_id='.$id);
    redirect('./news');
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
                    <form onsubmit="replaceApostrophe()" id="validate" class="new-added-form" method="post"  enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Title</label>
                                <input type="text" required placeholder="" class="form-control" name="title" id="title"
                                    value="<?php echo $title?>">
                            </div>
                            <div class="col-12-xxxl col-lg-12 col-12">
                                <label>Details</label>
                                <textarea name="details" class="full_input" id="details" cols="30" rows="10"><?php echo $details?></textarea>
                            </div>
                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                    <label>Dept *</label>
                                    <select class="form-control select2" name="dept" required>
                                        <?php
                                        $res=mysqli_query($con,"SELECT * FROM `depts_lab_list` where status='1'");
                                        while($row=mysqli_fetch_assoc($res)){
                                            if($row['short_form']==$dept){
                                                echo "<option selected='selected' value=".$row['short_form'].">".$row['name']." (".$row['short_form'].")</option>";
                                            }else{
                                                echo "<option value=".$row['short_form'].">".$row['name']." (".$row['short_form'].")</option>";
                                            }                                                        
                                        }
                                        ?>
                                    </select>
                                </div>
                            
                            <div class="col-lg-12 col-12 form-group">
                                    <div class="col-sm-12 img-body">
                                        <div class="center">
                                            <div class="form-input">
                                                <div class="preview">
                                                    <img id="file_ip_1-preview" <?php if($image!=''){
                                                        echo 'src="../images/news/'.$image.'"';}
                                                        ?> >
                                        </div>
                                        <label for="file_ip_1">Upload Image</label>
                                        <input type="file" name="image" id="file_ip_1" accept="image/*"
                                        onchange="showPreview(event);" <?php echo $required?>
                                        value="<?php echo $image?>">
                                    </div>
                                </div>
                                
                                <script type="text/javascript">
                                function showPreview(event) {
                                    if (event.target.files.length > 0) {
                                        var src = URL.createObjectURL(event.target.files[0]);
                                        var preview = document.getElementById("file_ip_1-preview");
                                        preview.src = src;
                                        preview.style.display = "block";
                                    }
                                }
                                </script>
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
    <script>
        function replaceApostrophe() {
            var details = document.getElementById('details').value; 
            details = details.replace(/'/g, "\\'"); 
            document.getElementById('details').value = details; 
        }
    </script>
