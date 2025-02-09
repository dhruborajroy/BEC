<?php 
define('SECURE_ACCESS', true);
include('header.php');
$id="";
$image="";
$previous_image="";
$title="";
$subtitle=" ";
$isbn_ten="";
$isbn_thirteen="";
$department="";
$publish_year="";
$publisher="";
$tags="";
$pages="";
$copies_owned="";
$edition="";
$required="";
$note="";
$language="English";
$description="";
$self="641fcfabbdb4e";
$self_story="";
$required="";
$author_array=[];
$accession="";
$msg="";
$category_id="";
$book_id="";
if(isset($_GET['id']) && $_GET['id']!=""){
	$id=get_safe_value($_GET['id']);
    $book_id=$id;
    $sql="select * from book where id='$id'";
    $res=mysqli_query($con,$sql);
	if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $image=$row['image'];
        $previous_image=$image;
        $title=$row['title'];
        $accession=$row['accession'];
        $subtitle=$row['subtitle'];
        $isbn_ten=$row['isbn_ten'];
        $isbn_thirteen=$row['isbn_thirteen'];
        $department=$row['department'];
        $publish_year=$row['publish_year'];
        $pages=$row['pages'];
        $publisher=$row['publisher'];
        $copies_owned=$row['copies_owned'];
        $tags=$row['tags'];
        $note=$row['notes'];
        $edition=$row['edition'];
        $tags=$row['tags'];
        $language=$row['language'];
        $category_id=$row['category_id'];
        $self=$row['self'];
        $self_story=$row['self_story'];
        $description=$row['description'];
        $required='';
        $author_list_sql="SELECT * FROM `book_author` where book_id='$id'";
        $res=mysqli_query($con,$author_list_sql);
        foreach ($res as $author_id){
            $author_array[]=$author_id['author_id'];
        }
    }else{
        redirect('index');
    }
}
if(isset($_POST['submit']) && isset($_POST['csrf_token']) ){
    if($_POST['csrf_token']!=$_SESSION['csrf_token']){
        die("You don't have permission to access that location");
    }
	$title=get_safe_value($_POST['title']);
    $subtitle=get_safe_value($_POST['subtitle']);
    $accession=get_safe_value($_POST['accession']);
    $isbn_ten=get_safe_value($_POST['isbn_ten']);
    $isbn_thirteen=get_safe_value($_POST['isbn_thirteen']);
    $department=get_safe_value($_POST['department']);
    $publisher=get_safe_value($_POST['publisher']);
    $tags=get_safe_value($_POST['tags']);
    $edition=get_safe_value($_POST['edition']);
    $publish_year=get_safe_value($_POST['publish_year']);
    $pages=get_safe_value($_POST['pages']);
    $self=get_safe_value($_POST['self']);
    $self_story=get_safe_value($_POST['self_story']);
    $description=get_safe_value($_POST['description']);
    if(isset($_POST['author'])){
        $author=$_POST['author'];
    }
    $note=get_safe_value($_POST['note']);
    $category_id=get_safe_value($_POST['category_id']);
    $language=get_safe_value($_POST['language']);
    $copies_owned=get_safe_value($_POST['copies_owned']);
   if($id==''){
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
                $id=uniqid();
                $output_image=$accession."_".$id."_".time().'.jpg';
                imagejpeg($img,UPLOAD_BOOK_IMAGE.$output_image,IMAGE_DECRESE_PERCENT);
                $sql="INSERT INTO `book` (`id`,`accession`, `title`, `subtitle`, `isbn_ten`, `isbn_thirteen`, `publisher`, `tags`, `edition`, `publish_year`, `pages`, `language`, `copies_have`, `description`, `notes`, `copies_owned`,`department`,`image`,`category_id`,`self`,`self_story`,`status`) VALUES 
                                            ('$id', '$accession','$title', '$subtitle', '$isbn_ten', '$isbn_thirteen', '$publisher',  '$tags', '$edition', '$publish_year', '$pages', '$language', '$copies_owned', '$description', '$note',  '$copies_owned','$department','$output_image','$category_id','$self','$self_story',1)";
                mysqli_query($con,$sql);
                $book_id=$id;
                foreach ($author as $author_id) {
                    $insert_id=uniqid();
                    $sql="INSERT INTO `book_author` (`id`, `book_id`,`author_id`,`status`) VALUES 
                    ('$insert_id', '$book_id','$author_id',1)";
                    mysqli_query($con,$sql);
                }
                $_SESSION['INSERT']=1;
            }
        }else{
            $msg= "Only select jpg or png image";
        }
        redirect('./books');
   }else{
        if($_FILES['image']['name']!=''){
            if(isset($_POST['author'])){
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
                        $output_image=$accession."_".$id."_".time().'.jpg';
                        imagejpeg($img,UPLOAD_BOOK_IMAGE.$output_image,IMAGE_DECRESE_PERCENT);
                        $sql="update `book` set  `title`='$title', `accession`='$accession',`subtitle`='$subtitle',`isbn_ten`='$isbn_ten',`isbn_thirteen`='$isbn_thirteen',`publisher`='$publisher',`tags`='$tags',`edition`='$edition',`publish_year`=$publish_year,`pages`='$pages' ,`department`='$department',`language`='$language',`description`='$description',`notes`='$note',`copies_owned`='$copies_owned', `category_id`='$category_id',`image`='$output_image',`self_story`='$self_story',`self`='$self' where  id='$id'";
                        mysqli_query($con,$sql);
                        foreach ($author as $author_id){
                            if(!in_array($author_id,$author_array)){
                                $id=uniqid();
                                $sql="INSERT INTO `book_author` (`id`, `book_id`,`author_id`,`status`) VALUES 
                                ('$id', '$book_id','$author_id',1)";
                                $res=mysqli_query($con,$sql);
                            }
                        }
                        foreach ($author_array as $author_id){
                            if(!in_array($author_id,$author)){
                                $sql="delete from book_author where author_id='$author_id' and book_id='$book_id'";
                                $res=mysqli_query($con,$sql);
                            }
                        }
                        if(file_exists('../media/books/'.$previous_image)){
                            unlink('../media/books/'.$previous_image);
                        }
                        redirect('./books');
                    }
                }else{
                    $msg= "Only select jpg or png image";
                }
            }else{
                $msg= "Please select author";
            }
        }else{
            if(isset($_POST['author'])){
                $sql="update `book` set  `title`='$title',  `accession`='$accession', `subtitle`='$subtitle',`isbn_ten`='$isbn_ten',`isbn_thirteen`='$isbn_thirteen',`publisher`='$publisher',`tags`='$tags',`edition`='$edition',`publish_year`=$publish_year,`pages`='$pages' ,`department`='$department',`language`='$language',`description`='$description',`notes`='$note',`copies_owned`='$copies_owned', `category_id`='$category_id' ,`self_story`='$self_story',`self`='$self' where  id='$id'";
                mysqli_query($con,$sql);
                foreach ($author as $author_id){
                    if(!in_array($author_id,$author_array)){
                        $id=uniqid();
                        $sql="INSERT INTO `book_author` (`id`, `book_id`,`author_id`,`status`) VALUES 
                        ('$id', '$book_id','$author_id',1)";
                        $res=mysqli_query($con,$sql);
                    }
                }
                foreach ($author_array as $author_id){
                    if(!in_array($author_id,$author)){
                        $sql="delete from book_author where author_id='$author_id' and book_id='$book_id'";
                        $res=mysqli_query($con,$sql);
    
                    }
                }
                redirect('./books');
            }else{
                $msg=  "Please select author";
            }
        }
        $_SESSION['UPDATE']=1;
    }
}

