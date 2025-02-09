<?php
define('SECURE_ACCESS', true);
include("header.php");
 
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='delete'){
		mysqli_query($con,"delete from notice where id='$id'");
		redirect('notices');
	}
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update notice set status='$status' where id='$id'");
        redirect('notices');
	}

}
?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Notices</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Notice</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <div class="row">
        <!-- All Notice Area Start Here -->
        <div class="col-12-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Notice Board</h3>
                        </div>
                        <div class="dropdown">
                            <a href="manage_notice"> 
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add new Notice</button>
                            </a>
                            <a href="upload_notice"> <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Upload Notice</button>
                            </a>
                        </div>
                    </div>
                    <div class="notice-board-wrap">
                        <?php 
                        $sql="select * from notice where dept='$dept_id' order by added_on desc";
                        $res=mysqli_query($con,$sql);
                        if(mysqli_num_rows($res)>0){
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                        ?>
                        <div class="notice-list">
                            <div class="post-date bg-skyblue">
                                <?php echo date('d-M-Y h:i A',$row['added_on']);?>
                            </div>
                            <div class="post-date bg-orange">
                                <a href="manage_notice?id=<?php echo $row['id']?>" style="color:black">Edit</a>
                            </div>
                            <div class="post-date bg-red">
                                <a href="?id=<?php echo $row['id']?>&type=delete" style="color:white">Delete</a>
                            </div>
                            <?php if($row['status']=='0'){?>
                            <div class="post-date bg-dark-pastel-green">
                                <a href="?id=<?php echo $row['id']?>&type=active" style="color:white">Active</a>
                            </div>
                            <?php }else{?>
                            <div class="post-date bg-violet-blue">
                                <a href="?id=<?php echo $row['id']?>&type=deactive" style="color:white">Deactive</a>
                            </div>
                            <?php }?>
                            <?php if($row['upload_status']!=1){?>
                                <div class="post-date bg-orange">
                                    <a href="../pdfreports/notice.php?notice_id=<?php echo $row['id']?>" style="color:white">Generate Pdf</a>
                                </div>
                            <?php }else{?>
                                <div class="post-date bg-orange">
                                    <a href="../notice_files/<?php echo $row['link']?>" style="color:white">Generate Pdf</a>
                                </div>
                            <?php } ?>
                            <h6 class="notice-title"><a href="../notice_files/<?php echo $row['link']?>"><?php echo $row['title']?></a></h6>
                            <div class="entry-meta"><?php echo $row['details']?></div>
                        </div>
                        <?php 
                           $i++;
                           } } else { ?>
                        <tr>
                            <td colspan="5">No data found</td>
                        </tr>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- All Notice Area End Here -->
    </div> <?php include("footer.php")?>