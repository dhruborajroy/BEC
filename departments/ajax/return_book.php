<?php
define('SECURE_ACCESS', true);
include("../../inc/connection.inc.php");
include("../../inc/function.inc.php");
// $sql="UPDATE book_issues,book SET book_issues.return_status='1' and book.copies_have=book.copies_have+1   WHERE book_issues.id='$issue_id' and book.id=book_issues.book_id;";
if(isset($_POST['issue_id']) && $_POST['issue_id']!=''){
    $issue_id=get_safe_value($_POST['issue_id']);
    $return_date=time();
    $sql="UPDATE book_issues SET return_status='1' , return_date='$return_date' WHERE book_issues.id='$issue_id'";
    mysqli_query($con,$sql);
    $swl="select book_id from book_issues where  book_issues.id='$issue_id'";
    $res=mysqli_query($con,$swl);
    $row=mysqli_fetch_assoc($res);
    $book_id=$row['book_id'];
    $sql="UPDATE book SET copies_have=copies_have+1 WHERE book.id='$book_id'";
    mysqli_query($con,$sql);
    if(mysqli_affected_rows($con)>0){
        echo "done";
    }else{
        echo "wrong";
    }
}?>