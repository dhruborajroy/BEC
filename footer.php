<?php
if (!defined('SECURE_ACCESS')) {
  die("Direct access not allowed!");
}?>
    <!--=================================Footer-->
    <footer class="space-pt bg-overlay-black-90 bg-holder footer mt-n5" style="background-image: url(images/bg/01.jpg);">
      <div class="container pt-5">
        <div class="row pb-5 pb-lg-6 mb-lg-3">
          <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0 pr-lg-5">
            <a href="index-2.html"><img class="img-fluid mb-3 footer-logo" src="images/logo-light.svg" alt=""></a>
            <p class="text-white">The best way is to develop and follow a plan. Start with your goals in mind and then work backward to develop the plan.</p>
            <h5 class="text-white mb-2 mb-sm-4">Follow Us</h5>
            <div class="social-icon social-icon-style-02">
              <ul>
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-12 col-lg-4 mb-4 mb-sm-0">
            <h5 class="text-white mb-2 mb-sm-4">Useful Link</h5>
            <div class="footer-link">
              <ul class="list-unstyled mb-0">
                <?php
                $useful_links_res=mysqli_query($con,"select * from useful_links where status=1");
                if(mysqli_num_rows($useful_links_res)>0){
                while($useful_links_row=mysqli_fetch_assoc($useful_links_res)){
                ?>
                  <li><a target="_blank" class="text-white" href="<?php echo $useful_links_row['link']?>"><?php echo $useful_links_row['link_text']?></a></li>
                <?php } }?>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <h5 class="text-white mb-2 mb-sm-4">Contact Us</h5>
            <!-- <p class="text-white">Helped thousands of clients to find the right property for their needs.</p> -->
            <div class="footer-contact-info">
              <div class="contact-address mt-4">
                <div class="contact-item">
                  <i class="fas fa-map-marker-alt"></i>
                  <p class="ml-3 mb-0 text-white"><?php echo ADDRESS?></p>
                </div>
                <div class="contact-item">
                  <i class="fas fa-microphone-alt"></i>
                  <p class="mb-0 font-weight-bold ml-3"><a class="text-white" href="tel:<?php echo TEL?>"><?php echo TEL?></a></p>
                </div>
                <div class="contact-item mb-0">
                  <i class="fas fa-headset"></i>
                  <a class="text-white ml-3 text-white" href="mailto:<?php echo EMAIL?>"><?php echo EMAIL?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom bg-dark py-4">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12 text-center">
              <p class="mb-0 text-white"> All Rights Reserved  ©Copyright. 2018-<?php echo date("Y")?>. Made with ❤️ by <a href="index">The Web Divers</a> </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!--=================================
    Footer-->

    <!--=================================
    Back To Top-->
    <div id="back-to-top" class="back-to-top">up</div>
    <!--=================================
    Back To Top-->

    <!--=================================
    Javascript -->

    <!-- JS Global Compulsory (Do not remove)-->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Page JS Implementing Plugins (Remove the plugin script here if site does not use that feature)-->
    <script src="js/jquery.appear.js"></script>
    <script src="js/counter/jquery.countTo.js"></script>
    <script src="js/select2/select2.full.js"></script>
    <script src="js/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/swiper/swiper.min.js"></script>
    <script src="js/swiperanimation/SwiperAnimation.min.js"></script>
    <script src="js/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="js/jarallax/jarallax.js"></script>
    <script src="js/shuffle/shuffle.min.js"></script>
    <script src="http://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="js/custom.js"></script>

  </body>
</html>
