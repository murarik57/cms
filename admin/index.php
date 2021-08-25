<?php include "includes/admin_header.php" ?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_nav.php" ?>
        
<?php
    $post_count=record_count('posts');
    $comments_count=record_count('comments');
    $users_count=record_count('users');
    $categories_count=record_count('categories');
    
    $draft_post_count=record_count("posts WHERE post_status='draft'");                                 
    $unapproved_comments_count=record_count("comments WHERE comment_status='unapproved'");   
    $subscriber_user_count=record_count("users WHERE user_role='subscriber'");    
?>         
    
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin Area
                            <small> <?php echo $_SESSION['user_name']; ?></small>
                        </h1> 
                    </div>
                </div>
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right"> 
                       <div class='huge'><?php echo $post_count; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                      <div class='huge'><?php echo $comments_count; ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                         <div class='huge'><?php echo $users_count; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                         <div class='huge'><?php echo $categories_count; ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->       
                <div class="row">
                  <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
          
                      //original code for bar graphs
//        function drawChart() {
//        var data = google.visualization.arrayToDataTable([
//          ['Year', 'Salesdf', 'Expenses', 'Profit'],
//          ['2014', 1000, 400, 200],
//          ['2015', 1170, 460, 250],
//          ['2016', 660, 1120, 300],
//          ['2017', 1030, 540, 350]
//        ]);              

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Statistics', 'Count', 'Sub Count'],
<?php
    $element_text=['Posts','Comments','Users','Categories'];
    //$element_subtext=['Draft Posts','Unapproved Comments','Subscriber Users'];
    $element_count=[$post_count ,$comments_count ,$users_count ,$categories_count];
    $element_subcount=[$draft_post_count ,$unapproved_comments_count ,$subscriber_user_count,0];
    for($i=0;$i<sizeof($element_text);$i++){
        echo "['{$element_text[$i]}'" . ", " . "$element_count[$i]" . ", " . "$element_subcount[$i]],";
    }
?>
//          ['Posts', 100]    
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
               <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
      </div>
                
    </div>
            <!-- /.container-fluid -->
 </div>
        <!-- /#page-wrapper -->    
<?php include "includes/admin_footer.php" ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

        <script>
            $(document).ready(function(){
                
            var pusher = new Pusher('c1f4a00ddf3e2f9fa865', {
                            cluster: 'ap2'
                        });
            var channel = pusher.subscribe('my-channel');
                
            channel.bind('new_user', function(data) {
                var message= data.message;
                  toastr.success(`${message} just registered`);                  
                });
        });
            
        </script>
        
       
      
     
    
   
  
 
