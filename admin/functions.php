<?php

function escape($string){
    global $connection;
    
    return mysqli_real_escape_string($connection,trim($string));
}

function imagePlaceholder($image){
    if(!$image)
        return 'placeholder.jpg';
    else
        return $image;
}

function users_online(){
        if(isset($_GET['onlineusers'])){
            session_start();
            include("../includes/db.php");
          
            $session=session_id();
            $time=time();
            $time_interval_in_seconds=60;
            $time_out=$time-$time_interval_in_seconds;

            $query="SELECT * FROM users_online WHERE session='$session'";
            $send_query=mysqli_query($connection,$query);
            $count=mysqli_num_rows($send_query);

            if($count == null){
                $result= mysqli_query($connection,"INSERT INTO users_online(session,time) VALUES('$session','$time')");
            }
            else{
                mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }

            $count_query=mysqli_query($connection,"SELECT * FROM users_online WHERE time > '$time_out'");
            echo $users_count=mysqli_num_rows($count_query);
            
        
        } // get request isset.
 }

users_online();

function insert_category(){
        global $connection;
          if(isset($_POST['submit'])){
                    $cat_title=$_POST['cat_title'];
                    if($cat_title == '' || empty($cat_title))
                        echo "This field cannot be empty";
                    else{

                        $query="INSERT INTO categories(cat_title) ";
                        $query .= "VALUE('$cat_title')";

                        $insert_category_query=mysqli_query($connection,$query);
                    if(!$insert_category_query)
                        die("failed".mysqli_error($connection));
                    }
                }                     
 }

function show_categories(){
        global $connection;
        $query= "SELECT * FROM categories";
        $show_all_categories=mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($show_all_categories)){
        $cat_title=$row['cat_title'];
        $cat_id=$row['cat_id'];
        echo "<tr><td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a class='btn btn-danger delete_link' rel='$cat_id' href='javascript:void(0)'>Delete</a></td>";
        echo "<td><a class='btn btn-info' href='categories.php?edit={$cat_id}'>Edit</a></td></tr>";
        //categories.php?delete={$cat_id}

        }
}

function delete_categories(){
        global $connection;
                if(isset($_GET['delete'])){
                    $id=$_GET['delete'];
                    $query="DELETE FROM categories ";
                    $query .= "WHERE cat_id='$id'";

                    $result= mysqli_query($connection,$query);
                    header("Location: categories.php");

                    if(!$result)
                        die("Deletion failed".mysqli_error($connection));
                    else
                        echo "Deleted sucessfully";
                }  
  
}

function view_posts(){
        global $connection;
//            $query="SELECT * FROM posts ORDER BY post_id DESC";
$query="SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author, posts.post_date, posts.post_image, posts.post_content, posts.post_tags, posts.post_views_count, posts.post_status, posts.post_user, ";
$query .="categories.cat_id, categories.cat_title FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC ";    
            $show_all_posts=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($show_all_posts)){
                    $post_id=$row['post_id'];
                    $post_category_id=$row['post_category_id'];
                    $post_title=$row['post_title'];
                    $post_author=$row['post_author'];
                    $post_date=$row['post_date'];
                    $post_image=$row['post_image'];
                    $post_content=$row['post_content'];
                    $post_tags=$row['post_tags'];
                    $post_status=$row['post_status'];
                    $post_views_count=$row['post_views_count'];
                    $post_user=$row['post_user'];
                    $cat_title=$row['cat_title'];
                    $cat_id=$row['cat_id']; 
                    
                    echo "<tr><td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='$post_id'></td>";
                    echo "<td>{$post_id}</td>";
                
                if(!empty($post_author)){
                    echo "<td>{$post_author}</td>";
                }
                elseif(!empty($post_user)){
                    echo "<td>{$post_user}</td>";
                }
                
           
                    echo "<td><a target='_blank' href='../post.php?post_id=$post_id'>{$post_title}</a></td>";
                
//                      $query= "SELECT * FROM categories WHERE cat_id=$post_category_id";
//                      $show_all_categories=mysqli_query($connection,$query);
//                        while($row=mysqli_fetch_assoc($show_all_categories)){
//                        $cat_title=$row['cat_title'];
//                        $cat_id=$row['cat_id'];  
//                        }
            
                    echo "<td>{$cat_title}</td>";
                    echo "<td>{$post_status}</td>";
                    echo "<td><img width='100' src='../images/{$post_image}' alt='not uploaded'></td>";
                    echo "<td>{$post_tags}</td>";
                
                    $comment_query="SELECT * FROM comments WHERE comment_post_id='$post_id' ";
                    $fetch_comment=mysqli_query($connection,$comment_query);
                    $post_comment_count=mysqli_num_rows($fetch_comment);  
                    
                    echo "<td><a href='post_comments.php?post_id={$post_id}'>{$post_comment_count}</a></td>";
                
            
                    echo "<td>{$post_date}</td>";
                    echo "<td><a href='?reset={$post_id}'>{$post_views_count}<?a></td>";
                    echo "<td><a class='btn btn-info' href='?source=edit_post&post_id={$post_id}'>Edit</a></td>";
                
    echo "<td><a class='btn btn-danger delete_link' rel='$post_id' href='javascript:void(0)'>Delete</a></td></tr>";
                          //?delete=$post_id  
                }
}

