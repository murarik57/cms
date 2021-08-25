<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 
  <!-- Navigation -->  
    <?php  include "includes/nav.php"; ?>
    
    
    <?php

if(isset($_GET['lang'])){
    $_SESSION['lang']=$_GET['lang'];
    
    if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']){
        echo "<script type='text/javascript'>location.reload();</script>";
    }
    include "includes/languages/".$_GET['lang'].".php";
}
else
    include "includes/languages/en.php";

?>
 
<?php
        //realtime notification by pusher
        require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
        
    $options = [
    'cluster' => 'ap2',
    'useTLS' => true
  ];

  $pusher = new Pusher\Pusher(
    $_ENV['APP_KEY'],
    $_ENV['APP_SECRET'],
    $_ENV['APP_ID'],
    $options
  );
// regis.. functionality
        $message ='';
        $message_username ='';
        $message_email ='';
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username=trim($_POST['username']);
            $password=trim($_POST['password']);
            $email=trim($_POST['email']);
            
            if(is_exist('user_name','users',$username)){
                $message_username = "<p class='bg-danger'>Username already exist</p>";
            }
            elseif(is_exist('user_email','users',$email)){
                $message_email = "<p class='bg-danger'>Email already exist</p>";
            }
            else{
                $data['message'] = $username;
                $pusher->trigger('my-channel', 'new_user', $data);
                $message=register_user($username,$password,$email);
            }
        } 
    ?>

    <!-- Page Content -->
    <div class="container">
    <form class="navbar-form navbar-right" action="" method="get" id="lang_form">
        <div class="form-group">
           <p>Select Lnaguage</p>
            <select class="form-control" name="lang" onchange="changeLanguage()">
<option value="en" <?php if(isset($_SESSION['lang']) && $_SESSION['lang']=='en'){echo 'selected';} ?>>English</option>
<option value="hn" <?php if(isset($_SESSION['lang']) && $_SESSION['lang']=='hn'){echo 'selected';} ?>>Hindi</option>
<option value="es" <?php if(isset($_SESSION['lang']) && $_SESSION['lang']=='es'){echo 'selected';} ?>>Spanish</option>
            </select>
        </div>
    </form>
    
    
    
    
    
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1><?php echo _REGISTER; ?></h1>
                   <h5 class="text-center"><?php echo $message; ?></h5>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo _USERNAME; ?>" autocomplete="on" value="<?php echo isset($username)?$username :'' ?>" >
                            <?php echo $message_username; ?>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL; ?>" autocomplete="on" value="<?php echo isset($email)?$email :''?>" >
                            <?php echo $message_email; ?>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD; ?>">
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-hover btn-custom btn-lg btn-block" value="<?php echo _REGISTER; ?>">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

               

        <hr>
        <script>
            function changeLanguage(){
                document.getElementById('lang_form').submit();
            }
        
        </script>



<?php include "includes/footer.php";?>
