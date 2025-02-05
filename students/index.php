<?php 
define('SECURE_ACCESS', true);
include("header.php");
?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo gettotalstudent()?></h2>
                                                <span>Total Students</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart1"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-book-image"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo getUsersIssuedBooksCount($_SESSION['USER_ID'])?></h2>
                                                <span>Issued Library Books</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart2"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo gettotalstudent()?></h2>
                                                <span>Total Students</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <!-- <canvas id="widgetChart3"></canvas> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-lg-12">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                        <h3 class="title-2 m-b-40">Semester wise GPA </h3>
                                        <canvas id="singelBarChart" height="333" style="display: block; width: 667px; height: 333px;" width="667" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                        <h3 class="title-2 m-b-40">CGPA </h3>
                                        <canvas id="cgpa-chart" height="333" style="display: block; width: 667px; height: 333px;" width="667" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        </div> -->
                        <!-- <div class="row">
                            <div class="col-lg-12">
                                <div class="au-card m-b-30">
                                    <div class="au-card-inner"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                        <h3 class="title-2 m-b-40">Bar chart</h3>
                                        <canvas id="barChart" height="444" style="display: block; width: 667px; height: 444px;" width="667" class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div> -->
<?php 
include("footer.php");
?>