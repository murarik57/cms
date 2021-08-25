<?php ob_start(); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] ."/cms/admin/functions.php"); ?>

<?php   
    define("DB_HOST",'localhost');
    define("DB_USER",'black');
    define("DB_PASS",'box');
    define("DB_NAME",'cms');

    $connection=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $query="SET NAMES utf8";
    mysqli_query($connection,$query);
//    if($connection){
//        echo "We are connected";
//    }
//    else
//        die("Connection failed".mysqli_error($connection));
?>