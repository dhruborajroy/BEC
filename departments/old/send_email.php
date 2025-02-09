<?php
session_start();
include("../inc/connection.inc.php");
include("../inc/function.inc.php");
require_once("../inc/smtp/class.phpmailer.php");

// echo csrf();
if(isset($_POST['book_issue_id']) && $_POST['book_issue_id']!='' && isset($_POST['csrf_token']) && $_POST['csrf_token']=$_SESSION['csrf_token']){
    $book_issue_id=get_safe_value($_POST['book_issue_id']);
    // $return_date=date('d-m-Y h:i:s');
    $sql="SELECT book_issues.book_id,book_issues.user_id,book_issues.return_date, users.email, users.name from book_issues,users where book_issues.id='$book_issue_id'";
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        echo send_email($row['email'],'Please return book '.$row['book_id'],"Book Notification");
        // echo "done";
    }
}?>