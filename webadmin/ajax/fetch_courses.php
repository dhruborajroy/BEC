<?php 
session_start();
define('SECURE_ACCESS', true);
include("../../inc/connection.inc.php");
echo "s";
if (isset($_POST['semester'], $_POST['selected_course'])) {
    $semester = mysqli_real_escape_string($con, $_POST['semester']);
    $selected_course = mysqli_real_escape_string($con, $_POST['selected_course']); // Get selected course ID

    // Fetch courses based on semester
    echo $query = "SELECT c.course_name, c.id, c.course_code, c.credit, c.semester, c.type, c.credit_hour, c.dept_id 
              FROM courses AS c 
              WHERE c.semester = '$semester'";
    $result = mysqli_query($con, $query);

    echo "<option value=''>Select Course</option>";
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $selected = ($row['id'] == $selected_course) ? "selected" : ""; // Compare with selected course
            echo "<option value='".$row['id']."' $selected>".$row['course_name']."</option>";
        }
    } else {
        echo "<option value=''>No courses found</option>";
    }
}
?>
