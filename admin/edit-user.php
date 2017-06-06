<?php //include connect config
require_once('../includes/connect.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <title>MMU Shadows 	Admin - Edit User</title>
  <?php include("includes/segments/metaEnLinks.php"); ?>
</head>
<body>

<div id="wrapper">

<?php
    $active = 'users';
     include("includes/segments/navigationBar.php");
?>

<div class="container">
	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		//collect form data
		extract($_POST);

		//very basic validation
		if($username ==''){
			$error[] = 'Please enter the username.';
		}

		if( strlen($password) > 0){

			if($password ==''){
				$error[] = 'Please enter the password.';
			}

			if($passwordConfirm ==''){
				$error[] = 'Please confirm the password.';
			}

			if($password != $passwordConfirm){
				$error[] = 'Passwords do not match.';
			}

		}


		if($email ==''){
			$error[] = 'Please enter the email address.';
		}

		if(!isset($error)){

			try {

				if(isset($password)){

					$hashedpassword = $user->password_hash($password, PASSWORD_BCRYPT);

					//update into database
					$stmt = $db->prepare('UPDATE blog_members SET username = :username, password = :password, email = :email WHERE memberID = :memberID') ;
					$stmt->execute(array(
						':username' => $username,
						':password' => $hashedpassword,
						':email' => $email,
						':memberID' => $memberID
					));


				} else {

					//update database
					$stmt = $db->prepare('UPDATE blog_members SET username = :username, email = :email WHERE memberID = :memberID') ;
					$stmt->execute(array(
						':username' => $username,
						':email' => $email,
						':memberID' => $memberID
					));

				}


				//redirect to index page
				header('Location: users.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>


	<?php

		try {

			$stmt = $db->prepare('SELECT memberID, username, email FROM blog_members WHERE memberID = :memberID') ;
			$stmt->execute(array(':memberID' => $_GET['id']));
			$row = $stmt->fetch();

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>
       <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12">
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
        <a href="users.php" class="btn btn-default">Back to Users Admin</a>
        <?php
        //check for any errors and display them.
	if(isset($error)){
		foreach($error as $error){
			echo '<div class="alert alert-danger">';
			  echo '<strong><center>'.$error.'.</center></strong>';
			echo '</div>';
		}
	}
	?>
          <!--Log in Form-->
          <div class="panel panel-info">
            <div class="panel-heading">Edit User Details.</div>
            <div class="panel-body">
	<form role="form" action="" method="POST">
	<input type='hidden' name='memberID' value='<?php echo $row['memberID'];?>'>
                <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" class="form-control" required="required" name='username' value='<?php echo $row['username'];?>'>
                </div>
                <div class="form-group">
                  <label for="pwd">Password (only to change):</label>
                  <input type="password" class="form-control" name="password" required="required" placeholder="Enter password" value='<?php if(isset($error)){ echo $_POST['password'];}?>'>
                </div>
                <div class="form-group">
                  <label for="pwd">Confirm Password:</label>
                  <input type="password" class="form-control" name="passwordConfirm" required="required" placeholder="Repeat Password" value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'>
                </div>
                <div class="form-group">
                  <label for="email">User Email:</label>
                  <input type="email" class="form-control" name="email" required="required" placeholder="Enter New Email Address" value='<?php echo $row['email'];?>'>
                </div>
                <button type="submit" class="btn btn-block btn-info" name="submit">Update User Details</button>
            </form>
            </div>
            <div class="panel-footer alert-danger"><strong>Danger with Password Change!</strong><br>If you change a another user's password, they may no longer be able to log in.</div>
          </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
        </div>
      </div>
      </div>

</div>

</body>
</html>
