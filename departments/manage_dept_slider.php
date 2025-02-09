<?php 
define('SECURE_ACCESS', true);
include("header.php");
$id="";
$title="";
$user_id="";
$details="";
$added_on="";
$sub_title="";
$button_link="";
$button_text="";
$image="";
$msg="";
$required='required';
if(isset($_GET['id']) && $_GET['id']!==""){
	$id=get_safe_value($_GET['id']);
    $swl="select * from `dept_sliders` where md5(id)='$id'";
    $res=mysqli_query($con,$swl);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $sub_title=$row['sub_title'];
        $button_text=$row['button_text'];
        $button_link=$row['button_link'];
        $added_on=$row['added_on'];
        $image=$row['image'];
        $dept_id=$row['dept'];
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
    // print_r($_POST);
	$title=get_safe_value($_POST['title']);
	$sub_title=get_safe_value($_POST['sub_title']);
	$button_text=get_safe_value($_POST['button_text']);
	$button_link=get_safe_value($_POST['button_link']);
    $user_id=$_SESSION['DEPT_ADMIN_ID'];
    $added_on=time();
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
                move_uploaded_file($_FILES['image']['tmp_name'],UPLOAD_DEPT_SLIDER_IMAGE.$image);
                echo $sql="INSERT INTO `dept_sliders` (`id`, `title`,`image`,`dept`, `sub_title`,`button_text`,`button_link`, `added_on`,`updated_on`, `added_by`, `status`) VALUES 
                                            ('$id', '$title',  '$image', '$dept_id', '$sub_title','$button_text','$button_link', '$added_on', '','$user_id', '1')";
                if(mysqli_query($con,$sql)){
                    $_SESSION['TOASTR_MSG']=array(
                        'type'=>'success',
                        'body'=>'Data Inserted',
                        'title'=>'Success',
                    );
                redirect('./sliders');
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
                move_uploaded_file($_FILES['image']['tmp_name'],UPLOAD_DEPT_SLIDER_IMAGE.$image);
                $sql="update `dept_sliders` set  `title`='$title', `image`='$image',  `sub_title`='$sub_title',`updated_on`='$updated_on',`added_by`='$user_id' where md5(id)='$id'";
                if(mysqli_query($con,$sql)){
                    $_SESSION['TOASTR_MSG']=array(
                        'type'=>'success',
                        'body'=>'Data Updated',
                        'title'=>'Success',
                    );
                    redirect('./sliders');
                    
                }else{
                    $msg= "Only select jpg or png image";
                }
            }
        }else{
            $sql="update `dept_sliders` set  `title`='$title', `sub_title`='$sub_title', `updated_on`='$updated_on',`added_by`='$user_id' where md5(id)='$id'";
            if(mysqli_query($con,$sql)){
                $_SESSION['TOASTR_MSG']=array(
                    'type'=>'success',
                    'body'=>'Data Updated',
                    'title'=>'Success',
                );
                redirect('./sliders');
            }
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
                            <h3>Create A Slider</h3>
                            <?php echo $msg?>
                        </div>
                    </div>
                    <form id="validate" class="new-added-form" method="post"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Title</label>
                                    <input type="text" placeholder="" class="form-control" name="title" id="title"
                                        value="<?php echo $title?>">
                                </div>
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Sub Title</label>
                                    <input type="text"  placeholder="Enter Subtitle" class="form-control" name="sub_title" id="sub_title"
                                        value="<?php echo $sub_title?>">
                                </div>
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Button Text</label>
                                    <input type="text" placeholder="Enter Button Text" class="form-control" name="button_text" id="button_text"
                                        value="<?php echo $button_text?>">
                                </div>
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Button Link</label>
                                    <input type="text"  placeholder="Enter Button Link" class="form-control" name="button_link" id="button_link"
                                        value="<?php echo $button_link?>">
                                </div>
                                <div class="col-lg-12 col-12 form-group">
                                    <div class="col-sm-12 img-body">
                                        <div class="center">
                                            <div class="form-input">
                                                <div class="preview">
                                                    <img id="file_ip_1-preview" <?php if($image!=''){
                                                        echo 'src="'.DEPT_SLIDER_IMAGE.$image.'"';}
                                                        ?> >
                                        </div>
                                        <label for="file_ip_1">Upload Image</label>
                                        <input type="file" name="image" id="file_ip_1" accept="image/*"
                                        onchange="showPreview(event);" <?php echo $required?>
                                        value="<?php echo $image?>">
                                    </div>
                                </div>
                                <div class="col-12 form-group mg-t-8">
                                    <input type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark"
                                        name="submit">
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
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>

    <script>
            ClassicEditor
                    .create( document.querySelector( '#editor' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
    </script>