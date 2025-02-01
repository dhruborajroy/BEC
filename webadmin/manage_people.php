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
   if(isset($_GET['id']) && $_GET['id']>0){
   	$id=get_safe_value($_GET['id']);
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
   }
   if(isset($_POST['submit'])){
       $name = get_safe_value($_POST['name']);
       $designation = get_safe_value($_POST['designation']);
       $phone = get_safe_value($_POST['phone']);
       $email = get_safe_value($_POST['email']);
       $research_interest = get_safe_value($_POST['research_interest']);
       $bio = get_safe_value($_POST['bio']);
       $facebook = get_safe_value($_POST['facebook']);
       $linked_in = get_safe_value($_POST['linked_in']);
       $education = get_safe_value($_POST['education']);
       $experience = get_safe_value($_POST['experience']);
       $dept = get_safe_value($_POST['dept']);
       $publication = get_safe_value($_POST['publication']);
       $scholarship_award = get_safe_value($_POST['scholarship_award']);
       $research = get_safe_value($_POST['research']);
       $teaching_supervision = get_safe_value($_POST['teaching_supervision']);
       $joined_at = get_safe_value($_POST['joined_at']);
       $visibility = get_safe_value($_POST['visibility']);
       $type = get_safe_value($_POST['type']);
       $dept_head = isset($_POST['dept_head']) ? 1 : 0; 
       $_SESSION['ADMIN_ID'];
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
                   $_SESSION['TOASTR_MSG']=array(
                     'type'=>'error',
                     'body'=>$msg,    
                     'title'=>'Error',
                  );
               }
               if(isset($img)){
                   $image=time().'.jpg';
                   move_uploaded_file($_FILES['image']['tmp_name'],UPLOAD_FACULTY_IMAGE.$image);
                           
                   $sql = "INSERT INTO people (id, name,image, designation, phone, email, research_interest, bio, facebook, linked_in, education, experience, publication, scholarship_award, research, teaching_supervision, joined_at, visibility, dept_head,type, status) 
                   VALUES ('$id','$name','$image', '$designation', '$phone', '$email', '$research_interest', '$bio', '$facebook', '$linked_in', '$education', '$experience', '$publication', '$scholarship_award', '$research', '$teaching_supervision', '$joined_at', '$visibility', $dept_head, '$type',  '1')";
                   if(mysqli_query($con,$sql)){
                       $_SESSION['TOASTR_MSG']=array(
                           'type'=>'success',
                           'body'=>'Data Inserted',
                           'title'=>'Success',
                       );
                       redirect('people');
                   }else{
                       echo $sql;
                   }
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
                $sql = "UPDATE people SET name='$name',image='$image', designation='$designation', phone='$phone', email='$email', research_interest='$research_interest', bio='$bio', facebook='$facebook', linked_in='$linked_in', education='$education', experience='$experience', publication='$publication', scholarship_award='$scholarship_award', research='$research', teaching_supervision='$teaching_supervision', joined_at='$joined_at', visibility='$visibility', dept_head=$dept_head, type='$type' WHERE id='$id'";
                if(mysqli_query($con,$sql)){
                    $_SESSION['TOASTR_MSG']=array(
                        'type'=>'success',
                        'body'=>'Data updated',
                        'title'=>'Success',
                    );
                    redirect('./people');
                }else{
                    echo $sql;
                }
            }
        }else{
            $updated_on=time();
            $sql = "UPDATE people SET name='$name', designation='$designation', phone='$phone', email='$email', research_interest='$research_interest', bio='$bio', facebook='$facebook', linked_in='$linked_in', education='$education', experience='$experience', publication='$publication', scholarship_award='$scholarship_award', research='$research', teaching_supervision='$teaching_supervision', joined_at='$joined_at', visibility='$visibility', dept_head=$dept_head, type='$type' WHERE id='$id'";
            if(mysqli_query($con,$sql)){
                $_SESSION['TOASTR_MSG']=array(
                    'type'=>'success',
                    'body'=>'Data updated',
                    'title'=>'Success',
                );
                redirect('people');
            }else{
                echo $sql;
            }
        }
    }
    echo $sql;
}
?>
<div class="dashboard-content-one">
<!-- Breadcubs Area Start Here -->
<div class="breadcrumbs-area">
   <h3>People</h3>
   <ul>
      <li>
         <a href="index.php">Home</a>
      </li>
      <li>People </li>
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
            <h3>Create A Profile</h3>
         </div>
      </div>
      <form id="validate" class="new-added-form" method="post"  enctype="multipart/form-data">
         <div class="row ">
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
               <label for="name">Name</label>
               <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
               <label for="designation">Designation</label>
               <input type="text" name="designation" id="designation" value="<?php echo htmlspecialchars($designation); ?>" class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
               <label for="phone">Phone</label>
               <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($phone); ?>" class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
               <label for="email">Email</label>
               <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 ">
               <label for="research_interest">Research Interest</label>
               <textarea class="full_input" name="research_interest" id="research_interest"  class="form-control"><?php echo htmlspecialchars($research_interest); ?></textarea>
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 ">
               <label for="bio">Bio</label>
               <textarea class="full_input" name="bio" id="bio" cols="30" rows="5" class="form-control"><?php echo htmlspecialchars($bio); ?></textarea>
            </div>
            <div class="col-xl-12 col-lg-6 col-12 form-group">
               <label> Type *</label>
               <select class="select2" name="type" required>
                     <?php
                     $data=[
                        'name'=>[
                           'Faculty',
                           'Officers',
                           'Staff',
                           'Former-faculty',
                        ]
                     ];
                     $count=count($data['name']);
                     for($i=0;$i<$count;$i++){
                        if($data['name'][$i]==$type){
                           echo "<option selected='selected' value=".$data['name'][$i].">".$data['name'][$i]."</option>";
                        }else{
                           echo "<option value=".$data['name'][$i].">".$data['name'][$i]."</option>";
                        }                                                        
                     }                                       
               ?>
               </select>
            </div>
            <div class="col-xl-12 col-lg-12 col-12 form-group">
               <label>Department *</label>
               <select class="form-control select2" name="dept" required>
                     <?php
                     $res=mysqli_query($con,"SELECT * FROM `depts_lab_list` where status='1'");
                     while($row=mysqli_fetch_assoc($res)){
                        if($row['short_form']==$dept_id){
                           echo "<option selected='selected' value=".$row['short_form'].">".$row['name']." (".$row['short_form'].")</option>";
                        }else{
                           echo "<option value=".$row['short_form'].">".$row['name']." (".$row['short_form'].")</option>";
                        }                                                        
                     }
                     ?>
               </select>
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
               <label for="facebook">Facebook</label>
               <input type="text" name="facebook" id="facebook" value="<?php echo htmlspecialchars($facebook); ?>" class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
               <label for="linked_in">LinkedIn</label>
               <input type="text" name="linked_in" id="linked_in" value="<?php echo htmlspecialchars($linked_in); ?>" class="form-control">
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 ">
               <label for="education">Education</label>
               <textarea class="full_input" name="education" id="education" cols="30" rows="5" class="form-control"><?php echo htmlspecialchars($education); ?></textarea>
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 ">
               <label for="experience">Experience</label>
               <textarea class="full_input" name="experience" id="experience" cols="30" rows="5" class="form-control"><?php echo htmlspecialchars($experience); ?></textarea>
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 ">
               <label for="publication">Publication</label>
               <textarea class="full_input" name="publication" id="publication" cols="30" rows="5" class="form-control"><?php echo htmlspecialchars($publication); ?></textarea>
            </div>
            <div class="col-12-xxxl col-lg-12 col-12">
               <label for="scholarship_award">Scholarship & Awards</label>
               <textarea class="full_input" name="scholarship_award" id="scholarship_award" cols="30" rows="5" class="form-control"><?php echo htmlspecialchars($scholarship_award); ?></textarea>
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 ">
               <label for="research">Research</label>
               <textarea class="full_input" name="research" id="research" cols="30" rows="5" class="form-control"><?php echo htmlspecialchars($research); ?></textarea>
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 ">
               <label for="teaching_supervision">Teaching & Supervision</label>
               <textarea class="full_input" class="full_input" name="teaching_supervision" id="teaching_supervision" cols="30" rows="5" class="form-control"><?php echo htmlspecialchars($teaching_supervision); ?></textarea>
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
               <label for="joined_at">Joined At</label>
               <input type="date" name="joined_at" id="joined_at" value="<?php echo htmlspecialchars($joined_at); ?>" class="form-control" required>
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
               <label for="visibility">Visibility</label>
               <select name="visibility" id="visibility" class="form-control select2">
                  <option value="public" <?php echo $visibility == 'public' ? 'selected' : ''; ?>>Public</option>
                  <option value="private" <?php echo $visibility == 'private' ? 'selected' : ''; ?>>Private</option>
               </select>
            </div>
            <div class="col-12-xxxl col-lg-12 col-12 form-group">
               <label for="dept_head">Department Head</label>
               <input type="checkbox" name="dept_head" id="dept_head" value="1" <?php echo $dept_head == 1 ? 'checked' : ''; ?>>
            </div>
            <div class="col-lg-12 col-12 form-group">
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