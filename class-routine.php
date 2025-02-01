<?php
define('SECURE_ACCESS', true);
include("header.php");
?>
    <!--=================================inner-header -->
    <section class="inner-banner bg-overlay-black-70 bg-holder" style="background-image: url('images/bg/09.jpg');">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-white">Class Routine</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================inner-header -->

    <!--=================================HISTORY -->
    <section class="space-ptb" >
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-12 col-lg-9">
            <div class=" mb-12">
              <div class="align-items-center">
                <h2 class="title align-items-center">HISTORY OF <span class="text-primary">BEC</span></h2>
              </div>
              <p class="lead">
                <?php
                    $genereral_infores=mysqli_query($con,"select general_info.history from general_info where id=1");
                    if(mysqli_num_rows($genereral_infores)>0){
                    while($genereral_infores_row=mysqli_fetch_assoc($genereral_infores)){
                    ?>
                      <?php echo $genereral_infores_row['history']?>  
                <?php } }?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================HISTORY -->

<?php include("footer.php")?>