<?php 
define('SECURE_ACCESS', true);
include("header.php");
?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Dept About Us</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Dept About Us</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
<?php 
$sql="select * from dept_general_info";
$res=mysqli_query($con,$sql);
if(mysqli_num_rows($res)>0){
$i=1;
while($row=mysqli_fetch_assoc($res)){
?>
<div class="card ui-tab-card">
   <div class="card-body">
      
      <div class="heading-layout1 mg-b-25">
         <div class="item-title">
            <h3><?php echo $row['dept_id']?> Dept Infos</h3>
         </div>
         <div class="dropdown">
               <a href="manage_dept_info?dept_id=<?php echo md5( $row['dept_id'])?>"> <button type="submit"
                     class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Edit <?php echo $row['dept_id']?> Dept Info</button>
               </a>
         </div>
      </div>
      <div class="basic-tab">
         <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
               <a class="nav-link active show" data-toggle="tab" href="#<?php echo $row['dept_id']?>_dept_publication" role="tab" aria-selected="true">
               Publications
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#<?php echo $row['dept_id']?>_dept_research" role="tab" aria-selected="false">
               Dept Research
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#<?php echo $row['dept_id']?>_dept_scholarships" role="tab" aria-selected="false">
               Dept scholarships
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#<?php echo $row['dept_id']?>_dept_about" role="tab" aria-selected="false">
                 Dept about
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#<?php echo $row['dept_id']?>_dept_vision_mission" role="tab" aria-selected="false">
               Dept vision mission
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#<?php echo $row['dept_id']?>_dept_head_msg" role="tab" aria-selected="false">
               Dept Head Message
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#<?php echo $row['dept_id']?>_dept_booklet" role="tab" aria-selected="false">
               Dept booklet
               </a>
            </li>
         </ul>
         <div class="tab-content">
                <div class="tab-pane fade active show col-12 form-group" id="<?php echo $row['dept_id']?>_dept_publication" role="tabpanel">
                    <div class="col-12 form-group mg-t-8">
                        <p><?php echo $row['dept_publication']?>
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade show col-12 form-group" id="<?php echo $row['dept_id']?>_dept_research" role="tabpanel">
                    <div class="col-12 form-group mg-t-8">
                        <p><?php echo $row['dept_research']?>
                        </p>
                    </div>
                    
                </div>
                <div class="tab-pane fade  show col-12 form-group" id="<?php echo $row['dept_id']?>_dept_scholarships" role="tabpanel">
                    <div class="col-12 form-group mg-t-8">
                        <p><?php echo $row['dept_scholarships']?>
                        </p>
                    </div>
                    
                </div>
                <div class="tab-pane fade  show col-12 form-group" id="<?php echo $row['dept_id']?>_dept_about" role="tabpanel">
                    <div class="col-12 form-group mg-t-8">
                        <p><?php echo $row['dept_about']?>
                        </p>
                    </div>
                    
                </div>
                <div class="tab-pane fade  show col-12 form-group" id="dept_about" role="tabpanel">
                    <div class="col-12 form-group mg-t-8">
                        <p><?php echo $row['dept_about']?>
                        </p>
                    </div>
                    
                </div>
                <div class="tab-pane fade  show col-12 form-group" id="<?php echo $row['dept_id']?>_dept_vision_mission" role="tabpanel">
                    <div class="col-12 form-group mg-t-8">
                        <p><?php echo $row['dept_vision_mission']?>
                        </p>
                    </div>
                    
                </div>
                <div class="tab-pane fade  show col-12 form-group" id="<?php echo $row['dept_id']?>_dept_head_msg" role="tabpanel">
                    <div class="col-12 form-group mg-t-8">
                        <p><?php echo $row['dept_head_msg']?>
                        </p>
                    </div>
                    
                </div>
                <div class="tab-pane fade  show col-12 form-group" id="<?php echo $row['dept_id']?>_dept_booklet" role="tabpanel">
                    <div class="col-12 form-group mg-t-8">
                        <p><?php echo $row['dept_booklet']?>
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