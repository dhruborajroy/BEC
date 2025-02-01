<?php 
define('SECURE_ACCESS', true);
include("header.php");
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id'])){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='delete'){
		mysqli_query($con,"delete from about_us where id='$id'");
		redirect('about_us');
	}
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update about_us set status='$status' where id='$id'");
        redirect('./about_us');
	}

}
?>
<!-- Page Area Start Here -->
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>About Us</h3>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>About Us</li>
            </ul>
    </div>
    <!-- Breadcubs Area End Here -->

    
<?php 
$sql="select * from about_us";
$res=mysqli_query($con,$sql);
if(mysqli_num_rows($res)>0){
$i=1;
while($row=mysqli_fetch_assoc($res)){
?>
<div class="card ui-tab-card">
   <div class="card-body">
      
      <div class="heading-layout1 mg-b-25">
         <div class="item-title">
            <h3>About Us</h3>
         </div>
         <div class="dropdown">
               <a href="manage_about_us"> <button type="submit"
                     class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Edit</button>
               </a>
         </div>
      </div>
      <div class="basic-tab">
         <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
               <a class="nav-link active show" data-toggle="tab" href="#title" role="tab" aria-selected="true">
               Details
               </a>
            </li>
         </ul>
         <div class="tab-content">
                <div class="tab-pane fade active show col-12 form-group" id="title" role="tabpanel">
                    <div class="col-12 form-group mg-t-8">
                        <h1><?php echo $row['title']?>
                        </h1>
                        <p><?php echo $row['details']?>
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade show col-12 form-group" id="details" role="tabpanel">
                    <div class="col-12 form-group mg-t-8">
                        <p><?php echo $row['details']?>
                        </p>
                    </div>
                    
                </div>
         </div>
      </div>
   </div>
</div>

<?php 
$i++;
} } else { ?>
No data found
<?php } ?>
<?php include('footer.php');?>