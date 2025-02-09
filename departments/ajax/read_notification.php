<?php
include("./inc/connection.inc.php");
include("./inc/function.inc.php");
if(isset($_POST['time']) && $_POST['time']!=''  && isset($_POST['csrf_token']) && $_POST['csrf_token']!='' ){
    $time=time();
    $_SESSION['LAST_NOTIFICATION']=$time;
    $user_id=$_SESSION['USER_ID'];
    // $return_date=date('d-m-Y h:i:s');
    $sql="UPDATE admin SET last_notification='$time'  WHERE users.id='$user_id'";
    mysqli_query($con,$sql);
    if(mysqli_affected_rows($con)>0){
        echo "done";
    }else{
        echo "wrong";
    }
}
?>