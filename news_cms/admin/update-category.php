<?php include "header.php";
include 'config.php'; 
 if ($_SESSION['role']==0) {
    header("Location:$url/admin/post.php"); 
    }

?>
<?php

$category_id=$_GET['id'];

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="cat_id" class="form-control" value="1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <?php 
                          $view_data="SELECT category_name FROM category WHERE category_id='{$category_id}'";
                          $run_view_data_query=mysqli_query($conn,$view_data);
                          if (mysqli_num_rows($run_view_data_query)>0) {
                             while ($rows=mysqli_fetch_assoc($run_view_data_query)) { 
                          ?>
                        <input type="text" name="cat_name" class="form-control"
                            value="<?php echo $rows['category_name']?>" placeholder="" required>
                        <?php  }
                    }?>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
                <?php  
                  if (isset($_POST['submit'])) {    
                    $cat_name=$_POST['cat_name'];
                    $sql="UPDATE category SET category_name='{$cat_name}' WHERE category_id=$category_id";
                    $result=mysqli_query($conn,$sql)or die("query failed");
                    header("Location:$url/admin/category.php");
                }
                  ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>