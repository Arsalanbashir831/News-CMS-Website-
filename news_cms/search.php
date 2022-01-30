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
                 $search=$_GET['search'];
                $searched_item= "SELECT * FROM post WHERE title='{$search}'";
            $flag=false;
                 $run_query_search=mysqli_query($conn,$searched_item);
                 if (mysqli_num_rows($run_query_search)>0) {
                     $flag=true;
                     while ($post_title=mysqli_fetch_assoc($run_query_search)) {
                   
                ?>
                  <h2 class="page-heading">Search : <?php echo $post_title['title'] ?></h2>
                  <?php 
                    }
                }
                else{
                    echo '<h2 class="page-heading">Search : not found </h2>';
                }
                if ($flag==true) {
                    //query for left join 
                        $limit=3;
                        if (isset($_GET['page'])) {
                          $pageNum=$_GET['page'];
                        }
                        else{
                          $pageNum=1;
                        }
                        $offset=($pageNum-1)*$limit;
                           $sql="SELECT * FROM post
                            LEFT JOIN category ON post.category=category.category_id
                            LEFT JOIN user ON post.author=user.user_id
                            WHERE title='{$search}'
                            ORDER BY post.post_id DESC LIMIT $offset,$limit";
                        $result=mysqli_query($conn,$sql)or die("query failed");
                       if (mysqli_num_rows($result)>0) {
                           while ($rows=mysqli_fetch_assoc($result)) {

                  ?>
                      <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?category=<?php echo $rows['category_id']?>&post_id=<?php echo $rows['post_id']?>"><img src="admin/upload/<?php echo $rows['post_img']?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href="single.php?category=<?php echo $rows['category_id']?>&post_id=<?php echo $rows['post_id']?>"><?php echo $rows['title']?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a  href='category.php?category=<?php echo $rows['category_id']?>'><?php echo $rows['category_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?user_id=<?php echo $rows['user_id']?>'><?php echo $rows['username']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $rows['post_date']?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php
                                     $dis=strtolower($rows['description']);
                                    echo substr($dis,0,150)."......" ?>
                                    </p>
                                    <a class='read-more pull-right' href="single.php?category=<?php echo $rows['category_id']?>&post_id=<?php echo $rows['post_id']?>">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                           }
                        }
                    ?>
                    
                    <?php
                  $get_user_query="SELECT * FROM post WHERE title='{$search}'";
                  $run_get_user_query=mysqli_query($conn,$get_user_query);
                  if (mysqli_num_rows($run_get_user_query)>0) {
                      $total_records=mysqli_num_rows($run_get_user_query);
                      // using the total page formula 
                      $total_page=ceil($total_records/$limit);
                      echo '<ul class="pagination admin-pagination">';
                      if ($pageNum>1) {
                        echo '<li><a href="search.php?page='.($pageNum-1).'&search='.$search.'">Prev</a></li>';
                      }
                    for ($i=1; $i<=$total_page ; $i++) { 
                        $active="";
                        if ($i==$pageNum) {
                            $active="active";
                        }  
                        echo '  <li class="'.$active.'"><a href="search.php?page='.$i.'&search='.$search.'">'.$i.'</a></li>';
                    }
                    if ($pageNum<$total_page) {
                        echo '<li><a href="search.php?page='.($pageNum+1).'&search='.$search.'">Next</a></li>';
                      } 
                   echo '</ul>';
                  }
                  ?>




                    <?php }?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
