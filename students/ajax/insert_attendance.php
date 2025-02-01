<?php
$con = mysqli_connect("localhost", "root", "", "school");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $student_id = mysqli_real_escape_string($con, $_POST["student_id"]);
    $status = mysqli_real_escape_string($con, $_POST["status"]);
    $selectedDate = mysqli_real_escape_string($con, $_POST["selectedDate"]);
    $semester = mysqli_real_escape_string($con, $_POST["semester"]);
    $course_id = mysqli_real_escape_string($con, $_POST["course"]);
    $faculty_id = mysqli_real_escape_string($con, $_POST["faculty_id"]);
    $date = date("Y-m-d",strtotime($selectedDate)); 

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
