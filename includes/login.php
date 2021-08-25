<?php include "db.php"; ?>
<?php session_start();  ?>

<?php
    if(isset($_POST['submit'])){
        $username=trim($_POST['username']);
        $password=($_POST['password']);
        login_user($username,$password);
  
    }

?>