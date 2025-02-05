<?php 
    define('SECURE_ACCESS', true);
   include("header.php");
   // Initialize all variables as blank
    $id="";
    $name = "";
    $designation = "";
    $phone = "";
    $email = "";
    $research_interest = "";
    $bio = "";
    $facebook = "";
    $linked_in = "";
    $education = "";
    $experience = "";
    $publication = "";
    $scholarship_award = "";
    $research = "";
    $teaching_supervision = "";
    $joined_at = "";
    $visibility = "public"; // Default value for visibility
    $dept_head = 0; 
    $dept="";
    $image="";
    $type="";
    $required="required";
    $id=$_SESSION['FACULTY_ID'];
    $res=mysqli_query($con,"select * from `people` where id='$id'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        // Retrieve all variables
        $name = $row['name'];
        $designation = $row['designation'];
        $phone = $row['phone'];
        $email = $row['email'];
        $research_interest = $row['research_interest'];
        $bio = $row['bio'];
        $facebook = $row['facebook'];
        $linked_in = $row['linked_in'];
        $education = $row['education'];
        $dept = $row['dept'];
        $experience = $row['experience'];
        $publication = $row['publication'];
        $scholarship_award = $row['scholarship_award'];
        $research = $row['research'];
        $teaching_supervision = $row['teaching_supervision'];
        $joined_at = $row['joined_at'];
        $visibility = $row['visibility'];
        $dept_head = $row['dept_head'];
        $image = $row['image'];
        $type = $row['type'];
        $required="";
    }else{
        $_SESSION['TOASTR_MSG']=array(
            'type'=>'error',
            'body'=>'You don\'t have the permission to access the location!',    
            'title'=>'Error',
        );
        redirect("index.php");
    }
   if(isset($_POST['submit'])){
    // pr($_POST);
       $designation = get_safe_value($_POST['designation']);
       $phone = get_safe_value($_POST['phone']);
       $research_interest = get_safe_value($_POST['research_interest']);
       $bio = get_safe_value($_POST['bio']);
       $facebook = get_safe_value($_POST['facebook']);
       $linked_in = get_safe_value($_POST['linked_in']);
       $education = get_safe_value($_POST['education']);
       $experience = get_safe_value($_POST['experience']);
       $publication = get_safe_value($_POST['publication']);
       $scholarship_award = get_safe_value($_POST['scholarship_award']);
       $research = get_safe_value($_POST['research']);
       $teaching_supervision = get_safe_value($_POST['teaching_supervision']);
       $_SESSION['ADMIN_ID'];
       $added_on=time();
       $updated_on=time();
       if(isset($_FILES['image']['name'])){
        if($_FILES['image']['name']!=''){
            $info=getimagesize($_FILES['image']['tmp_name']);
        }
       }
       if(isset($info['mime'])){
           if($info['mime']=="image/jpeg"){
               $img=imagecreatefromjpeg($_FILES['image']['tmp_name']);
           }elseif($info['mime']=="image/png"){
               $img=imagecreatefrompng($_FILES['image']['tmp_name']);
           }else{
              $msg= "Only select jpg or png image";
              $_SESSION['TOASTR_MSG']=array(
                 'type'=>'error',
                 'body'=>$msg,    
                 'title'=>'Error',
              );
           }
           if(isset($img)){
               $image=time().'.jpg';
               move_uploaded_file($_FILES['image']['tmp_name'],UPLOAD_FACULTY_IMAGE.$image);
               $updated_on=time();
               $sql = "UPDATE people SET image='$image', designation='$designation', phone='$phone', email='$email', research_interest='$research_interest', bio='$bio', facebook='$facebook', linked_in='$linked_in', education='$education', experience='$experience', publication='$publication', scholarship_award='$scholarship_award', research='$research', teaching_supervision='$teaching_supervision', joined_at='$joined_at', visibility='$visibility', dept_head=$dept_head, type='$type' WHERE id='$id'";
               if(mysqli_query($con,$sql)){
                   $_SESSION['TOASTR_MSG']=array(
                       'type'=>'success',
                       'body'=>'Data updated',
                       'title'=>'Success',
                   );
                   redirect('profile');
               }else{
                   echo $sql;
               }
           }
       }else{
           $updated_on=time();
           $sql = "UPDATE people SET  designation='$designation', phone='$phone', email='$email', research_interest='$research_interest', bio='$bio', facebook='$facebook', linked_in='$linked_in', education='$education', experience='$experience', publication='$publication', scholarship_award='$scholarship_award', research='$research', teaching_supervision='$teaching_supervision', joined_at='$joined_at', visibility='$visibility', dept_head=$dept_head, type='$type' WHERE id='$id'";
           if(mysqli_query($con,$sql)){
               $_SESSION['TOASTR_MSG']=array(
                   'type'=>'success',
                   'body'=>'Data updated',
                   'title'=>'Success',
               );
               redirect('profile');
           }else{
               echo $sql;
           }
       }
    }
