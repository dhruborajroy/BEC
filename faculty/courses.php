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
                                                <th>Course Code</th>
                                                <th>Course Title</th>
                                                <th>Batch</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                             $sql="select course_teachers.*, courses.course_name,courses.course_code from course_teachers,courses where courses.id=course_teachers.course_id";
                                            $res=mysqli_query($con,$sql);
                                            if(mysqli_num_rows($res)>0){
                                            $i=1;
                                            while($row=mysqli_fetch_assoc($res)){
                                            ?>
                                            <tr>
                                                
                                                <td><?php echo $row['course_code']?></td>
                                                <td><?php echo $row['course_name']?></td>
                                                <td><?php echo $row['batch']?></td>
                                                
                                            </tr>

                                            <?php 
                                            $i++;
                                            } } else { ?>
                                            <?php } ?>
                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Semester Clearance</h2>
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
                                        <tr class="tr-shadow">
                                            <td>
                                                <label class="au-checkbox">
                                                    <input type="checkbox">
                                                    <span class="au-checkmark"></span>
                                                </label>
                                            </td>
                                            <td>Lori Lynch</td>
                                            <td>
                                                <span class="block-email">lori@example.com</span>
                                            </td>
                                            <td>
                                                <span class="block-email">lori@example.com</span>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
<?php 
include("footer.php");
?>