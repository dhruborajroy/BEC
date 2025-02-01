<?php
if($id==''){
  
            $id=uniqid();
            $info=getimagesize($_FILES['image']['tmp_name']);
            if(isset($info['mime'])){
                if($info['mime']=="image/jpeg"){
                    $img=imagecreatefromjpeg($_FILES['image']['tmp_name']);
                }elseif($info['mime']=="image/png"){
                    $img=imagecreatefrompng($_FILES['image']['tmp_name']);
                }else{
                    $msg= "Only select jpg or png image";
                }
                if(isset($img)){
                    $image=time().'.jpg';
                    move_uploaded_file($_FILES['image']['tmp_name'],UPLOAD_FACULTY_IMAGE.$image);
                            
                    $sql = "INSERT INTO faculty (id, name,image, designation, phone, email, research_interest, bio, facebook, linked_in, education, experience, publication, scholarship_award, research, teaching_supervision, joined_at, visibility, dept_head, status) 
                    VALUES ('$id','$name','$image', '$designation', '$phone', '$email', '$research_interest', '$bio', '$facebook', '$linked_in', '$education', '$experience', '$publication', '$scholarship_award', '$research', '$teaching_supervision', '$joined_at', '$visibility', $dept_head, '$status')";
                    if(mysqli_query($con,$sql)){
                        $_SESSION['TOASTR_MSG']=array(
                            'type'=>'success',
                            'body'=>'Data Inserted',
                            'title'=>'Success',
                        );
                        // redirect('./about_us');
                    }else{
                        echo $sql;
                    }
            }
}else{
        
}