?>

<!-- MAIN CONTENT-->
<div class="main-content">
<div class="section__content section__content--p30">
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
      <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Basic Form</strong> Elements
            </div>
            <div class="card-body card-block">
                <form method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" value="<?php echo htmlspecialchars($name); ?>" id="text-input" name="text-input" placeholder="" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="disabled-input" class=" form-control-label">Email</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="disabled-input" name="disabled-input" placeholder="<?php echo htmlspecialchars($email); ?>" disabled="disabled" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="password-input" class=" form-control-label">Designation</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-control select2" name="designation">
                                <option disabled selected>Select Designation </option>
                                <?php
                                    $data = [
                                        'Professor'  => 'Professor',
                                        'Associate Professor'  => 'Associate Professor',
                                        'Assistant Professor'  => 'Assistant Professor',
                                        'Lecturer'  => 'Lecturer',
                                        'Officer'  => 'Officer',
                                        'Security Officer'  => 'Security Officer',
                                        'Others'  => 'Others',
                                    ];

                                    foreach ($data as $key => $val) {
                                        if ($key == $designation) {
                                            echo "<option selected='selected' value='$key'>$val</option>";
                                        } else {
                                            echo "<option value='$key'>$val</option>";
                                        }
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="password-input" class=" form-control-label">Facebook</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="password-input" value="<?php echo htmlspecialchars($facebook); ?>" name="facebook" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="password-input" class=" form-control-label">Phone</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="password-input" value="<?php echo htmlspecialchars($phone); ?>" name="phone" placeholder="Password" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="password-input" class=" form-control-label">Linkedin</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="password-input" value="<?php echo htmlspecialchars($linked_in); ?>" name="linked_in" placeholder="Password" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Research Interest</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="research_interest" id="textarea-input" rows="9" placeholder="" class="form-control textarea-input"><?php echo htmlspecialchars($research_interest); ?></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Bio</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="bio" id="textarea-input" rows="9" placeholder="" class="form-control textarea-input"><?php echo htmlspecialchars($bio); ?></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Education</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="education" id="textarea-input" rows="9" class="form-control textarea-input"><?php echo htmlspecialchars($education); ?></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Publication</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="publication" id="textarea-input" rows="9" placeholder="" class="form-control textarea-input textarea-input"><?php echo htmlspecialchars($publication); ?></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Experience</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="experience" id="textarea-input" rows="9" class="form-control textarea-input"><?php echo htmlspecialchars($experience); ?></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Scholarships & Awards</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="scholarship_award" id="textarea-input" rows="9" placeholder="" class="form-control textarea-input"><?php echo htmlspecialchars($scholarship_award); ?></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Professional Training</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="research" id="textarea-input" rows="9" placeholder="" class="form-control textarea-input"><?php echo htmlspecialchars($research); ?></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="textarea-input" class=" form-control-label">Teaching & Supervision</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <textarea name="teaching_supervision" id="textarea-input" rows="9" placeholder="" class="form-control textarea-input"><?php echo htmlspecialchars($teaching_supervision); ?></textarea>
                        </div>
                    </div>
                    
                    <div class="row col-lg-12 col-12">
                            <div class="col-sm-12 img-body">
                                <div class="center">
                                    <div class="form-input">
                                        <div class="preview">
                                        <img style="height:150px;width:150px;" id="file_ip_1-preview" <?php if($image!=''){
                                            echo 'src="../images/teachers/'.$image.'"';}
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
                            </div>
                    </div>
                
            </div>
            <div class="card-footer">
                <input type="submit" name="submit" class="btn btn-primary btn-sm">
            </div>
        </form>

        </div>
    </div>

      </div>
   </div>
</div>
<?php include("footer.php");?>