function delete_post(){
    global $connection;
    
    if(isset($_GET['delete'])){
        $post_id=$_GET['delete'];
        $query= "DELETE FROM posts WHERE post_id='$post_id'";
        
        $del_request=mysqli_query($connection,$query);
        header("Location: posts.php");
    }
}

function record_count($table){
    global $connection;
    $query= "SELECT * FROM " . $table;
    $count = mysqli_query($connection,$query);
    if(!$count)
        die(mysqli_error($connection));
        
    else
        return $recorded_count=mysqli_num_rows($count);
        
    
}

function is_exist($column,$table,$value){
    global $connection;
    $query="SELECT $column FROM $table WHERE $column = '$value'";
    $result=mysqli_query($connection,$query);
    if(!$result){
        echo $query;
        die("error ho gaya".mysqli_error($connection));
    }
    if(mysqli_num_rows($result)>0)
        return true;
    else
        return false;
        
}

function register_user($username,$password,$email){
            global $connection;
            
           if(!empty($username) && !empty($password) && !empty($email)){
            $username=mysqli_real_escape_string($connection,$username);
            $password=mysqli_real_escape_string($connection,$password);
            $email=mysqli_real_escape_string($connection,$email);
    
            $password=password_hash($password,PASSWORD_BCRYPT,['cost'=>12]);
                      
            $query="INSERT INTO users(user_role,user_email,user_name,user_pass) ";
            $query .= "VALUES('subscriber','$email','$username','$password') ";
        
            $insert_user=mysqli_query($connection,$query);
        
                if(!$insert_user)
                    die("Insertion fialed".mysqli_error($connection));
                else
                    return "<p class='bg-success'>Registration Submited for review</p>";
                }
            else
                return "<p class='bg-danger'>Fields Cannot Be empty</p>";

}

function login_user($username,$password){
    global $connection;
    $username=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection,$password);
        
        $query="SELECT * FROM users WHERE user_name='$username'";
        $select_user_query=mysqli_query($connection,$query);
        $count=mysqli_num_rows($select_user_query);
        
        if($count<1)
            return "<p class='bg-danger'>Username Not Found</p>";
    else{
        
        while($row=mysqli_fetch_assoc($select_user_query)){
            $db_user_id = $row['user_id'];
            $db_user_name = $row['user_name'];
            $db_user_pass = $row['user_pass'];
            $db_user_fname = $row['user_fname'];
            $db_user_lname = $row['user_lname'];
            $db_user_role = $row['user_role'];
        }
                
        if(password_verify($password,$db_user_pass)){
            $_SESSION['user_name']=$db_user_name;
            $_SESSION['user_fname']=$db_user_fname;
            $_SESSION['user_lname']=$db_user_lname;
            $_SESSION['user_role']=$db_user_role;
            
            header("Location: admin");
        }
        else{
            return "<p class='bg-danger'>Password is incorrect!</p>";          
        }
    }
}