<?php 
   define('SECURE_ACCESS', true);
   include("header.php");
?>
<!-- MAIN CONTENT-->
<div class="main-content">
<div class="col-12">
    
<div class="card">
    <div class="card-header">
       <strong>Students Attendance</strong>
    </div>
    <div class="card-body card-block">
       <form method="get" enctype="multipart/form-data" class="form-horizontal">
          <div class="row form-group col-md-12">
             <div class="col-sm-12 col-md-6 mt-2">
                <select id="semester" class="form-control-lg form-control">
                   <option value='0'>Select Semester</option>
                   <?php 
                      $semesters = [
                          '1' => '1st',
                          '2' => '2nd',
                          '3' => '3rd',
                          '4' => '4th',
                          '5' => '5th',
                          '6' => '6th',
                          '7' => '7th',
                          '8' => '8th',
                      ];
                      foreach ($semesters as $key=>$sem) {
                          echo "<option value='$key'>$sem</option>";
                      }
                   ?>
                </select>
             </div>
             <div class="col-sm-12 col-md-6 mt-2">
                <select name="course_id" id="course" class="form-control-lg form-control">
                   <option value="">Select Course</option>
                </select>
             </div>
          </div>
    </div>
    <div class="card-footer">
       <input type="submit" value="Get Attendance" disabled id="get_attendance" class="btn btn-primary btn-sm">
       <a href="attendance_data" class="btn btn-danger btn-sm"> 
            <i class="fa fa-ban"></i> Reset
       </a>
    </div>
    </form>
</div>

<?php if(isset($_GET['course_id'])) { ?>
    <div class="card">
        <div class="card-body">
            <div class="col-12 row">
                <div class="col-8">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Attendance</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive col-12">
                <table class="table bs-table table-striped table-bordered">
                    <?php 
                        // Fetch all distinct dates
                        $course_id = get_safe_value($_GET['course_id']);
                        $date_query = "SELECT DISTINCT date FROM attendance WHERE  student_id='$user_id'  AND course_id='$course_id' ORDER BY date ASC";
                        $date_result = mysqli_query($con, $date_query);
                        $dates = [];
                        while ($row = mysqli_fetch_assoc($date_result)) {
                            $dates[] = $row['date'];
                        }

                        // Fetch student data and their attendance records
                        $student_query = "SELECT s.id, s.name, s.class_roll FROM students s  where s.id='$user_id'  ORDER BY s.class_roll ASC";
                        $student_result = mysqli_query($con, $student_query);
                        $students = [];
                        while ($row = mysqli_fetch_assoc($student_result)) {
                            $students[$row['id']] = [
                                'name' => $row['name'], 
                                'class_roll' => $row['class_roll'], 
                                'attendance' => array_fill_keys($dates, '<i class="fas fa-times text-danger"></i>') // Default absent
                            ];
                        }

                        // Fetch attendance records
                        $attendance_query = "SELECT student_id, date, value FROM attendance WHERE course_id='$course_id'";
                        $attendance_result = mysqli_query($con, $attendance_query);
                        while ($row = mysqli_fetch_assoc($attendance_result)) {
                            // Make sure the value is either '1' or '0'
                            $attendance_value = $row['value'] == 1 ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';
                            if (isset($students[$row['student_id']])) {
                                $students[$row['student_id']]['attendance'][$row['date']] = $attendance_value;
                            }
                        }

                        $total_days = count($dates);
                    ?>
                    <thead>
                        <tr>
                            <th class="text-left">Students</th>
                            <?php foreach ($dates as $date) { echo "<th>$date</th>"; } ?>
                            <th>Attendance %</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student) { 
                            if (!isset($student['name']) || empty($student['name'])) {
                                continue; // Skip empty or invalid student entries
                            }
                            // Corrected Attendance Calculation
                            $present_count = 0;
                            foreach ($dates as $date) {
                                if ($student['attendance'][$date] == '<i class="fas fa-check text-success"></i>') {
                                    $present_count++;
                                }
                            }
                            $attendance_percentage = ($total_days > 0) ? round(($present_count / $total_days) * 100, 2) . '%' : '0%';
                        ?>
                        <tr>
                            <td class="text-left"><?php echo isset($student['name']) ? $student['name'] : 'N/A'; ?></td>
                            <?php foreach ($dates as $date) {
                                echo "<td>" . $student['attendance'][$date] . "</td>";
                            } ?>
                            <td><?php echo $attendance_percentage; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

</div>
<?php 
   include("footer.php");
?>
<script>
    
// Function to check if all fields are filled
function checkFormFields() {
    var semester = $('#semester').val();
    var course = $('#course').val();

    if (semester !== "0" && course !== "") {
        $('#get_attendance').prop('disabled', false); 
    } else {
        $('#get_attendance').prop('disabled', true); 
    }
}

$("#semester").change(function() {
    checkFormFields();
    var semester = $(this).val();

    $.ajax({
        url: "ajax/fetch_courses",
        method: "POST",
        data: { semester: semester },
        success: function(response) {
            $("#course").html(response);
        }
    });

    $("#course").change(function() {
        checkFormFields();
    });

});
</script>
