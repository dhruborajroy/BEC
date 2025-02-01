<?php 
define('SECURE_ACCESS', true);
include("header.php");
if(isset($_GET['id']) && $_GET['id']!==""){
	$id=get_safe_value($_GET['id']);
    $swl="select services_request.*,services.name as service_name ,services.link as link,students.id as student_id,students.name as student_name,students.reg_no,batch.name as batch_name from services_request,students,services,batch  where (services_request.id)='$id' and students.id=services_request.student_id and services_request.type=services.id and students.batch=batch.id";
    $res=mysqli_query($con,$swl);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $student_id=$row['student_id'];
        $student_name=$row['student_name'];
        $service_name=$row['service_name'];
        $link=$row['link'];
        $reg_no=$row['reg_no'];
        $batch_name=$row['batch_name'];
        $reason=$row['reason'];
        $type=$row['type'];
        $status=$row['status'];
        $public_access=$row['public_access'];
        $added_on=$row['added_on'];
        $public_access=$row['public_access'];
        $downloadable=$row['downloadable'];
        $required='';
    }else{
        $_SESSION['TOASTR_MSG']=array(
           'type'=>'error',
           'body'=>'You don\'t have the permission to access the location!',    
           'title'=>'Error',
        );
      //   redirect("index.php");
    }
}
// $url=FRONT_SITE_PATH."/pdfreports/".$type"";
?>
<div class="dashboard-content-one">
<!-- Breadcubs Area Start Here -->
<div class="breadcrumbs-area">
   <h3>Service Print</h3>
   <ul>
      <li>
         <a href="index.php">Home</a>
      </li>
      <li>Service Print </li>
   </ul>
</div>
<!-- Breadcubs Area End Here -->
<div class="row">
   <!-- Add Notice Area Start Here -->
   <div class="col-4-xxxl col-12">
      <div class="card height-auto">
         <div class="card-body">
            <div class="heading-layout1">
               <div class="item-title">
                  <h3>Service Status</h3>
               </div>
            </div>
            <form class="new-added-form" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-12-xxxl col-lg-6 col-12 form-group">
                     <label>Student Name</label>
                     <input type="text" disabled placeholder="" class="form-control" name="title" id="title"
                           value="<?php echo $student_name?>">
                  </div>
                  <div class="col-12-xxxl col-lg-6 col-12 form-group">
                     <label>Reason</label>
                     <input type="text" disabled placeholder="" class="form-control" name="title" id="title"
                           value="<?php echo $reason?>">
                  </div>
                  <div class="col-12-xxxl col-lg-6 col-12 form-group">
                     <label>Service Type</label>
                     <input type="text" disabled placeholder="" class="form-control" name="title" id="title"
                           value="<?php echo $service_name?>">
                  </div>
                  <div class="col-12-xxxl col-lg-6 col-12 form-group">
                     <label>Batch</label>
                     <input type="text" disabled placeholder="" class="form-control" name="title" id="title"
                           value="<?php echo $batch_name?>">
                  </div>
                  <div class="col-12-xxxl col-lg-6 col-12 form-group row">
                     <div class="col-12-xxxl col-lg-2 col-12 form-group">
                           <label>Public Access</label>
                           <input class="form-control" disabled name="public_access" <?php echo $public_access == '1' ? 'checked' : ''; ?> type="checkbox" >
                     </div>
                     <div class="col-12-xxxl col-lg-2 col-12 form-group">
                           <label>Downloadable</label>
                           <input class="form-control" disabled name="downloadable" <?php echo $downloadable == '1' ? 'checked' : ''; ?> type="checkbox" >
                     </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-12 form-group">
                     <label>Action *</label>
                     <select class="select2" name="status" required>
                           <option selected disabled>Please Select status </option>
                           <?php
                     $data=[
                              'name'=>[
                                 'Approved',
                                 'Rejected',
                                 'Processing',
                              ]
                           ];
                           $count=count($data['name']);
                           for($i=0;$i<$count;$i++){
                              if($data['name'][$i]==$status){
                                 echo "<option selected='selected' value=".$data['name'][$i].">".$data['name'][$i]."</option>";
                              }                                                      
                           }
                     ?>
                     </select>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- Add Notice Area End Here -->
   <!-- All Notice Area Start Here -->
   <div class="col-8-xxxl col-12">
      <div class="card height-auto">
         <div class="card-body">
            <div class="heading-layout1">
               <div class="item-title">
                  <h3>Service Preview</h3>
               </div>
            </div>
            <div class="notice-board-wrap">
               <iframe id="pdfPreview" src="../pdfreports/<?php 
                  echo $link.".php?student_id=".md5($student_id);
               ?>" width="100%" height="750px" ></iframe>
            </div>
         </div>
      </div>
   </div>
   <!-- All Notice Area End Here -->
</div>
<?php include("footer.php")?>