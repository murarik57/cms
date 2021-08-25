<div class="col-md-4">
                
    
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                <form action="search.php" method="post">   
                    <div class="input-group">
                        <input type="search" class="form-control" name="search">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                </form>     
                    <!-- /.input-group -->
                </div>
               
                <!-- Login -->
                <div class="well">
                   <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'): ?>
                       <h4>Welcome: <?php echo $_SESSION['user_name']; ?></h4>
                       <span class="input-group-btn">
                        <a href="/cms/includes/logout.php"  class="btn btn-primary">LogOut</a>
                        </span>
                       
                   <?php else: ?>
                    <h4>Login to admin area</h4>
                    <form action="/cms/login" method="post">   
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="username">
                        </div>

                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="password">
                            <span class="input-group-btn">
                            <button name="login" class="btn btn-primary" type="submit">Login
                            </button>
                            </span>
                        </div>          
                    </form>
                    <br>
                    <a class="btn btn-success" href="/cms/registration">Register&nbsp;</a>
                    <a class="btn btn-info" href="/cms/forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot Password?</a>
                    
                   <?php endif; ?>
                   
                    
                    <!-- /.input-group -->
                </div>
                
                
                
                

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                               <?php
                                    $query= "SELECT * FROM categories";
                                    $show_categories_query=mysqli_query($connection,$query);

                                    while($row=mysqli_fetch_assoc($show_categories_query)){
                                        
                                        
                                        
                                     echo "<li><a href='/cms/category/{$row['cat_id']}'>{$row['cat_title']}</a>";
                                    }
                                
                                
                                ?>
                                
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>