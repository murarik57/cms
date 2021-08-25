<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
  <!-- Navigation -->
    
    <?php  include "includes/nav.php"; ?>
 
    <?php
        $message ='';
            if(isset($_POST['submit'])){
            $to='keedabakchod@gmail.com';
            $header="FROM: " . $_POST['email'];
            $subject=$_POST['subject'];
            $msg=wordwrap($_POST['body']);
            $name=$_POST['name'];
            
            if(!empty($header) && !empty($subject) && !empty($msg)){
                if(mail($to,$subject,$msg,$header))
                    $message = "<p class='bg-success'>Message has been sent!</p>";
            }
            else
                $message = "<p class='bg-danger'>Fields Cannot Be empty</p>";       
        }
    ?>

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact Us</h1>
                   <h5 class="text-center"><?php echo $message; ?></h5>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="name" class="sr-only">Your Name</label>
                            <input type="text" name="name" id="username" class="form-control" placeholder="Your name">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Your Email">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Leave your message here!" class="form-control" name="body" id="body" cols="50" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-hover btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
        <hr>
<?php include "includes/footer.php";?>