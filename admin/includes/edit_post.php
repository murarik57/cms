<?php
    if(isset($_GET['post_id'])){
       $id= $_GET['post_id'];
        
       $query= "SELECT * FROM posts WHERE post_id='$id'";
       $update_query=mysqli_query($connection,$query);
        
        while($row=mysqli_fetch_assoc($update_query)){
            $post_id=$row['post_id'];
            $post_category_id=$row['post_category_id'];
            $post_title=$row['post_title'];
            $post_author=$row['post_author'];
            $post_user=$row['post_user'];
            $post_date=$row['post_date'];
            $post_image=$row['post_image'];
            $post_content=$row['post_content'];
            $post_tags=$row['post_tags'];
            $post_status=$row['post_status'];
           // $post_comment_count=$row['post_comment_count'];
            
        }
    }
            
        if(isset($_POST['update_post'])){
        
        $post_category_id=$_POST['post_category'];
        $post_title=$_POST['title'];
        $post_author=$_POST['author'];
        $post_user=$_POST['post_user'];
         
        $post_image=$_FILES['image']['name'];
        $post_image_temp=$_FILES['image']['tmp_name'];
        
        $post_content=$_POST['post_content'];
        $post_tags=$_POST['post_tags'];
        $post_status=$_POST['post_status'];
        
        
        move_uploaded_file($post_image_temp,"../images/$post_image");
    
        
        $query = "UPDATE posts SET ";
        $query .="post_category_id='$post_category_id', ";    
        $query .="post_title='$post_title', ";    
        $query .="post_author='$post_author', ";    
        $query .="post_user='$post_user', ";    
        $query .="post_date=now(), ";    
        $query .="post_image='$post_image', ";    
        $query .="post_content='$post_content', ";    
        $query .="post_tags='$post_tags', ";    
        $query .="post_status='$post_status' ";    
        $query .="WHERE post_id='$id' ";    
        
        $update_query=mysqli_query($connection,$query);
        
        if(!$update_query)
            die("Insertion fialed".mysqli_error($connection));
        else
            echo "<p class='bg-success'>Post Has Been Updated.<a target='_blank' href='../post.php?post_id=$id'> View Post</a></p>";
    
    }        
            
?> 
            

   <form action="" method="post" enctype="multipart/form-data">
    
        <div class="form-group">
           <label for="title">Post Title</label>
            <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
        </div>
        
        <div class="form-group">
           <label for="post_category">Category</label>
            <select name="post_category" id="post_category">
                <?php
                    $query= "SELECT * FROM categories";
                    $select_categories=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($select_categories)){
                        $cat_title=$row['cat_title'];
                        $cat_id=$row['cat_id'];
                        
                        if($cat_id == $post_category_id)
                            echo    "<option selected value='$cat_id'>$cat_title</option>";
                        else
                            echo    "<option value='$cat_id'>$cat_title</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="post_user">Post User</label>
            <select name="post_user" id="">
              <option value="<?php echo $post_user; ?>"><?php echo $post_user; ?></option>
               <?php
                    $query = "SELECT * FROM users";
                    $show_users=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($show_users)){
                        $user_name=$row['user_name'];
                        if($user_name != $post_user)
                            echo "<option value='$user_name'>$user_name</option>";
                    }
                ?>
            </select> 
                
        </div>
        
        
        
        <div class="form-group">
           <label for="author">Post Author</label>
            <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
        </div>
        
        <div class="form-group">
           <select name="post_status" id="">
               <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
               <?php
                if($post_status == 'draft')
                   echo    "<option value='published'>Publish</option>"; 
               else
                   echo    "<option value='draft'>Draft</option>";
               ?>
           </select>
        </div>
        
        <div class="form-group">
           <label for="post_image">Post Image</label>
            <img width="100" src="../images/<?php echo $post_image; ?>"  alt="">
            <input type="file" name="image">
        </div>
        
        <div class="form-group">
           <label for="post_tags">Post Tags</label>
            <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
        </div>
        
        <div class="form-group">
           <label for="post_content">Post Content</label>
            <textarea  name="post_content" id="textbox" cols="30" rows="10" class="form-control"><?php echo $post_content;?>
            </textarea>
        </div>
                        
        <div class="form-group">
           <input type="submit" class="btn btn-primary" value="Publish" name="update_post">
        </div>

</form>