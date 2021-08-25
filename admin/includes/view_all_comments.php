<table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Comment</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>In Response To</th>
                        <th>Date</th>
                        <th>Approve</th>
                        <th>Unapprove</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>   
                   <?php 
                        $query="SELECT * FROM comments ";
                        $show_all_comments=mysqli_query($connection,$query);
                        while($row=mysqli_fetch_assoc($show_all_comments)){
                            $comment_id=$row['comment_id'];
                            $comment_post_id=$row['comment_post_id'];
                                    
                            $comment_author=$row['comment_author'];
                            $comment_date=$row['comment_date'];
                            $comment_email=$row['comment_email'];
                            $comment_content=$row['comment_content'];
                            $comment_status=$row['comment_status'];
                            
                            echo "<tr><td>{$comment_id}</td>";
                            echo "<td>{$comment_author}</td>";
                            echo "<td>{$comment_content}</td>";
                            echo "<td>{$comment_email}</td>";
                            echo "<td>{$comment_status}</td>";
                            
                            $post_query = "SELECT * FROM posts WHERE post_id='$comment_post_id' ";
                            $result=mysqli_query($connection,$post_query);
                            while($row=mysqli_fetch_assoc($result)){
                                $post_title=$row['post_title'];
                                $post_id=$row['post_id'];
                                 echo "<td><a href='../post.php?post_id=$post_id' target='_blank'>$post_title</a></td>";
                            }
                            
                            echo "<td>{$comment_date}</td>";
                            echo "<td><a href='?approve={$comment_id}'>Approve</a></td>";
                            echo "<td><a href='?unapprove={$comment_id}'>Unapprove</a></td>";
                            echo "<td><a href='?delete={$comment_id}'>Delete</a></td></tr>";
                        }
                    ?>
                </tbody>
             </table>
<?php 
    if(isset($_GET['delete'])){
        $comment_id=$_GET['delete'];
        $query= "DELETE FROM comments WHERE comment_id='$comment_id'";
        
        $del_request=mysqli_query($connection,$query);
        header("Location: comments.php");
    }

  if(isset($_GET['unapprove'])){
      $comment_id=$_GET['unapprove'];
      $query="UPDATE comments SET comment_status = 'unapproved' WHERE comment_id= '$comment_id'";
      $unapprove_request=mysqli_query($connection,$query);
        header("Location: comments.php");
        
    }
 if(isset($_GET['approve'])){
      $comment_id=$_GET['approve'];
      $query="UPDATE comments SET comment_status = 'approved' WHERE comment_id= '$comment_id'";
      $approve_request=mysqli_query($connection,$query);
        header("Location: comments.php");
        
    }


?>             
            