
<?php
include "delete_modal.php";
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $checkBoxValue){
            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options){
                case 'published':
                    $query="UPDATE posts SET ";
                    $query .="post_status='{$bulk_options}' ";    
                    $query .="WHERE post_id='$checkBoxValue' ";
                    $reslut =mysqli_query($connection,$query);
                    break;
                case 'draft':
                    $query="UPDATE posts SET ";
                    $query .="post_status='{$bulk_options}' ";    
                    $query .="WHERE post_id='$checkBoxValue'";
                    $reslut =mysqli_query($connection,$query);
                    break;
                
                case 'delete':
                    $query= "DELETE FROM posts WHERE post_id='$checkBoxValue'";
                    $del_request=mysqli_query($connection,$query);
                    break;
                
                case 'clone':
                    $query= "SELECT * FROM posts WHERE post_id='$checkBoxValue'";
                    $show_all_posts=mysqli_query($connection,$query);
                while($row=mysqli_fetch_assoc($show_all_posts)){
                        $post_category_id=$row['post_category_id'];
                        $post_title=$row['post_title'];
                        $post_author=$row['post_author'];
                        $post_user=$row['post_user'];
                        $post_date=$row['post_date'];
                        $post_image=$row['post_image'];
                        $post_content=$row['post_content'];
                        $post_tags=$row['post_tags'];
                        $post_status=$row['post_status'];
                }
            $query ="INSERT INTO posts(post_category_id,post_title,post_author,post_user,post_date,post_image,post_content,post_tags,post_status) ";
            $query .= "VALUES('$post_category_id','$post_title','$post_author','$post_user',now(),'$post_image','$post_content','$post_tags','draft') ";

            $insert_query=mysqli_query($connection,$query);
                    
            }
        }
    }

?>
   <form action="" method="post">
    <div class="row">
    <div id="bulkOptionContainer" class="col-xs-4">
        <select name="bulk_options" id="" class="form-control">
            <option value="">Select Option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select> 
    </div> 
       <div class="col-xs-4">
           <input type="submit" name="submit" class="btn btn-success" value="Apply">&nbsp;<a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
       </div>
   </div>
   <br>                                   
<table class="table table-hover table-bordered">
                <thead>
                    <tr>
                       <th><input type="checkbox" id="selectAllBoxes"></th>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Comments<br><small>(Click to see all)</small></th>
                        <th>Date</th>
                        <th>Views Count<br><small>(Click to Reset)</small></th>
                    </tr>
                </thead>
                <tbody>
                   <?php view_posts(); ?>
                </tbody>
             </table>
</form>               
<?php delete_post(); ?>
<?php
    if(isset($_GET['reset'])){
        $post_id=$_GET['reset'];
        $query= "UPDATE posts SET post_views_count = 0 WHERE post_id=" . mysqli_real_escape_string($connection,$_GET['reset']);
        
        $reset_request=mysqli_query($connection,$query);
        header("Location: posts.php");
    }
?>











