<?php 
define('SECURE_ACCESS', true);
include("header.php");
?>
<div class="dashboard-content-one">
<!-- Breadcubs Area Start Here -->
<div class="breadcrumbs-area">
   <h3>Admin Dashboard</h3>
   <ul>
      <li>
         <a href="index.php">Home</a>
      </li>
      <li>Admin</li>
   </ul>
</div>
<!-- Breadcubs Area End Here -->
<!-- Dashboard summery Start Here -->
<div class="row gutters-20">
   <div class="col-xl-3 col-sm-6 col-12">
      <div class="dashboard-summery-one mg-b-20">
         <div class="row align-items-center">
            <div class="col-6">
               <div class="item-icon bg-light-green ">
                  <!-- <i class="flaticon-classmates text-green"></i> -->
                  <img src="https://cdn-icons-png.flaticon.com/512/2784/2784461.png" alt="" srcset="">
               </div>
            </div>
            <div class="col-6">
               <div class="item-content">
                  <div class="item-title">Students</div>
                  <div class="item-number"><span class="counter" data-num="<?php echo $students=gettotalstudent()?>"><?php echo $students?></span></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-3 col-sm-6 col-12">
      <div class="dashboard-summery-one mg-b-20">
         <div class="row align-items-center">
            <div class="col-6">
               <div class="item-icon bg-light-green ">
                  <!-- <i class="flaticon-classmates text-green"></i> -->
                  <img src="https://cdn-icons-png.flaticon.com/512/3135/3135810.png" alt="" srcset="">
               </div>
            </div>
            <div class="col-6">
               <div class="item-content">
                  <div class="item-title">Faculty</div>
                  <div class="item-number"><span class="counter" data-num="<?php echo $students=gettotalcount("Faculty")?>"><?php echo $students?></span></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-3 col-sm-6 col-12">
      <div class="dashboard-summery-one mg-b-20">
         <div class="row align-items-center">
            <div class="col-6">
               <div class="item-icon bg-light-green ">
                  <!-- <i class="flaticon-classmates text-green"></i> -->
                  <img src="https://cdn-icons-png.flaticon.com/512/3502/3502880.png" alt="" srcset="">
               </div>
            </div>
            <div class="col-6">
               <div class="item-content">
                     <div class="item-title">Total Books</div>
                     <div class="item-number"><span class="counter"
                           data-num="<?php echo $getBooksCount=getBooksCount()?>"><?php echo $getBooksCount?></span>
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-3 col-sm-6 col-12">
      <div class="dashboard-summery-one mg-b-20">
         <div class="row align-items-center">
            <div class="col-6">
               <div class="item-icon bg-light-green ">
                  <!-- <i class="flaticon-classmates text-green"></i> -->
                  <img src="https://cdn-icons-png.flaticon.com/512/7803/7803013.png" alt="" srcset="">
               </div>
            </div>
            <div class="col-6">
               <div class="item-content">
                     <div class="item-title">Total Requests</div>
                     <div class="item-number"><span class="counter"
                           data-num="<?php echo $getRequestedBooksCount=getRequestedBooksCount()?>"><?php echo $getRequestedBooksCount?></span>
                        </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Dougnut Chart Here -->
   <div class="col-12 col-xl-3 col-3-xxxl">
      <div class="card dashboard-card-three pd-b-20">
            <div class="card-body">
               <div class="heading-layout1">
                  <div class="item-title">
                        <h3>Students</h3>
                  </div>
               </div>
               <div class="doughnut-chart-wrap">
                  <canvas id="student-doughnut-chart" width="100" height="300"></canvas>
               </div>
               <div class="student-report">
                  <div class="student-count pseudo-bg-blue">
                        <h4 class="item-title">Female Students</h4>
                        <div class="item-number"><?php echo gettotalstudent('female')?></div>
                  </div>
                  <div class="student-count pseudo-bg-yellow">
                        <h4 class="item-title">Male Students</h4>
                        <div class="item-number"><?php echo gettotalstudent('male')?></div>
                  </div>
               </div>
            </div>
      </div>
   </div>
   
   <!-- Line Chart Here -->
   <div class="col-12 col-xl-9 col-9-xxxl">
      <div class="card dashboard-card-one pd-b-20">
            <div class="card-body">
               <div class="heading-layout1">
                  <div class="item-title">
                        <h3>Department Wise Student Count</h3>
                  </div>
                  <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                        <div class="dropdown-menu dropdown-menu-right">
                           <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                           <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                           <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                        </div>
                  </div>
               </div>
               <div class="earning-report">
                  <div class="item-content">
                        <div class="single-item pseudo-bg-red">
                           <h4>Students of Civil Engineering</h4>
                        </div>
                        <div class="single-item pseudo-bg-blue">
                           <h4>Students of EEE</h4>
                        </div>
                  </div>
               </div>
               <div class="earning-chart-wrap"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <canvas id="earning-line-chart" width="722" height="320" class="chartjs-render-monitor" style="display: block; width: 722px; height: 320px;"></canvas>
               </div>
            </div>
      </div>
   </div>
   <!-- Bar Chart Here -->
   <div class="col-12 col-xl-12 col-12-xxxl">
      <div class="card dashboard-card-two pd-b-20">
            <div class="card-body">
               <div class="heading-layout1">
                  <div class="item-title">
                        <h3>Students Count Batch Wise</h3>
                  </div>
               </div>
               <div class="expense-report">

               <?php 
                $sql = "SELECT b.id AS batch_id, b.name AS batch_name, COUNT(s.id) AS student_count 
                FROM batch b 
                LEFT JOIN students s ON b.id = s.batch 
                GROUP BY b.id, b.name 
                ORDER BY b.numaric_value ASC";
    
                $result = mysqli_query($con, $sql);
                
                $batches = []; // Initialize an empty array
                
                // Fetch data and store in an array
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $batches[] = $row;
                    }
                    mysqli_free_result($result);
                } else {
                    echo "Error: " . mysqli_error($con);
                }
                
                $lastBatch = end($batches); // Get the last element

                foreach ($batches as $batch) {?>
                    <div class="monthly-expense ">
                        <div class="expense-date">Batch <?php echo $batch['batch_name']?></div>
                        <div class="expense-amount"><span></span> <?php echo $batch['student_count']?> Students</div>
                  </div>

               <?php  }
                ?>
                  
               </div>
               <div class="expense-chart-wrap">
                  <canvas id="expense-bar-chart" width="100" height="300"></canvas>
               </div>
            </div>
      </div>
   </div>
