<?php 
define('SECURE_ACCESS', true);
include("header.php");
?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Reports</h3>
        <ul>
            <li>
                <a href="index">Home</a>
            </li>
            <li>Reports</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Class Routine Area Start Here -->
    <div class="row">
        <div class="col-12-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Medium of Instruction</h3>
                        </div>
                    </div>
                    <form class="new-added-form" action="../pdfreports/moi.php" target="_blank">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Student *</label>
                                <select class="form-control select2" name="student_id">
                                    <option>Select Student</option>
                                    <?php
                                    $st_sql="SELECT students.id,students.name,students.reg_no,depts_lab_list.id as dept_id FROM `students`,depts_lab_list where depts_lab_list.short_form='$dept_id'  and depts_lab_list.id=students.dept_id";
                                    $res=mysqli_query($con,$st_sql);
                                    while($row=mysqli_fetch_assoc($res)){
                                        echo "<option value=".md5($row['id']).">".$row['name']."(".$row['reg_no'].")</option>";                                                        
                                    }
                                    ?>
                                </select>
                                
                                <?php
                                // echo $st_sql;                                    
                                ?>
                            </div>
                            <div class="col-6 form-group mg-t-8">
                                <label></label>
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Generate</button>
                                <a target="_blank"  href="../pdfreports/moi.php?student_id=all" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Generate All</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Clearance</h3>
                        </div>
                    </div>
                    <form class="new-added-form" action="../pdfreports/clearance.php" target="_blank">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Student *</label>
                                <select class="form-control select2" name="student_id">
                                    <option>Select Student</option>
                                    <?php

                                    $res=mysqli_query($con,$st_sql);
                                    while($row=mysqli_fetch_assoc($res)){
                                        echo "<option value=".md5($row['id']).">".$row['name']."(".$row['reg_no'].")</option>";                                                        
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6 form-group mg-t-8">
                                <label></label>
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Generate</button>
                                <a target="_blank"  href="../pdfreports/moi.php?student_id=all" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Generate All</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Testimonials For Currently Studying Students</h3>
                        </div>
                    </div>
                    <form class="new-added-form" action="../pdfreports/testimonial_current.php" target="_blank">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Student *</label>
                                <select class="form-control select2" name="student_id">
                                    <option>Select Student</option>
                                    <?php
                                    $res=mysqli_query($con,$st_sql);
                                    while($row=mysqli_fetch_assoc($res)){
                                        echo "<option value=".md5($row['id']).">".$row['name']."(".$row['reg_no'].")</option>";                                                        
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6 form-group mg-t-8">
                                <label></label>
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Generate</button>
                                <a target="_blank" href="../pdfreports/testimonial_current?student_id=all" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Generate All</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Testimonials For Graduate Students</h3>
                        </div>
                    </div>
                    <form target="_blank" class="new-added-form" action="../pdfreports/testimonial_graduate.php">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Student *</label>
                                <select class="form-control select2" name="student_id">
                                    <option>Select Student</option>
                                    <?php
                                    $res=mysqli_query($con,"SELECT * FROM `students` ");
                                    while($row=mysqli_fetch_assoc($res)){
                                        echo "<option value=".md5($row['reg_no']).">".$row['name']."(".$row['reg_no'].")</option>";                                                        
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6 form-group mg-t-8">
                                <label></label>
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Generate</button>
                                <a target="_blank"  href="../pdfreports/testimonial_graduate?student_id=all" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Generate All</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Class Routine Area End Here -->
<?php include("footer.php")?>