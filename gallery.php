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
              <h1 class="text-white">Gallery</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================inner-header -->

    <!--=================================Gallery -->
    <section class="space-ptb">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10 text-center">
            <!-- Section Title START -->
            <div class="section-title">
              <h2>Our Gallery</h2>
            </div>
            <!-- Section Title END -->
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="filters-group mb-lg-4 text-center">
              <button class="btn-filter  active" data-group="all">All</button>
              <button class="btn-filter" data-group="branding">Branding</button>
              <button class="btn-filter" data-group="web">Web</button>
              <button class="btn-filter" data-group="photography">Photography</button>
              <button class="btn-filter" data-group="advertising">Advertising</button>
              <button class="btn-filter" data-group="design">Design</button>
            </div>
            <div class="my-shuffle-container columns-3 popup-gallery full-screen">
              <!-- item START -->
              <div class="grid-item" data-groups='["branding"]'>
                <div class="portfolio-item">
                  <div class="position-relative">
                    <img class="img-fluid" src="images/gallery/02.jpg" alt="">
                    <div class="portfolio-overlay">
                      <a class="portfolio-img" href="images/gallery/02.jpg"><i class="fas fa-arrows-alt"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- item End -->

              <!-- item START -->
              <div class="grid-item" data-groups='["web", "photography", "branding"]'>
                <div class="portfolio-item">
                  <div class="position-relative">
                    <img class="img-fluid" src="images/gallery/03.jpg" alt="">
                    <div class="portfolio-overlay">
                      <a class="portfolio-img" href="images/gallery/03.jpg"><i class="fas fa-arrows-alt"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- item End -->

              <!-- item START -->
              <div class="grid-item" data-groups='["photography"]'>
                <div class="portfolio-item">
                  <div class="position-relative">
                    <img class="img-fluid" src="images/gallery/04.jpg" alt="">
                    <div class="portfolio-overlay">
                      <a class="portfolio-img" href="images/gallery/04.jpg"><i class="fas fa-arrows-alt"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- item End -->

              <!-- item START -->
              <div class="grid-item" data-groups='["advertising"]'>
                <div class="portfolio-item">
                  <div class="position-relative">
                    <img class="img-fluid" src="images/gallery/05.jpg" alt="">
                    <div class="portfolio-overlay">
                      <a class="portfolio-img" href="images/gallery/05.jpg"><i class="fas fa-arrows-alt"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- item End -->

              <!-- item START -->
              <div class="grid-item" data-groups='["design", "advertising"]'>
                <div class="portfolio-item">
                  <div class="position-relative">
                    <img class="img-fluid" src="images/gallery/06.jpg" alt="">
                    <div class="portfolio-overlay">
                      <a class="portfolio-img" href="images/gallery/06.jpg"><i class="fas fa-arrows-alt"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- item End -->

              <!-- item START -->
              <div class="grid-item" data-groups='["branding", "web"]'>
                <div class="portfolio-item">
                  <div class="position-relative">
                    <img class="img-fluid" src="images/gallery/01.jpg" alt="">
                    <div class="portfolio-overlay">
                      <a class="portfolio-img" href="images/gallery/01.jpg"><i class="fas fa-arrows-alt"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- item End -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================Gallery -->

<?php include("footer.php")?>