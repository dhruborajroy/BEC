<?php 
define('SECURE_ACCESS', true);
include("header.php");
?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Applied Services</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>date</th>
                                                <th>Service ID</th>
                                                <th>Service Type</th>
                                                <th class="text-right">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                            $sql="select services_request.*, services.name as service_name from services_request,services where student_id='$user_id'  and services_request.type=services.id";
                                            $res=mysqli_query($con,$sql);
                                            if(mysqli_num_rows($res)>0){
                                            $i=1;
                                            while($row=mysqli_fetch_assoc($res)){
                                            ?>
                                            <tr>
                                                <td><?php echo date("d M Y ",$row['added_on'])?></td>
                                                <td><?php echo strtoupper($row['id'])?></td>
                                                <td><?php echo $row['service_name']?></td>
                                                <td>
                                                    <span class="<?php echo $row['public_access'] == '1' ? 'role member' : 'role user '; ?>">
                                                        <?php echo $row['public_access'] == '1' ? 'Approved' : 'Pending'; ?>
                                                    </span>
                                                </td>
                                            </tr>

                                            <?php 
                                            $i++;
                                            } } else { ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Requested Books</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Book</th>
                                                <th>Request From</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $sql="SELECT book_requests.*,students.name,book.title FROM `book_requests`,`students`,`book` WHERE book_requests.user_id=students.id and book_requests.book_id=book.id  AND students.id='".$_SESSION['USER_ID']."'";
                                            $res=mysqli_query($con,$sql);
                                            if(mysqli_num_rows($res)>0){
                                            $i=1;
                                            while($row=mysqli_fetch_assoc($res)){
                                            ?>
                                            <tr role="row" class="odd">
                                                <td ><?php echo $i?></td>
                                                <td ><?php echo $row['title']?></td>
                                                <td ><?php echo $row['name']?></td>
                                                <td>
                                                    <span class="<?php echo $row['status'] == '1' ? 'role member' : 'role user '; ?>">
                                                        <?php echo $row['status'] == '1' ? 'Accepted. Please Collect book from the library as soon as possible.' : 'Pending. Waitng for approval.'; ?>
                                                    </span>
                                                </td>
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
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Issued Books</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Book</th>
                                                <th>Issue Date</th>
                                                <th>Expire Date</th>
                                                <th>Penulty</th>
                                                <th>Countdown</th>
                                                <th class="text-right">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $sql="SELECT book_issues.*,book.title,students.id,students.name FROM `book_issues`,book,students WHERE book_issues.user_id=students.id and book_issues.book_id=book.id AND students.id='".$_SESSION['USER_ID']."'";
                                            $res=mysqli_query($con,$sql);
                                            if(mysqli_num_rows($res)>0){
                                            $i=1;
                                            while($row=mysqli_fetch_assoc($res)){
                                            ?>
                                            <tr role="row" class="odd">
                                                <td><?php echo $i?></td>
                                                <td><?php echo $row['title']?></td>
                                                <td>
                                                    <?php echo date('d-M-Y h:i A',strtotime($row['issued_date']))?></td>
                                                <td>
                                                    <?php echo date('d-M-Y h:i A',strtotime($row['expire_date']))?></td>
                                                <td><?php echo $row['penalty']?></td>
                                                <td>
                                                    <?php  $event=strtotime($row['expire_date']);
                                                    echo round(($event-time())/86400)." days left";
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php 
                                            $i++;
                                            } } else { ?>
                                            <tr>
                                                <td colspan="8">No data found</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
<?php 
include("footer.php");
?>