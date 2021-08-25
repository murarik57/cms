<?php include "includes/admin_header.php" ?>
<?php
    if(isset($_SESSION['user_name'])){
       $user_name=$_SESSION['user_name'];
        
        $query="SELECT * FROM users WHERE user_name ='$user_name' ";
        $select_user=mysqli_query($connection,$query);
        
        while($row=mysqli_fetch_assoc($select_user)){
            $user_fname=$row['user_fname'];
            $user_lname=$row['user_lname'];
            $user_role=$row['user_role'];   
            $user_email=$row['user_email'];
            $user_name=$row['user_name'];
            $user_pass=$row['user_pass'];
        }
    }

            if(isset($_POST['update_profile'])){
            $user_fname=$_POST['user_fname'];
            $user_lname=$_POST['user_lname'];
            $user_role=$_POST['user_role'];   
            $user_email=$_POST['user_email'];
            $user_name=$_POST['user_name'];
            $user_pass=$_POST['user_pass'];
                
            $query ="UPDATE users SET ";
            $query .="user_fname='$user_fname', ";    
            $query .="user_lname='$user_lname', ";    
            $query .="user_role='$user_role', ";    
            $query .="user_email='$user_email', ";    
            $query .="user_name='$user_name', ";    
            $query .="user_pass='$user_pass' ";  
            $query .="WHERE user_name='$user_name' ";   
             
        $update_profile=mysqli_query($connection,$query);
        
        if(!$update_profile)
            die("Insertion fialed".mysqli_error($connection));
        else
            echo "Profile Details Has Been Updated Sucessfully!";
    } 

?>

<div id="wrapper">
    <!-- Navigation -->
<?php include "includes/admin_nav.php" ?>

    <div id="page-wrapper">
     <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
            <h1 class="page-header">
                 Your Profile
            </h1>
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
            <input type="password" value="<?php echo $user_pass; ?>" class="form-control" name="user_pass">
        </div>
        
<!--
        <div class="form-group">
           <label for="post_image">Post Image</label>
            <input type="file" class="form-control" name="image">
        </div>
-->
    
        <div class="form-group">
           <input type="submit" class="btn btn-primary" value="Update Profile" name="update_profile">
        </div>

</form>

            </div>
         </div>
        <!-- /.row -->

       </div>
        <!-- /.container-fluid -->

        </div>
</div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>