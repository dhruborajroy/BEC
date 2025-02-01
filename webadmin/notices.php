<?php
define('SECURE_ACCESS', true);
 include("header.php");?>
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
                        $sql="select * from notice where status='1' order by added_on desc";
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