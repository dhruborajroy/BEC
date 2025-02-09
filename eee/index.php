<?php
   define('SECURE_ACCESS', true);
   session_start();
   include("header.php");
   $dept_id="eee";
   ?>
   
<!--=================================Banner -->
<section class="banner position-ralative">
   <div id="main-slider" class="swiper-container h-800 h-lg-700 h-md-600 h-sm-400">
      <div class="swiper-wrapper">
         <?php
            $slider_sql="select * from `dept_sliders` where dept='$dept_id' order by added_on desc";
            $slider_res=mysqli_query($con,$slider_sql);
            if(mysqli_num_rows($slider_res)>0){
            while($slider_row=mysqli_fetch_assoc($slider_res)){
            ?>
         <!-- Swiper Slider 1-->
         <div class="swiper-slide align-items-center d-flex bg-overlay-black-10" style="background-image: url(../images/dept/sliders/<?php echo $slider_row['image']?>); background-size: cover; background-position: center center;">
            <div class="swipeinner container">
               <div class="row justify-content-center text-center">
                  <div class="col-lg-10 col-md-12">
                     <div class="slider-1">
                        <div class="animated" data-swiper-animation="fadeInUp" data-duration="1s" data-delay="0.25s">
                           <h1 class="animated text-white mb-4" data-swiper-animation="fadeInUp" data-duration="1.5s" data-delay="0.25s"><?php echo $slider_row['title']?></h1>
                           <div class="animated text-white px-lg-5" data-swiper-animation="fadeInUp" data-duration="2.5s" data-delay="0.25s"><?php echo $slider_row['sub_title']?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php 
            } } else { ?>
               <!-- Swiper Slider 1-->
               <div class="swiper-slide align-items-center d-flex bg-overlay-black-40" style="background-image: url(images/sliders/1.png); background-size: cover; background-position: center center;">
                  <div class="swipeinner container">
                     <div class="row justify-content-center text-center">
                        <div class="col-lg-10 col-md-12">
                           <div class="slider-1">
                              <div class="animated" data-swiper-animation="fadeInUp" data-duration="1s" data-delay="0.25s">
                                 <h1 class="animated text-white mb-4" data-swiper-animation="fadeInUp" data-duration="1.5s" data-delay="0.25s">Default Slider</h1>
                                 <div class="animated text-white px-lg-5" data-swiper-animation="fadeInUp" data-duration="2.5s" data-delay="0.25s">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
         <?php } ?>
      </div>
   </div>
   <!-- Pagination -->
   <div class="swiper-button-prev text-white"><i class="fa fa-arrow-left"></i></div>
   <div class="swiper-button-next text-white"><i class="fa fa-arrow-right"></i></div>
</section>
<!--=================================Banner -->

<!--=================================Fearture icon -->
<section class="py-3 bg-primary">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="d-flex align-items-center">
               <div class="flex-grow-1 marquee-spotlight p-1">
                  <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="10">
                     <?php
                        $swl= "select * from notice where status=1 and dept='$dept_id'  order by added_on desc";
                        $notice_res=mysqli_query($con,$swl);
                        if(mysqli_num_rows($notice_res)>0){
                        while($notice_res_row=mysqli_fetch_assoc($notice_res)){
                        ?>
                        <a  style="color:white;text-decoration:none" href="../notice_files/<?php echo $notice_res_row['link']?>" target="_blank"  style="padding-left:100px">
                           <span  style="color:white" class="spotlight-date" style="color:red;"><i class="far fa-calendar-check mr-1"></i> <?php echo date("d-M-Y",$notice_res_row['added_on'])?></span>
                           <span class="spotlight-notice" style="color:white"> <?php echo $notice_res_row['title']?> </span>
                        </a>
                     <?php } }?>
                  </marquee>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--=================================Fearture icon -->
