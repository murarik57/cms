 <form action="" method="post">
              <label for="cat-title">Update Category</label>

              <?php
                if(isset($_GET['edit'])){
                    $id=$_GET['edit'];
                    $query= "SELECT * FROM categories WHERE cat_id='$id'";
                    $show_all_categories_id=mysqli_query($connection,$query);

                     while($row=mysqli_fetch_assoc($show_all_categories_id)){
                                $cat_title=$row['cat_title'];
                ?>            



               <div class="form-group">
                <input type="text" value="<?php if(isset($cat_title)) echo $cat_title; ?>" class="form-control" name="cat_title">
                </div>
                <div class="form-group">
                <input type="submit" class="btn btn-primary" name="update" value="Update">
                </div>
    <?php    }} ?> 
           
           
            </form>  
            
<?php 
if(isset($_POST['update'])){
    $new_cat_title=$_POST['cat_title'];

    $query="UPDATE categories SET cat_title='$new_cat_title' WHERE cat_id='$cat_id'";

    $update_query=mysqli_query($connection,$query);
    header("Location: categories.php");

}

?>

