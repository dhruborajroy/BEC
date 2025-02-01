<?php 
define('SECURE_ACCESS', true);
include("header.php");
?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Semester Clearance</h2>
                                
                                <iframe id="pdfPreview" src="../pdfreports/hall_clearance?student_id=<?php 
                                    echo md5($user_id);
                                ?>" width="100%" height="750px" ></iframe>
                            </div>
                        </div>
<?php 
include("footer.php");
?>