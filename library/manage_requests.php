<?php
define('SECURE_ACCESS', true);
include('header.php');
$id="";
$book_id='';
$user_id='';
$added_on='';
$added_on='';
$updated_on='';
$note='';
$status='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($_GET['id']);
    $res=mysqli_query($con,"select * from book_requests where id='$id'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $book_id=$row['book_id'];
        $user_id=$row['user_id'];
        $added_on=$row['added_on'];
        $updated_on=$row['updated_on'];
        $note=$row['note'];
        $status=$row['status'];
    }else{
        redirect("index.php");
    }
}
if(isset($_POST['submit'])){
	$book_id=get_safe_value($_POST['book_id']);
	$user_id=get_safe_value($_POST['user_id']);
	$added_on=date('d-m-Y h:i:s');
	$updated_on=date('d-m-Y h:i:s');
	$note=get_safe_value($_POST['note']);
	$status=get_safe_value($_POST['status']);
   if($id==''){
        $id=uniqid();
        $sql="INSERT INTO `book_requests` (`id`, `book_id`,`user_id`, `added_on`, `note`, `updated_on`, `status`) VALUES 
                                        ('$id', '$book_id','$user_id', '$added_on', '$note','$updated_on', '$status')";
        mysqli_query($con,$sql);
        $_SESSION['INSERT']=1;
    }else{
        $sql="update `book_requests` set  `book_id`='$book_id', `user_id`='$user_id', `updated_on`='$updated_on', `status`='$status' where id='$id'";
        mysqli_query($con,$sql);    
        $_SESSION['UPDATE']=1;
    }
    // $sql;
    redirect('./requested_books.php');
}
?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
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
            <form class="new-added-form" method="post">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Books *</label>
                        <select class="form-control select2" name="book_id">
                            <option disabled selected>Select Book</option>
                            <?php
                            $res=mysqli_query($con,"SELECT * FROM `book`");
                            while($row=mysqli_fetch_assoc($res)){
                                if($row['id']==$book_id){
                                    echo "<option selected='selected' value=".$row['id'].">".$row['title']." (Accession-".$row['accession'].")"."</option>";
                                }else{
                                    echo "<option value=".$row['id'].">".$row['title']." (Accession-".$row['accession'].")"."</option>";
                                }                                                        
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>User *</label>
                        <select class="form-control select2" name="user_id">
                            <option disabled selected>Select User</option>
                            <?php
                            $res=mysqli_query($con,"SELECT * FROM `students` where status='1'");
                            while($row=mysqli_fetch_assoc($res)){
                                if($row['id']==$user_id){
                                    echo "<option selected='selected' value=".$row['id'].">".$row['name']."(".$row['id'].")"."</option>";
                                }else{
                                    echo "<option value=".$row['id'].">".$row['name']." (".$row['class_roll'].")"."</option>";
                                }                                                        
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Status</label>
                        <select class="select2" name="status" required>
                            <?php
                            $data=[
                                'Pending',
                                'Accepted',
                                'Rejected',
                            ];
                            foreach($data as $key=>$val){
                                if($key==$status){
                                    echo "<option selected='selected' value=".$key.">".$val."</option>";
                                }else{
                                    echo "<option  value=".$key.">".$val."</option>";
                                }                                                        
                            }                              
                        ?>
                        </select>
                        <?php
                            $data=[
                                'name'=>[
                                    'Pending',
                                    'Accepted',
                                    'Rejected',
                                ]
                            ];
                            // pr($data['name']);  
                            ?>
                        <!-- </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Status</label>
                        <select class="select2" name="Status" required>
                            <?php
                            // $data=[
                            //     'name'=>[
                            //         'No',
                            //         'Yes',
                            //     ]
                            // ];
                            // $count=count($data['name']);
                            // for($i=0;$i<$count;$i++){
                            //     if($data['name'][$i]==$status){
                            //         echo "<option selected='selected' value=".$data['name'][$i].">".$data['name'][$i]."</option>";
                            //     }else{
                            //         echo "<option value=".$data['name'][$i].">".$data['name'][$i]."</option>";
                            //     }                                                        
                            // }                                       
                        ?>
                        </select>
                    </div> -->
                        <div class="col-md-6 form-group"></div>
                        <div class="">
                            <div class="class=" col-xl-6 col-lg-12 col-12 form-group row">
                                <label for="">Note</label>
                                <textarea class="textarea form-control" name="note" id="form-message" cols="10"
                                    rows="9"><?php echo $note?></textarea>
                            </div>
                        </div>
                        <div class="col-12 form-group mg-t-8">
                            <button name="submit" type="submit"
                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <!-- Add Class Area End Here -->
    <?php include('footer.php');?>