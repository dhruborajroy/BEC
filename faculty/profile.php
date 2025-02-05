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
$id=$_SESSION['FACULTY_ID'];
$sql="select * from people where id='$id' ";
$res=mysqli_query($con,$sql);
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
    redirect("logout");
}
?>
<!-- MAIN CONTENT-->
<div class="main-content">
                <div class="section_content section_content--p30">
                    <div class="container-fluid">
                        

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Profile</strong> 
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                    <div class="col-3 col-md-3">
                                    </div>
                                    <div class="col-9 col-md-9">
                                            <img width="300px"  src="../images/teachers/<?php echo $image?>" alt="" srcset="">
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
                                            <label for="disabled-input" class=" form-control-label">Designation</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $designation?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label"> Phone</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $phone?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Email</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $email?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="disabled-input" class=" form-control-label">Dept</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" disabled id="text-input" name="text-input" value="<?php echo $dept?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="default-tab">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <a class="nav-item nav-link active show" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Bio</a>
                                                    <a class="nav-item nav-link" id="nav-education-tab" data-toggle="tab" href="#nav-education" role="tab" aria-controls="nav-profile" aria-selected="false">Education</a>
                                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-experience" role="tab" aria-controls="nav-contact" aria-selected="false">Experience</a>
                                                    <a class="nav-item nav-link" id="nav-publications-tab" data-toggle="tab" href="#nav-publications" role="tab" aria-controls="nav-contact" aria-selected="false">Publications</a>
                                                    <a class="nav-item nav-link" id="nav-scholarship_award-tab" data-toggle="tab" href="#nav-scholarship_award" role="tab" aria-controls="nav-contact" aria-selected="false">Scholarships & Awards</a>
                                                    <a class="nav-item nav-link" id="nav-research-tab" data-toggle="tab" href="#nav-research" role="tab" aria-controls="nav-contact" aria-selected="false">Professional Training</a>
                                                    <a class="nav-item nav-link" id="nav-teaching_supervision-tab" data-toggle="tab" href="#nav-teaching_supervision" role="tab" aria-controls="nav-contact" aria-selected="false">Teaching & Supervision</a>
                                                </div>
                                            </nav>
                                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                                <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                    <p>
                                                    <div class="blockquote mt-5">
                                                        <div class="blockquote-info">
                                                        <div class="blockquote-quote">
                                                            <i class="fas fa-quote-left"></i>
                                                        </div>
                                                        <div class="blockquote-content">
                                                            <?php echo $row['bio']?>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </p>
                                                </div>
                                                <div class="tab-pane fade" id="nav-education" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                    <div class="section-title mt-5">
                                                        <h4 class="title">Education</h4>
                                                    </div>
                                                    <p><?php echo $row['education']?></p>
                                                </div>
                                                <div class="tab-pane fade" id="nav-experience" role="tabpanel" aria-labelledby="nav-experience-tab">
                                                    <div class="section-title mt-5">
                                                        <h4 class="title">Experience</h4>
                                                    </div>
                                                    <p><?php echo $row['experience']?></p>
                                                </div>
                                                <div class="tab-pane fade" id="nav-publications" role="tabpanel" aria-labelledby="nav-publications-tab">
                                                    <div class="section-title mt-5">
                                                        <h4 class="title">Publication</h4>
                                                    </div>
                                                    <p><?php echo $row['publication']?></p>
                                                </div>
                                                <div class="tab-pane fade" id="nav-scholarship_award" role="tabpanel" aria-labelledby="nav-scholarship_award-tab">
                                                    <div class="section-title mt-5">
                                                        <h4 class="title">Scholarships & Awards</h4>
                                                    </div>
                                                    <p><?php echo $row['scholarship_award']?></p>
                                                </div>
                                                <div class="tab-pane fade" id="nav-research" role="tabpanel" aria-labelledby="nav-research-tab">
                                                    <div class="section-title mt-5">
                                                        <h4 class="title">Research</h4>
                                                    </div>
                                                    <p><?php echo $row['research']?></p>
                                                </div>
                                                <div class="tab-pane fade" id="nav-teaching_supervision" role="tabpanel" aria-labelledby="nav-teaching_supervision-tab">
                                                    <div class="section-title mt-5">
                                                        <h4 class="title">Teaching Supervision</h4>
                                                    </div>
                                                    <p><?php echo $row['teaching_supervision']?></p>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
<?php 
include("footer.php");
?>