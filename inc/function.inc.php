<?php

if (!defined('SECURE_ACCESS')) {
    die("Direct access not allowed!");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'mailer/src/Exception.php';
require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';


function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($str){
	global $con;
	$str=mysqli_real_escape_string($con,$str);
	return $str;
}
function redirect($link){
	?>
<script>
window.location.href = '<?php echo $link?>';
</script>
<?php
	die();
}
    
function send_email($email,$html,$subject,$attachment=""){;
    $mail = new PHPMailer(true);    
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = SMTP_USERNAME;                     //SMTP username
    $mail->Password   = SMTP_PASSWORD;                            //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;         //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->setFrom(SMTP_USERNAME, 'BEC');
    $mail->addAddress($email);
    if($attachment!=""){
        $mail->addAttachment($attachment);
    }
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $html;
    
    if($mail->send()){
        return "done";
    }else{
        return "error";
    }
}
function sendLoginEmail($email){
	$html="";	
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$result=curl_exec($ch);
	$result=json_decode($result,1);
	// echo "<pre>";
	// print_r($result);
	$html="";
	if($result['status']=='success'){
		$html.='New Login information. '.date("F j, Y \a\t h:i:s A").' <br>Country: '.$result["country"].'<br>'.'<b>Ip Address: '.$result["query"].'</b><br> Zip: '.$result["zip"].'<br> City: '.$result["city"].'<br> Isp: '.$result["isp"].'<br> Region Name: '.$result["regionName"].'<br> ';
		include("browserDetection.php");
		$Browser = new foroco\BrowserDetection();
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$result = $Browser->getAll($useragent);
		foreach ($result as $key => $value) {
			$key=str_replace("_", " ", $key);
			$html.=ucfirst($key).'= '.ucfirst($value).'<br> ';
			
		}
	}
	send_email($email,$html,"Login Information ".date('F j, Y \at h:i:s A'));
}
function rand_str(){
	$str=str_shuffle("abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz");
	return $str=substr($str,0,15);
	
}

function maskEmail($email, $minLength =1, $maxLength = 10, $mask = "***") {
    $atPos = strrpos($email, "@");
    $name = substr($email, 0, $atPos);
    $len = strlen($name);
    $domain = substr($email, $atPos);

    if (($len / 2) < $maxLength) $maxLength = ($len / 2);

    $shortenedEmail = (($len > $minLength) ? substr($name, 0, $maxLength) : "");
    return  "{$shortenedEmail}{$mask}{$domain}";
}

function get_content($URL){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $URL);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}


  
function isAdmin(){
	if(!isset($_SESSION['ADMIN_LOGIN'])){
	?>
<script>
window.location.href = './login.php';
</script>
<?php
	}
}

function isUSER(){
	if(!isset($_SESSION['USER_LOGIN'])){
	?>
<script>
window.location.href = './login.php';
</script>
<?php
	}
}

function isFaculty(){
	if(!isset($_SESSION['FACULTY_LOGIN'])){
		return 0;
	?>
<script>
window.location.href = './login.php';
</script>
<?php
	}
}


function getUsers(){
	global $con;
	$sql="SELECT count(DISTINCT id) as number FROM users ";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['number'];
	}
} 
function getTotalCourse($faculty_id){
	global $con;
	$sql="SELECT count(DISTINCT id) as number FROM course_teachers where teacher_id='$faculty_id'";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['number'];
	}
} 

function set_zero($number,$redix="3"){
	return str_pad($number, $redix, '0', STR_PAD_LEFT);
}

function getAvailableBooksCount($book_id){
	global $con;
	$sql="SELECT count(DISTINCT id) as number FROM book_issues where book_id='$book_id'";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['number'];
	}
} 
function gettotalstudent($gender=""){
	global $con;
    $add_sql="";
    if($gender!=""){
        $add_sql="where gender='$gender'";
    }
	$sql="SELECT count(DISTINCT id) as student FROM students $add_sql";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['student'];
	}
}


function getBooksCount(){
	global $con;
	$sql="SELECT sum(copies_owned) as number FROM book ";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['number'];
	}
} 

function getIssuedBooksCount(){
	global $con;
	$sql="SELECT count(DISTINCT id) as number FROM book_issues";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['number'];
	}
} 

function getRequestedBooksCount(){
	global $con;
	$sql="SELECT count(DISTINCT id) as number FROM book_requests ";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['number'];
	}
} 

