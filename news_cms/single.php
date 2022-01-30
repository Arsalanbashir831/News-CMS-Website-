<?php include 'header.php';
include 'admin/config.php';
?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <?php 
                        $post_id=$_GET['post_id'];
                        $cat_id=$_GET['category'];
                         $sql="SELECT * FROM post
                         LEFT JOIN category ON post.category=category.category_id
                         LEFT JOIN user ON post.author=user.user_id";
                         $result=mysqli_query($conn,$sql);
                         if (mysqli_num_rows($result)) {
                             while ($rows=mysqli_fetch_assoc($result)) {
                                 if ($post_id==$rows['post_id']&&$cat_id=$rows['category_id']) {
                                     
                                 
                        ?>
                        <div class="post-content single-post">
                            <h3> <?php echo $rows['title']?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <?php echo $rows['category_name']?>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php'><?php echo  $rows['username']?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo  $rows['post_date']?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $rows['post_img'] ?>" alt=""/>
                            <p class="description">
                            <?php  echo $rows['description']?></p>
                        </div>
                        <?php
                                 }
                             }
                            }
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
