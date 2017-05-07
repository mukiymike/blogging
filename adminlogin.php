<?php
	//Start session
	session_start();
	
	//Connect to mysql server
	require "connect.php";
	//Sanitize the POST values
	if(isset($_POST['login'])){
	$adminusername = $_POST['user_name'];
	$adminpassword = $_POST['password'];
	
	//Create query
	$qry="SELECT * FROM admin WHERE user_name='$adminusername' AND password='$adminpassword'";
	$result=mysqli_query($conn,$qry);
	//Check whether the query was successful or not
	if($result) {
		if(mysqli_num_rows($result) > 0) {
			while ($user_type= mysqli_fetch_assoc($result)){
				$type=$user_type['type'];
				if ($type==2) {
					# code...
			//Login Successful
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['id'];
			$_SESSION['SESS_USER_NAME'] = $member['username'];
			session_write_close();
			//if ($level="admin"){
			header("location: dashbod.php");
		exit();
			}
		  }
		}
	}else {
			//Login failed
			header('location: index.html');
			exit();
		}
	}
   
else if (isset($_POST['register'])) {
		$username=$_POST['user_name'];
		$pass=$_POST['password'];
		
		$register="INSERT into admin (`user_name`,`password`,`type`) 
		          values ('$username','$pass',2)";
		$register_run=mysqli_query($conn,$register);
		if ($register_run) {
			echo '<div class="alert alert-success">Registration successful</div>';
		}
    else{
			echo '<div class="alert alert-danger">could not register</div>';
		 }
	 
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script  src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body background="gray">
<div class="row">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-10 col-md-offset-3 login">
			
				<form method="POST" action="adminlogin.php">
					<div class="panel panel-info">
					<div class="panel-heading">Login</div>
					<div class="panel-body">
						<div class="form-group">
							<input type="text" name="user_name" placeholder="Enter your Username" class="form-control">
						</div>
						<div class="form-group">
							<input type="Password" name="password" placeholder="Enter your Password" class="form-control">
						</div>
						
					</div>
					<div class="panel-footer">
						<button type="submit" class="btn btn-info" name="login">Login</button>&nbsp;&nbsp;<span><a href="#register" data-toggle="modal">Register</a></span>
					</div>
				</div>
				</form>
			</div>

			<div class="modal fade" id="register">
				<div class="modal-dialog">
					<form method="POST" action="adminlogin.php">
						<div class="modal-content">
							<div class="modal-header">Register<button class="close" data-dismiss="modal" type="button">&times;</button></div>
							<div class="modal-body">
								<div class="form-group">
									<input class="form-control" name="user_name" placeholder="User name" type="text" required></input>
								</div>
								<div class="form-group">
									<input class="form-control" name="password" placeholder="Password" type="password" required></input>
								</div>
								<div class="form-group">
									<input class="form-control" name="conpass" placeholder="Confirm Password" type="password" required></input>
								</div>
								
							</div>
							<div class="modal-footer"><button type="submit" class="btn btn-info" name="register">Register</button>&nbsp;&nbsp;&nbsp;<span><button type="reset" class="btn btn-warning">Refresh</button></span></div>
						</div>
					</form>
				</div>
			</div>

</body>
</html>



