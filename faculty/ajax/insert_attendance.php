<?php
session_start();
define('SECURE_ACCESS', true);
require('../../inc/constant.inc.php');
require('../../inc/connection.inc.php');
require_once("../../inc/smtp/class.phpmailer.php");
require('../../inc/function.inc.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedDate = mysqli_real_escape_string($con, $_POST["selectedDate"]);
    $course_id = mysqli_real_escape_string($con, $_POST["course"]);
    $semester = mysqli_real_escape_string($con, $_POST["semester"]);
    $student_id = mysqli_real_escape_string($con, $_POST["student_id"]);
    $status = mysqli_real_escape_string($con, $_POST["status"]);
    $faculty_id = $_SESSION['FACULTY_ID'];
    $date = date("Y-m-d",strtotime($selectedDate)); 
    
    
    // Step 1: Insert all students who are not yet recorded in attendance (set status = 0)
    $query = "INSERT INTO attendance (student_id, value, date, course_id, faculty_id, added_on)
    SELECT s.id, 0, '$date', '$course_id', '$faculty_id', UNIX_TIMESTAMP()
    FROM students s
    WHERE NOT EXISTS (
        SELECT 1 FROM attendance a 
        WHERE a.student_id = s.id 
        AND a.date = '$date' 
        AND a.course_id = '$course_id' 
        AND a.faculty_id = '$faculty_id'
    )";

    mysqli_query($con, $query);

    // Step 2: If individual attendance is updated, process that separately
    // if (isset($_POST['student_id']) && isset($_POST['status'])) {

    //     $student_id = mysqli_real_escape_string($con, $_POST["student_id"]);
    //     $status = mysqli_real_escape_string($con, $_POST["status"]);

    //     echo $query = "INSERT INTO attendance (student_id, value, date, course_id, faculty_id, added_on) 
    //               VALUES ('$student_id', '$status', '$date', '$course_id', '$faculty_id', UNIX_TIMESTAMP())
    //               ON DUPLICATE KEY UPDATE value = '$status'";

    //     if (mysqli_query($con, $query)) {
    //         echo "success";
    //     } else {
    //         echo "error";
    //     }
    //     exit;
    // }

    // echo "success"; // Return success after inserting default values

    $check_sql = "SELECT id FROM course_teachers WHERE semester = '$semester' AND teacher_id = '$faculty_id' and course_id = '$course_id'  and status='1'";
    $check_res = mysqli_query($con, $check_sql);
    
    if (mysqli_num_rows($check_res) > 0) {
        $check_sql = "SELECT id FROM attendance WHERE student_id = '$student_id' AND date = '$date' AND faculty_id = '$faculty_id' and course_id = '$course_id'";
        $check_res = mysqli_query($con, $check_sql);
        if (mysqli_num_rows($check_res) > 0) {
            $sql = "UPDATE attendance SET value = '$status',course_id = '$course_id', updated_on = UNIX_TIMESTAMP() WHERE student_id = '$student_id' AND date = '$date'  AND course_id = '$course_id' and faculty_id='$faculty_id' ";
        } else {
            $sql = "INSERT INTO attendance (student_id, value, date, course_id,faculty_id, added_on) VALUES ('$student_id', '$status', '$date','$course_id','$faculty_id', UNIX_TIMESTAMP())";
        }
        if (mysqli_query($con, $sql)) {
            echo "success";
        } else {
            echo "mysqli_error_1";
        }
    }else{
        echo "permission_error_2";
    }
}
?>
