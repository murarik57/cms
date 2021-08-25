<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php include "includes/nav.php" ?>
   
    <!-- Navigation -->
    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
    
                    if(isset($_GET['cat_id'])){
                        $post_category_id=$_GET['cat_id'];
                            
                    $query = "SELECT * FROM posts WHERE post_category_id=$post_category_id AND post_status = 'published'";
                    $select_all_posts_query= mysqli_query($connection,$query);
                    $number=mysqli_num_rows($select_all_posts_query);
                    if($number==0)
                        echo "<h1>No Post found for this category</h1>";
                        
            
                        while($row=mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id=$row['post_id'];   
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,25);
        
                ?>
      
                <!-- First Blog Post -->
                <h2>
                    <a href="/cms/post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="/cms/images/<?php echo imagePlaceholder($post_image); ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                         
                   
                 <?php } } }
                    else
                        echo "<h2 class='text-center'>Please Login to see post in categories.</h2>";
                    
                ?>
  

                <!-- Pager -->
              
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
    <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        
<?php include "includes/footer.php" ?>
