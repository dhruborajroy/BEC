<?php 
define('SECURE_ACCESS', true);
include("header.php");
$teacher_name="";
$course_name="";
$course_code="";
$id="";
$teacher_id="";
$semester="";
$course_id="";
$msg="";
if(isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
    $sql="select course_teachers.*, courses.course_name,courses.course_code,courses.semester,people.name as teacher_name ,people.id as teacher_id from course_teachers,courses,people where courses.id=course_teachers.course_id and  course_teachers.teacher_id=people.id and course_teachers.id='$id'";
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $teacher_name=$row['teacher_name'];
        $teacher_id=$row['teacher_id'];
        $course_name=$row['course_name'];
        $semester=$row['semester'];
        $course_code=$row['course_code'];
        $course_id=$row['course_id'];
    }else{
        $_SESSION['TOASTR_MSG']=array(
           'type'=>'error',
           'body'=>'You don\'t have the permission to access the location!',    
           'title'=>'Error',
        );
        redirect("index.php");
    }
}
if(isset($_POST['submit'])){
    
    $course_id=get_safe_value($_POST['course']);
    $teacher_id=get_safe_value($_POST['teacher_id']);
    $semester=get_safe_value($_POST['semester']);
    if ($id == '') {
        // Check for duplicate entry
        $check_sql = "SELECT * FROM `course_teachers` WHERE `teacher_id` = '$teacher_id' 
                      AND `batch` = '' AND `semester` = '$semester' AND `course_id` = '$course_id'";
        $result = mysqli_query($con, $check_sql);
    
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['TOASTR_MSG'] = array(
                'type' => 'error',
                'body' => 'Course already assigned to this teacher',
                'title' => 'Duplicate Entry',
            );
            $msg="Course already assigned to this teacher";
        } else {
            $id = uniqid();
            $sql = "INSERT INTO `course_teachers` (`id`, `teacher_id`, `batch`, `semester`, `course_id`, `status`) VALUES 
                    ('$id', '$teacher_id', '', '$semester', '$course_id', '1')";
            
            if (mysqli_query($con, $sql)) {
                $_SESSION['TOASTR_MSG'] = array(
                    'type' => 'success',
                    'body' => 'Data Inserted',
                    'title' => 'Success',
                );
                redirect("course_teachers");
            } else {
                echo "Error: " . mysqli_error($con);
            }
        }
    } else {
        
        // Check for duplicate entry
        $check_sql = "SELECT * FROM `course_teachers` WHERE `teacher_id` = '$teacher_id' 
                      AND `batch` = '' AND `semester` = '$semester' AND `course_id` = '$course_id'";
        $result = mysqli_query($con, $check_sql);
    
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['TOASTR_MSG'] = array(
                'type' => 'error',
                'body' => 'Course already assigned to this teacher',
                'title' => 'Duplicate Entry',
            );
            $msg="Course already assigned to this teacher";
        } else {
            $sql = "UPDATE `course_teachers` SET `teacher_id` = '$teacher_id', `batch` = '', 
                    `semester` = '$semester', `course_id` = '$course_id' WHERE `id` = '$id'";
            
            if (mysqli_query($con, $sql)) {
                $_SESSION['TOASTR_MSG'] = array(
                    'type' => 'success',
                    'body' => 'Data Updated',
                    'title' => 'Success',
                );
                redirect("course_teachers");
            } else {
                echo "Error: " . mysqli_error($con);
            }
        }
    }
    redirect('./course_teachers');
}

?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Notice board</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Notices </li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <div class="row">
        <!-- Add Notice Area Start Here -->
        <div class="col-12-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Create Course Teacher</h3>
                            <h3><?php echo $msg?></h3>
                        </div>
                    </div>
                    <form id="validate" class="new-added-form" method="post">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-12 form-group">
                                <label>Course Teachers *</label>
                                <select class="form-control select2" name="teacher_id">
                                    <?php
                                    $res=mysqli_query($con,"SELECT people.name,people.id FROM `people` where type='faculty' and status='1'");
                                    while($row=mysqli_fetch_assoc($res)){
                                        if($row['id']==$teacher_id){
                                            echo "<option selected='selected' value=".$row['id'].">".$row['name']."</option>";
                                        }else{
                                            echo "<option value=".$row['id'].">".$row['name']."</option>";
                                        }                                                        
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                <label for="visibility">Semester</label>
                                <select class="form-control" name="semester" id="semester" >
                                    <option value='0'>Select Semester</option>
                                    <?php
                                            $data  = [
                                                '1' => '1st',
                                                '2' => '2nd',
                                                '3' => '3rd',
                                                '4' => '4th',
                                                '5' => '5th',
                                                '6' => '6th',
                                                '7' => '7th',
                                                '8' => '8th',
                                            ];

                                            foreach ($data as $key => $val) {
                                                if ($key == $semester) {
                                                    echo "<option selected='selected' value='$key'>$val</option>";
                                                } else {
                                                    echo "<option value='$key'>$val</option>";
                                                }
                                            }
                                            ?>
                                </select>
                            </div>
                            <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                <label for="visibility">Semester</label>
                                <select class="form-control select2" name="course" id="course"  data-selected="<?php echo $course_id?>">
                                    
                                </select>
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <input type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark"
                                    name="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Notice Area End Here -->
    </div>
    <?php include("footer.php")?>
    

    
   <script>
    
    // Function to check if all fields are filled
    function checkFormFields() {
        var semester = $('#semester').val();
        var course = $('#course').val();

        if (semester !== "0" && course !== "") {
                $('#get_attendance').prop('disabled', false); 
        } else {
            $('#get_attendance').prop('disabled', true); 
        }
    }

    window.onload = function() {
        var semester = $("#semester").val();
        var selectedCourse = $("#course").attr("data-selected"); // Get previously selected course

       $.ajax({
           url: "ajax/fetch_courses",
           method: "POST",
           data: { 
             semester: semester,
             selected_course:selectedCourse 
           },
           success: function(response) {
               $("#course").html(response);
           }
       });

       $("#course").change(function() {
           checkFormFields();
       });
    };


   $("#semester").change(function() {
        checkFormFields();
        // alert();
        var semester = $(this).val();
        var selectedCourse = $("#course").attr("data-selected"); // Get previously selected course

        $.ajax({
            url: "ajax/fetch_courses",
            method: "POST",
            data: {
                semester: semester,
                selected_course:selectedCourse 
            },
            success: function(response) {
                $("#course").html(response);
            }
        });
        $("#course").change(function() {
            checkFormFields();
        });
   });
   
   </script>