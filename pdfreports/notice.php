<?php
define('SECURE_ACCESS', true);
include("../inc/constant.inc.php");
include("../inc/connection.inc.php");
include("../inc/function.inc.php");
include("../inc/en2bn.php");
require('../inc/vendor/autoload.php');
require_once("../inc/phpqrcode/qrlib.php");
header('Content-Type: text/html; charset=utf-8');
if (isset($_GET['notice_id']) && $_GET['notice_id']!="") {
    $notice_id=get_safe_value($_GET['notice_id']);
}else{
    $_SESSION['PERMISSION_ERROR']=1;
    redirect("/");
}
$sql="select * from `notice` where id='$notice_id' and upload_status='0'";
$res=mysqli_query($con,$sql);
$html="";

$filepath = "../images/qr_code/qrcode.png";
if(mysqli_num_rows($res)>0){
    $row=mysqli_fetch_assoc($res);
    $file=$notice_id.'_'.time().'.pdf';
    QRcode::png(FRONT_SITE_PATH."notice_files/".$file, $filepath);
    
    $html='<table class="table" width="100%">';

    $html.='
        <tr>
            <td align="left">                    
                <img  src="'.BD_LOGO.'" width="100" height="100" /> 
            </td>
            <td  align="center" colspan="5">
                <span style="font-size:20px">'.NAME.'</span>
                <br>
                '.ADDRESS.'
                <br>
                Tel: '.TEL.' | Email: '.EMAIL.'
                <br>
                '.FRONT_SITE_PATH.'
            </td>
            <td align="right">                    
                <img  src="'.LOGO.'" width="100" height="100" /> 
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
                    স্মারক নং: '.$row['reference'].'
                </td>
                <td  align="right" colspan="3">
                    তারিখ: '.Bengali_DTN(date("d F Y ",($row['added_on']))).' ইং
                </td>
            </tr>';
            $html.='
                <tr>
                    <td align="center" colspan="7"  style="padding-top:30px">                    
                    <u style="font-size:35px">'.$row['title'].'</u>
                    </td>
                </tr>';
                $html.='
                    <tr >
                        <td align="left" colspan="7"  style="padding-top:10px">                    
                            <p style="text-align: justify !important;text-justify: inter-word  !important;">'.$row['details'].'</p>
                        </td>
                    </tr>';
            $html.='
            <tr>
                <td align="left"  colspan="1">
                    <img width="150" src="'.$filepath.'" width="100" height="100" />
                </td>
                <td  align="center" colspan="3"> 
                </td>
                <td  align="center" style="padding-top:100px" colspan="4">
                    <div align="right">
                        <img  src="'.SIGNATURE_IMAGE.'" width="100" height="50" />
                        <span style="font-style:30px">
                            <br>
                                <span style="font-size:20px">'.SIGNATURE_NAME.' </span>
                            <br>
                        </span>
                    </div>
                </td>
            </tr>';
            $html .= '
            <tr>
                <td align="left" colspan="7">
                    <ol>';
                    $notice_sql = "SELECT referances.name 
                                    FROM referances 
                                    INNER JOIN notice_referance ON referances.id = notice_referance.referance_id 
                                    INNER JOIN notice ON notice.id = notice_referance.notice_id 
                                    WHERE notice.id = '$notice_id' 
                                    ORDER BY referances.priority ASC";
                    $notice_res = mysqli_query($con, $notice_sql);
                    if(mysqli_num_rows($notice_res)>0){
                        $html .=  "<u >সদয় অবগতি ও প্রয়োজনীয় কার্যার্থে অনুলিপি(জেষ্ঠতার ভিত্তিতে নয়):</u>";
                    }
                    while ($notice_res_row = mysqli_fetch_assoc($notice_res)) {
                        $html .= '<li>' . $notice_res_row['name'] . '</li>';
                    }
                    
                    $html .= '
                    </ol>
                </td>
            </tr>';
        
	    $html.='</table>';
}else{
    redirect("/");
}
// echo $html;
$mpdf=new \Mpdf\Mpdf([
    'tempDir' => __DIR__ . '/custom',
    'default_font_size' => 12,
    'default_font' => 'FreeSerif',
	'margin_left' => 20,
	'margin_right' => 20,
	'margin_top' => 2,
	'margin_bottom' => 10,
]);
$mpdf->SetTitle('Notice Barisal Engineering College');
$mpdf->SetFooter('Developed By The Web divers');
$mpdf->WriteHTML($html);
// if($row['link']==""){
    $mpdf->output("../notice_files/".$file,'F');
    $mpdf->output("../notice_files/".$file,'I');
    $sql="UPDATE `notice` SET `link` = '$file' WHERE `notice`.`id` = '$notice_id'";
    mysqli_query($con,$sql);
// }
// redirect("../webadmin/notices");