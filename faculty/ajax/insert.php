<?php 

define('SECURE_ACCESS', true);
require('../../inc/constant.inc.php');
require('../../inc/connection.inc.php');
require_once("../../inc/smtp/class.phpmailer.php");
require('../../inc/function.inc.php');

// Function to generate random data for students
function generateRandomStudentData($index) {
    $names = ['Dhruboraj Roy', 'Nazmul Haque Jahid', 'John Doe', 'Jane Smith', 'Mohammad Ali', 'Maria Khan'];
    $class_roll = rand(1000000, 9999999);
    $reg_no = rand(100, 999);
    $sessions = ['2021', '2022', '2023'];
    $fNames = ['Debendra Nath Roy', 'Abdul Haque', 'John Doe Sr.', 'David Smith', 'Mohammad Shahid', 'Mohammad Asif'];
    $mNames = ['M4', 'Najma Begum', 'Masha', 'Sarah', 'Hina', 'Nazia'];
    $phoneNumbers = ['017059272574', '01882874194', '01987654321', '01777777777', '01812345678'];
    $addresses = ['Adarsopara, Sadar, Lalmonirhat', 'Barishal Engineering College Hall', 'Deora, Barura, Cumilla', 'Dhaka, Bangladesh'];
    $dob = '2000-01-01';
    $genders = ['Male', 'Female'];
    $religions = ['Hinduism', 'Islam', 'Christianity'];
    $bloodGroups = ['A+', 'B+', 'O+', 'AB+'];
    $departments = [1, 2]; // Example departments
    $batches = [1, 2, 3];
    $semesters = [1, 2, 3, 4];
    $password = password_hash('password123', PASSWORD_BCRYPT);
    $emails = ['dhruborajroy3@gmail.com', 'jahid@example.com', 'john@example.com', 'jane@example.com'];
    $images = ['1738067831.jpg', '1738050598.jpg'];

    return [
        'name' => $names[array_rand($names)],
        'class_roll' => $class_roll,
        'reg_no' => $reg_no,
        'session' => $sessions[array_rand($sessions)],
        'fName' => $fNames[array_rand($fNames)],
        'mName' => $mNames[array_rand($mNames)],
        'phoneNumber' => $phoneNumbers[array_rand($phoneNumbers)],
        'presentAddress' => $addresses[array_rand($addresses)],
        'permanentAddress' => $addresses[array_rand($addresses)],
        'dob' => $dob,
        'gender' => $genders[array_rand($genders)],
        'religion' => $religions[array_rand($religions)],
        'bloodGroup' => $bloodGroups[array_rand($bloodGroups)],
        'dept_id' => $departments[array_rand($departments)],
        'batch' => $batches[array_rand($batches)],
        'semester' => $semesters[array_rand($semesters)],
        'password' => $password,
        'email' => $emails[array_rand($emails)],
        'image' => $images[array_rand($images)],
        'status' => 1 // Active student
    ];
}

// Insert 100 random students into the database
for ($i = 0; $i < 100; $i++) {
    $student = generateRandomStudentData($i);

    $query = "INSERT INTO students (name, class_roll, reg_no, session, fName, mName, phoneNumber, presentAddress, permanentAddress, dob, gender, religion, bloodGroup, dept_id, batch, semester, password, email, image, status) 
              VALUES (
                  '".mysqli_real_escape_string($con, $student['name'])."',
                  '".mysqli_real_escape_string($con, $student['class_roll'])."',
                  '".mysqli_real_escape_string($con, $student['reg_no'])."',
                  '".mysqli_real_escape_string($con, $student['session'])."',
                  '".mysqli_real_escape_string($con, $student['fName'])."',
                  '".mysqli_real_escape_string($con, $student['mName'])."',
                  '".mysqli_real_escape_string($con, $student['phoneNumber'])."',
                  '".mysqli_real_escape_string($con, $student['presentAddress'])."',
                  '".mysqli_real_escape_string($con, $student['permanentAddress'])."',
                  '".mysqli_real_escape_string($con, $student['dob'])."',
                  '".mysqli_real_escape_string($con, $student['gender'])."',
                  '".mysqli_real_escape_string($con, $student['religion'])."',
                  '".mysqli_real_escape_string($con, $student['bloodGroup'])."',
                  '".mysqli_real_escape_string($con, $student['dept_id'])."',
                  '".mysqli_real_escape_string($con, $student['batch'])."',
                  '".mysqli_real_escape_string($con, $student['semester'])."',
                  '".mysqli_real_escape_string($con, $student['password'])."',
                  '".mysqli_real_escape_string($con, $student['email'])."',
                  '".mysqli_real_escape_string($con, $student['image'])."',
                  '".mysqli_real_escape_string($con, $student['status'])."'
              )";
    
    if (!mysqli_query($con, $query)) {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}

echo "100 random students inserted successfully.";

// Close the connection
mysqli_close($con);
?>
