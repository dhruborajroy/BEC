<?php 
define('SECURE_ACCESS', true);
include('header.php');

// Initialize all variables as blank
$id="";
$name = "";
$designation = "";
$phone = "";
$email = "";
$research_interest = "";
$bio = "";
$facebook = "";
$linked_in = "";
$education = "";
$experience = "";
$publication = "";
$scholarship_award = "";
$research = "";
$teaching_supervision = "";
$joined_at = "";
$visibility = "public"; // Default value for visibility
$dept_head = 0; 
$dept="";
$image="";
$type="";
$required="required";
if(isset($_GET['id']) && $_GET['id']>0){
$id=get_safe_value($_GET['id']);
    $res=mysqli_query($con,"select * from `people` where md5(id)='$id'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        // Retrieve all variables
        $name = $row['name'];
        $designation = $row['designation'];
        $phone = $row['phone'];
        $email = $row['email'];
        $research_interest = $row['research_interest'];
        $bio = $row['bio'];
        $facebook = $row['facebook'];
        $linked_in = $row['linked_in'];
        $education = $row['education'];
        $dept = $row['dept'];
        $experience = $row['experience'];
        $publication = $row['publication'];
        $scholarship_award = $row['scholarship_award'];
        $research = $row['research'];
        $teaching_supervision = $row['teaching_supervision'];
        $joined_at = $row['joined_at'];
        $visibility = $row['visibility'];
        $dept_head = $row['dept_head'];
        $image = $row['image'];
        $type = $row['type'];
        $required="";
    }else{
        $_SESSION['TOASTR_MSG']=array(
            'type'=>'error',
            'body'=>'You don\'t have the permission to access the location!',    
            'title'=>'Error',
        );
        redirect("index.php");
    }
}
?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Peoples</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>People Details</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

    <!-- Students  Form Area Start Here -->
    <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Student Details</h3>
                            </div>
                           <!-- <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>
        
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div> -->
                        </div>
                        <div class="single-info-details">
                            <div class="item-img">
                                <img src="../images/teachers/<?php echo $image?>" alt="teachers">
                            </div>
                            <div class="item-content">
                                <!-- <div class="header-inline item-header">
                                    <h3 class="text-dark-medium font-medium"><?php echo $name?>s</h3>
                                    <div class="header-elements">
                                        <ul>
                                            <li><a href="#"><i class="far fa-edit"></i></a></li>
                                            <li><a href="#"><i class="fas fa-print"></i></a></li>
                                            <li><a href="#"><i class="fas fa-download"></i></a></li>
                                        </ul>
                                    </div>
                                </div> -->
                                <div class="info-table table-responsive">
                                    <table class="table text-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $name?></td>
                                            </tr>
                                            <tr>
                                                <td>Designation:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $designation?></td>
                                            </tr>
                                            <tr>
                                                <td>Education:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $education?></td>
                                            </tr>
                                            <tr>
                                                <td>Joined At:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $joined_at?></td>
                                            </tr>
                                            <tr>
                                                <td>Phone:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $phone?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- Students  Form Area End Here -->

    <?php include('footer.php');?>