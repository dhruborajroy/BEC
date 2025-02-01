<?php 
include("header.php");
$msg="";
if(isset($_GET['id']) && $_GET['id']!=""){
	$id=get_safe_value($_GET['id']);
    // $sql="select id from book where book.id='$id'";
    // $res=mysqli_query($con,$sql);
	// if(mysqli_num_rows($res)>0){
    // }else{
    //     // redirect('index.php');
    // }
}
?>

<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Profile</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Issuence & Request History</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
                <!-- Issence table Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Issue History</h3>
                            </div>
                        </div>
                        <div class="single-info-details">
                            <div class="table-responsive">
                                <table class="table display data-table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title (Accession- Copy)</th>
                                            <th>Student's Name</th>
                                            <th>Issued Date</th>
                                            <th>Return Status</th>
                                            <th>Return Date</th>
                                            <th>Lost</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        <?php 
                                        $sql="SELECT book.title,book.accession,book_issues.issued_date,book_issues.expire_date,book_issues.return_date,book_issues.lost,book_issues.return_status,book_issues.book_copy,users.name FROM `book`,book_issues,users WHERE book_issues.book_id=book.id and book.id='$id' AND users.id=book_issues.user_id";
                                        $res=mysqli_query($con,$sql);
                                        if(mysqli_num_rows($res)>0){
                                        $i=1;
                                        while($row=mysqli_fetch_assoc($res)){
                                        ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1 dtr-control"><?php echo $i?></td>
                                            <td class="sorting_1 dtr-control"><?php echo $row['title']." (".set_zero($row['accession'])."-".set_zero($row['book_copy']).")"?></td>
                                            <td class="sorting_1 dtr-control"><?php echo $row['name']?></td>
                                            <td class="sorting_1 dtr-control"><?php echo $row['issued_date']?></td>
                                            <td class="sorting_1 dtr-control"><?php echo $row['return_status']?></td>
                                            <td class="sorting_1 dtr-control"><?php echo $row['return_date']?></td>
                                            <td class="sorting_1 dtr-control"><?php echo $row['lost']?></td>
                                        </tr>
                                        <?php 
                                        $i++;
                                        } } else { ?>
                                        <tr>
                                            <td colspan="5">No data found</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Issence table Area End Here -->
    <?php include("footer.php")?>