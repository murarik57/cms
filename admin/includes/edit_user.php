<?php
    if(isset($_GET['user_id'])){
       $id= $_GET['user_id'];
        
       $query= "SELECT * FROM users WHERE user_id='$id'";
       $show_user=mysqli_query($connection,$query);
        
        while($row=mysqli_fetch_assoc($show_user)){
            $user_fname=$row['user_fname'];
            $user_lname=$row['user_lname'];
            $user_role=$row['user_role'];   
            $user_email=$row['user_email'];
            $user_name=$row['user_name'];
            $user_pass=$row['user_pass'];
        }
    }
            
        if(isset($_POST['update_user'])){
            $user_fname=$_POST['user_fname'];
            $user_lname=$_POST['user_lname'];
            $user_role=$_POST['user_role'];   
            $user_email=$_POST['user_email'];
            $user_name=$_POST['user_name'];
            $user_pass=$_POST['user_pass'];
            $user_pass=password_hash($user_pass,PASSWORD_BCRYPT,['cost'=>10]);
            
//            $query="SELECT randSalt FROM users";
//            $randomSalt=mysqli_query($connection,$query);
//                        
//            $row=mysqli_fetch_array($randomSalt);
//            $salt=$row['randSalt'];
//            $hash_pass=crypt($user_pass,$salt);
                
            $query ="UPDATE users SET ";
            $query .="user_fname='$user_fname', ";    
            $query .="user_lname='$user_lname', ";    
            $query .="user_role='$user_role', ";    
            $query .="user_email='$user_email', ";    
            $query .="user_name='$user_name', ";    
            $query .="user_pass='$user_pass' ";  
            $query .="WHERE user_id='$id' ";   
             
        $update_user=mysqli_query($connection,$query);
        
        if(!$update_user)
            die("Insertion fialed".mysqli_error($connection));
        else
            echo "<p class='bg-success'>User Details Has Been Updated Sucessfully!</p>";
    }        
            
?> 

   <form action="" method="post" enctype="multipart/form-data">
    
        <div class="form-group">
           <label for="title">Firstname</label>
            <input type="text" value="<?php echo $user_fname; ?>" class="form-control" name="user_fname">
        </div>
        
         <div class="form-group">
           <label for="title">Lastname</label>
            <input type="text" value="<?php echo $user_lname; ?>" class="form-control" name="user_lname">
        </div>
        
        <div class="form-group">
             <select name="user_role" id="post_category">
                    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                    <option value="admin">admin</option>
                    <option value="subscriber">subscriber</option>
                    <option value="guest">guest</option>                   
                </select>
            </div>
       <div class="form-group">
           <label for="post_tags">Email</label>
            <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
        </div>
        
        <div class="form-group">
           <label for="author">Username</label>
            <input type="text" value="<?php echo $user_name; ?>" class="form-control" name="user_name">
        </div>
        
        <div class="form-group">
           <label for="post_status">Password</label>
            <input type="password" autocomplete="off" class="form-control" name="user_pass">
        </div>
        
<!--
        <div class="form-group">
           <label for="post_image">Post Image</label>
            <input type="file" class="form-control" name="image">
        </div>
-->
    
        <div class="form-group">
           <input type="submit" class="btn btn-primary" value="Update User" name="update_user">
        </div>

</form>