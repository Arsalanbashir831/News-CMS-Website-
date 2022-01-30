<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
     
        <form action="save_updated_post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <?php
        include 'config.php';
        $category_id=$_GET['category'];
        $post_id=$_GET['id'];
        $sql="SELECT * FROM post WHERE post.post_id={$post_id};"; 
        $result=mysqli_query($conn,$sql);
        if (mysqli_num_rows($result)>0) {
            while ($rows=mysqli_fetch_assoc($result)) {
        ?>   
        <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $rows['post_id']?>" placeholder="">
            </div>
            <div class="form-group">
                
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $rows['title']?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                  <?php echo  $rows['description']; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <?php
                    $view_cat_sql="SELECT * FROM category ";
                    $run_view_cat_sql=mysqli_query($conn,$view_cat_sql);
                    if (mysqli_num_rows($run_view_cat_sql)>0) {
                        while ($rows1=mysqli_fetch_assoc($run_view_cat_sql)) {
                            if ($rows['category']==$rows1['category_id']) {
                               $selected="selected";
                            }
                            else{
                                $selected="";
                            }
                         echo '<option '.$selected.' value="'.$rows1['category_id'].'">'. $rows1['category_name'].'</option>';   
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image" >
                <img  src="upload/<?php echo $rows['post_img']?>" height="150px">
                <input type="hidden" name="old_image" value="<?php echo $rows['post_img']?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
            <?php
              }
            }
            ?>
        </form>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
