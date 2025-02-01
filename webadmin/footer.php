
<!-- Footer Area Start Here -->
<footer class="footer-wrap-layout1">
    <div class="copyright">© Copyrights <a href="http://bec.edu.bd" target="blank">Barishal Engineering College </a> 2018-<?php echo date('Y')?>.| P-1102 | V-1.1.2 |
        All
        rights reserved. Developed by <a href="index" > Dhrubo Raj Roy </a></div>
</footer>
<!-- Footer Area End Here -->
</div>
</div>
<!-- Page Area End Here -->
</div>
<!-- jquery-->
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Plugins js -->
<script src="js/plugins.js"></script>
<!-- Popper js -->
<script src="js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="js/bootstrap.min.js"></script>
<!-- Counterup Js -->
<script src="js/jquery.counterup.min.js"></script>
<!-- Moment Js -->
<script src="js/moment.min.js"></script>
<!-- Waypoints Js -->
<script src="js/jquery.waypoints.min.js"></script>
<!-- Scroll Up Js -->
<script src="js/jquery.scrollUp.min.js"></script>
<!-- Full Calender Js -->
<script src="js/fullcalendar.min.js"></script>
<!-- Select 2 Js -->
<script src="js/select2.min.js"></script>
<!-- Date Picker Js -->
<script src="js/datepicker.min.js"></script>
<!-- Chart Js -->
<script src="js/Chart.min.js"></script>
<!-- Scroll Up Js -->
<script src="js/jquery.scrollUp.min.js"></script>
<!-- Data Table Js -->
<script src="js/jquery.dataTables.min.js"></script>
<!-- validate JS -->
<!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> -->
<!-- Custom Js -->
<script src="js/toastr.min.js"></script>
<!-- sweet alert JS -->
<script src="./js/sweetalert.min.js"></script>
<script src="css/summernote/summernote.min.js"></script>
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
<!-- Custom Js -->
<script src="js/main.js"></script>
<script src="js/custom.php"></script>
<!-- <script src="js/validation.php"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
      $('.full_input').summernote({
        tabsize: 2,
        height: 300,
        callbacks: {
            onPaste: function(e) {
                e.preventDefault(); // Prevent pasting
                alert("Pasting is disabled!"); // Optional: Show an alert
            }
        },
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['code','help']]
        ]
      });
    </script>
    
    <script>
        function replaceApostrophe() {
            var details = document.getElementById('details').value;
            details = details.replace(/'/g, "\\'"); 
            document.getElementById('details').value = details; 
        }
    </script>
</body>

</html>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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