function getIssuedBooksCountInYear($startDate,$endDate){
	global $con;
	$startDate=strtotime($startDate);
	$endDate=strtotime($endDate);
	$sql="SELECT COUNT(DISTINCT book_issues.id) as number FROM book_issues WHERE issued_date BETWEEN '$startDate' and '$endDate' ";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['number'];
	}
} 
function getUsersIssuedBooksCountInYear($startDate,$endDate,$user_id){
	global $con;
	$startDate=strtotime($startDate);
	$endDate=strtotime($endDate);
	$sql="SELECT COUNT(DISTINCT book_issues.id) as number FROM book_issues WHERE issued_date BETWEEN '$startDate' and '$endDate' and user_id='$user_id'";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['number'];
	}
} 

// SELECT COUNT(DISTINCT book_issues.id) as number FROM book_issues WHERE issued_date BETWEEN '01-01-2022 00:00:01' and '31-12-2022 23:59:59';

function getUsersIssuedBooksCount($user_id){
	$additional_sql="";
	global $con;
	if($user_id!=''){
		$additional_sql="where user_id='$user_id'";
	}
	$sql="SELECT count(DISTINCT id) as number FROM book_issues ".$additional_sql;
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['number'];
	}
} 

function gettotalcount($type){
	global $con;
	$sql="SELECT count(DISTINCT id) as people FROM people where type='$type'";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['people'];
	}
}

function getTotalNotice(){
	global $con;
	$sql="SELECT count(DISTINCT id) as count FROM notice where status='1'";
	$res=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($res)){
	  return $row['count'];
	}
}


function getGpaCount($student_id) {
    global $con;

    // SQL Query to fetch CGPA values only
    $sql = "SELECT CONCAT(
                LPAD(FORMAT(COALESCE(MAX(CASE WHEN sc.semester = '1st' THEN sc.gpa END), 0.00), 2), 4, ' '), ', ',
                LPAD(FORMAT(COALESCE(MAX(CASE WHEN sc.semester = '2nd' THEN sc.gpa END), 0.00), 2), 4, ' '), ', ',
                LPAD(FORMAT(COALESCE(MAX(CASE WHEN sc.semester = '3rd' THEN sc.gpa END), 0.00), 4, ' '), 4, ' '), ', ',
                LPAD(FORMAT(COALESCE(MAX(CASE WHEN sc.semester = '4th' THEN sc.gpa END), 0.00), 2), 4, ' '), ', ',
                LPAD(FORMAT(COALESCE(MAX(CASE WHEN sc.semester = '5th' THEN sc.gpa END), 0.00), 2), 4, ' '), ', ',
                LPAD(FORMAT(COALESCE(MAX(CASE WHEN sc.semester = '6th' THEN sc.gpa END), 0.00), 2), 4, ' '), ', ',
                LPAD(FORMAT(COALESCE(MAX(CASE WHEN sc.semester = '7th' THEN sc.gpa END), 0.00), 2), 4, ' '), ', ',
                LPAD(FORMAT(COALESCE(MAX(CASE WHEN sc.semester = '8th' THEN sc.gpa END), 0.00), 2), 4, ' ')
            ) AS cgpa_list
            FROM students s
            LEFT JOIN students_cgpa sc ON s.id = sc.student_id
            WHERE s.id = '$student_id'
            GROUP BY s.id";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row ? $row['cgpa_list'] : '0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00';
}


// function calculateSemesterWiseCGPA($student_id) {
//     $gpaList = getGpaCount($student_id);
//     $gpaArray = explode(", ", $gpaList);

//     $sum = 0;
//     $cgpaArray = [];

//     for ($i = 0; $i < count($gpaArray); $i++) {
//         $sum += floatval($gpaArray[$i]); 
//         $cgpa = round($sum / ($i + 1), 2); 
//         $cgpaArray[] = $cgpa;
//     }

//     return implode(", ", $cgpaArray);
// }

function calculateSemesterWiseCGPA($student_id) {
    // Get GPA List
    $gpaList = getGpaCount($student_id);

    // Convert comma-separated values into an array
    $gpaArray = explode(", ", $gpaList);

    $sum = 0;
    $cgpaArray = [];

    // Loop through each semester and calculate CGPA
    for ($i = 0; $i < count($gpaArray); $i++) {
        $gpa = floatval($gpaArray[$i]);

        // Stop counting if the GPA is 0
        if ($gpa == 0.00) {
            break;
        }

        $sum += $gpa; // Add GPA to the sum
        $cgpa = round($sum / ($i + 1), 2); // Compute cumulative average
        $cgpaArray[] = $cgpa;
    }

    // If CGPA array is empty, return 0.00
    return !empty($cgpaArray) ? implode(", ", $cgpaArray) : '0.00';
}


