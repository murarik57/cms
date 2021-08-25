<?php include "includes/header.php" ?>
<?php include "includes/db.php" ?>
   
    <!-- Navigation -->
    
<?php include "includes/nav.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
              <?php
                $per_page=3;
                if(isset($_GET['page'])){
                    $page=$_GET['page'];
                }
                else
                    $page="";
                if($page == "" || $page==1){
                    $page_num=0;
                }
                else{
                    $page_num=($page*$per_page)-$per_page;
                }    
                
                ?>
               <h1 class="page-header">
                    All Posts
                </h1>
                
                
                <?php
                    $posts_query="SELECT * FROM posts WHERE post_status ='published'";
                    $result=mysqli_query($connection,$posts_query);
                    $count=mysqli_num_rows($result);
                if($count == 0){
                    echo "<h2 class='text-center'>No post Available. Please login to Admin area to see your draft post there!</h2>";
                }
                    $count= ceil($count / $per_page);

                    
                    $query = "SELECT * FROM posts WHERE post_status ='published' LIMIT $page_num,$per_page";
                    $select_all_posts_query= mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id=$row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,25);
                        
                        
                ?>
      
                <!-- First Blog Post -->
                <h2>
                    <a href="post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="/cms/postbyAuthor.php?post_author=<?php echo $post_author; ?>">
                    <?php 
                        if(!empty($post_author))
                            echo $post_author;
                        elseif(!empty($post_user))
                            echo $post_user;
                    ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="/cms/post.php?post_id=<?php echo $post_id; ?>"><img class="img-responsive" src="/cms/images/<?php echo imagePlaceholder($post_image); ?>" alt="Post Image"></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                         
                   
                    <?php } ?>
  

                <!-- Pager -->
              
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
    <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->
    
        <hr>
        <ul class="pager">
            <?php
                for($i=1;$i<=$count;$i++){
                    if($i == $page){
                        echo "<li><a class='active_link' href='?page=$i'>$i</a></li>";
                    }
                    else
                        echo "<li><a href='?page=$i'>$i</a></li>";
                }   
            ?>

        </ul>

        
<?php include "includes/footer.php" ?>
