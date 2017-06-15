<?php
//include connect confits
require_once('../includes/connect.php');


//check if already logged in
if( $user->is_logged_in() ){ header('Location: index.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <title>MMU Shadows - Admin Login</title>
  <?php include("includes/segments/metaEnLinks.php"); ?>
</head>
<body>
<div id="login">

	<?php

	//process login form if submitted
	if(isset($_POST['submit'])){

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		if($user->login($username,$password)){

			//logged in return to index page
			header('Location: index.php');
			exit;


		} else {
			$message = 'Wrong username or password';
		}

	}//end if submit

	?>
<br><center><h2>Multimedia Shadows - Admin Section</h2></center><hr>
<div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12">
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
           <?php
           if(isset($message)){
       	echo '<div class="alert alert-danger">';
	echo '<strong><center>'.$message.'.</center></strong>';
	echo '</div>';
	}
	?>
          <!--Log in Form-->
          <div class="panel panel-info">
            <div class="panel-heading">Please Log in First.</div>
            <div class="panel-body">
	<form role="form" action="" method="POST">
                <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" class="form-control" name="username" required="required" placeholder="Enter Your Username">
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" name="password" required="required" placeholder="Enter your password">
                </div>
                <div class="checkbox">
                  <label><input type="checkbox"> Remember me</label>
                </div>
                <button type="submit" class="btn btn-block btn-info" name="submit">Get Me In</button>
            </form>
            </div>
            <div class="panel-footer alert-warning"><strong>Can't Log in?</strong><br>If you feel lost, you're probably at the wrong place.<a href="../">Get Me Outta here!</a></div>
          </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
        </div>
      </div>
    </div>

</div>
</body>
</html>
