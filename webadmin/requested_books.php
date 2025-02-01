<?php 
define('SECURE_ACCESS', true);
include('header.php');
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	// if($type=='delete'){
	// 	mysqli_query($con,"delete from applicants where id='$id'");
	// 	redirect('bus.php');
	// }
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update book_requests set status='$status' where id='$id'");
        redirect('./book_requests.php');
	}

}
// $sql="select * from book_requests order by id desc";
$sql="select book_requests.*,book_requests.id as book_request_id,students.id,students.name,book.id,book.title,book.accession from book_requests,students,book where book_requests.user_id=students.id and book.id=book_requests.book_id  order by `book_requests`.`added_on` ASC";
$res=mysqli_query($con,$sql);
?>
<!-- Page Area Start Here -->
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Book Requests</h3>
        <ul>
            <li>
                <a href="index">Home</a>
            </li>
            <li>All Book Requests</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Book Requests Data</h3>
                </div>
                <div class="dropdown show">
                    <div class="col-12 form-group mg-t-8">
                        <a href="manage_requests.php"> <button type="submit"
                                class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Request</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Book</th>
                            <th>Request From</th>
                            <th>Creation Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php 
                        echo form_csrf();
                        if(mysqli_num_rows($res)>0){
                        $i=1;
                        while($row=mysqli_fetch_assoc($res)){
                        ?>
                        <tr role="row" class="odd">
                            <td class="sorting_1 dtr-control"><?php echo $row['accession']?></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['title']//." ".$row['accession'].""?></td>
                            <td class="sorting_1 dtr-control"><?php echo $row['name']?></td>
                            <td class="sorting_1 dtr-control">
                                <?php echo date('d M Y h:i A',strtotime($row['added_on']))?></td>
                            <td class="sorting_1 dtr-control">
                                <?php  
                                $status=$row['status'];
                                if($status==1){
                                    echo "Accepted.";
                                }else if($status==0){
                                    echo "Pending";}
                                ?>
                            </td>
                            <td>
                                <ul style="display: flex;">
                                    <!-- <li class="nav-item">
                                    </li> -->
                                    <?php if($status==0){?>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tooltip" data-placement="top" title="Accept"
                                            onclick="confirmAccept('<?php echo $row['book_request_id']?>','accept')"><i
                                                class="fa fa-check text-dark-pastel-green custom_cursor"></i></a>
                                    </li>
                                    <?php }?>
                                    <?php if($status==1){?>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tooltip" data-placement="top" title="Reject"
                                            onclick="confirmAccept('<?php echo $row['book_request_id']?>','reject')"><i
                                                class="fa fa-times text-dark-pastel-green custom_cursor"></i></a>
                                    </li>
                                    <?php }?>
                                    <?php if($status!=0 && $status!=2){?>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tooltip" data-placement="top"
                                            title="Issue Book"
                                            href="manage_issues_using_request.php?id=<?php echo $row['book_request_id']?>"><i
                                                class="fas fa-book text-dark-pastel-green custom_cursor"></i></a>
                                    </li>
                                    <?php }?>
                                    <?php if($status==2){?>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link"
                                            onclick="confirmAccept('<?php //echo $row['book_request_id']?>','issue')">Book
                                            Issued</a>
                                    </li> -->
                                    <?php }?>
                                </ul>
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
    <script>

    function confirmAccept(book_request_id,type){
        swal({
                title: "Are you sure?",
                text: "Do you want to accept this book request?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                accept_request(book_request_id,type);
            }else {
            }
        });
    }

function accept_request(book_request_id, type) {
  var book_request_id = book_request_id;
  var type = type;
  var csrf_token = jQuery("#csrf_token").val();
  jQuery.ajax({
    url: "./ajax/accept_request",
    data:
      "book_request_id="+book_request_id+
      "&csrf_token="+csrf_token +
      "&type="+type,
      type: "post",
      failure: function (result) {
        alert(result);
    },
    success: function (result) {
      // accept alerts
      if (result == "accept_done") {
        swal("Hurray!", "The Book request has been accepted.", "success")
            .then((value) => {
                if(value==true){
                    location.reload();
                }
        });
      } else if (result == "accept_wrong") {
        swal("Sorry!", "Something Went wrong", "error")
            .then((value) => {
                if(value==true){
                    location.reload();
                }
        });
        // alert("Book already returned");
      }
      // reject alerts
      if (result == "reject_done") {
        swal("Sorry!", "The Book request has been rejected.", "success")
            .then((value) => {
                if(value==true){
                    location.reload();
                }
        });
      } else if (result == "reject_wrong") {
        swal("Sorry!", "Something Went wrong", "error")
            .then((value) => {
                if(value==true){
                    location.reload();
                }
        });
        // alert("Book already returned");
      }
      // Issue Alerts
      if (result == "book_issued") {
        swal("Hurray!", "The Book request has been Issued.", "success")
            .then((value) => {
                if(value==true){
                    location.reload();
                }
        });
      } else if (result == "issence_wrong") {
        swal("Sorry!", "Something Went wrong", "error")
            .then((value) => {
                if(value==true){
                    location.reload();
                }
        });
        // alert("Book already returned");
      }else {
        // alert(result);
        console.log(result);
      }
    },
  });
}
</script>