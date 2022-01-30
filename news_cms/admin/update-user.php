<?php include "header.php";
include 'config.php';
if ($_SESSION['role']==0) {
    header("Location:$url/admin/post.php"); 
    }
?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
              <?php
                        
                        $userId=$_GET['id'];
                        $user_read_query="SELECT * FROM user WHERE user_id=$userId";
                        $result=mysqli_query($conn,$user_read_query);
                        if (mysqli_num_rows($result)>0) {
                        while ($row=mysqli_fetch_assoc($result)) {   
               ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $userId?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                          <?php if ($row['role']==1) {
                             echo '<option value="1" selected >Admin</option>';
                             echo '<option value="0">Subscriber</option>';
                          }
                          else {
                            echo '<option value="1">Admin</option>';
                            echo '<option value="0" selected >Subscriber</option>';
                          }?>
   
                          </select>
                      </div>
                      <?php } }?>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php                    
                    if (isset($_POST['submit'])) {
                        $fname= mysqli_real_escape_string($conn,$_POST['f_name']);
                        $lname=mysqli_real_escape_string($conn,$_POST['l_name']);
                        $user_name=mysqli_real_escape_string($conn,$_POST['username']);
                        $role=mysqli_real_escape_string($conn,$_POST['role']);
                       //updation query
                      $update_sql="UPDATE user 
                      SET first_name='{$fname}',last_name='{$lname}',username='{$user_name}',role='{$role}'
                      WHERE user_id=$userId";
                      $run_query=mysqli_query($conn,$update_sql);
                      header("Location:$url/admin/users.php");
                     }
                    ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
