<?php 
define('SECURE_ACCESS', true);

if(!isset($_GET['news_id'])){
  header("Location: /");
}
include("header.php");
$news_id=get_safe_value($_GET['news_id']);
?>
    <!--=================================
    Case Study Detail -->
    <section class="space-ptb">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
              <?php
               $news_res=mysqli_query($con,"select * from news where status=1 AND md5(id)='$news_id'");
               if(mysqli_num_rows($news_res)>0){
               while($news_res_row=mysqli_fetch_assoc($news_res)){
               ?>
            <div class="events">
              <div class="events-img">
                <img class="img-fluid border-0" src="images/news/<?php echo $news_res_row['image']?>" alt="">
              </div>
              <div class="events-content mt-4">
                <a href="#" class="text-dark h2"><?php echo $news_res_row['title']?></a>
                 <div class="events-meta my-2 mt-3">
                  <ul class="list-unstyled mb-0 d-flex">
                    <li class="mr-3"><a href="#"><i class="fas fa-calendar-alt pr-1"></i><?php echo date("d M Y",($news_res_row['added_on']))?></a></li>
                  </ul>
                </div>
                <p> <?php echo $news_res_row['details']?></p>
              </div>
            </div>

            <?php } }else{
              redirect("/");  
            }?>
          </div>
        </div>
      </div>
    </section>
    <!--=================================Case Study Detail -->
<?php include("footer.php")?>