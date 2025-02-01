<?php 
define('SECURE_ACCESS', true);
include("header.php");
?>
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="statistic__item">
                                    <h2 class="number"><?php echo gettotalstudent()?></h2>
                                    <span class="desc">Total Students</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="statistic__item">
                                    <h2 class="number"><?php echo getTotalCourse($faculty_id)?></h2>
                                    <span class="desc">Current Courses</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
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