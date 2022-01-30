<?php
include 'config.php';
 if ($_SESSION['role']==0) {
    header("Location:$url/admin/post.php"); 
    }

$userId=$_GET['id'];
// delete query
$del_query="DELETE FROM user WHERE user_id=$userId";
$run_query=mysqli_query($conn,$del_query);
header("Location:$url/admin/users.php");
?>