<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<!-- Navigation -->

<?php  include "includes/nav.php"; ?>
<?php
    $message='';
    if(isset($_POST['login'])){
        $username=trim($_POST['username']);
        $password=($_POST['password']);
        if(!empty($username) && !empty($password))
            $message=login_user($username,$password);
        else
            $message="<p class='bg-danger'>Please enter username and password to login.</p>";
    }

?>


<!-- Page Content -->
<div class="container">

	<div class="form-gap"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">


							<h3><i class="fa fa-user fa-4x"></i></h3>
							<h2 class="text-center">Login</h2>
							<div class="panel-body">


								<form id="login-form" role="form" autocomplete="on" class="form" method="post">

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

											<input name="username" type="text" class="form-control" placeholder="Enter Username">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
											<input name="password" type="password" class="form-control" placeholder="Enter Password">
										</div>
									</div>

									<div class="form-group">
                                        <?php echo $message; ?>

										<input name="login" class="btn btn-lg btn-success btn-block" value="Login" type="submit">
									</div>


								</form>
				<a class="btn btn-lg btn-primary" href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot Password?</a>

							</div><!-- Body-->

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<?php include "includes/footer.php";?>

</div> <!-- /.container -->
