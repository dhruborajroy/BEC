<?php


define('SECURE_ACCESS', true);
require('connection.inc.php');
require('function.inc.php');
$name="s";
$otp=11;
// echo send_email_using_tamplate($name,$otp);

// Function to Calculate CGPA from getGpaCount()
function calculateCGPA($student_id) {
    // Get GPA List
    $gpaList = getGpaCount($student_id);

    // Convert comma-separated values into an array
    $gpaArray = explode(", ", $gpaList);

    // Calculate CGPA (sum of non-zero GPAs / count of non-zero GPAs)
    $sum = 0;
    $count = 0;
    
    foreach ($gpaArray as $gpa) {
        $gpa = floatval($gpa); // Convert string to float
        if ($gpa > 0) {
            $sum += $gpa;
            $count++;
        }
    }

    // Avoid division by zero
    $cgpa = ($count > 0) ? round($sum / $count, 2) : 0.00;
    
    return number_format($cgpa, 2); // Format to 2 decimal places
}

// Example Usage:
$student_id = 9;
echo "GPA List: " . getGpaCount($student_id) . "<br>";
echo "CGPA: " . calculateCGPA($student_id);
