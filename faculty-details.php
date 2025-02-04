<?php 
   define('SECURE_ACCESS', true);
   include("header.php");
   
   if(isset($_GET['id']) && $_GET['id']>0){
   	  $id=get_safe_value($_GET['id']);
       $res=mysqli_query($con,"select * from people where type='faculty' and md5(id)='$id'");
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
           $experience = $row['experience'];
           $publication = $row['publication'];
           $scholarship_award = $row['scholarship_award'];
           $research = $row['research'];
           $teaching_supervision = $row['teaching_supervision'];
           $joined_at = $row['joined_at'];
           $visibility = $row['visibility'];
           $dept_head = $row['dept_head'];
           $status = $row['status'];
       }else{
           $_SESSION['TOASTR_MSG']=array(
              'type'=>'error',
              'body'=>'You don\'t have the permission to access the location!',    
              'title'=>'Error',
           );
           redirect("index.php");
     }
   }else{
     $_SESSION['TOASTR_MSG']=array(
        'type'=>'error',
        'body'=>'You don\'t have the permission to access the location!',    
        'title'=>'Error',
     );
     redirect("index.php");
   }
   ?>
<!--=================================inner-header -->
<section class="inner-banner bg-overlay-black-70 bg-holder" style="background-image: url('images/bg/02.jpg');">
   <div class="container">
      <div class="row d-flex justify-content-center">
         <div class="col-md-12">
            <div class="text-center">
               <h1 class="text-white">Faculty Details</h1>
            </div>
         </div>
      </div>
   </div>
</section>
<!--=================================inner-header -->
<!--=================================Team-single -->
<section class="space-pt">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="row">
               <div class="col-md-12 mb-4 mb-md-0">
                
              </div>
            </div>
            <div class="row mt-4">
               <div class="col-md-4 mb-4 mb-md-0">
                  <div class="team-single is-sticky">
                     <div class="team-img">
                        <img class="img-fluid border-radius" src="images/teachers/<?php echo $row['image']?>" alt="">
                     </div>
                     <div class="social mt-4 text-center">
                        <ul class="pl-0">
                           <li><a href="<?php echo $row['facebook']?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                           <li><a href="<?php echo $row['linked_in']?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                           <li><a href="mailto:<?php echo $row['email']?>"><i class="fa fa-envelope"></i></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-8 mb-4 mb-md-0">
                  <div class="team-info">
                     <a href="#" class="team-name h4"><?php echo $row['name']?></a>
                     <h6 class="border-bottom text-primary my-3 pb-3"><?php echo $row['designation']?></h6>
                     <h6 class="border-bottom text-primary my-3 pb-3">Department of <?php echo strtoupper($row['dept'])?> </h6>
                     <div class="d-flex">
                        <h6>Phone:</h6>
                        <label class="ml-3"><?php echo $row['phone']?></label>
                     </div>
                     <div class=" d-flex">
                        <h6>Email:</h6>
                        <label class="ml-3"><?php echo $row['email']?></label>
                     </div>
                     <div class=" d-flex">
                        <h6>Reserarch Interest:</h6>
                        <label class="ml-3"><?php echo $row['research_interest']?></label>
                     </div>
                  </div>
               </div>
               <div class="col-md-12 mt-5">
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
                                <!-- research named as Professional Training -->
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
                                    <h4 class="title">Professional Training</h4>
                                    <!-- research named as Professional Training -->
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
               </div>
            </div>
         </div>
      </div>
      <!--=================================Team -->
      <section class="space-pb mt-5">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-8 col-md-10 text-center">
                  <!-- Section Title START -->
                  <div class="section-title">
                     <h2>Faculty Members</h2>
                  </div>
                  <!-- Section Title END -->
               </div>
            </div>
            <div class="row">
               <?php
                  $sql="SELECT * FROM `people` WHERE md5(id) != '$id' limit 4";
                  $res=mysqli_query($con,$sql); 
                  if(mysqli_num_rows($res)>0){
                    $i=1;        
                    while($row=mysqli_fetch_assoc($res)){
                  ?>
               <div class="col-xl-3 col-lg-6 col-sm-6 mb-4">
                  <!-- team-01 START -->
                  <div class="team">
                     <div class="team-img">
                        <img class="img-fluid" src="images/teachers/<?php echo $row['image']?>" alt="">
                     </div>
                     <div class="team-info">
                        <a href="faculty-details?id=<?php echo md5($row['id'])?>" class="team-name"><?php echo $row['name']?></a>
                        <p class="team-leader"><?php echo $row['designation']?></p>
                        <ul class="list-unstyled">
                           <li><a href="<?php echo $row['facebook']?>"><i class="fab fa-facebook-f"></i></a></li>
                           <li><a href="<?php echo $row['linked_in']?>"><i class="fab fa-linkedin-in"></i></a></li>
                           <li><a href="mailto:<?php echo $row['email']?>"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                     </div>
                  </div>
                  <!-- team-01 END -->
               </div>
               <?php 
                  $i++;
                  } } else { ?>
               <div class="col-xl-3 col-lg-6 col-sm-6 mb-4">
                  <!-- team-01 START -->
                  <div class="team">
                     <div class="team-img">
                        <img class="img-fluid" src="images/teachers/rabbani.jpg" alt="">
                     </div>
                     <div class="team-info">
                        <a href="faculty-details" class="team-name">Md. Liton Rabbani</a>
                        <p class="team-leader">Principal(In-charge)</p>
                        <ul class="list-unstyled">
                           <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                           <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                           <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                           <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                     </div>
                  </div>
                  <!-- team-01 END -->
               </div>
               <?php } ?>
            </div>
         </div>
      </section>
   </div>
</section>
<!--=================================Team-single -->
<?php include("footer.php")?>