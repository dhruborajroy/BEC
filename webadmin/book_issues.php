<?php 
define('SECURE_ACCESS', true);
include('header.php');
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='delete'){
		mysqli_query($con,"delete from book_issues where id='$id'");
		redirect('book_issues.php');
	}
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update book_issues set status='$status' where id='$id'");
        redirect('./book_issues.php');
	}

}
$sql="select book_issues.*,book_issues.id as book_issue_id,students.class_roll,students.name,book.id,book.title,book.accession from book_issues,students,book where book_issues.user_id=students.id and book.id=book_issues.book_id order by book_issues.issued_date desc";
$res=mysqli_query($con,$sql);
?>
<?php echo form_csrf()?>
<!-- Page Area Start Here -->
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Book Issuence</h3>
            <ul>
                <li>
                    <a href="index">Home</a>
                </li>
                <li>All Book Issuence</li>
            </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Students Data</h3>
                </div>
                <div class="dropdown show">
                    <div class="col-12 form-group mg-t-8">
                        <a href="manage_issues"> <button type="submit"
                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Issue Book</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>Accession</th>
                            <th>Book</th>
                            <th>Issued To</th>
                            <th>Issue Date</th>
                            <th>Penulty</th>
                            <th>Status</th>
                            <th>Countdown</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php if(mysqli_num_rows($res)>0){
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                        ?>
                        <tr role="row" class="odd">
                            <td class="sorting_1 dtr-control"><?php echo " ".$row['accession']."" ." - ". set_zero($row['book_copy'])?></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['title']?></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['name']." (".$row['class_roll'].")"?></td>
                            <td class="sorting_1 dtr-control">
                                <?php echo date('d-M-Y h:i A',strtotime($row['issued_date']))?></td>
                            <td class="sorting_1 dtr-control">
                            <td class="sorting_1 dtr-control">
                                <?php  
                                $status=$row['status'];
                                $return="";
                                $return_status=$row['return_status'];
                                if($status==1){
                                    if($return_status==1){
                                        $return="& Returned";
                                    }
                                    echo "Book Issued ".$return;
                                }else if($status==0){
                                    echo "Book is ready for Issuence";}
                                ?>
                            </td>
                            <td class="sorting_1 dtr-control">
                                <?php  
                                $event=strtotime($row['expire_date']);
                                 $days=round(($event-time())/86400);
                                 if($days<=0){
                                    $days=0;
                                 }
                                 echo $days." days left";
                                ?></td>
                            <td style="width: auto;">
                                <ul style="display: flex;">
                                <?php 
                                if($return_status==0){?>
                                    <li class="nav-item" id="return_<?php echo $row['book_issue_id']?>">
                                        <a class="nav-link" data-toggle="tooltip" data-placement="top"
                                            title="Return Book"
                                            onclick="confirmReturn('<?php echo $row['book_issue_id']?>')"><i
                                                class="fas fa-undo-alt text-dark-pastel-green"></i></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tooltip" data-placement="top"
                                            title="Notify User"
                                            onclick="send_notification('<?php echo $row['book_issue_id']?>')"><i
                                                class="fas fa-bell text-dark"></i></a>
                                    </li>
                                    <li class="nav-item">
                                        <a data-original-title="Book Is Lost" class="nav-link" data-toggle="tooltip"
                                            data-placement="top" title="Book is lost" href="#tab15" role="tab"
                                            aria-selected="false"><i
                                                class="fas fa-times text-dark-pastel-green"></i></a>
                                    </li>
                                <?php }?>
                                    <li class="nav-item">
                                        <a class="nav-link " data-toggle="tooltip" data-placement="top" title="Edit"
                                            href="manage_issues.php?id=<?php echo $row['book_issue_id']?>"><i
                                                class="fas fa-pencil-alt text-dark-pastel-green"></i></a>
                                    </li>
                                </ul>
                            </td>

                        </tr>
                        <?php 
                           $i++;
                           } } else { ?>
                        <tr>
                            <td colspan="8" style="text-align:center">No data found</td>
                        </tr>
                        <?php } ?>
                        <?php echo form_csrf();?>

                </table>
            </div>
        </div>
    </div>
    <!-- Teacher Table Area End Here -->
    <?php include('footer.php');?>
    
<script>
    function confirmReturn(issue_id){
        swal({
                title: "Are you sure?",
                text: "Do you want to return this book?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                return_books(issue_id);
            }else {
            }
        });
    }

function return_books(issue_id) {
  var issue_id = issue_id;
  var csrf_token = jQuery("#csrf_token").val();
  jQuery.ajax({
    url: "./ajax/return_book.php",
    data: "issue_id=" + issue_id + "&csrf_token=" + csrf_token,
    type: "post",
    failure: function (result) {
      alert(result);
    },
    success: function (result) {
      if (result == "done") {
        swal("Good job!", "Book returned Successfully", "success")
            .then((value) => {
                if(value==true){
                    location.reload();
                }
        });
        $('#return_'+issue_id).hide();
      }
      if (result == "wrong") {
        alert("Book already returned");
        $('#return_'+issue_id).hide();
      }
    },
  });
}
</script>