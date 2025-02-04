<?php 
define('SECURE_ACCESS', true);
include("header.php");
if(isset($_GET['type'])){
  $type=get_safe_value($_GET['type']);
}
?>
    <!--=================================
    inner-header -->
    <section class="inner-banner bg-overlay-black-70 bg-holder" style="background-image: url('../images/bg/02.jpg');">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-white">People</h1>
            </div>  
          </div>
        </div>
      </div>
    </section>
    <!--=================================inner-header -->

    <!--=================================Team -->
    <section class="space-ptb">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10 text-center">
          </div>
        </div>
        <div class="row mb-xl-4">
            <?php
            $additional_sql="";
            if($type!=""){
              $additional_sql="and type='$type'";
            }
            $sql="SELECT * FROM people WHERE dept = '$dept_id' $additional_sql ORDER BY CASE WHEN designation = 'Professor' THEN 1 WHEN designation = 'Associate Professor' THEN 2 WHEN designation = 'Assistant Professor' THEN 3 WHEN designation = 'Lecturer' THEN 4 ELSE 5 END";
            $res=mysqli_query($con,$sql); 
            if(mysqli_num_rows($res)>0){
              $i=1;        
              while($row=mysqli_fetch_assoc($res)){
            ?>
            <div class="col-xl-3 col-lg-6 col-sm-6 mb-4">
            <!-- team-01 START -->
            <div class="team">
              <div class="team-img">
                <img class="img-fluid" src="../images/teachers/<?php echo $row['image']?>" alt="">
              </div>
              <div class="team-info">
                <a href="../faculty-details?id=<?php echo md5($row['id'])?>" class="team-name"><?php echo $row['name']?></a>
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
                No People found
            <?php } ?>
            
          </div>
        </div>
      </div>
    </section>
    <!--=================================Team -->

<?php include("footer.php")?>