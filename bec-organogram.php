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
              <h1 class="text-white">BEC Organogram </h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================inner-header -->
                <?php
                    $genereral_infores=mysqli_query($con,"select general_info.organogram from general_info where id=1");
                    if(mysqli_num_rows($genereral_infores)>0){
                    while($genereral_infores_row=mysqli_fetch_assoc($genereral_infores)){
                    ?>
                      <?php echo $genereral_infores_row['organogram']?>  
                <?php } }?>

<?php include("footer.php")?>