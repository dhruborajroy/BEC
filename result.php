<?php
define('SECURE_ACCESS', true);
include("header.php");
?>
<style>
.container1 {
  position: relative;
  width: 100%;
  max-width: 100%;
  height: 0;
  padding-top: 56.25%; /* 16:9 Aspect Ratio */
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Responsive iframe */
.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: none;
}

/* Tablet Optimization */
@media (max-width: 768px) {
  .container1 {
    padding-top: 85%; /* Increased height for better readability */
  }
}

/* Mobile Optimization */
@media (max-width: 480px) {
  .container1 {
    padding-top: 120%; /* Further increased height for small screens */
  }
}
</style>

<div class="container1">
  <iframe class="responsive-iframe" src="https://www.cmc.du.ac.bd/result.php"></iframe>
</div>

<?php include("footer.php"); ?>
