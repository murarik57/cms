<?php 
    if(isset($_POST['create_user'])){
        
        $user_fname=escape($_POST['user_fname']);
        $user_lname=escape($_POST['user_lname']);
        $user_role=escape($_POST['user_role']);   
        $user_email=escape($_POST['user_email']);
        $user_name=escape($_POST['user_name']);
        $user_pass=escape($_POST['user_pass']);
        $user_pass=password_hash($user_pass,PASSWORD_BCRYPT,['cost'=>10]);
    
        $query="INSERT INTO users(user_fname,user_lname,user_role,user_email,user_name,user_pass) ";
        $query .= "VALUES('$user_fname','$user_lname','$user_role','$user_email','$user_name','$user_pass') ";
        
        $insert_user=mysqli_query($connection,$query);
        
        if(!$insert_user)
            die("Insertion fialed".mysqli_error($connection));
        else
            echo "New User created sucessfully ";
    
    }
?>

   <form action="" method="post" enctype="multipart/form-data">
    
        <div class="form-group">
           <label for="title">Firstname</label>
            <input type="text" class="form-control" name="user_fname">
        </div>
        
         <div class="form-group">
           <label for="title">Lastname</label>
            <input type="text" class="form-control" name="user_lname">
        </div>
        
        <div class="form-group">
             <select name="user_role" id="post_category">
                    <option value="subscriber">Select Role</option>
                    <option value="admin">admin</option>
                    <option value="subscriber">subscriber</option>
                    <option value="guest">guest</option>                   
                </select>
            </div>
       <div class="form-group">
           <label for="post_tags">Email</label>
            <input type="email" class="form-control" name="user_email">
        </div>
        
        <div class="form-group">
           <label for="author">Username</label>
            <input type="text" class="form-control" name="user_name">
        </div>
        
        <div class="form-group">
           <label for="post_status">Password</label>
            <input type="password" class="form-control" name="user_pass">
        </div>
        
<!--
        <div class="form-group">
           <label for="post_image">Post Image</label>
            <input type="file" class="form-control" name="image">
        </div>
-->
    
        <div class="form-group">
           <input type="submit" class="btn btn-primary" value="Create User" name="create_user">
        </div>

</form>