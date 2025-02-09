<?php 
define('SECURE_ACCESS', true);
include('header.php');
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id'])){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='delete'){
		mysqli_query($con,"delete from depts_lab_list where id='$id'");
		redirect('departments');
	}
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update depts_lab_list set status='$status' where id='$id'");
        redirect('departments');
	}

}
?>
<!-- Page Area Start Here -->
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Departments</h3>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>All Departments</li>
            </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All departments' Data</h3>
                </div>
                <div class="dropdown show">
                    <div class="col-12 form-group mg-t-8">
                        <a href="manage_depts"> <button type="submit"
                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add new Departments</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Bangla</th>
                            <th>Short Form</th>
                            <th>Visibility</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php 
                        
                        $sql="select * from depts_lab_list";
                        $res=mysqli_query($con,$sql);
                        if(mysqli_num_rows($res)>0){
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                        ?>
                        <tr role="row" class="odd">
                            <td class="sorting_1 dtr-control"><?php echo $row['name']?></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['name_bn']?></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['short_form']?></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['public_view'] == '1' ? 'Public' : 'Private'; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="manage_depts.php?id=<?php echo $row['id']?>"><i
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