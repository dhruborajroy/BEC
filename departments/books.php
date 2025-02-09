<?php 
define('SECURE_ACCESS', true);
include('header.php');
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='delete'){
		mysqli_query($con,"delete from book where id='$id'");
		redirect('books');
	}
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update book set status='$status' where id='$id'");
        redirect('./books');
	}

}
$sql="select * from book order by accession asc";
$res=mysqli_query($con,$sql);
?>
<!-- Page Area Start Here -->
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Books</h3>
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>All Books</li>
            </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Books' Data</h3>
                </div>
                <div class="dropdown show">
                    <div class="col-12 form-group mg-t-8">
                        <a href="manage_books"> <button type="submit"
                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add new Book</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>Accession</th>
                            <th>Image</th>
                            <th>Book</th>
                            <th>ISBN</th>
                            <th>Quantity</th>
                            <!-- <th>Copies Have</th> -->
                            <th>Issued</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php if(mysqli_num_rows($res)>0){
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                        ?>
                        <tr role="row" class="odd">
                            <td class="sorting_1 dtr-control"><?php echo set_zero($row['accession'])?></td>
                            <td class="sorting_1 dtr-control"><img height="30px" width="30px"
                                    src="../library/media/books/<?php echo $row['image']?>" alt="student"></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['title']?></td>
                            <!-- <td class="sorting_1 dtr-control">
                            <?php 
                            //echo set_zero($row['accession'])?>
                                <?php
                                // $author_sql="SELECT book_author.*,authors.name FROM `authors`,book_author where book_author.author_id=authors.id and book_author.book_id='".$row['id']."'";
                                // $author_res=mysqli_query($con,$author_sql);
                                // while($author_row=mysqli_fetch_assoc($author_res)){?>
                                    <?php //echo $author_row['name']?>
                                <?php //}?>
                            </td> -->
                            <td class="sorting_1 dtr-control"><?php echo $row['isbn_ten']?></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['copies_owned']?></td>
                            <!-- <td class="sorting_1 dtr-control"> -->
                                <?php 
                                    // $row['copies_owned']-intval(getAvailableBooksCount($row['id']))
                                    // echo $row['copies_have']
                                // ?></td>
                            <td class="sorting_1 dtr-control">
                                <?php echo intval(getAvailableBooksCount($row['id']))?></td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="manage_books.php?id=<?php echo $row['id']?>"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="book_issuence_history.php?id=<?php echo $row['id']?>"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i>Issuence History</a>
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
                            <td colspan="5">No data found</td>
                        </tr>
                        <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <!-- Teacher Table Area End Here -->
    <?php include('footer.php');?>