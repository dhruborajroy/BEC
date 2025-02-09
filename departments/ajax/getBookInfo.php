<?php

define('SECURE_ACCESS', true);
include("../../inc/connection.inc.php");
include("../../inc/constant.inc.php");
include("../../inc/function.inc.php");
$database_book_array=[];
$issued_book_array=[];

if(isset($_POST['book_id']) && isset($_POST['user_id'])) {
    $book_id=get_safe_value($_POST['book_id']);
    $user_id=get_safe_value($_POST['user_id']);
    $sql="select `book_issues`.* from book_issues where book_issues.book_id='".$book_id."' and user_id='$user_id'  and return_status!='1'";
    $issued_res=mysqli_query($con,$sql);
    if(mysqli_num_rows($issued_res)>0){
        echo "already_issued_to_this_user";
    }else{
        $sql="select `book`.`copies_owned` from book where book.id='".$book_id."'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($res);
        $copies_array=[];
        $copies=$row['copies_owned'];
        for ($i=1; $i <= $copies; $i++) {
            $copies_array[]=$i;
        }
        $sql="select `book_issues`.* from book_issues where book_issues.book_id='".$book_id."' and return_status!='1'";
        $already_issued_res=mysqli_query($con,$sql);
        mysqli_num_rows($already_issued_res);
        $row_count=mysqli_num_rows($already_issued_res);
        if($row_count==$row['copies_owned']){
            echo 'no_copy_available';
        }else{
            if($row_count>0){
                foreach ($already_issued_res as $already_issued_copy){
                    $already_issued_copy_array[]=$already_issued_copy;
                }
                $count=count($already_issued_copy_array);
                for ($i=0; $i < $count; $i++){
                    $book_copy_array[]=$already_issued_copy_array[$i]['book_copy'];
                }
                foreach ($book_copy_array as $delete_value){
                    if(($key=array_search($delete_value,$copies_array)) !== false){
                        unset($copies_array[$key]);
                    }
                }
                foreach ($copies_array as $key=>$val){
                    echo '<option value="'.$val.'">'.set_zero($val).'</option>';
                }
            }else{
                foreach ($copies_array as $key=>$val){
                    echo '<option value="'.$val.'">'.set_zero($val).'</option>';
                }
            }
        }
    }
}
?>