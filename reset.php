<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
    if(!isset($_GET['email']) || !isset($_GET['token']))
        header("Location: index");
    
    $message='';
    $verified=false;
    $email_url=$_GET['email'];
    $token_url=$_GET['token'];
   
    $stmt=mysqli_prepare($connection,"SELECT user_name, user_email, token FROM users WHERE token=?");
          mysqli_stmt_bind_param($stmt,"s",$token_url);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt, $user_name, $user_email, $token_db);
          mysqli_stmt_fetch($stmt);
          mysqli_stmt_close($stmt);
    
    if($token_url !== $token_db || $email_url !== $user_email)
        header("Location: index");
            
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $password=trim($_POST['password']);
        $confirmPassword=trim($_POST['confirmPassword']);
        
        if(empty($password) || empty($confirmPassword))
            $message="<h3 class='bg-danger'>Fields Cannot be empty!</h3>"; 
            
        elseif($password !== $confirmPassword)
            $message="<h3 class='bg-danger'>Password Mismatch!</h3>";
        else{
            $password=password_hash($password,PASSWORD_BCRYPT,['cost'=>12]);
            $stmt=mysqli_prepare($connection,"UPDATE users SET token='', user_pass='$password' WHERE user_email=?");
            mysqli_stmt_bind_param($stmt,"s",$email_url);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $message="<h3 class='bg-success text-center'>Password has been changed!<br><a href='login'>Click Here To Login</a></h3>";
            $verified=true;
        }
        
    }

?>



<!-- Navigation -->

<?php  include "includes/nav.php"; ?>

<div class="container">

<?php if(!$verified): ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">

                                <?php echo $message; ?>
                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                            <input id="password" name="password" placeholder="Enter password" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                            <input id="confirmPassword" name="confirmPassword" placeholder="Confirm password" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input name="resetPassword" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
             <?php echo $message; ?>      
     <?php endif; ?>


<hr>

<?php include "includes/footer.php";?>

</div> <!-- /.container -->