<?php
define('SECURE_ACCESS', true);
include("header.php");
?>
    <!--=================================inner-header -->
    <section class="inner-banner bg-overlay-black-70 bg-holder" style="background-image: url('images/bg/02.jpg');">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-white">Vission & Mission </h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================inner-header -->

    <div class="body-section mt-2 mb-2">
    <?php
        $genereral_infores=mysqli_query($con,"select general_info.bec_at_a_glance from general_info where id=1");
        if(mysqli_num_rows($genereral_infores)>0){
        while($genereral_infores_row=mysqli_fetch_assoc($genereral_infores)){
        ?>
          <?php echo $genereral_infores_row['bec_at_a_glance']?>  
    <?php } }?>

  </div>

<?php include("footer.php")?>