function calculateCGPA($student_id) {
    $gpaList = getGpaCount($student_id);
    $gpaArray = explode(", ", $gpaList);
    $sum = 0;
    $count = 0;
    foreach ($gpaArray as $gpa) {
        $gpa = floatval($gpa); 
        if ($gpa > 0) {
            $sum += $gpa;
            $count++;
        }
    }
    $cgpa = ($count > 0) ? round($sum / $count, 2) : 0.00;
    return number_format($cgpa, 2); 
}


function getDeptStudentCount($dept_id){
	global $con;
	$sql = "SELECT 
	b.id AS batch_id, 
	b.name AS batch_name, 
	COALESCE(COUNT(s.id), 0) AS student_count  
	FROM batch b
	LEFT JOIN students s ON b.id = s.batch AND s.dept_id = $dept_id
	WHERE 1
	GROUP BY b.id, b.name
	ORDER BY b.id ASC";
	$result = mysqli_query($con, $sql);
	$batches = []; 
	if ($result) {
	while ($row = mysqli_fetch_assoc($result)) {
	$batches[] = $row;
	}
	mysqli_free_result($result);
	} else {
	    echo "Error: " . mysqli_error($con);
	}
	$batchNames = [];
	$studentCounts = [];
	foreach ($batches as $batch) {
	$batchNames[] = '"Batch ' . str_pad($batch['batch_name'], 2, "0", STR_PAD_LEFT) . '"';
	$studentCounts[] = $batch['student_count'];
	}
	implode(", ", $batchNames) . "<br>";
	return  implode(", ", $studentCounts);
}

function getDeptBatchList($dept_id){
	global $con;
	$sql = "SELECT 
	b.id AS batch_id, 
	b.name AS batch_name, 
	COALESCE(COUNT(s.id), 0) AS student_count  
	FROM batch b
	LEFT JOIN students s ON b.id = s.batch AND s.dept_id = 1
	WHERE 1
	GROUP BY b.id, b.name
	ORDER BY b.id ASC";

	$result = mysqli_query($con, $sql);

	$batches = []; 
	if ($result) {
	while ($row = mysqli_fetch_assoc($result)) {
	$batches[] = $row;
	}
	mysqli_free_result($result);
	} else {
	echo "Error: " . mysqli_error($con);
	}

	// Display results
	$batchNames = [];
	$studentCounts = [];

	foreach ($batches as $batch) {
	$batchNames[] = '"Batch ' . str_pad($batch['batch_name'], 2, "0", STR_PAD_LEFT) . '"';
	$studentCounts[] = $batch['student_count'];
	}

	return  implode(", ", $batchNames);
}



function send_email_using_tamplate($name,$otp){
	$tamplate= "../inc/email.php";
	$file_content=file_get_contents("../inc/email.php");
	$array=array(
		"{YOUR_NAME}"=>$name,
		"{OTP_NUMBER}"=>$otp,
        "{DATE}"=>date("d M Y h:i"),
	);
	$keys = array_keys($array);
	$values = array_values($array);
	return str_replace($keys, $values, $file_content);
}

function getBetweenDates($startDate, $endDate){
	$rangArray = [];
	$startDate = strtotime($startDate);
	$endDate = strtotime($endDate);
	for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += (86400)) {
											
		$date = date('d', $currentDate);
		$rangArray[] = $date;
	}
	return $rangArray;
}

