<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<?php 

    require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require './vendor/phpmailer/phpmailer/src/Exception.php';
    require './vendor/phpmailer/phpmailer/src/SMTP.php';
    require './classes/Config.php';
    require './vendor/autoload.php';
    
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\SMTP;
      use PHPMailer\PHPMailer\Exception;


    $message='';
    if(!isset($_GET) || !$_GET['forgot']){
        header("Location: index");
    }
    if(isset($_POST['recover-submit'])){
        $email=escape($_POST['email']);
        
        if(empty($email))
            $message = "<h3 class='bg-danger'>Please enter your email address!</h3>";
            
        elseif(!is_exist('user_email','users',$email))
            $message = "<h3 class='bg-danger'>This email is not registered with Us!</h3>";
        
        else{
            $length=50;
            $token=bin2hex(openssl_random_pseudo_bytes($length));
            if($stmt= mysqli_prepare($connection,"UPDATE users SET token='{$token}' WHERE user_email= ?")){
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
            else
                die(mysqli_error($connection));
        
            /** PHPMailer code from here   */  
        $mail = new PHPMailer();
            
        //Server settings
//      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output           
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = Config::SMTP_HOST;                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                 //Enable SMTP authentication
        $mail->Username   = Config::SMTP_USER;                     //SMTP username
        $mail->Password   = Config::SMTP_PASSWORD;                               //SMTP password
        $mail->Port       = Config::SMTP_PORT; 
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8'; 
                      
            
//¿Qué piensas del español? spanish text for utf encoding
        $mail->setFrom('sender email', 'Black Box CMS');
        $mail->addAddress($email);     //Add a recipient
        $mail->Subject = 'Password Reset Link';
$mail->Body    = '<p>Click on the link to reset your Password: <a href="http://localhost/cms/reset.php?email='.$email.'&token='.$token.'">http://localhost/cms/reset.php?email='.$email.'&token='.$token.'</a></p>';
            
        $mail->AltBody = 'Here is the link to rest password';
            if($mail->send())
                $message = "<h3 class='bg-success '>Reset Link has Been sent.</h3>";
            else
                echo "Mailer Error: " . $mail->ErrorInfo;           

        }//else
}//isset-recover submit
        

?>



<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">


                                     <?php echo $message; ?>

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>
                                    <a class="btn btn-lg btn-block btn-success" href="index">Home Page</a>

                                </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->
