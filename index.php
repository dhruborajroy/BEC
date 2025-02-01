<?php 
define('SECURE_ACCESS', true);
include("header.php");
include("backup/index.php");
?>
<!--=================================Banner -->
<section class="banner position-ralative">
   <div id="main-slider" class="swiper-container h-800 h-lg-700 h-md-600 h-sm-400" style="max-height:500px">
      <div class="swiper-wrapper">
         <?php
            $active="";
              $slider_sql="select * from `sliders` order by added_on desc";
              $slider_res=mysqli_query($con,$slider_sql);
              if(mysqli_num_rows($slider_res)>0){
              while($slider_row=mysqli_fetch_assoc($slider_res)){
            ?>
         <!-- Swiper Slider 1-->
         <div class="swiper-slide align-items-center d-flex bg-overlay-black-10" style="background-image: url(images/sliders/<?php echo $slider_row['image']?>); background-size: cover; background-position: center center;">
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
         <div class="swiper-slide align-items-center d-flex bg-overlay-black-40" style="background-image: url(images/sliders/1.png  ); background-size: cover; background-position: center center;">
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
<!--=================================Notice -->
<div class="spotlight-content">
   <div class="d-flex">
      <div class="flex-shrink-0 spotlight-title p-2">
         <span>Latest Info</span>
      </div>
      <div class="flex-grow-1 marquee-spotlight p-1">
         <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="10">
            <?php
               $notice_res=mysqli_query($con,"select * from notice where status=1 order by added_on desc");
               if(mysqli_num_rows($notice_res)>0){
               while($notice_res_row=mysqli_fetch_assoc($notice_res)){
               ?>
            <a href="notice_files/<?php echo $notice_res_row['link']?>" target="_blank"  style="padding-left:100px">
            <span class="spotlight-date" style="color:red;"><i class="far fa-calendar-check mr-1"></i> <?php echo date("d-M-Y",$notice_res_row['added_on'])?></span>
            <span class="spotlight-notice"> <?php echo $notice_res_row['title']?> </span>
            </a>
            <?php } }?>
         </marquee>
      </div>
   </div>
</div>
<!--=================================Why choose us -->
<section class="bg-dark">
   <div class="container-fluid">
      <div class="row no-guuters">
         <div class="col-lg-6 px-4 px-md-5 px-lg-6 py-6 px-lg-6" style="background-image: url(images/about/pattern.png);">
            <div class="section-title">
               <h2 class="title">About Us</h2>
               <?php
                  $about_us_sql="select about_us.details from `about_us`";
                  $about_us_res=mysqli_query($con,$about_us_sql);
                  if(mysqli_num_rows($about_us_res)>0){
                  while($about_us_row=mysqli_fetch_assoc($about_us_res)){
                  ?>
               <p class="mb-0" style=" text-align: justify;text-justify: inter-word;">
                  <?php echo $about_us_row['details']?>
               </p>
               <?php 
                  } } else { ?>
               <?php } ?>
            </div>
         </div>
         <div class="col-lg-6 bg-holder d-none d-lg-block" style="background-image: url(images/01.jpg);">
         </div>
      </div>
   </div>
</section>
<!--=================================Why choose us -->
<!--=================================Counter -->
<section class="space-pb bg-light">
   <div class="container">
      <div class="row " style="padding-top: 70px;">
         <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
            <div class="counter">
               <div class="counter-icon">
                  <i class="flaticon-team-1"></i>
               </div>
               <div class="counter-content">
                  <span class="timer" data-to="<?php echo $gettotalstudent=gettotalstudent()?>" data-speed="100"><?php echo $gettotalstudent?></span>
                  <label>Students</label>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
            <div class="counter">
               <div class="counter-icon">
                  <i class="flaticon-diploma-1"></i>
               </div>
               <div class="counter-content align-self-center">
                  <span class="timer" data-to="<?php echo $gettotalcount=gettotalcount("faculty")?>" data-speed="10"><?php echo $gettotalcount?></span>
                  <label>Teachers</label>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3 mb-4 mb-md-0">
            <div class="counter">
               <div class="counter-icon">
                  <i class="flaticon-support"></i>
               </div>
               <div class="counter-content">
                  <span class="timer" data-to="200" data-speed="10000">200</span>
                  <label>Graduates</label>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-lg-3">
            <div class="counter">
               <div class="counter-icon">
                  <i class="flaticon-trophy-1"></i>
               </div>
               <div class="counter-content">
                  <span class="timer" data-to="4" data-speed="10">4</span>
                  <label>Institutes</label>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--=================================Counter -->
<!--=================================Course item -->
<section class="space-ptb">
   <div class="container">
      <div class="row">
         <div class="col-sm-8">
            <div class="section-title">
               <h2 class="title">Our Departments</h2>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="my-shuffle-container columns-3 popup-gallery full-screen">

                  <?php
                  $depts_lab_list_sql="SELECT * FROM `depts_lab_list` where public_view='1'";
                  $depts_lab_list_res=mysqli_query($con,$depts_lab_list_sql);
                  if(mysqli_num_rows($depts_lab_list_res)>0){
                  while($depts_lab_list_row=mysqli_fetch_assoc($depts_lab_list_res)){
                  ?>

                  <!-- item START -->
                  <div class="grid-item" >
                     <div class="course-item">
                        <div class="coures-img">
                           <img class="img-fluid" src="images/dept/<?php echo $depts_lab_list_row['image']?>" alt="">
                        </div>
                        <div class="course-conten">
                           <h5 class="mb-3">
                              <a target="_blank" href="dept/<?php echo strtolower($depts_lab_list_row['short_form'])?>"><?php echo $depts_lab_list_row['name']?></a>
                           </h5>
                        </div>
                     </div>
                  </div>
                  <!-- item End -->
                  
                  <?php 
                     } } else { ?>
                  <?php } ?>
            </div>
         </div>
      </div>
   </div>
</section>
<!--=================================Course item -->
<!--=================================Why choose us -->
<!-- <section class="bg-dark">
   <div class="container-fluid">
      <div class="row no-guuters">
         <div class="col-lg-6 bg-holder d-none d-lg-block" style="background-image: url(images/bg/01.jpg);">
         </div>
         <div class="col-lg-6 px-4 px-md-5 px-lg-6 py-6 px-lg-6" style="background-image: url(images/about/pattern.png);">
            <div class="section-title">
               <h2 class="title">About Us</h2>
               <p class="mb-0"  style=" text-align: justify;text-justify: inter-word;">
               <?php
                  $about_us_sql="select about_us.details from `about_us`";
                  $about_us_res=mysqli_query($con,$about_us_sql);
                  if(mysqli_num_rows($about_us_res)>0){
                  while($about_us_row=mysqli_fetch_assoc($about_us_res)){
                  ?>
                  <?php echo $about_us_row['details']?>
                  <?php 
                     } } else { ?>
                  <?php } ?>
               </p>
            </div>
         </div>
      </div>
   </div>
</section> -->
<!--=================================Why choose us -->
<!--=================================Event -->
<section class="space-ptb">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="row">
               <div class="col-lg-7">
                  <div class="row">
                     <div class="col-md-7">
                        <div class="section-title">
                           <h2 class="title">Latest Events</h2>
                        </div>
                     </div>
                     <div class="col-md-5 text-md-right mb-4 mb-md-0">
                        <a class="btn btn-primary btn-round" href="news">View All</a>
                     </div>
                  </div>
                  <div class="events">
                     <div class="row">
                        <div class="col-12">
                           <?php
                              $news_res=mysqli_query($con,"select * from news where status=1 limit 3");
                              if(mysqli_num_rows($news_res)>0){
                              while($news_res_row=mysqli_fetch_assoc($news_res)){
                              ?>
                           <div class="events shadow p-4 bg-white border-radius mt-1">
                              <div class="row">
                                 <div class="col-lg-3">
                                    <div class="events-img mb-4 mb-lg-0">
                                       <img class="img-fluid border-0" src="images/news/<?php echo $news_res_row['image']?>" >
                                    </div>
                                 </div>
                                 <div class="col-lg-6 align-self-center">
                                    <div class="events-content">
                                       <a href="news-details.php?news_id=<?php echo md5($news_res_row['id'])?>" class="text-dark h5"><?php echo $news_res_row['title']?></a>
                                       <div class="events-meta my-2">
                                          <ul class="list-unstyled mb-0 d-flex">
                                             <li class="mr-3"><i class="fas fa-calendar-alt pr-1"></i> <?php echo date("d M Y",strtotime($news_res_row['added_on']))?></li>
                                          </ul>
                                       </div>
                                       <p class="text-dark mb-lg-0" style=" text-align: justify;text-justify: inter-word;">
                                          <?php 
                                             $maxLength = 700;
                                             
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
                                    <a class="btn btn-dark btn-round" href="news-details.php?news_id=<?php echo md5($news_res_row['id'])?>">View News</a>
                                 </div>
                              </div>
                           </div>
                           <?php } }?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-5 mt-xl-0 mt-4 shadow" >
                  <div class="row">
                     <div class="col-md-7">
                        <div class="section-title">
                           <h2 class="title">Notices</h2>
                        </div>
                     </div>
                     <div class="col-md-5 text-md-right mb-4 mb-md-0">
                        <a class="btn btn-primary btn-round" href="notice">View All Notice</a>
                     </div>
                  </div>
                  <marquee direction="up" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="5">
                     <?php 
                        $notice_res=mysqli_query($con,"select * from notice where status=1 order by added_on desc limit 5");
                        if(mysqli_num_rows($notice_res)>0){
                        while($notice_res_row=mysqli_fetch_assoc($notice_res)){?>
                     <div class="blog-post d-flex align-items-center border border-radius mt-1">
                        <div class="blog-date">
                           <h3><?php echo date("d",$notice_res_row['added_on'])?></h3>
                           <span><?php echo date("F",$notice_res_row['added_on'])?></span>
                        </div>
                        <div class="blog-contant">
                           <a class="btn p-0" href="notice_files/<?php echo $notice_res_row['link']?>">
                              <h5 class="mt-0 mb-3"><?php echo $notice_res_row['title']?></h5>
                           </a>
                        </div>
                     </div>
                     <?php } }?>
                  </marquee>
               </div>
               <!-- <div class="col-lg-4 equal-height-cols" >
                  <div class="col-md-12 ">
                     <div class="card">
                        <div class="card-body">
                           <div class="default-tab">
                              <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                 <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <p>
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  </div> -->
            </div>
         </div>
      </div>
   </div>
</section>
<!--=================================Event -->
<?php include("footer.php")?>