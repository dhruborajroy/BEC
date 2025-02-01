<?php 
define('SECURE_ACCESS', true);
include('header.php');
$id="";
$book='';
$book_id='';
$issued_date=time();
$expire_date=strtotime("+15 day");
$return_date='';
$penalty='';
$user_id='';
$book_copy='';
$update="";
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($_GET['id']);
    $res=mysqli_query($con,"select * from book_issues where id='$id'");
    if(mysqli_num_rows($res)>0){
        $update=true;
        $row=mysqli_fetch_assoc($res);
        $book_id=$row['book_id'];
        $expire_date=$row['expire_date'];
        $return_date=$row['return_date'];
        $penalty=$row['penalty'];
        $user_id=$row['user_id'];
        $book_copy=$row['book_copy'];
        $issued_date=$row['issued_date'];
    }else{
        redirect("index.php");
    }
}
if(isset($_POST['submit']) && isset($_POST['csrf_token']) ){
    if($_POST['csrf_token']!=$_SESSION['csrf_token']){
        die("You don't have permission to access that location");
    }
	$book_id=get_safe_value($_POST['book_id']);
	$book_copy=get_safe_value($_POST['book_copy']);
	$user_id=get_safe_value($_POST['user_id']);
	$issued_date=time();
    $date=strtotime(date('Y-m-d h:i:s'));
    $date = date("Y-m-d", strtotime($date ." +15 day"));
	$expire_date=strtotime($date);
   if($id==''){
        $id=uniqid();
        $sql="INSERT INTO `book_issues` (`id`, `book_id`, `book_copy`,`user_id`, `issued_date`, `expire_date`, `return_status`,`return_date`, `penalty`, `lost`, `status`) VALUES 
                                        ('$id', '$book_id', '$book_copy','$user_id', '$issued_date', '$expire_date', '0', 0,'$penalty', '0', '1')";
        $rees=mysqli_query($con,"select * from book where book.id='$book_id'");
        $roww=mysqli_fetch_assoc($rees);
        $swl="update book set copies_have='".(intval($roww['copies_have'])-1)."' where book.id='$book_id'";
        if(mysqli_query($con,$sql)){
            if(mysqli_query($con,$swl)){
                $html=send_issue_email($id);
                $user_email=mysqli_fetch_assoc(mysqli_query($con,"Select email,name,phoneNumber from users where users.id='$user_id'"));
                // $send_email= send_email($user_email['email'],$html,"Book Issuence Email");
                $send_email="done";
                if($send_email=='done'){
                    // $sms="Dear ".$user_email['name'].", Dynamics of Structures [240-002] copy of book has been issued to you. Please return it by the expire date. Happy Reading -Central Library, BEC";
                    // send_sms_greenweb($user_email['phoneNumber'],$sms);
                    redirect('./book_issues.php');
                }
            }
        }
    }else{
        $sql="update `book_issues` set `book_id`='$book_id',`book_copy`='$book_copy', `user_id`='$user_id' , `expire_date`='$expire_date',  `penalty`='$penalty'  where id='$id'";
        if(mysqli_query($con,$sql)){
            redirect('./book_issues.php');
        }
    }
    // echo $sql;
}
?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Book Issuence</h3>
            <ul>
                <li>
                    <a href="index">Home</a>
                </li>
                <li>Manage Book Issuence</li>
            </ul>
    </div>
    <!-- Breadcubs Area End Here -->

    <!-- Add Class Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Book Issues</h3>
                </div>
            </div>
            <form class="new-added-form" id="validate" method="post">
                <?php echo form_csrf()?>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>User *</label>
                        <select class="form-control select2" name="user_id" id="user_id" >
                            <option disabled selected>Select User</option>
                            <?php
                            $res=mysqli_query($con,"SELECT * FROM `students` where status='1'");
                            while($row=mysqli_fetch_assoc($res)){
                                if($row['id']==$user_id){
                                    echo "<option selected='selected' value=".$row['id'].">".$row['name']."</option>";
                                }else{
                                    if($update!==true){
                                        echo "<option value=".$row['id'].">".$row['name']." (".$row['class_roll'].")"."</option>";
                                    }
                                }                                                        
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Books *</label>
                        <select class="form-control " name="book_id" id="book_id">
                            <option disabled selected>Select Book</option>
                            <?php
                            $res=mysqli_query($con,"SELECT * FROM `book` where status='1'");
                            while($row=mysqli_fetch_assoc($res)){
                                if($row['id']==$book_id){
                                    echo "<option selected='selected' value=".$row['id'].">".$row['title']." (Accession-".$row['accession'].")"."</option>";
                                }else{
                                    if($update!==true){
                                        echo "<option value=".$row['id'].">".$row['title']." (Accession-".$row['accession'].")"."</option>";
                                    }
                                }                                                        
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group" >
                        <label>Book Copy *</label>
                        <select class="form-control  book_copy select2" require="required" name="book_copy" id="book_copy">
                            <option disabled selected>Select Book copy</option>
                            <?php
                                if($book_copy!=""){
                                    echo "<option selected='selected' value=".$book_copy.">".set_zero($book_copy)."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Issue Date</label>
                        <input type="text" placeholder="dd/mm/yyyy" name="issue_date" class="form-control "
                            id="future-air-datepicker issue_date" data-position="bottom right"
                            value="<?php if (!empty($issued_date)) {
                            echo date('d/m/Y', strtotime($issued_date));
                            } else {
                                echo 'Invalid date';
                            }
                            ?>" readonly>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Expire Date</label>
                        <input type="text" placeholder="Expire Date" name="expire_date" ID="expire_date" readonly
                            class="form-control air-datepicker" value="<?php echo date('d/m/Y ',strtotime($expire_date))?>">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Return Date</label>
                        <input type="text" placeholder="Return Date" value="<?php 
                        if($return_date!=""){
                            echo date('d/m/Y h:i A',$return_date);
                        }?>"
                            name="return_date" id="return_date" class="form-control air-datepicker"
                            data-position="bottom right" readonly>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <div class="col-md-6 form-group"></div>
                        <div class="col-12 form-group mg-t-8">
                            <button name="submit" id="submit" type="submit"
                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <!-- Add Class Area End Here -->
    <br>
    <!-- Add Class Area Start Here -->
    <!-- <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Book Issues</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title (Accession- Copy)</th>
                            <th>Student's Name</th>
                            <th>Issued Date</th>
                            <th>Return Status</th>
                            <th>Return Date</th>
                            <th>Lost</th>
                        </tr>
                    </thead>
                </table>
            </div>
                        
        </div>
    </div> -->
    <!-- Add Class Area End Here -->
    <?php include('footer.php');?>

    <script>
        $(document).on("change","#book_id",function(e){
            e.preventDefault();
            // var copy= $('#book_copy').val();
            // copy=$("select#book_copy option").filter(":selected").val();
            // console.log(copy);
        });
        $(document).on("change","#book_id",function(e){
            e.preventDefault();
            var id= $(this).val();
            var user_id= $('#user_id').val();
            $.ajax ({
                    url:'./ajax/getBookInfo',
                    type:'post',
                    data:"type=getCount&book_id="+id+"&user_id="+user_id,
                    success: function(result){
                        if(result=='already_issued_to_this_user'){
                            swal({
                                title: "Error",
                                text: "This book is already issued to this user. You can't issue an another copy of book to this user!",
                                icon: "warning",
                                dangerMode: true,
                            }).then((value)=>{
                                if(value==true){
                                    location.reload();
                                }
                            });
                            jQuery('#submit').prop("disabled","disabled");
                        }else{
                            if(result!="no_copy_available"){
                                $("#book_copy").html(result);
                                jQuery('#submit').prop("disabled",false);
                            }else{
                                swal({
                                    title: "Sorry",
                                    text: "No copy of book is available!",
                                    icon: "warning",
                                    dangerMode: true,
                                });
                                // .then((value)=>{
                                //     if(value==true){
                                //         location.reload();
                                //     }
                                // });
                                jQuery('#submit').prop("disabled","disabled");
                                $("#book_copy").html('<option value="none" selected> No copy of book is available</option>');
                            }
                        }
                    }
                });
        });

        // $(document).on("change","#user_id",function(e){
        //     e.preventDefault();
        //     var user_id= $('#user_id').val();
        //     // alert();
        //     // $('#myTable').DataTable( {
        //     //     ajax: {
        //     //         url:'./ajax/getUserHistory.php',
        //     //         type:'post',
        //     //         data:"&user_id="+user_id,
        //     //         success: function(result){
        //     //             console.log(result);
        //     //         }
        //     //     },
        //     //     columns: [        
        //     //         { data: 'name' },
        //     //     ],
        //     // } );
        //     $('#myTable').DataTable( {
        //         ajax: './ajax/getUserHistory.php',
        //         columns: [
        //             { data: 'name' },
        //             { data: 'position' },
        //             { data: 'salary' },
        //             { data: 'state_date' },
        //             { data: 'office' },
        //             { data: 'extn' }
        //         ]
        //     } );
        // });
        

    </script>