</div>

<div class="row gutters-20">
   <!-- notice -->
   <div class="col-lg-12 col-xl-6 col-6-xxxl">
      <div class="card dashboard-card-six pd-b-20">
         <div class="card-body">
            <div class="heading-layout1 mg-b-17">
               <div class="item-title">
                  <h3>Notice Board</h3>
               </div>
            </div>
            <div class="notice-box-wrap">
               <?php 
                  $sql="select * from notice where status='1' order by added_on desc";
                  $res=mysqli_query($con,$sql);
                  if(mysqli_num_rows($res)>0){
                  $i=1;
                  while($row=mysqli_fetch_assoc($res)){
                  ?>
               <div class="notice-list">
                  <div class="post-date bg-orange text-color-black">
                     <?php echo date('d-M-Y h:i A',$row['added_on']);?>
                  </div>
                  <div class="post-date bg-skyblue text-color-black">
                     <?php echo get_time_ago(intval($row['added_on']));?>
                  </div>
                  <div class="post-date bg-orange">
                     <a href="../notice_files/<?php echo $row['link']?>" style="color:white">Print Pdf</a>
                  </div>
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
   <!-- calender  -->
   <div class="col-12 col-xl-6 col-6-xxxl">
      <div class="card dashboard-card-four pd-b-20">
            <div class="card-body">
               <div class="heading-layout1">
                  <div class="item-title">
                        <h3>BEC Calender</h3>
                  </div>
                  <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                           aria-expanded="false">...</a>

                        <div class="dropdown-menu dropdown-menu-right">
                           <a class="dropdown-item" href="#"><i
                                    class="fas fa-times text-orange-red"></i>Close</a>
                           <a class="dropdown-item" href="#"><i
                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                           <a class="dropdown-item" href="#"><i
                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                        </div>
                  </div>
               </div>
               <div class="calender-wrap">
                  <div id="fc-calender" class="fc-calender"></div>
               </div>
            </div>
      </div>
   </div>
<!-- Dashboard summery End Here -->
</div>
<!-- Dashboard Content Start Here -->
<div class="row gutters-20">
</div>
<!-- Dashboard Content End Here -->


<?php include('footer.php');?>