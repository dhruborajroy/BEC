<?php 
session_start();
define('SECURE_ACCESS', true);
require('../../inc/constant.inc.php');
require('../../inc/connection.inc.php');
require_once("../../inc/smtp/class.phpmailer.php");
require('../../inc/function.inc.php');

if (isset($_POST['semester'])) {
    $semester = mysqli_real_escape_string($con, $_POST['semester']);
    $faculty_id = $_SESSION['FACULTY_ID'];
    
    // Fetch courses based on semester
    echo $query = "SELECT c.course_name,c.id, c.course_code, c.credit, c.semester, c.type, c.credit_hour, c.dept_id FROM courses AS c where c.semester = '$semester'";
    $result = mysqli_query($con, $query);
    echo "<option value=''>Select Course</option>";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='".$row['id']."'>".$row['course_name']."</option>";
        }
    } else {
        echo "<option value=''>No courses found</option>";
    }
}

?>