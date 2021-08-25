<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

    <!-- Navigation -->
 <?php include "includes/admin_nav.php" ?>
 <?php include "includes/delete_modal.php"; ?>

<div id="page-wrapper">
 <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
        Welcome to Admin Area
        <small>Author</small>
        </h1>

    <div class="col-xs-6">
            <form action="" method="post">
              <label for="cat-title">Add Category</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="cat_title">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="submit">
                </div>
                <?php insert_category(); ?>

            </form>

            <?php 
            if(isset($_GET['edit'])){
                $cat_id=$_GET['edit'];
                include "includes/update_categories.php";
            }
            ?>


    </div>

                <div class="col-xs-6">

                    <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <td>Id</td>
                    <td>Category Title</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php show_categories(); ?>

                    <?php delete_categories(); ?>
                    </tbody>
                    </table>

                </div>

        </div>
     </div>
    <!-- /.row -->

   </div>
    <!-- /.container-fluid -->

</div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>