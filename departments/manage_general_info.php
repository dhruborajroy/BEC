<?php 
define('SECURE_ACCESS', true);
include("header.php");
$swl="select * from `general_info` where id='1'";
$res=mysqli_query($con,$swl);
if(mysqli_num_rows($res)>0){
    $row=mysqli_fetch_assoc($res);
    $history=$row['history'];
    $vision_mission=$row['vision_mission'];
    $organogram=$row['organogram'];
    $bec_at_a_glance=$row['bec_at_a_glance'];
    $bec_monogram=$row['bec_monogram'];
}else{
    $_SESSION['TOASTR_MSG']=array(
        'type'=>'error',
        'body'=>'You don\'t have the permission to access the location!',    
        'title'=>'Error',
    );
    // redirect("index.php");
}
if(isset($_POST['submit'])){
    $image=time().'.jpg';
	$history=($_POST['history']);
	$vision_mission=($_POST['vision_mission']);
	$bec_at_a_glance=$_POST['bec_at_a_glance'];
	$bec_monogram=($_POST['bec_monogram']);
    
    $updated_on=time();
    if(isset($info['mime'])){
        if($info['mime']=="image/jpeg"){
            $img=imagecreatefromjpeg($_FILES['organogram']['tmp_name']);
        }elseif($info['mime']=="image/png"){
            $img=imagecreatefrompng($_FILES['organogram']['tmp_name']);
        }else{
            $msg= "Only select jpg or png image";
        }
        if(isset($img)){
            $sql = "UPDATE `general_info` SET `history` = '$history',`vision_mission` = '$vision_mission',`organogram` = '$organogram',`bec_at_a_glance` = '$bec_at_a_glance',`bec_monogram` = '$bec_monogram' WHERE `general_info`.`id` = '1'";

            if(mysqli_query($con,$sql)){
                $_SESSION['TOASTR_MSG']=array(
                    'type'=>'success',
                    'body'=>'Data Updated',
                    'title'=>'Success',
                );
                // redirect('./sliders');
                
            }else{
                $msg= "Only select jpg or png image";
            }
        }
    }else{
        $sql = "UPDATE `general_info` SET `history` = '$history',`vision_mission` = '$vision_mission',`bec_at_a_glance` = '$bec_at_a_glance',`bec_monogram` = '$bec_monogram' WHERE `general_info`.`id` = '1'";

        if(mysqli_query($con,$sql)){
            $_SESSION['TOASTR_MSG']=array(
                'type'=>'success',
                'body'=>'Data Updated',
                'title'=>'Success',
            );
        }
    }

    $sql = "UPDATE `general_info` SET `history` = '$history',`vision_mission` = '$vision_mission',`organogram` = '$organogram',`bec_at_a_glance` = '$bec_at_a_glance',`bec_monogram` = '$bec_monogram' WHERE `general_info`.`id` = '1'";
    if(mysqli_query($con,$sql)){
        $_SESSION['TOASTR_MSG']=array(
            'type'=>'success',                
            'body'=>'Data Updated',
            'title'=>'Success',
        );
        // redirect('./about_us');
    }else{
        echo $sql;
    }
}
?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>General Infos</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>General Infos </li>
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
                        </div>
                    </div>
                    <form  onsubmit="replaceApostrophe()"  id="validate" class="new-added-form" method="post">
                        <div class="row">
                            <div class="col-12-xxxl col-lg-12 col-12 ">
                                <h1>History</h1>
                                <textarea class="full_input" name="history" id="history"><?php echo $history?></textarea class="full_input">
                            </div>
                            <div class="col-12-xxxl col-lg-12 col-12 ">
                                <h1>Vision Mission </h1>
                                <textarea class="full_input" name="vision_mission" id="vision_mission" cols="30" rows="30"><?php echo $vision_mission?></textarea class="full_input">
                            </div>
                            
                            
                                <script type="text/javascript">
                                function showPreview(event) {
                                    if (event.target.files.length > 0) {
                                        var src = URL.createObjectURL(event.target.files[0]);
                                        var preview = document.getElementById("file_ip_1-preview");
                                        preview.src = src;
                                        preview.style.display = "block";
                                    }
                                }
                                </script>
                            <div class="col-12-xxxl col-lg-12 col-12 ">
                                <h1>At a glance</h1>
                                <textarea class="full_input" name="bec_at_a_glance" id="bec_at_a_glance" cols="30" rows="30"><?php echo $bec_at_a_glance?></textarea class="full_input">
                            </div>
                            <div class="col-12-xxxl col-lg-12 col-12 ">
                            <h1>Monogram</h1>
                                <textarea class="full_input" name="bec_monogram" id="bec_monogram" cols="30" rows="30"><?php echo $bec_monogram?></textarea class="full_input">
                            </div>
                            <div class="col-lg-12 col-12 form-group">
                                <div class="col-sm-12 img-body">
                                    <div class="center">
                                        <div class="form-input">
                                            <div class="preview">
                                                <img id="file_ip_1-preview" <?php if($organogram!=''){
                                                    echo 'src="../images/'.$organogram.'"';}
                                                    ?> >
                                    </div>
                                    <label for="file_ip_1">Upload Organogram</label>
                                    <input type="file" name="image" id="file_ip_1" accept="image/*"
                                    onchange="showPreview(event);" value="<?php echo $organogram?>">
                                </div>
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
        function replaceApostrophe() {
            var history = document.getElementById('history').value;
            history = history.replace(/'/g, "\\'"); 
            document.getElementById('history').value = history; 
            // 
            
            var vision_mission = document.getElementById('vision_mission').value;
            vision_mission = vision_mission.replace(/'/g, "\\'"); 
            document.getElementById('vision_mission').value = vision_mission; 
            // 
            
            var organogram = document.getElementById('organogram').value;
            organogram = organogram.replace(/'/g, "\\'"); 
            document.getElementById('organogram').value = organogram; 
            // 
            
            var bec_at_a_glance = document.getElementById('bec_at_a_glance').value;
            bec_at_a_glance = bec_at_a_glance.replace(/'/g, "\\'"); 
            document.getElementById('bec_at_a_glance').value = bec_at_a_glance; 
            // 
            
            var bec_monogram = document.getElementById('bec_monogram').value;
            bec_monogram = bec_monogram.replace(/'/g, "\\'"); 
            document.getElementById('bec_monogram').value = bec_monogram; 
        
        }
    </script>