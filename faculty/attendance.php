<?php 
   define('SECURE_ACCESS', true);
   include("header.php");
   $semester="";
   ?>
<!-- MAIN CONTENT-->
<div class="main-content">
<div class="section__content section__content--p30">
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-header">
               <strong>Students Attandance</strong>
            </div>
            <div class="card-body card-block">
               <form  method="post" enctype="multipart/form-data" class="form-horizontal">
                  <div class="row form-group col-md-12">
                     <div class="col-sm-12 col-md-4 mt-2">
                        <input value="<?php echo date("d-m-Y")?>" type="date" id="dateInput" name="dateInput" class="form-control-lg form-control" select>
                     </div>
                     <div class="col-sm-12 col-md-4 mt-2">
                        <select name="semester" id="semester" class="form-control-lg form-control">
                           <option value='0'>Select Semester</option>
                           
                           <?php
                                $data  = [
                                    '1' => '1st',
                                    '2' => '2nd',
                                    '3' => '3rd',
                                    '4' => '4th',
                                    '5' => '5th',
                                    '6' => '6th',
                                    '7' => '7th',
                                    '8' => '8th',
                                ];

                                foreach ($data as $key => $val) {
                                    if ($key == $semester) {
                                        echo "<option selected='selected' value='$key'>$val</option>";
                                    } else {
                                        echo "<option value='$key'>$val</option>";
                                    }
                                }
                                ?>
                        </select>
                    </div>
                     <div class="col-sm-12 col-md-4 mt-2">
                        <select name="course" id="course" class="form-control-lg form-control">
                           <option value="">Select Course</option>
                        </select>
                     </div>
                  </div>
               </form>
            </div>
            <div class="card-footer">
               <input type="submit" value="Get Students" id="get_students" disabled name="submit" class="btn btn-primary btn-sm">
               <a href="attendance"> 
               <button type="reset" class="btn btn-danger btn-sm">
               <i class="fa fa-ban"></i> Reset
               </button>
               </a>
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <strong class="card-title">Attendance List</strong>
               <div>
                <span id="total_students">Total Students: 0</span> |
                <span id="present_students">Present: 0</span> |
                <span id="absent_students">Absent: 0</span>
            </div>

            </div>
            <div id="students-container">
               <p class="text-center">Select date, semester, course to view students.</p>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include("footer.php");?>
<script>
    $(document).on("click", "#get_students", function () {
    var selectedDate = $('#dateInput').val();
    var semester = $('#semester').val();
    var course = $('#course').val();

    // Fetch students list
    $.ajax({
        url: "ajax/fetch_students",
        method: "POST",
        data: { selectedDate: selectedDate, semester: semester, course: course },
        success: function (response) {
            $("#students-container").html(response);
            updateAttendanceCount();

            // Insert default attendance (status = 0) for all students
            let student_ids = [];
            $(".attendance-toggle").each(function () {
                student_ids.push($(this).data("id"));
            });

            if (student_ids.length > 0) {
                $.post("ajax/insert_attendance", {
                    student_ids: student_ids,
                    status: 0,
                    semester: semester,
                    selectedDate: selectedDate,
                    course: course
                }, function (response) {
                    if (response == "success") {
                        console.log("Default attendance inserted successfully");
                    } else {
                        console.warn("Failed to insert default attendance");
                    }
                });
            }
        }
    });
});

// Function to count present and absent students
function updateAttendanceCount() {
    let total = $(".attendance-toggle").length;
    let present = $(".attendance-toggle:checked").length;
    let absent = total - present;

    $("#total_students").text(`Total Students: ${total}`);
    $("#present_students").text(`Present: ${present}`);
    $("#absent_students").text(`Absent: ${absent}`);
}

// Update counts on attendance toggle change
$(document).on("change", ".attendance-toggle", function () {
    let student_id = $(this).data("id");
    let status = $(this).is(":checked") ? 1 : 0;

    var selectedDate = $('#dateInput').val();
    var faculty_id = $('#faculty_id').val();
    var semester = $('#semester').val();
    var course = $('#course').val();

    $.post("ajax/insert_attendance", {
        student_id: student_id,
        status: status,
        semester: semester,
        selectedDate: selectedDate,
        course: course,
        faculty_id: faculty_id
    }, function (response) {
        if (response == "success") {
            toastr.success('Attendance updated successfully!', 'Success');
            updateAttendanceCount();
        } else {
            toastr.warning('Something went wrong.', 'Warning');
        }
    });
});



    
   $(document).ready(function() {
       let today = new Date().toISOString().split('T')[0]; // Get today's date
       $("#dateInput").val(today);
       
       // Function to check if all fields are filled
       function checkFormFields() {
           var dateInput = $('#dateInput').val();
           var semester = $('#semester').val();
           var course = $('#course').val();
   
            if (dateInput !== "" && semester !== "0" && course !== "") {
                 $('#get_students').prop('disabled', false); 
            } else {
                $('#get_students').prop('disabled', true); 
            }
       }
   
   
       $("#dateInput").change(function() {
           checkFormFields();
       });
   
   
       $("#semester").change(function() {
           checkFormFields();
           
           var semester = $(this).val();
           var faculty_id = $('#faculty_id').val();
   
           $.ajax({
               url: "ajax/fetch_courses",
               method: "POST",
               data: { semester: semester ,
                   faculty_id:faculty_id
               },
               success: function(response) {
                   $("#course").html(response);
                   checkFormFields();  
               }
           });
   
       });
   
       $("#course").change(function() {
           checkFormFields();
       });
   
       $(document).on("change", ".attendance-toggle", function() {
           let student_id = $(this).data("id");
           let status = $(this).is(":checked") ? 1 : 0;
   
           var selectedDate = $('#dateInput').val();
           var faculty_id = $('#faculty_id').val();
           var semester = $('#semester').val();
           var course = $('#course').val();
   
           $.post("ajax/insert_attendance", { 
               student_id: student_id, 
               status: status ,
               semester: semester,
               selectedDate: selectedDate,
               course:course,
               faculty_id:faculty_id
           }, function(response) {
               if(response == "success") {
                   toastr.success('Attendance updated successfully!', 'Success');
               } else {
                   toastr.warning('Something went wrong.', 'Warning');
               }
           });
       });
   
       // Handle submit action
       $(document).on("click", "#get_students", function() {
   
           var selectedDate = $('#dateInput').val();
           var semester = $('#semester').val();
           var course = $('#course').val();
           
           $.ajax({
               url: "ajax/fetch_students",
               method: "POST",
               data: { 
                   selectedDate:selectedDate,
                   semester: semester,
                   course:course  
               },
               success: function(response) {
                   $("#students-container").html(response);
               }
           });
       });
   });
   
   
</script>