<table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>   
                   <?php 
                    include "delete_modal.php";
                        $query="SELECT * FROM users ";
                        $show_all_users=mysqli_query($connection,$query);
                        while($row=mysqli_fetch_assoc($show_all_users)){
                            $user_id=$row['user_id'];
                            $user_name=$row['user_name'];
                            $user_pass=$row['user_pass'];
                            $user_fname=$row['user_fname'];
                            $user_lname=$row['user_lname'];
                            $user_email=$row['user_email'];
                            $user_image=$row['user_image'];
                            $user_role=$row['user_role'];
                            
                            echo "<tr><td>{$user_id}</td>";
                            echo "<td>{$user_name}</td>";
                            echo "<td>{$user_fname}</td>";
                            echo "<td>{$user_lname}</td>";
                            echo "<td>{$user_email}</td>";                             
                            echo "<td>{$user_role}</td>";
                            
                            echo "<td><a class='btn btn-info' href='?source=edit_user&user_id={$user_id}'>Edit</a></td>";
                            echo "<td><a rel='$user_id' class='btn btn-danger delete_link' href='javascript:void()'>Delete</a></td></tr>";
                        }
                    ?>
                </tbody>
             </table>
<?php 
    if(isset($_GET['delete'])){
        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
            $user_id=$_GET['delete'];
            $query= "DELETE FROM users WHERE user_id='$user_id'";
        
            $del_request=mysqli_query($connection,$query);
            header("Location: users.php");
        }
    }
?>  