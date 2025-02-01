<?php
define('SECURE_ACCESS', true);
include("../inc/constant.inc.php");
include("../inc/connection.inc.php");
include("../inc/function.inc.php");
include("../inc/en2bn.php");
require('../inc/vendor/autoload.php');
require_once("../inc/phpqrcode/qrlib.php");
$filepath = "../images/qr_code/qrcode.png";
QRcode::png("Demo QR code.", $filepath);
$html="";
$html='<table class="table" width="100%">';
$html.='
    <tr>
        <td align="left" colspan="3" style="font-size:20px">                    
            পুরকৌশল বিভাগ<br>বরিশাল ইঞ্জিনিয়ারিং কলেজ<br>বরিশাল - ৮২০০, বাংলাদেশ<br>Email: '.EMAIL.'
        </td>
        <td  align="center" colspan="1">
        <img  src="'.LOGO.'" width="100" height="100" /> 
        </td>
        <td align="right" colspan="3" style="font-size:20px">                    
            Department of Civil Engineering<br>Barishal Engineering College<br>Barishal-8200, Bangladesh<br>Email: '.EMAIL.'
        </td>
    </tr>';
    $html.='
        <tr>
            <td align="left" colspan="7" style="height:4">                    
                <hr>
            </td>
        </tr>';
    $html.='
        <tr >
            <td align="left" colspan="4">                    
                Ref No: BEC/MOI/25
            </td>
            <td  align="right" colspan="3">
                Date: 13 Jan 2025
            </td>
        </tr>';
        $html.='
            <tr>
                <td align="left" colspan="7" align="center" style="padding-top:20px">                    
                <u style="font-size:35px">TO WHOM IT MAY CONCERN</u>
                </td>
            </tr>';
            $html.='<tr>
                <td colspan="7" style="text-align: justify; padding-top: 10px; font-size: 15px;line-height: 1.3; ">
                    <p style="margin-bottom: 15px;">
                        I take great pleasure in writing this letter of recommendation for <strong>Md. Nashib Hossain</strong>, who is seeking 
                        admission to the Master\'s program at your esteemed university. I have had the privilege of knowing Nashib 
                        personally as he was my direct undergraduate project student. In my experience, he has proven himself to be 
                        an exceptionally talented and dedicated student, making him a standout individual in our department. His 
                        proficiency in various academic disciplines, including <strong>AutoCAD, ETABS, and Computer Science</strong>, has been 
                        consistently impressive.
                    </p><p style="margin-bottom: 15px;">
                        I take great pleasure in writing this letter of recommendation for <strong>Md. Nashib Hossain</strong>, who is seeking 
                        admission to the Master\'s program at your esteemed university. I have had the privilege of knowing Nashib 
                        personally as he was my direct undergraduate project student. In my experience, he has proven himself to be 
                        an exceptionally talented and dedicated student, making him a standout individual in our department. His 
                        proficiency in various academic disciplines, including <strong>AutoCAD, ETABS, and Computer Science</strong>, has been 
                        consistently impressive.
                    </p>
                    <p style="margin-bottom: 15px;">
                        I can confidently confirm that Nashib Hossain completed his <strong>Bachelor of Science degree in Civil 
                        Engineering</strong> from Barishal Engineering College with outstanding academic achievements. Throughout his 
                        academic journey, he consistently maintained an impressive <strong>CGPA of 3.41 (up to the 7th semester)</strong>, reflecting 
                        his unwavering commitment to excellence.
                    </p>
                    <p style="margin-bottom: 15px;">
                        Under my guidance, Nashib undertook several research projects as part of his undergraduate studies. He 
                        exhibited remarkable leadership skills and was highly regarded by both his peers and faculty members. His 
                        ability to collaborate effectively within a team and work independently when 
                        required is truly commendable.
                    </p>
                    <p style="margin-bottom: 15px;">
                        Beyond the classroom, his exceptional work ethic is further exemplified by his self-driven approach to 
                        learning. He has demonstrated the capacity to master a wide range of subjects from diverse specializations. 
                        His dedication to research is particularly noteworthy. His work, 
                        <strong>"Sand Fineness Modulus Prediction in Construction Sector Using Convolutional Neural Network"</strong>, 
                        was published in a prestigious <strong>Q3 journal</strong>, and another paper achieved an outstanding 
                        <strong>impact factor of 7.2</strong>. These accomplishments underscore his remarkable scholarly abilities and unwavering 
                        passion for research and experimentation.
                    </p>
                    <p>
                        <strong>Md. Nashib Hossain</strong> is not only highly committed and tenacious but also possesses a genuine passion for 
                        advancing his knowledge and skills in his chosen field. I have been consistently impressed by his dedication 
                        and abilities, and I have no doubt that he will excel in any academic or research endeavor he undertakes. 
                        I wish him every success in his future endeavors.
                    </p>
                    <p>
                        <strong>Md. Nashib Hossain</strong> is not only highly committed and tenacious but also possesses a genuine passion for 
                        advancing his knowledge and skills in his chosen field. I have been consistently impressed by his dedication 
                        and abilities, and I have no doubt that he will excel in any academic or research endeavor he undertakes. 
                        I wish him every success in his future endeavors.
                    </p>
                </td>
            </tr>';
        $html.='
        <tr>
            <td  align="left" style="padding-top:100px" colspan="5">
                <div align="right">
                    <img  src="'.SIGNATURE_IMAGE.'" width="100" height="50" />
                    <span style="font-style:20px">
                        <br>
                            <span style="font-size:15px">
                            Md. Liton Rabbani <br>
                            Assistant Professor &amp; Head <br>
                            Department of Civil Engineering<br>
                            Barishal Engineering College, Barishal, Bangladesh.<br>
                            Cell: +8801745599180<br>
                            E-mail: litonkce01@gmail.com </span>
                        <br>
                    </span>
                </div>
            </td>
            <td align="right"  colspan="2">
                <img  src="'.$filepath.'" width="150" height="150" />
            </td>
        </tr>';
	    $html.='</table>';

// echo $html;
$mpdf = new \Mpdf\Mpdf([
    'tempDir' => __DIR__ . '/custom',
    'default_font_size' => 11, // Reduced font size
    'default_font' => 'FreeSerif',
    'margin_left' => 10, // Reduced margins
    'margin_right' => 10,
    'margin_top' => 2,
    'margin_bottom' => 2,
]);
// Force everything into a single page
$mpdf->SetCompression(true); // Enable content compression
$mpdf->shrink_tables_to_fit = 1; // Shrink tables if needed
$mpdf->SetAutoPageBreak(false); // Disable auto page breaks
$mpdf->SetDisplayMode('fullpage'); // Display in full-page mode

$html = '<style>
    body { font-size: 11px; line-height: 1.1; } 
    table { page-break-inside: avoid; } /* Prevent tables from breaking across pages */
</style>' . $html;
$html = '<style>
    body { transform: scale(0.95); transform-origin: top left; } 
</style>' . $html;
$mpdf->SetTitle('Notice Barisal Engineering College');
// $mpdf->SetFooter('Developed By Dhrubo Raj Roy');
$mpdf->WriteHTML($html);
$mpdf->output("../notice_files/".$file,'I');