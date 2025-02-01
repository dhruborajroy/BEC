<?php 
define('SECURE_ACCESS', true);
include("header.php");
$msg="";
$id="";
$name='';
$fname='';
$mname='';
$phoneNumber='';
$presentAddress='';
$permanentAddress='';
$required='required';
$paymentStatus='';
$dob='';
$gender='';
$religion='';
$bloodGroup='';
$image='';
$email='';
$batch='';
$deptId="";
$session="";
$batch_name="";
$id=$_SESSION['USER_ID'];
$sql="select students.*,batch.name as batch_name,batch.session as session,depts_lab_list.name as dept_name  from students,batch,depts_lab_list where students.id='$id' and students.batch=batch.id and students.dept_id=depts_lab_list.id";
$res=mysqli_query($con,$sql);
if(mysqli_num_rows($res)>0){
    $row=mysqli_fetch_assoc($res);
    $name=$row['name'];
    $class_roll=$row['class_roll'];
    $reg_no=$row['reg_no'];
    $fname=$row['fName'];
    $mname=$row['mName'];
    $phoneNumber=$row['phoneNumber'];
    $presentAddress=$row['presentAddress'];
    $permanentAddress=$row['permanentAddress'];
    $dob=$row['dob'];
    $gender=$row['gender'];
    $religion=$row['religion'];
    $bloodGroup=$row['bloodGroup'];
    $image=$row['image'];
    $email=$row['email'];
    $dept_id=$row['dept_id'];
    $batch=$row['batch'];
    $batch_name=$row['batch_name'];
    $session=$row['session'];
    $dept_name=$row['dept_name'];
    $required='';
}else{
    redirect("logout");
}
?>

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Student Details</strong> 
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                    <div class="col-3 col-md-3">
                                    </div>
                                    <div class="col-9 col-md-9">
                                            <img src="../images/students/<?php echo $image?>" alt="" srcset="">
                                            <!-- <img width="300px" src="http://localhost/students/images/icon/avatar-01.jpg" alt="" srcset=""> -->
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Name</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $name?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="email-input" class=" form-control-label">Email</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $email?>" class="form-control">

                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Class Roll</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $class_roll?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Dhaka University Registration Number</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $reg_no?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Session</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $session?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Father's Name</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $fname?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Mother's Name</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $mname?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Phone Number</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $phoneNumber?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Present Address </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $presentAddress?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Permanent Address</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $permanentAddress?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Date of Birth</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $dob?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Gender</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $gender?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Religion</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $religion?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Blood Group</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $bloodGroup?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">dept_id Group</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $dept_name?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Batch </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $batch_name?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Email </label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $email?>" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
<?php 
include("footer.php");
?>