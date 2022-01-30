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
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <?php
                          
                          $limit=4;
                          if (isset($_GET['page'])) {
                            $pageNum=$_GET['page'];
                          }
                          else{
                            $pageNum=1;
                          }
                          $offset=($pageNum-1)*$limit;
                          $sql="SELECT * FROM user ORDER BY user_id DESC LIMIT $offset,$limit";
                          $result=mysqli_query($conn,$sql);
                          if (mysqli_num_rows($result)>0) {
                              while ($rows=mysqli_fetch_assoc($result)) {
                          ?>
                      <tbody>
                          <tr>
                              <td class='id'><?php echo  $rows['user_id']?></td>
                              <td><?php echo $rows['first_name'].' '.$rows['last_name']?></td>
                              <td><?php echo $rows['username']?></td>
                              <?php if ($rows['role']==1) {
                                  echo ' <td>Admin</td>';
                              }
                              else {
                                echo ' <td>Subscriber</td>';
                              }
                              ?>
                              <td class='edit'><a href='update-user.php?id=<?php echo $rows['user_id']?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $rows['user_id']?>'><i class='fa fa-trash-o'></i></a></td>
                            </tr>
                      </tbody>
                      <?php    }
                          }?>
                  </table>

                  <?php
                  $get_user_query="SELECT * FROM user";
                  $run_get_user_query=mysqli_query($conn,$get_user_query);
                  if (mysqli_num_rows($run_get_user_query)>0) {
                      $total_records=mysqli_num_rows($run_get_user_query);
                      
                      // using the total page formula 
                      $total_page=ceil($total_records/$limit);
                      echo '<ul class="pagination admin-pagination">';
                      if ($pageNum>1) {
                        echo '<li><a href="users.php?page='.($pageNum-1).'">Prev</a></li>';
                      }
                    for ($i=1; $i<=$total_page ; $i++) { 
                        $active="";
                        if ($i==$pageNum) {
                            $active="active";
                        }  
                        echo '  <li class="'.$active.'"><a href="users.php?page='.$i.'">'.$i.'</a></li>';
                    
                    }
                    if ($pageNum<$total_page) {
                        echo '<li><a href="users.php?page='.($pageNum+1).'">Next</a></li>';
                      } 
                   echo '</ul>';
                  }
                  ?>
              </div>
          </div>
      </div>
    
  </div>
<?php include "header.php"; ?>
