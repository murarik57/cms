<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
   
    <!-- Navigation -->
    
<?php include "includes/nav.php" ?>
   
   <?php 
    //loged in user details
    if(isset($_SESSION['user_name'])){
         $user_name=$_SESSION['user_name'];
         $post_id=$_GET['post_id'];
        $result=mysqli_query($connection,"SELECT user_id FROM users WHERE user_name='$user_name'");
        $user_session_id=mysqli_fetch_assoc($result);
         $user_se_id=$user_session_id['user_id'];
         $liked=record_count("likes WHERE post_id=$post_id AND user_id=$user_se_id");
        if($liked >= 1){
            $class='unlike';
            $class_icon='glyphicon glyphicon-thumbs-down';
            $msg=' Unlike';
        }
        else{
            $class='like';
            $class_icon='glyphicon glyphicon-thumbs-up';
            $msg=' Like';
        }

    }

?>
    
<?php
    $searchPost="SELECT * FROM posts WHERE post_id=".$_GET['post_id'];
    $send_query=mysqli_query($connection,$searchPost);
    $post =mysqli_fetch_assoc($send_query);
    $likes=$post['post_likes']; 

    if(isset($_POST['liked'])){
        $post_id=$_POST['post_id'];
        $user_id=$_POST['user_id'];
         
        //update post likes
        mysqli_query($connection,"UPDATE posts SET post_likes=post_likes+1 WHERE post_id=$post_id");
        //set likes
        mysqli_query($connection,"INSERT INTO likes(user_id,post_id) VALUES($user_id, $post_id)");
        exit();
    }

 
    if(isset($_POST['unliked'])){
        $post_id=$_POST['post_id'];
        $user_id=$_POST['user_id'];
         
        //2. Delete Likes
        mysqli_query($connection,"DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id");
        
        //update - decrease likes
        
        mysqli_query($connection,"UPDATE posts SET post_likes=post_likes-1 WHERE post_id=$post_id");
        
        exit();
    }

    
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                
                <?php
                    if(isset($_GET['post_id'])){
                        $post_id= $_GET['post_id'];
                        
                    $view_query="UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id='$post_id' ";
                    $send_query=mysqli_query($connection,$view_query);
                        if(!$send_query)
                            die("error".mysqli_error($connection));
                        
                    $query = "SELECT * FROM posts WHERE post_id='$post_id' AND post_status='published'";
                    $select_all_posts_query= mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($select_all_posts_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                 
                ?>
                
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="/cms">
                    <?php
                        if(!empty($post_author))
                            echo $post_author;
                        elseif(!empty($post_user))
                            echo $post_user;
                    ?>
                    </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="/cms/images/<?php echo imagePlaceholder($post_image); ?>" alt="Post Image">
                <hr>
                <p><?php echo $post_content; ?></p>
             
                <div class="row" id="myDiv">
                    <p class="likes pull-right"><?php echo 'Likes: '.$likes . "&nbsp;"; ?>
                    <?php if(isset($msg)): ?>
                        <a class="<?php echo $class; ?>" data-toggle="tooltip" title="<?php echo ($msg==" Like") ? 'Want to Like' :'You liked this post click to unlike' ; ?>" href="">
                        <span class="<?php echo $class_icon; ?>">
                        </span><?php echo $msg; ?></a>
                    <?php else: ?> 
                        <a href="/cms/login">Login to like this post</a>
                        <?php endif; ?>
            
                    </p>
                </div>
<!--
                <div class="row">
                    <p class="pull-right">10<a class="unlike" href="#"><span class="glyphicon glyphicon-thumbs-down"></span>UnLike</a></p>
                </div>
-->
                <div class="clearfix"></div>
                         
                   
                    <?php } }
        else
            header("Location: index");      
                ?>
                                     
                <!-- Blog Comments -->
<?php
if(isset($_POST['create_comment'])){
    $comment_post_id=$post_id= $_GET['post_id'];
    $comment_author=$_POST['comment_author'];
    $comment_email=$_POST['comment_email'];
    $comment_content=$_POST['comment_content'];
    $comment_date=date('d-m-y');
    
    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
        $query="INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_date,comment_status) ";
    $query .= "VALUES ('$comment_post_id','$comment_author','$comment_email','$comment_content',now(),'Unapproved') ";

    $insert_comment=mysqli_query($connection,$query);
    if(!$insert_comment)
        die("Failed ".mysqli_query($connection));
    else
        echo "<h2>Comment Posted Sucessfully</h2>";
}
    
    else{
        echo "<script> alert('Fields cannot be empty'); </script>";
    }

}

?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                       <div class="form-group">
                           <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                         <div class="form-group">
                           <label for="email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
    <?php
              
        $query="SELECT * FROM comments WHERE comment_post_id='$post_id' ";
        $query .= "AND comment_status = 'approved' ";
        $query .= "ORDER BY comment_id DESC "; // descending for newest comment as top
        $show_comments = mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($show_comments)){
            $comment_date=$row['comment_date'];
            $comment_content=$row['comment_content'];
            $comment_author=$row['comment_author'];
            ?>
            
            <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="https://via.placeholder.com/64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
 
    <?php } ?>
                
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
    <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
  
<?php include "includes/footer.php" ?>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
         var post_id = <?php echo $post_id; ?>;
         var user_id = <?php echo $user_se_id; ?>;
         
       
    //liking
       $('.like').click(function(){
           console.log("load hua document");
           
            $.ajax({
                url: "/cms/post/<?php echo $post_id; ?>",
                type: 'post',
                data: {
                    'liked': 1,
                    'post_id': post_id,
                    'user_id': user_id
                }
                
            });           
       });
        
    //unliking
        
        $('.unlike').click(function(){
           console.log("load hua document");
            
            $.ajax({
                url: "/cms/post/<?php echo $post_id; ?>",
                type: 'post',
                data: {
                    'unliked': 1,
                    'post_id': post_id,
                    'user_id': user_id
                }
                
            });
           
       });
        
        
    });
</script>
