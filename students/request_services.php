<?php 
define('SECURE_ACCESS', true);
include("header.php");
$msg="";
$type="";
if(isset($_POST['submit'])){
	$reason=get_safe_value($_POST['reason']);
	$type=get_safe_value($_POST['type']);
    $user_id=$_SESSION['USER_ID'];
    $time=time();
    $id=uniqid();
    // echo "select id from services where student_id='$user_id' and type='$type'";
    echo $sqqql="select id from services_request where student_id='$user_id' and type='$type' and status!='Approved'";
    if(mysqli_num_rows(mysqli_query($con,$sqqql))>0){
        $msg='<div class="alert alert-danger col-lg-12" role="alert">
                Services already applied.
            </div>';
    }else{
        $sql="INSERT INTO `services_request` (`id`, `student_id`, `type`, `reason`, `public_access`,  `added_on`, `status`) VALUES 
            ('$id', '$user_id', '$type', '$reason', '0','$time', '0')";
        if(mysqli_query($con,$sql)){
        $_SESSION['TOASTR_MSG']=array(
        'type'=>'success',                
        'body'=>'Data Updated',
        'title'=>'Success',
        );
        redirect('./index');
        }else{
        echo $sql;
        }
    }
}
?>

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Services</div>
                                    <div class="card-body">

                                        <div class="card-title">
                                            <h3 class="text-center title-2">Apply for online Services</h3>
                                            <?php echo $msg?>
                                        </div>
                                        <hr>

                                        <form method="post" >
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class="form-control-label"><h1>Reason</h1></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="reason"required  id="textarea-input" rows="9" placeholder="Please Specify Reason and the name of faculty by whom you want recommendation letter " class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="selectLg" class=" form-control-label">Select Large</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="type" required id="selectLg" class="form-control-lg form-control">
                                                    <option disabled selected>Please Select Service Type </option>
                                                    <?php
                                                        $res=mysqli_query($con,"SELECT * FROM `services` where status='1'");
                                                        while($row=mysqli_fetch_assoc($res)){
                                                            if($row['id']==$type){
                                                                echo "<option selected='selected' value=".$row['id'].">".$row['name']."</option>";
                                                            }else{
                                                                echo "<option value=".$row['id'].">".$row['name']."</option>";
                                                            }                                                        
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Submit</span>
                                                    <!-- <span id="payment-button-sending" style="display:none;">Sending…</span> -->
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
<?php 
include("footer.php");
?>