?>
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Books</h3>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>Manage Books</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->

    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Books Details</h3>
                    <br>
                    <?php echo $msg;?>
                </div>
            </div>
            <form class="new-added-form validate" id="validate" method="post" enctype="multipart/form-data">
                <?php echo form_csrf();?>
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Accession No*</label>
                        <input type="text" class="form-control book-field-title tooltipstered" id="accession"
                            autocomplete="off" name="accession" value="<?php echo $accession?>">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Title *</label>
                        <input type="text" class="form-control book-field-title tooltipstered" id="title"
                            autocomplete="off" name="title" value="<?php echo $title?>">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Subtitle *</label>
                        <input type="text" class="form-control book-field-title tooltipstered" id="sub_title"
                            autocomplete="off" name="subtitle" value="<?php echo $subtitle?>" required>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>ISBN 10 *</label>
                        <input type="text" class="form-control book-field-title tooltipstered" id="isbn_ten"
                            autocomplete="off" name="isbn_ten" value="<?php echo $isbn_ten?>" required>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>ISBN 13 *</label>
                        <input type="text" class="form-control book-field-title tooltipstered" id="isbn_thirteen"
                            autocomplete="off" name="isbn_thirteen" value="<?php echo $isbn_thirteen?>" required>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Department *</label>
                        <select class="form-control select2" name="department" required id="department">
                            <?php
                            $res=mysqli_query($con,"SELECT * FROM `depts_lab_list` where status='1'");
                            while($row=mysqli_fetch_assoc($res)){
                                if($row['short_form']==$dept_id){
                                echo "<option selected='selected' value=".$row['id'].">".$row['name']." (".$row['short_form'].")</option>";
                                }else{
                                echo "<option value=".$row['id'].">".$row['name']." (".$row['short_form'].")</option>";
                                }                                                        
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Category *</label>
                        <select class="form-control select2" name="category_id" required id="category_id">
                            <option disabled selected>Select category</option>
                            <?php
                            $res=mysqli_query($con,"SELECT * FROM `category`");
                            while($row=mysqli_fetch_assoc($res)){
                                if($row['id']==$category_id){
                                    echo "<option selected='selected' value=".$row['id'].">".$row['name']."</option>";
                                }else{
                                    echo "<option value=".$row['id'].">".$row['name']."</option>";
                                }                                                        
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Publisher *</label>
                        <select class="form-control select2" name="publisher" required id="publisher">
                            <option disabled selected>Select publisher</option>
                            <?php
                            $res=mysqli_query($con,"SELECT * FROM `publications`");
                            while($row=mysqli_fetch_assoc($res)){
                                if($row['id']==$publisher){
                                    echo "<option selected='selected' value=".$row['id'].">".$row['name']."</option>";
                                }else{
                                    echo "<option value=".$row['id'].">".$row['name']."</option>";
                                }                                                        
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Book Self *</label>
                        <select class="form-control select2" name="self" required id="self">
                            <option disabled selected>Select Book self</option>
                            <?php
                            $res=mysqli_query($con,"SELECT * FROM `self` where status='1'");
                            while($row=mysqli_fetch_assoc($res)){
                                if($row['id']==$self){
                                    echo "<option selected='selected' value=".$row['id'].">".$row['name']." (".$row['short_form'].")</option>";
                                }else{
                                    echo "<option value=".$row['id'].">".$row['name']." (".$row['short_form'].")</option>";
                                }                                                        
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Book Self Story *</label>
                        <select class="form-control select2" name="self_story" required id="self_story">
                            <option disabled selected>Select Book self Story</option>
                            <?php
                            $data=[
                                    'name'=>[
                                        '1st',
                                        '2nd',
                                        '3rd',
                                        '4th',
                                        '5th',
                                    ]
                                ];
                                $count=count($data['name']);
                                for($i=0;$i<$count;$i++){
                                    if($data['name'][$i]==$self_story){
                                        echo "<option selected='selected' value=".$data['name'][$i].">".$data['name'][$i]."</option>";
                                    }else{
                                        echo "<option value=".$data['name'][$i].">".$data['name'][$i]."</option>";
                                    }                                                        
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Authors *</label> 
                        <select onchange="checkAuthor()" name="author[]" id="authors" multiple class="form-control select2">
                            <?php
                                $res=mysqli_query($con,"SELECT * FROM `authors`");
                                        foreach ($res as $author) {?>
                                            <option value="<?php echo $author['id']?>" <?php echo in_array($author['id'],$author_array) ? 'selected' :''?>><?php echo $author['name']."(".$author['short_name'].")";?></option>
                                            <?php
                                        }
                                ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Tags *</label>
                        <input type="text" class="form-control book-field-title tooltipstered" id="tags"
                            autocomplete="off" name="tags" value="<?php echo $tags?>">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Edition *</label>
                            <select class="form-control select2" name="edition" required id="edition">
                                <option disabled selected>Select Book Edition</option>
                                <?php
                                    for($i=1;$i<=40;$i++){
                                        $number=addOrdinalNumberSuffix($i);
                                        if($number==$edition){
                                            echo "<option selected='selected' value=".$i.">".$number."</option>";
                                        }else{
                                            echo "<option value=".$i.">".$number."</option>";
                                        }                                                        
                                    }
                                ?>
                            </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Copies Owned *</label>
                        <input type="text" class="form-control book-field-title tooltipstered" id="copies_owned"
                            autocomplete="off" name="copies_owned" placeholder="Copies Owned"
                            value="<?php echo $copies_owned?>">
                    </div>
                    <!-- <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Published Year *</label>
                        <input type="text" class="form-control book-field-title tooltipstered" id="publish_year"
                            autocomplete="off" name="publish_year" value="<?php //echo $publish_year?>">
                    </div> -->
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Date of Register</label>
                        <input type="date" placeholder="Date of Register" name="publish_year" ID="publish_year" 
                            class="form-control " value="<?php echo $publish_year?>">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Pages *</label>
                        <input type="text" class="form-control book-field-title tooltipstered" id="pages"
                            autocomplete="off" name="pages" value="<?php echo $pages?>">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Book Language *</label>
                        <select class="form-control select2" name="language" required id="language">
                            <option disabled selected>Select Book language</option>
                            <?php
                            $data=[
                                    'name'=>[
                                        'Bangla',
                                        'English',
                                        'Arabic',
                                        'Hindi',
                                        'Urdu',
                                    ]
                                ];
                                $count=count($data['name']);
                                for($i=0;$i<$count;$i++){
                                    if($data['name'][$i]==$language){
                                        echo "<option selected='selected' value=".$data['name'][$i].">".$data['name'][$i]."</option>";
                                    }else{
                                        echo "<option value=".$data['name'][$i].">".$data['name'][$i]."</option>";
                                    }                                                        
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Notes *</label>
                        <input id="note" name="note" value="<?php echo $note?>">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Description *</label>
                        <input id="description" name="description" value="<?php echo $description?>">
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <div class="col-sm-12 img-body">
                            <div class="center">
                                <div class="form-input">
                                    <div class="preview">
                                        <img id="file_ip_1-preview" <?php if($image!=''){
                                                    echo 'src="'.BOOK_IMAGE.$image.'"';}
                                                    ?> style="width:200px;height: 200px">
                                    </div>
                                    <label for="file_ip_1">Upload Image</label>
                                    <input type="file" name="image" id="file_ip_1" accept="image/*"
                                        onchange="showPreview(event);" <?php echo $required?>
                                        value="<?php echo $image?>">
                                </div>
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
                        </div>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" id="submit" name="submit"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        <!-- <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Admit Form Area End Here -->
    <?php include('footer.php');?>
    <script>
        function checkAuthor(){
            var author=$('#authors').val();
            console.log('chane');
            if(author==""){
                $('#submit').prop('disabled', true);
                $('#submit').html('Select Author');
            }else{
                $('#submit').html('Save');
                $('#submit').prop('disabled', false);
            }
        }

    </script>