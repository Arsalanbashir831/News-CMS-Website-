<?php 
include 'config.php';

if (empty($_FILES['new-image']['name'])) {
   
    $file_name=$_POST['old_image'];

}
else {
  
    $erros=array();
    $file_name=$_FILES['new-image']['name'];
    $file_size=$_FILES['new-image']['size'];
    $file_tmp=$_FILES['new-image']['tmp_name'];
    $file_type=$_FILES['new-image']['type'];
    $txt=explode('.',$file_name);
   $file_ext=end($txt);
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
    unlink("upload/".$_POST['old_image']);
}

 $sql="UPDATE post SET title='{$_POST['post_title']}', 
description='{$_POST['postdesc']}',
category={$_POST['category']},
post_img='{$file_name}' 
WHERE post.post_id={$_POST['post_id']}";
mysqli_query($conn,$sql);

header("Location:$url/admin/post.php");
?>