function get_time_ago($time){
    $time_difference = time() - $time;
    if( $time_difference < 1 ){ 
		return 'less than 1 second ago'; 
	}
    $condition = array( 
				12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second',
    );
    foreach( $condition as $secs => $str ){
        $d = $time_difference / $secs;
        if( $d >= 1 ){
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}

function randomEmail($name) {
    $domains = ["@ce.bec.edu.bd", "@bec.edu.bd","@eee.bec.edu.bd", "@gmail.com"];
    return strtolower(str_replace(' ', '_', $name)) . rand(1, 99) . $domains[array_rand($domains)];
}

function randomBangladeshiName() {
    $firstNames = ["Abdul", "Md.", "Shahriar", "Rafi", "Hasan", "Tariq", "Shams", "Arif", "Imran", "Nayeem"];
    $lastNames = ["Rahman", "Islam", "Hossain", "Ahmed", "Khan", "Chowdhury", "Alam", "Kabir", "Faruque", "Sikder"];
    return "Dr. " . $firstNames[array_rand($firstNames)] . " " . $lastNames[array_rand($lastNames)];
}

function addOrdinalNumberSuffix($num) {
    if (!in_array(($num % 100),array(11,12,13))){
      switch ($num % 10) {
        // Handle 1st, 2nd, 3rd
        case 1:  return $num.'<sup>st</sup>';
        case 2:  return $num.'<sup>nd</sup>';
        case 3:  return $num.'<sup>rd</sup>';
      }
    }
    return $num.'<sup>th</sup>';
}

function numberTowords($num){
    $ones = array(
        0 => "ZERO",
        1 => "ONE",
        2 => "TWO",
        3 => "THREE",
        4 => "FOUR",
        5 => "FIVE",
        6 => "SIX",
        7 => "SEVEN",
        8 => "EIGHT",
        9 => "NINE",
        10 => "TEN",
        11 => "ELEVEN",
        12 => "TWELVE",
        13 => "THIRTEEN",
        14 => "FOURTEEN",
        15 => "FIFTEEN",
        16 => "SIXTEEN",
        17 => "SEVENTEEN",
        18 => "EIGHTEEN",
        19 => "NINETEEN",
        "014" => "FOURTEEN"
    );
    $tens = array(
        0 => "ZERO",
        1 => "TEN",
        2 => "TWENTY",
        3 => "THIRTY",
        4 => "FORTY",
        5 => "FIFTY",
        6 => "SIXTY",
        7 => "SEVENTY",
        8 => "EIGHTY",
        9 => "NINETY"
    );
    $hundreds  = array(
        "HUNDRED",
        "THOUSAND",
        "MILLION",
        "BILLION",
        "TRILLION",
        "QUARDRILLION"
    );
    /*limit t quadrillion */
    $num       = number_format($num, 2, ".", ",");
    $num_arr   = explode(".", $num);
    $wholenum  = $num_arr[0];
    $decnum    = $num_arr[1];
    $whole_arr = array_reverse(explode(",", $wholenum));
    krsort($whole_arr, 1);
    $rettxt = "";
    foreach ($whole_arr as $key => $i) {
        
        while (substr($i, 0, 1) == "0")
            $i = substr($i, 1, 5);
        if ($i < 20) {
            /* echo "getting:".$i; */
            $rettxt .= $ones[$i];
        } elseif ($i < 100) {
            if (substr($i, 0, 1) != "0")
                $rettxt .= $tens[substr($i, 0, 1)];
            if (substr($i, 1, 1) != "0")
                $rettxt .= " " . $ones[substr($i, 1, 1)];
        } else {
            if (substr($i, 0, 1) != "0")
                $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];
            if (substr($i, 1, 1) != "0")
                $rettxt .= " " . $tens[substr($i, 1, 1)];
            if (substr($i, 2, 1) != "0")
                $rettxt .= " " . $ones[substr($i, 2, 1)];
        }
        if ($key > 0) {
            $rettxt .= " " . $hundreds[$key] . " ";
        }
    }
    if ($decnum > 0) {
        $rettxt .= " and ";
        if ($decnum < 20) {
            $rettxt .= $ones[$decnum];
        } elseif ($decnum < 100) {
            $rettxt .= $tens[substr($decnum, 0, 1)];
            $rettxt .= " " . $ones[substr($decnum, 1, 1)];
        }
    }
    return $rettxt;
}

function csrf(){
	$csrf_token=md5(uniqid(rand()));
	$_SESSION['csrf_token']=$csrf_token;
	return $_SESSION['csrf_token'];
}

function form_csrf(){
	$csrf_token=csrf();
	$html='<input type="hidden" name="csrf_token" id="csrf_token"
	value="'.$csrf_token.'">';
	return $html;
}

/*
"Numbers": {
        "Numbers": " 01770618575",
        "Number1": " 01929918378",
        "Number2": " 01770618576",
        "Number3": " 01877722345",
        "Number4": " 01619777282",
        "Number5": " 01619777283",
        "Insufficient": "01823074817",
        "Debit Block": "01823074818"
    },
    "otp":"123456",
    "pin":"12121"
*/
// Bkash Functions Starts here
?>