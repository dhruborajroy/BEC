
                            <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>© Copyrights <a href="http://bec.edu.bd" target="blank">Barishal Engineering College </a> 2018-<?php echo date('Y')?>.| P-1102 | V-1.1.2 |
        All
        rights reserved. Developed by <a href="index" > Dhrubo Raj Roy </a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
            </div>

</div>

<!-- Jquery JS-->
<script src="../students/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="../students/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="../students/vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="../students/vendor/slick/slick.min.js">
</script>
<script src="../students/vendor/wow/wow.min.js"></script>
<script src="../students/vendor/animsition/animsition.min.js"></script>
<script src="../students/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="../students/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="../students/vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="../students/vendor/circle-progress/circle-progress.min.js"></script>
<script src="../students/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../students/vendor/chartjs/Chart.bundle.min.js"></script>
<script src="../students/vendor/select2/select2.min.js">
<script src="../students/js/toastr.min.js">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
   toastr.options = {
       "closeButton": true,
       "debug": false,
       "newestOnTop": true,
       "progressBar": true,
       "positionClass": "toast-top-right",
       "preventDuplicates": true,
       "showDuration": "300",
       "hideDuration": "1000",
       "timeOut": "000", // 5 seconds
       "extendedTimeOut": "1000",
       "showEasing": "swing",
       "hideEasing": "linear",
       "showMethod": "fadeIn",
       "hideMethod": "fadeOut",
        "preventDuplicates": true, // Prevent duplicates
        "positionClass": "toast-top-right", // Position of the toastr
        "closeButton": true, // Show close button
        "timeOut": 1000, // Duration for which the toastr is displayed
        "extendedTimeOut": 1000 // Duration for which the toastr is displayed when hovering over it
   }
</script>

<!-- Main JS-->
<script src="../students/js/main.js"></script>
<script src="../students/js/custom.php"></script>

</body>

</html>
<!-- end document-->

<!-- jQuery (required for Summernote) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap (required for Summernote) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Summernote CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>

$(document).ready(function() {
    $('.textarea-input').summernote({
        height: 300,  // Set the height of the editor
        placeholder: '',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
        ]
    });
});
</script>

<?php
if (isset($_SESSION['TOASTR_MSG'])) {
    $type = $_SESSION['TOASTR_MSG']['type']; // success, error, info, warning
    $body = $_SESSION['TOASTR_MSG']['body'];
    $title = $_SESSION['TOASTR_MSG']['title'];

    echo "<script>
        $(document).ready(function() {
            toastr.$type('$body', '$title');
        });
    </script>";

    // Clear Toastr message after displaying
    unset($_SESSION['TOASTR_MSG']);
}
?>
