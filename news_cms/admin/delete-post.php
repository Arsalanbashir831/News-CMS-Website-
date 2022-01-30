<?php
include 'config.php';
$post_id=$_GET['id'];
$cat_id=$_GET['category'];
// get image from db
$post_query="SELECT * FROM post WHERE post_id=$post_id";
// running the query
$result=mysqli_query($conn,$post_query);
$row=mysqli_fetch_assoc($result);
// delete the image from the upload folder
unlink("upload/".$row['post_img']);
$sql="DELETE FROM post WHERE post_id=$post_id AND category=$cat_id;";
$sql.="UPDATE category SET post=post-1 WHERE category_id=$cat_id";
if (mysqli_multi_query($conn,$sql)) {
   header("Location:$url/admin/post.php");
}

?>