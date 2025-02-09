<?php 
define('SECURE_ACCESS', true);
include('header.php');
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id'])){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='delete'){
		mysqli_query($con,"delete from services_request where id='$id'");
		redirect('service_requests');
	}
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update services_request set status='$status' where id='$id'");
        redirect('./service_requests');
	}

}
?>
<!-- Page Area Start Here -->
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Service Requests</h3>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>Service Requests</li>
            </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Service Requests</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Details</th>
                            <th>Service Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                        $sql="select services_request.reason,services_request.type,services_request.id,services_request.status as status,students.name,services.name as service_name from services_request, students,services,depts_lab_list where services_request.student_id=students.id and services.id=services_request.type and  depts_lab_list.short_form='$dept_id'  and depts_lab_list.id=students.dept_id";
                        $res=mysqli_query($con,$sql);
                        if(mysqli_num_rows($res)>0){
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                        ?>
                        <tr role="row" class="odd">
                            <td class="sorting_1 dtr-control"><?php echo $row['name']?></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['reason']?></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['service_name']?></td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="manage_service_requests.php?id=<?php echo $row['id']?>"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                                <?php if($row['status']=='0'){?>
                                        <a class="dropdown-item" href="?id=<?php echo $row['id']?>&type=active"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Active</a>
                                                <?php }else{?>
                                        <a class="dropdown-item" href="?id=<?php echo $row['id']?>&type=deactive"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Deactive</a>
                                                <?php }?>
                                        <a class="dropdown-item" href="?id=<?php echo $row['id']?>&type=delete"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php 
                           $i++;
                           } } else { ?>
                        <tr>
                            <td colspan="3">No data found</td>
                        </tr>
                        <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <!-- Teacher Table Area End Here -->
    <?php include('footer.php');?>