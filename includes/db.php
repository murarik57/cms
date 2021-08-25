<?php ob_start(); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] ."/cms/admin/functions.php"); ?>

<?php   
    define("DB_HOST",'localhost');
    define("DB_USER",'your user');
    define("DB_PASS",'your pass');
    define("DB_NAME",'your db);

    $connection=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    $query="SET NAMES utf8";
    mysqli_query($connection,$query);
//    if($connection){
//        echo "We are connected";
//    }
//    else
//        die("Connection failed".mysqli_error($connection));
?>
