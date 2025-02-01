<?php 

define('SECURE_ACCESS', true);
require('../../inc/constant.inc.php');
require('../../inc/connection.inc.php');
require_once("../../inc/smtp/class.phpmailer.php");
require('../../inc/function.inc.php');

if (isset($_POST['semester'])) {
    $semester = mysqli_real_escape_string($con, $_POST['semester']);
    $date = mysqli_real_escape_string($con, $_POST['selectedDate']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    $query = "SELECT s.id, s.name, s.reg_no, 
                (SELECT value 
                FROM attendance a 
                WHERE a.student_id = s.id 
                AND a.course_id = '$course'  -- Replace with the desired course ID
                AND a.date = '$date'      -- Replace with the desired date
                ORDER BY a.id DESC 
                LIMIT 1) AS attendance_status 
              FROM students s WHERE semester = '$semester'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $student_id = $row['id'];
            $checked = ($row['attendance_status'] == 1) ? 'checked' : '';
            echo '
            <div class="d-flex align-items-center justify-content-between flex-wrap p-2 border-bottom">
                <div class="flex-grow-1 text-start">
                    <span>'.htmlspecialchars($row['name']).'</span>
                </div>
                <div class="flex-grow-1 text-center">
                    <span>'.htmlspecialchars($row['reg_no']).'</span>
                </div>
                <div class="flex-grow-1 text-end">
                    <label class="switch switch-3d switch-success">
                        <input type="checkbox" class="switch-input attendance-toggle" data-id="'.$student_id.'" '.$checked.'>
                        <span class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                </div>
            </div>';
        }
    } else {
        echo "<p class='text-center text-danger'>No students found</p>";
    }
}
?>