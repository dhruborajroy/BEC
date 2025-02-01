<?php
define('SECURE_ACCESS', true);
include("../inc/constant.inc.php");
include("../inc/connection.inc.php");
include("../inc/function.inc.php");
include("../inc/en2bn.php");
require('../inc/vendor/autoload.php');
require_once("../inc/phpqrcode/qrlib.php");
$filepath = "../images/qr_code/qrcode.png";
$additional_sql = "";
$page_break = ""; 
$first_page = true; 

if (isset($_GET['student_id']) && $_GET['student_id'] !="") {
    $student_id = get_safe_value($_GET['student_id']);
    $additional_sql = " and md5(students.id)='$student_id'";
    if($student_id=="all"){
        $additional_sql = "";
    }
}else{
    redirect("/");
    die;
}

$query = "SELECT students.name, students.fName, students.reg_no,students.dept_id,depts_lab_list.name_bn, batch.session FROM students,batch,depts_lab_list where batch.id=students.batch and depts_lab_list.id=students.dept_id $additional_sql"; 
$result = mysqli_query($con, $query);

$all_testimonials_html = ''; 
if(mysqli_num_rows($result)>=1){
    while ($student = mysqli_fetch_assoc($result)) {
        if (!$first_page) {
            $all_testimonials_html .= "<pagebreak />";
        }
        $first_page = false; 
    
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => __DIR__ . '/custom',
            'default_font_size' => 12,
            'default_font' => 'FreeSerif',
            'margin_left' => 20,
            'margin_right' => 20,
            'margin_top' => 10,
            'margin_bottom' => 10,
        ]);
    
        $mpdf->SetTitle('TESTIMONIAL - ' . $student['name']);
        $mpdf->SetFooter('<div style="text-align:center;">Developed By The Web Divers</div>');
    
        
        $html = '<table class="table" width="100%" border="0" cellspacing="0" cellpadding="5" style="border-collapse: collapse; page-break-inside: avoid;">';
        $html .= '
            <tr>
                <td align="left" width="10%">                    
                    <img src="'.BD_LOGO.'" width="100" height="100" /> 
                </td>
                <td align="center" colspan="4">
                    <span style="font-size:20px">'.NAME.'</span>
                    <br>
                    '.ADDRESS.'
                    <br>
                    Tel: '.TEL.' | Email: '.EMAIL.'
                    <br>
                    '.FRONT_SITE_PATH.'
                </td>
                <td align="right" width="10%">                    
                    <img src="'.LOGO.'" width="100" height="100" /> 
                </td>
            </tr>';
        
        $html .= '
            <tr>
                <td align="left" colspan="6" style="height:4; border-bottom: 1px solid black;">                    
                </td>
            </tr>';
            $dept_id=$student['dept_id'];
        // **Main Content with Borders**
        $html .= '
            <tr style="border: 0px solid black;">
                <td align="left" colspan="6" style="padding-top:20px;text-align: justify;font-size:20px; border: 0px solid black;">
                    অত্র কলেজের <strong>' . $student['name_bn'] . '</strong> বিভাগের শিক্ষার্থী <strong>' . $student['name'] . '</strong>, ঢাবি রেজিঃ <strong>' . $student['reg_no'] . '</strong>, শিক্ষাবর্ষ: <strong>' . $student['session'] . '</strong>,  
                    এর সকল একাডেমিক কার্যক্রম শেষ হওয়ায় অত্র প্রতিষ্ঠান থেকে তার কোর্স সমাপনী সনদ ও প্রশংসা পত্র প্রদানের ব্যবস্থা গ্রহণ করা হচ্ছে। তাঁর দেনা-পাওনা সম্পর্কে 
                    বিস্তারিত তথ্যের জন্য সংশ্লিষ্ট সকলকে নিম্নবর্ণিত ছক অনুযায়ী ব্যবস্থা গ্রহণ করতে নির্দেশ প্রদান করা হলো।
                    </td>
            </tr>';  
        
        $sql = "SELECT * FROM depts_lab_list where depts_lab_list.id='$dept_id' or depts_lab_list.print='1'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                // Force a page break before the department name if necessary
                $html .= '
                <tr align="center" style="border: 0px solid black; page-break-before: always;">
                    <td colspan="6" align="center" style="font-size:25px; border: 1px solid black;">
                        <u>'.$row['name_bn'].'</u>
                    </td>
                </tr>';
                
                $html .= '
                <tr style="border: 1px solid black;">
                    <td align="center" width="10%" style="border: 1px solid black;">ক্রমিক</td>
                    <td align="left" width="30%" style="border: 1px solid black;">বিভাগ/সপ</td>
                    <td align="left" width="15%" style="border: 1px solid black;">দেনা-পাওনা তথ্য</td>
                    <td align="left" width="15%" style="border: 1px solid black;">ভারপ্রাপ্ত কর্মকর্তার স্বাক্ষর</td>
                    <td align="left" width="15%" style="border: 1px solid black;">ওয়ার্কশপ সুপার/সপ ইনচার্জের স্বাক্ষর</td>
                    <td align="left" width="15%" style="border: 1px solid black;">বিভাগীয় প্রধানের স্বাক্ষর</td>
                </tr>';
        
                $lab_sql = "SELECT * FROM lab_list WHERE dept_id='".$row['id']."'";
                $lab_res = mysqli_query($con, $lab_sql);
                if (mysqli_num_rows($lab_res) > 0) {
                    $i = 1;
                    while ($lab_row = mysqli_fetch_assoc($lab_res)) {
                        // Add page-break-before or prevent breaking for each lab name
                        $html .= '
                        <tr style="border: 1px solid black; page-break-before: always;">
                            <td align="center" style="border: 1px solid black;">'.$i.'</td>
                            <td align="left" style="border: 1px solid black;">'.$lab_row['name'].'</td>
                            <td align="left" style="border: 1px solid black;"></td>
                            <td align="left" style="border: 1px solid black;"></td>
                            <td align="left" style="border: 1px solid black;"></td>
                            <td align="left" style="border: 1px solid black;"></td>
                        </tr>';
                        $i++;
                    }
                } else {
                    $html .= '
                    <tr style="border: 0px solid black;">
                        <td colspan="6" align="center" style="border: 1px solid black;">কোন তথ্য পাওয়া যায়নি</td>
                    </tr>';
                }
            }
        } else {
            $html .= '
            <tr style="border: 0px solid black;">
                <td colspan="6" align="center" style="border: 1px solid black;">কোন তথ্য পাওয়া যায়নি</td>
            </tr>';
        }
        
        // **Footer with Borders**
        $html .= '
        <tr style="border: 0px solid black;">
            <td align="center" colspan="6" style="font-size:20px;padding-top:40px">
                তাঁর নিকট থেকে ___________________ টাকা পাওয়া/ফেরত দেয়া হলো।
            </td>
        </tr>';
        
        $html .= '
        <tr style="border: 0px solid black;">
            <td align="center" colspan="3" style="font-size:20px;padding-top:30px">কোষাধ্যক্ষ</td>
            <td align="center" colspan="3" style="font-size:20px;padding-top:30px">হিসাবরক্ষক</td>
        </tr>';
        
        $html .= '
        <tr style="border: 0px solid black;">
            <td align="left" colspan="6" style="font-size:20px;padding-top:20px"> 
            উপরোক্ত তথ্যের প্রেক্ষিতে তাকে ছাড়পত্র প্রদানের নির্দেশ প্রদান করা হলো।
            </td>

        </tr>';
        $html .= '
        <tr style="border: 0px solid black;">
            <td align="left" colspan="1"></td>
            <td align="center" colspan="3"></td>
            <td align="center" style="padding-top:00px" colspan="2">
                <div align="right">
                    <span style="font-style:30px">
                        <br>
                            <span style="font-size:20px">'.SIGNATURE_NAME.'</span>
                        <br>
                    </span>
                </div>
            </td>
        </tr>';
        
        $html .= '</table>';


        $mpdf->WriteHTML($html);
        $file = $student['session']."_".$student['reg_no']."_". '_TESTIMONIAL.pdf';
        $mpdf->Output("../testimonials/" . $file, 'F'); 
        $all_testimonials_html .= $html;
    }
}else{
    redirect("/");
}
// echo $html;
$all_mpdf = new \Mpdf\Mpdf([
    'tempDir' => __DIR__ . '/custom',
    'default_font_size' => 12,
    'default_font' => 'nikosh',
    'margin_left' => 20,
    'margin_right' => 20,
    'margin_top' => 5,
    'margin_bottom' => 5,
]);
$all_mpdf->SetTitle('All Testimonials - Barishal Engineering College');
// $all_mpdf->SetFooter('<div style="text-align:center;">Developed By The Web Divers</div>');
$all_mpdf->WriteHTML($all_testimonials_html);
$all_mpdf->Output("../testimonials/ALL_TESTIMONIALS.pdf", 'I'); // Save the file
mysqli_close($con);
?>