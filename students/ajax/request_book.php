<?php
define('SECURE_ACCESS', true);
include("../../inc/connection.inc.php");
include("../../inc/function.inc.php");
session_start();
if(isset($_POST['book_id']) && $_POST['book_id']!='' && isset($_POST['csrf_token']) && $_POST['csrf_token']!='' && $_POST['csrf_token']==$_SESSION['csrf_token']){
    $book_id=get_safe_value($_POST['book_id']);
    $return_date=date('d-m-Y h:i:s');
	$added_on=date('d-m-Y h:i:s');
	$updated_on="";
    $note="";
    $user_id=$_SESSION['USER_ID'];
    $res=mysqli_query($con,"select id from book_requests where book_id='$book_id' and user_id='$user_id' and status='0'");
    if(mysqli_num_rows($res)>0){
        echo "requested";
    }else{
        $id=uniqid();
        $sql="INSERT INTO `book_requests` (`id`, `book_id`,`user_id`, `added_on`, `note`, `updated_on`, `status`) VALUES 
                                            ('$id', '$book_id','$user_id', '$added_on', '$note','$updated_on', '0')";
        mysqli_query($con,$sql);
        // echo "done";
        if(mysqli_affected_rows($con)>0){
            echo "done";
        }else{
            echo "wrong";
        }
    }
}?>