<!--=================================Event -->
<section class="space-ptb bg-dark">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 mt-12 mt-lg-0">
            <div class="row mb-4 mb-md-0">
               <div class="col-md-8">
                  <div class="section-title">
                     <h2>Latest News</h2>
                  </div>
               </div>
               <div class="col-md-4 text-md-right">
                  <a class="btn btn-white" href="news">View All</a>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <?php
                     $news_res=mysqli_query($con,"select * from news  where  dept='$dept_id' and status=1");
                     if(mysqli_num_rows($news_res)>0){
                     while($news_res_row=mysqli_fetch_assoc($news_res)){
                     ?>
                  <div class="events shadow p-4 bg-white border-radius">
                     <div class="row">
                        <div class="col-lg-3">
                           <div class="events-img mb-4 mb-lg-0">
                              <img class="img-fluid border-0" src="../images/news/<?php echo $news_res_row['image']?>" alt="">
                           </div>
                        </div>
                        <div class="col-lg-6 align-self-center">
                           <div class="events-content">
                              <a href="../news-details.php?news_id=<?php echo md5($news_res_row['id'])?>" class="text-dark h5"><?php echo $news_res_row['title']?></a>
                              <div class="events-meta my-2">
                                 <ul class="list-unstyled mb-0 d-flex">
                                    <li class="mr-3"><i class="fas fa-calendar-alt pr-1"></i> <?php echo date("d M Y",strtotime($news_res_row['added_on']))?></li>
                                 </ul>
                              </div>
                              <p class="text-dark mb-lg-0">
                                 <?php 
                                    $maxLength = 600;
                                    if (strlen($news_res_row['details']) > $maxLength) {
                                        $truncatedString = substr_replace($news_res_row['details'], '...', $maxLength);
                                    } else {
                                        $truncatedString = $news_res_row['details'];
                                    }
                                    echo $truncatedString;
                                    ?>
                              </p>
                           </div>
                        </div>
                        <div class="col-lg-3 align-self-center text-lg-right text-left">
                           <a class="btn btn-dark btn-round" href="../news-details.php?news_id=<?php echo md5($news_res_row['id'])?>">View News</a>
                        </div>
                     </div>
                  </div>
                  <?php } }?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--=================================Event -->
<!--=================================Team -->
<section class="space-ptb">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-8 col-md-10 text-center">
            <!-- Section Title START -->
            <div class="section-title">
               <h2 class="title">Faculty Members</h2>
            </div>
            <!-- Section Title END -->
         </div>
      </div>
      <div class="row">
         <?php
            $faculty_sql="select * from people where dept='$dept_id' and type='faculty'";
            $faculty_res=mysqli_query($con,$faculty_sql); 
            if(mysqli_num_rows($faculty_res)>0){
              $i=1;        
              while($faculty_row=mysqli_fetch_assoc($faculty_res)){
            ?>
          <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
              <!-- team-01 START -->
              <div class="team-02">
                <div class="team-img">
                    <img class="img-fluid border-radius" src="../images/teachers/<?php echo $faculty_row['image']?>" alt="">
                </div>
                <div class="team-info text-center">
                    <a target="_blank" href="../faculty-details?id=<?php echo md5($faculty_row['id'])?>" class="team-title"><?php echo $faculty_row['name']?></a>
                    <p class="team-designation text-white"><?php echo $faculty_row['designation']?></p>
                    <div class="team-social">
                      <ul>
                          <li><a href="<?php echo $faculty_row['facebook']?>"><i class="fab fa-facebook-f"></i></a></li>
                          <li><a href="<?php echo $faculty_row['linked_in']?>"><i class="fab fa-linkedin-in"></i></a></li>
                      </ul>
                    </div>
                </div>
              </div>
              <!-- team-01 END -->
          </div>
         <?php 
            $i++;
            } } else { ?>
         No Members Found
         <?php } ?>
      </div>
   </div>
</section>
<!--=================================Team -->
<?php include("footer.php")?>