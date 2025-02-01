<?php 

define('SECURE_ACCESS', true);
session_start();
if (!defined('SECURE_ACCESS')) {
    die("You don't have permission to access the location");
}
require('../inc/constant.inc.php');
require('../inc/connection.inc.php');
require_once("../inc/smtp/class.phpmailer.php");
require('../inc/function.inc.php');
isFaculty();
$faculty_id=$_SESSION[ 'FACULTY_ID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 10px; /* Reduced font size for more rows */
            margin: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px; /* Reduced padding for compactness */
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        @media screen {
            .row-f { background-color: #ffcccc; }
            .cell-positive { background-color: #ccffcc; }
            .cell-a { background-color: #ccf2ff; }
        }

        @media print {
            @page {
                margin: 10mm; /* Reduced margins for printing */
                size: A4 landscape;
            }
            body {
                margin: 0;
                padding: 0;
            }
            table {
                margin: 0 auto;
                width: 100%;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
            thead {
                display: table-header-group;
            }
            .row-f, .cell-positive, .cell-a {
                background-color: transparent !important;
            }
            .no-print {
                display: none;
            }
            /* Header for print is now compact */
            .header-print {
                text-align: center;
                margin-bottom: 10px;
                font-weight: bold;
                font-size: 12px; /* Slightly reduced font size */
            }
            /* Red background for attendance percent < 60% */
            .attendance-percent-low {
                background-color: red !important;
                color: white; /* White text for readability */
            }
        }
    </style>
</head>
<body>

<!-- Print Heading -->
<div class="no-print header-print">
    <p>Barishal Engineering College</p>
    <p>Subject Code: CE XXX</p>
    <p>Subject Title: Anything</p>
</div>

<table class="table bs-table table-striped table-bordered text-nowrap">
    <?php 
        // Fetch all distinct dates
        $date_query = "SELECT DISTINCT date FROM attendance where faculty_id='$faculty_id' and course_id='4' ORDER BY date ASC";
        $date_result = mysqli_query($con, $date_query);
        $dates = [];
        while ($row = mysqli_fetch_assoc($date_result)) {
            $dates[] = $row['date'];
        }

        // Fetch student data and their attendance records
        $student_query = "SELECT s.id, s.name, s.class_roll FROM students s ORDER BY s.class_roll ASC";
        $student_result = mysqli_query($con, $student_query);
        $students = [];
        while ($row = mysqli_fetch_assoc($student_result)) {
            $students[$row['id']] = [
                'name' => $row['name'], 
                'class_roll' => $row['class_roll'], 
                'attendance' => array_fill_keys($dates, 'A') // Default absent
            ];
        }
        // pr($students);
        // Fetch attendance records
        $attendance_query = "SELECT student_id, date, value FROM attendance";
        $attendance_result = mysqli_query($con, $attendance_query);
        while ($row = mysqli_fetch_assoc($attendance_result)) {
            // Replace attendance value with 'Present' or 'Absent'
            $attendance_value = $row['value'] == 1 ? 'P' : 'A';
            $students[$row['student_id']]['attendance'][$row['date']] = $attendance_value;
        }
        // pr($students);
        
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
            $present_count = substr_count(implode('', $student['attendance']), 'P');
            $attendance_percentage = $total_days > 0 ? round(($present_count / $total_days) * 100, 2) : 0;
            $row_class = $attendance_percentage < 60 ? 'row-f' : ''; // Mark rows with less than 60% attendance
        ?>
            <tr class="<?php echo $row_class; ?>">
                <td class="text-left"><?php echo $student['name']; ?></td>
                <?php foreach ($dates as $date) {
                    $cell_class = $student['attendance'][$date] == 'P' ? 'cell-positive' : '';
                    echo "<td class='$cell_class'>" . $student['attendance'][$date] . "</td>";
                } ?>
                <td class="<?php echo $attendance_percentage < 60 ? 'attendance-percent-low' : ''; ?>">
                    <?php echo $attendance_percentage . '%'; ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
<?php 
        // pr($students);?>
