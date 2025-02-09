<?php 
define('SECURE_ACCESS', true);
include('header.php');
$msg="";
$id="";
$name='';
$fname='';
$mname='';
$phoneNumber='';
$presentAddress='';
$permanentAddress='';
$required='required';
$paymentStatus='';
$dob='';
$gender='';
$religion='';
$bloodGroup='';
$image='';
$email='';
$batch='';
$reg_no='';
$deptId="";
$semester="";
$class_roll="";
$class_roll="";
$dept_id="";
$dept_name="";
if(isset($_GET['id']) && $_GET['id']!=""){
	$id=get_safe_value($_GET['id']);
    $res=mysqli_query($con,"select students.*,depts_lab_list.name as dept_name from students,depts_lab_list where md5(students.id)='$id' and students.dept_id=depts_lab_list.id");
	if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $name=$row['name'];
        $class_roll=$row['class_roll'];
        $reg_no=$row['reg_no'];
        $fname=$row['fName'];
        $mname=$row['mName'];
        $phoneNumber=$row['phoneNumber'];
        $presentAddress=$row['presentAddress'];
        $permanentAddress=$row['permanentAddress'];
        $dob=$row['dob'];
        $gender=$row['gender'];
        $religion=$row['religion'];
        $bloodGroup=$row['bloodGroup'];
        $image=$row['image'];
        $email=$row['email'];
        $dept_id=$row['dept_id'];
        $batch=$row['batch'];
        $semester=$row['semester'];
        $dept_name=$row['dept_name'];
        $password=$row['password'];
        $required='';
    }else{
        $_SESSION['TOASTR_MSG']=array(
            'type'=>'error',
            'body'=>'You don\'t have the permission to access the location!',    
            'title'=>'Error',
        );
        redirect("students");
        die;
    }
}
?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Students</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Student Details</li>
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
                                <img src="../images/students/<?php echo $image?>" alt="student">
                            </div>
                            <div class="item-content">
                                <div class="header-inline item-header">
                                    <h3 class="text-dark-medium font-medium"><?php //echo $name?>s</h3>
                                    <!-- <div class="header-elements">
                                        <ul>
                                            <li><a href="#"><i class="far fa-edit"></i></a></li>
                                            <li><a href="#"><i class="fas fa-print"></i></a></li>
                                            <li><a href="#"><i class="fas fa-download"></i></a></li>
                                        </ul>
                                    </div> -->
                                </div>
                                <div class="info-table table-responsive">
                                    <table class="table text-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $name?></td>
                                            </tr>
                                            <tr>
                                                <td>Gender:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $gender?></td>
                                            </tr>
                                            <tr>
                                                <td>Father Name:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $fname?></td>
                                            </tr>
                                            <tr>
                                                <td>Mother Name:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $mname?></td>
                                            </tr>
                                            <tr>
                                                <td>Date Of Birth:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $dob?></td>
                                            </tr>
                                            <tr>
                                                <td>Religion:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $religion?></td>
                                            </tr>
                                            <tr>
                                                <td>Dept Name:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $dept_name?></td>
                                            </tr>
                                            <tr>
                                                <td>Blood Groups:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $bloodGroup?></td>
                                            </tr>
                                            <tr>
                                                <td>Semester:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $semester?></td>
                                            </tr>
                                            <tr>
                                                <td>Password:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $password?></td>
                                            </tr>
                                            <tr>
                                                <td>Reg No:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $reg_no?></td>
                                            </tr>
                                            <tr>
                                                <td>Present Address:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $presentAddress?></td>
                                            </tr>
                                            <tr>
                                                <td>Permanent Address:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $permanentAddress?></td>
                                            </tr>
                                            <tr>
                                                <td>Phone:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $phoneNumber?></td>
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