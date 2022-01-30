<?php include "header.php";
 include 'config.php';
 if ($_SESSION['role']==0) {
    header("Location:$url/admin/post.php"); 
    }

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php 
                        
                         $limit=3;
                         if (isset($_GET['page'])) {
                           $pageNum=$_GET['page'];
                         }
                         else{
                           $pageNum=1;
                         }
                         $offset=($pageNum-1)*$limit;
                         $sql="SELECT * FROM category ORDER BY category_id DESC LIMIT $offset,$limit";
                         $result=mysqli_query($conn,$sql);
                        if (mysqli_num_rows($result)>0) {
                            while ($rows=mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td class='id'><?php echo $rows['category_id'];?></td>
                            <td><?php echo $rows['category_name'];?></td>
                            <td><?php echo $rows['post'];?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $rows['category_id'];?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $rows['category_id'];?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php                         
                        }
                    }
                ?>
                    </tbody>

                </table>
                
                <?php
                  $get_user_query="SELECT * FROM category";
                  $run_get_user_query=mysqli_query($conn,$get_user_query);
                  if (mysqli_num_rows($run_get_user_query)>0) {
                      $total_records=mysqli_num_rows($run_get_user_query);
                      // using the total page formula 
                      $total_page=ceil($total_records/$limit);
                      echo '<ul class="pagination admin-pagination">';
                      if ($pageNum>1) {
                        echo '<li><a href="category.php?page='.($pageNum-1).'">Prev</a></li>';
                      }
                    for ($i=1; $i<=$total_page ; $i++) { 
                        $active="";
                        if ($i==$pageNum) {
                            $active="active";
                        }  
                        echo '  <li class="'.$active.'"><a href="category.php?page='.$i.'">'.$i.'</a></li>';
                    }
                    if ($pageNum<$total_page) {
                        echo '<li><a href="category.php?page='.($pageNum+1).'">Next</a></li>';
                      } 
                   echo '</ul>';
                  }
                  ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
