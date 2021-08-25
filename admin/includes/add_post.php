<?php 
    if(isset($_POST['create_post'])){
        
        $post_category_id=$_POST['post_category_id'];
        $post_title=$_POST['title'];
        $post_author=$_POST['author'];
        $post_user=$_POST['post_user'];
        
        $post_date=date('d-m-y');
        
        $post_image=$_FILES['image']['name'];
        $post_image_temp=$_FILES['image']['tmp_name'];
        
        $post_content=$_POST['post_content'];
        $post_tags=$_POST['post_tags'];
 
        move_uploaded_file($post_image_temp,"../images/$post_image");
        
        $query ="INSERT INTO posts(post_category_id,post_title,post_author,post_user,post_date,post_image,post_content,post_tags,post_status) ";
        $query .= "VALUES('$post_category_id','$post_title','$post_author','$post_user',now(),'$post_image','$post_content','$post_tags','draft') ";
        
        $insert_query=mysqli_query($connection,$query);
        
        if(!$insert_query)
            die("Insertion fialed".mysqli_error($connection));
        else
            echo "<p class='bg-success'>Submited! Your Post Has Been held for Aprroval.</p>";
    
    }
?>

   <form action="" method="post" enctype="multipart/form-data">
    
        <div class="form-group">
           <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title">
        </div>
        
        <div class="form-group">
           <label for="post_category">Post Category</label>
                <select name="post_category_id" id="">
                   <?php
                        $query= "SELECT * FROM categories";
                        $show_all_categories=mysqli_query($connection,$query);
                        while($row=mysqli_fetch_assoc($show_all_categories)){
                        $cat_title=$row['cat_title'];
                        $cat_id=$row['cat_id'];
                         echo "<option value='$cat_id'>$cat_title</option>";
                        }
                    ?>
                    
                </select>
            </div>
            <div class="form-group">
            <label for="post_user">Post User</label>
            <select name="post_user" id="">
               <?php
                    $query = "SELECT * FROM users";
                    $show_users=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($show_users)){
                        $user_name=$row['user_name'];
                        echo "<option value='$user_name'>$user_name</option>";
                    }
                ?>
            </select> 
                
        </div>
            
        
        <div class="form-group">
           <label for="author">Post Author</label>
            <input type="text" class="form-control" name="author">
        </div>
                
        <div class="form-group">
           <label for="post_image">Post Image</label>
            <input type="file" class="form-control" name="image">
        </div>
        
        <div class="form-group">
           <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="post_tags">
        </div>
        
        <div class="form-group">
           <label for="post_content">Post Content</label>
            <textarea name="post_content" id="textbox" cols="30" rows="10" class="form-control"></textarea>
        </div>
        
        <div class="form-group">
           <input type="submit" class="btn btn-primary" value="Publish" name="create_post">
        </div>

</form>