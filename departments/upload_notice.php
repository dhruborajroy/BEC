<?php 
   define('SECURE_ACCESS', true);
   include("header.php");
   $title="";
   $date="";
   $id="";
   if(isset($_GET['id']) && $_GET['id']>0){
   	$id=get_safe_value($_GET['id']);
       $res=mysqli_query($con,"select * from `notice` where id='$id'");
       if(mysqli_num_rows($res)>0){
           $row=mysqli_fetch_assoc($res);
           $title=$row['title'];
           $date=$row['date'];
       }else{
           $_SESSION['TOASTR_MSG']=array(
              'type'=>'error',
              'body'=>'You don\'t have the permission to access the location!',    
              'title'=>'Error',
           );
           redirect("index.php");
       }
   }
   if(isset($_POST['submit'])){
      $title=get_safe_value($_POST['title']);
      $date=time();
      $user_id=$_SESSION['DEPT_ADMIN_ID'];
      if($id==''){
         $id=uniqid();
         $pdf=$id."_".time().'.pdf';
         move_uploaded_file($_FILES['notice_pdf']['tmp_name'],UPLOAD_NOTICE_PDF.$pdf);
         $sql="INSERT INTO `notice` (`id`, `title`, `link`,`dept`, `added_on`,`upload_status`,`user_id`, `status`) VALUES 
                                       ('$id', '$title',  '$pdf', '$dept_id','$date','1','$user_id', '1')";
         if(mysqli_query($con,$sql)){
               $_SESSION['TOASTR_MSG']=array(
                  'type'=>'success',
                  'body'=>'Data Inserted',
                  'title'=>'Success',
               );
         }else{
               echo $sql;
         }
      }
      redirect('./notices');
}
?>
<div class="dashboard-content-one">
<!-- Breadcubs Area Start Here -->
<div class="breadcrumbs-area">
   <h3>Notice board</h3>
   <ul>
      <li>
         <a href="index.php">Home</a>
      </li>
      <li>Notices </li>
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
                  <h3>Upload A Notice</h3>
               </div>
            </div>
            <form class="new-added-form" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-12-xxxl col-lg-6 col-12 form-group">
                     <label>Title</label>
                     <input type="text" required placeholder="" class="form-control" name="title" id="title"
                        value="<?php echo $title?>">
                  </div>
                  <div class="col-12-xxxl col-lg-12 col-12 ">
                     <label>Upload Files(Only PDF Format)</label>
                     <input required type="file" name="notice_pdf" id="pdfUpload" accept="application/pdf">
                  </div>
                  <!-- <div class="col-12-xxxl col-lg-6 col-12 form-group">
                     <label>Date</label>
                     <input type="text" name="date" placeholder="" class="form-control air-datepicker">
                     <i class="far fa-calendar-alt"></i>
                  </div> -->
                  <div class="col-12 form-group mg-t-8 mt-5 center">
                     <input type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark"
                        name="submit">
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
                  <h3>Notice Preview</h3>
               </div>
            </div>
            <div class="notice-board-wrap">
               <iframe id="pdfPreview" width="100%" height="500px" style="display: none;"></iframe>
            </div>
         </div>
      </div>
   </div>
   <!-- All Notice Area End Here -->
</div>
<?php include("footer.php")?>
<script>
   document.getElementById('pdfUpload').addEventListener('change', function(event) {
       let file = event.target.files[0]; // Get the uploaded file
   
       if (file && file.type === 'application/pdf') {
           let fileURL = URL.createObjectURL(file); // Create object URL
           let pdfPreview = document.getElementById('pdfPreview');
           pdfPreview.style.display = "block"; // Show the iframe
           pdfPreview.src = fileURL; // Set the file URL as iframe source
       } else {
           alert('Please upload a valid PDF file.');
       }
   });
</script>