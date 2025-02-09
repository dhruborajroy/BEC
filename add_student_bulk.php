<?php 
define('SECURE_ACCESS', true);

require('./inc/constant.inc.php');
require('./inc/connection.inc.php');
require('./inc/function.inc.php');
require_once("./inc/smtp/class.phpmailer.php");

send_email("enamulhoshen244@gmail.com","Your account has been created","Account Created");
die;
// JSON data
$jsonData = file_get_contents("data/eee04.json");

// Decode JSON
$students = json_decode($jsonData, true);

// Insert data into the student table
foreach ($students as $student) {
    $name = ucwords(strtolower(mysqli_real_escape_string($con, $student["Name"])));
    $reg_no = mysqli_real_escape_string($con, $student["Reg"]);
    $dept_id = 2; //1=civil 2=eee 

    // Default values for required fields
    //$sl = intval($reg_no);
    // $sl = str_pad($sl, 2, '0', STR_PAD_LEFT);

    $class_roll = "";  // Empty class roll
    $session = "2020-2021";  // Example session
    $fName = "Unknown";  // Default father name
    $mName = "Unknown";  // Default mother name
    $phoneNumber = "0000000000";  // Default phone number
    $presentAddress = "Not Available";
    $permanentAddress = "Not Available";
    $dob = "2000-01-01";  // Example DOB
    $gender = "Male";
    $religion = "Not Specified";
    $bloodGroup = "Unknown";
    $batch = "4";
    $semester = 8;
    $password = $dept_id .$reg_no;  // Hashed default password
    $email = strtolower(str_replace(' ', '', $name)) . "@bec.edu.bd"; // Example email
    $image = "default.jpg";
    $status = 1;

    $sql = "INSERT INTO students (name, class_roll, reg_no, session, fName, mName, phoneNumber, presentAddress, permanentAddress, dob, gender, religion, bloodGroup, dept_id, batch, semester, password, email, image, status) 
            VALUES ('$name', '$class_roll', '$reg_no', '$session', '$fName', '$mName', '$phoneNumber', '$presentAddress', '$permanentAddress', '$dob', '$gender', '$religion', '$bloodGroup', '$dept_id', '$batch', '$semester', '$password', '$email', '$image', '$status')";
    // send_email("")
    

    if (mysqli_query($con, $sql)) {
        echo "Student $name added successfully.<br>";
    } else {
        echo "Error adding student $name: " . mysqli_error($con) . "<br>";
    }
}

// Close conection
mysqli_close($con);
?>
