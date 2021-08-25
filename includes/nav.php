<?php session_start(); ?>
       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   <?php
                        $query= "SELECT * FROM categories";
                        $select_all_categories_query=mysqli_query($connection,$query);
                    
                    while($row=mysqli_fetch_assoc($select_all_categories_query)){
                        if(isset($_GET['cat_id']) && $row['cat_id'] == $_GET['cat_id']){
                            echo "<li class='active'><a href='/cms/category.php?cat_id={$row['cat_id']}'>{$row['cat_title']}</a>";
                        }
                        else{
                            echo "<li><a href='/cms/category/{$row['cat_id']}'>{$row['cat_title']}</a>";
                        }
                    }
                    
                    ?>
            
                    <li>
                        <a href="/cms/contact">Contact Us</a>
                    </li>
                    <?php
                    if(isset($_SESSION['user_role']) && isset($_GET['post_id'])){
                                $post_id=$_GET['post_id'];
                                echo "<li><a href='/cms/admin/posts.php?source=edit_post&post_id=$post_id'>Edit Post</a></li>";     
                    }
                    if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){
                        echo "<li><a href='/cms/includes/logout.php'>Logout</a></li>";
                        echo "<li><a href='/cms/Admin'>Admin</a></li>";
                    }
                    else
                        echo "<li><a href='/cms/login'>Login</a></li>";
                       ?>
                       
                </ul>
            </div>
            
            <!-- /.navbar-collapse -->
            
            
            
        </div>
        <!-- /.container -->
    </nav>