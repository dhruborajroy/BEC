<?php
define('SECURE_ACCESS', true);
include("header.php");
?>
    <!--=================================
    campus-->
    <section class="space-ptb">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
              <h3 class="text-center shadow-sm p-3 mb-5  bg-light rounded">All Notices</h3>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-striped text-center mb-0 data_table">
                <thead>
                  <tr class="bg-dark">
                    <th class="text-white" scope="col">Date</th>
                    <th class="text-white" scope="col">Title</th>
                    <th class="text-white" scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                <?php
               $notice_res=mysqli_query($con,"select * from notice where status=1 order by added_on desc");
               if(mysqli_num_rows($notice_res)>0){
               while($notice_res_row=mysqli_fetch_assoc($notice_res)){
               ?>
               <tr  style="font-size: 22px;">
                 <td style="color:#1a2844 !important;"><i class="far fa-calendar-check mr-1"></i> <?php echo date("d-M-Y",$notice_res_row['added_on'])?></td>
                 <td><?php echo $notice_res_row['title']?></td>
                 <td  style="color:red;"><a  style="color:red;" href="notice_files/<?php echo $notice_res_row['link']?>">Download <i class="fa fa-download "></i></a></td>
               </tr>
              <?php } }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=================================camps-->

<?php include("footer.php")?>
<script>
let table = new DataTable('.data_table', {
    order: [[0, 'asc']], 
    columnDefs: [
        { type: "date", targets: 0 }
    ],
    paging: true,   
    searching: true 
});
</script>