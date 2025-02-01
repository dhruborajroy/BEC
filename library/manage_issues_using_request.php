<?php 
define('SECURE_ACCESS', true);
include('header.php');
$id="";
$book='';
$book_id='';
$issued_date=time();
// $issued_date=date('d-m-Y h:i:s');
$expire_date=strtotime("+15 day");
$return_date='';
$penalty='';
$user_id='';
$book_copy='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($_GET['id']);
    $request_id=$id;
    $res=mysqli_query($con,"select * from book_requests where id='$id'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $book_id=$row['book_id'];
        $user_id=$row['user_id'];
        $note=$row['note'];
        $status=$row['status'];
        $user_id=$row['user_id'];
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
	$issued_date=date('d-m-Y');
	$expire_date=date('d-m-Y',strtotime("+15 day"));
	// $lost=get_safe_value($_POST['lost']);
   if($id==''){
        redirect("index");
    }else{
        $id=uniqid();
        $swl="INSERT INTO `book_issues` (`id`, `book_id`, `book_copy`,`user_id`, `issued_date`, `expire_date`, `return_status`,`return_date`, `penalty`, `lost`, `status`) VALUES 
                                        ('$id', '$book_id', '$book_copy','$user_id', '$issued_date', '$expire_date', '0', 0,'$penalty', '0', '1')";
        if(mysqli_query($con,$swl)){
            $sql="UPDATE book SET copies_have=copies_have-1 WHERE book.id='$book_id'";
            if(mysqli_query($con,$sql)){
                $_SESSION['UPDATE']=1;
                $sql="UPDATE book_requests SET status=2 WHERE book_requests.id='$request_id'";
                if(mysqli_query($con,$sql)){
                    redirect('./book_issues.php');
                }
            }
        }
    }
    // echo $swl;
    // echo $sql;
}
?>
<div class="dashboard-content-one" id="load" onload="getBookCopy()">
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
                                    // echo "<option value=".$row['id'].">".$row['name']." (".$row['roll'].")"."</option>";
                                }                                                        
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Books *</label>
                        <select class="form-control select2 " name="book_id" id="book_id">
                            <option disabled selected>Select Book</option>
                            <?php
                            $res=mysqli_query($con,"SELECT * FROM `book`");
                            while($row=mysqli_fetch_assoc($res)){
                                if($row['id']==$book_id){
                                    echo "<option selected='selected' value=".$row['id'].">".$row['title']." (Accession-".$row['accession'].")"."</option>";
                                }else{
                                    // echo "<option value=".$row['id'].">".$row['title']." (Accession-".$row['accession'].")"."</option>";
                                }                                                        
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group" >
                        <label>Book Copy *</label>
                        <select class="form-control  book_copy select2" require="required" name="book_copy" id="book_copy">
                            <option disabled selected>Select Book Copy</option>
                            <?php
                                if($book_copy!=""){
                                    echo "<option selected='selected' value=".$book_copy.">".set_zero($book_copy)."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group" >
                        <label></label>
                        <button type="button" class="btn-fill-md text-orange-peel border-orange-peel" id="getBookCopy">Get Available Copyies</button>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Issue Date</label>
                        <input type="text" placeholder="dd/mm/yyyy" name="issue_date" class="form-control "
                            id="future-air-datepicker issue_date" data-position="bottom right"
                            value="<?php echo date('d/m/Y h:i',$issued_date)?>" readonly>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Expire Date</label>
                        <input type="text" placeholder="Expire Date" name="expire_date" ID="expire_date" readonly
                            class="form-control air-datepicker" value="<?php echo date('d/m/Y h:i',$expire_date)?>">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Return Date</label>
                        <input type="text" placeholder="Return Date" value="<?php echo $return_date?>"
                            name="return_date" id="return_date" class="form-control air-datepicker"
                            data-position="bottom right">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <div class="col-md-6 form-group"></div>
                        <div class="col-12 form-group mg-t-8">
                            <button name="submit" id="submit" type="submit"
                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" disabled="disabled">Save</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <!-- Add Class Area End Here -->
    <?php include('footer.php');?>

    <script>
        $(document).on("click","#getBookCopy",function(e){
            e.preventDefault();
            var book_id= $('#book_id').val();
            var user_id= $('#user_id').val();
            $.ajax ({
                url:'./ajax/getBookInfo',
                type:'post',
                data:"type=getCount&book_id="+book_id+"&user_id="+user_id,
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
                        console.log(result);
                        $("#book_copy").html(result);
                        jQuery('#submit').prop("disabled",false);
                    }
                }
            });
        })

    </script>