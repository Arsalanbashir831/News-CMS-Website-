<?php include "header.php";
include 'config.php';


if ($_SESSION['role']==0) {
    header("Location:$url/admin/post.php"); 
    }
?>

<?php 
if (isset($_POST['save'])) {
    
    $fname= mysqli_real_escape_string($conn,$_POST['fname']);
    $lname=mysqli_real_escape_string($conn,$_POST['lname']);
    $user_name=mysqli_real_escape_string($conn,$_POST['user']);
    $password=mysqli_real_escape_string($conn,md5($_POST['password']));
    $role=mysqli_real_escape_string($conn,$_POST['role']);

    $user_read_query="SELECT username FROM user WHERE username='{$user_name}'";
   $result=mysqli_query($conn,$user_read_query);
    if (mysqli_num_rows($result)>0) {
        echo '<p style ="color :red; margin: 10px,0px; text-align:center;"> sorry u cant use this username is already taken</p>';
    }
    else{
        // use insert query 
        $insert_user="INSERT INTO user(username,first_name,last_name,password,role)
        VALUES('{$user_name}','{$fname}','{$lname}','{$password}','{$role}')";
        $run_insert=mysqli_query($conn,$insert_user);
        header("Location:$url/admin/users.php");
    }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Subscriber</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
