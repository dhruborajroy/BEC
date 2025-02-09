<?php 
define('SECURE_ACCESS', true);
include("header.php");
?>
    <!--=================================inner-header -->
    <section class="inner-banner bg-overlay-black-70 bg-holder" style="background-image: url('../images/bg/02.jpg');">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-white">Department Vission & Mission </h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================inner-header -->

    
    <!--=================================vision_mission -->
    <section class="space-ptb" >
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-12 col-lg-9">
            <div class=" mb-12">
              <p class="lead">
                <?php
                    $genereral_infores=mysqli_query($con,"select dept_general_info.dept_about from dept_general_info where id=1 and  dept_id='$dept_id'");
                    if(mysqli_num_rows($genereral_infores)>0){
                    while($genereral_infores_row=mysqli_fetch_assoc($genereral_infores)){
                    ?>
                      <?php echo $genereral_infores_row['dept_about']?>  
                <?php } }?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php include("footer.php")?>