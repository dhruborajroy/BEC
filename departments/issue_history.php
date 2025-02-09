<?php 
include("header.php");
$msg="";
if(isset($_GET['id']) && $_GET['id']!=""){
	$id=get_safe_value($_GET['id']);
    // $id="642fc1956f554";
    $sql="select id from users where users.id='$id'";
    $res=mysqli_query($con,$sql);
	if(mysqli_num_rows($res)>0){
    }else{
        // redirect('index.php');
    }
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
                                <br>
                                <?php echo $msg?>
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
                                        $sql="select book_issues.*,book.title,book.accession,users.name from book_issues,book,users where book_issues.user_id='$id' and book_issues.book_id=book.id and book_issues.user_id=users.id";
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
                <!-- Issence table Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Issue History</h3>
                                <br>
                                <?php echo $msg?>
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
                                            <th>Requested Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        <?php 
                                        $sql="select book_requests.*,book.title,book.accession,users.name from book_requests,book,users where book_requests.user_id='$id' and book_requests.book_id=book.id and book_requests.user_id=users.id";
                                        $res=mysqli_query($con,$sql);
                                        if(mysqli_num_rows($res)>0){
                                        $i=1;
                                        while($row=mysqli_fetch_assoc($res)){
                                        ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1 dtr-control"><?php echo $i?></td>
                                            <td class="sorting_1 dtr-control"><?php echo $row['title']." (".set_zero($row['accession']).")"?></td>
                                            <td class="sorting_1 dtr-control"><?php echo $row['name']?></td>
                                            <td class="sorting_1 dtr-control"><?php echo $row['added_on']?></td>
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