<?php
define('SECURE_ACCESS', true);
include("../../inc/connection.inc.php");
include("../../inc/function.inc.php");

// if(isset($_POST['book_request_id']) && $_POST['book_request_id']!=''  && isset($_POST['csrf_token']) && $_POST['csrf_token']!='' && $_POST['csrf_token']==$_SESSION['csrf_token']){
    if(isset($_POST['type']) && $_POST['type']=='accept'){
        if(isset($_POST['book_request_id']) && $_POST['book_request_id']!=''  && isset($_POST['csrf_token']) && $_POST['csrf_token']!=''){
            $book_request_id=get_safe_value($_POST['book_request_id']);
            $sql="UPDATE book_requests SET status=1 WHERE id='$book_request_id'";
            mysqli_query($con,$sql);
            if(mysqli_affected_rows($con)>0){
                echo "accept_done";
            }else{
                echo "accept_wrong";
            }
        }
    }
    else if(isset($_POST['type']) && $_POST['type']=='reject'){
        if(isset($_POST['book_request_id']) && $_POST['book_request_id']!=''  && isset($_POST['csrf_token']) && $_POST['csrf_token']!=''){
            $book_request_id=get_safe_value($_POST['book_request_id']);
            $sql="UPDATE book_requests SET status=0 WHERE id='$book_request_id'";
            mysqli_query($con,$sql);
            if(mysqli_affected_rows($con)>0){
                echo "reject_done";
            }else{
                echo "reject_wrong";
            }
        }
    }
    else if(isset($_POST['type']) && $_POST['type']=='issue'){
        if(isset($_POST['book_request_id']) && $_POST['book_request_id']!=''  && isset($_POST['csrf_token']) && $_POST['csrf_token']!=''){
            $book_request_id=get_safe_value($_POST['book_request_id']);
            $sql="select * from book_requests WHERE id='$book_request_id'";
            $res=mysqli_query($con,$sql);
            if(mysqli_num_rows($res)>0){
                $id=uniqid();
                $row=mysqli_fetch_assoc($res);
                $book_id=$row['book_id'];
                $issued_date=time();
	            $expire_date=date('d-m-Y ',strtotime("+15 day"));
                $user_id=$row['user_id'];
                $sql="INSERT INTO `book_issues` (`id`, `book_id`,`user_id`, `issued_date`, `expire_date`, `return_status`,`return_date`, `penalty`, `lost`, `status`) VALUES 
                                        ('$id', '$book_id','$user_id', '$issued_date', '$expire_date', '', 0,'0', '0', '1')";
                mysqli_query($con,$sql);
                $sql="UPDATE book_requests SET status=2 WHERE id='$book_request_id'";
                mysqli_query($con,$sql);
                // echo "book_issued";
            }else{
                // echo "issence_wrong";
            }
        }
    }
?>