
<?php 
define('SECURE_ACCESS', true);
include('header.php');
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	// if($type=='delete'){
	// 	mysqli_query($con,"delete from students where id='$id'");
	// 	redirect('students');
	// }
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update students set status='$status' where id='$id'");
        redirect('students');
	}

}
?>
<!-- Page Area Start Here -->
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Students</h3>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>All Students</li>
            </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Students' Data</h3>
                </div>
                <!-- <div class="dropdown show">
                    <div class="col-12 form-group mg-t-8">
                        <a href="manage_students"> <button type="submit"
                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add new student</button>
                        </a>
                    </div>
                </div> -->
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Father's Name</th>
                            <th>Registration No</th>
                            <th>Session</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php 
                        $st_sql="SELECT students.id,students.name,students.image,students.status,students.fName,students.reg_no, batch.name as batch_name,depts_lab_list.id as dept_id FROM `students`,batch,depts_lab_list where depts_lab_list.short_form='$dept_id'  and depts_lab_list.id=students.dept_id and students.batch=batch.id ";

                        // $sql="select students.*, batch.name as batch_name from students,batch where students.batch=batch.id ";
                        $res=mysqli_query($con,$st_sql);
                        if(mysqli_num_rows($res)>0){
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                        ?>
                        <tr role="row" class="odd">
                            <td class="sorting_1 dtr-control"><?php echo $row['name']?></td>
                            <td class="sorting_1 dtr-control"><img height="30px" width="30px"
                                    src="../images/students/<?php echo $row['image']?>" alt="student"></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['fName']?></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['reg_no']?></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['batch_name']?></td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="view_student.php?id=<?php echo md5($row['id'])?>"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>View Details</a>
                                                <?php if($row['status']=='0'){?>
                                        <a class="dropdown-item" href="?id=<?php echo $row['id']?>&type=active"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Active</a>
                                                <?php }else{?>
                                        <a class="dropdown-item" href="?id=<?php echo $row['id']?>&type=deactive"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Deactive</a>
                                                <?php }?>
                                        <!-- <a class="dropdown-item" href="?id=<?php //echo $row['id']?>&type=delete"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Delete</a> -->
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php 
                           $i++;
                           } } else { ?>
                        <tr>
                            <td colspan="5">No data found</td>
                        </tr>
                        <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <!-- Teacher Table Area End Here -->
    <?php include('footer.php');?>