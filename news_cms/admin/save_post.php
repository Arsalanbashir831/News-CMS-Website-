<?php
include 'config.php';

if (isset($_FILES['fileToUpload'])) {
 
    $erros=array();
    $file_name=$_FILES['fileToUpload']['name'];
    $file_size=$_FILES['fileToUpload']['size'];
    $file_tmp=$_FILES['fileToUpload']['tmp_name'];
    $file_type=$_FILES['fileToUpload']['type'];
   $file_ext=end(explode('.',$file_name));
    $extension=array("jpeg","jpg","png");
   
    if (in_array($file_ext,$extension)===false) {
        $erros[]="this ext file is not allowed ...";
    }
    if ($file_size>2097152) {
        $erros[]="File size is too large must be less than 2MB";
    }
    if (empty($erros)==true) {
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }
    else{
        print_r($erros);
        die();
    }
}

session_start();
// get the user data
$title=mysqli_real_escape_string($conn,$_POST['post_title']);
$desc=mysqli_real_escape_string($conn,$_POST['postdesc']);
$category=mysqli_real_escape_string($conn,$_POST['category']);
$date=date("d M,Y");
$author=$_SESSION['id'];
$sql="INSERT INTO post(title,description,category,post_date,author,post_img) 
VALUES('{$title}','{$desc}',{$category},'{$date}',{$author},'{$file_name}');";
 $sql.="UPDATE category SET post=post+1 WHERE category_id={$category}";
if (mysqli_multi_query($conn,$sql)) {
    header("Location:$url/admin/post.php");
}
else{
    echo '<div class="alert alert-danger"> Query failed</div>';
}
?>
