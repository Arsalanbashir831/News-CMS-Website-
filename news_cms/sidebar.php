<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php 
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
          ORDER BY post.post_id DESC LIMIT $offset,$limit";
              $result=mysqli_query($conn,$sql)or die("query failed");
              if (mysqli_num_rows($result)>0) {
                while ($rows=mysqli_fetch_assoc($result)) {
        
        ?>
        <div class="recent-post">
            <a class="post-img"  href="single.php?category=<?php echo $rows['category_id']?>&post_id=<?php echo $rows['post_id']?>">
                <img src="admin/upload/<?php echo $rows['post_img']?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?category=<?php echo $rows['category_id']?>&post_id=<?php echo $rows['post_id']?>"><?php echo $rows['title']?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a  href='category.php?category=<?php echo $rows['category_id']?>'><?php echo $rows['category_name']?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $rows['post_date']?>
                </span>
                <a class="read-more" href="single.php?category=<?php echo $rows['category_id']?>&post_id=<?php echo $rows['post_id']?>">read more</a>
            </div>
        </div>
        <?php 
                }
            }
        ?>
        <!-- start -->
      
    </div>
    <!-- /recent posts box -->
</div>
