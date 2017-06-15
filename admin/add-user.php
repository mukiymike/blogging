<?php //include connect config
require_once('../includes/connect.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <title>Admin - Add User</title>
  <?php include("includes/segments/metaEnLinks.php"); ?>
</head>
<body>

<div id="wrapper">

    <?php
    $active = 'users';
     include("includes/segments/navigationBar.php");
     ?>

    <section>
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

		if($password ==''){
			$error[] = 'Please enter the password.';
		}

		if($passwordConfirm ==''){
			$error[] = 'Please confirm the password.';
		}

		if($password != $passwordConfirm){
			$error[] = 'Passwords do not match.';
		}

		if($email ==''){
			$error[] = 'Please enter the email address.';
		}

		if(!isset($error)){

			$hashedpassword = $user->password_hash($password, PASSWORD_BCRYPT);

			try {

				//insert into database
				$stmt = $db->prepare('INSERT INTO blog_members (username,password,email) VALUES (:username, :password, :email)') ;
				$stmt->execute(array(
					':username' => $username,
					':password' => $hashedpassword,
					':email' => $email
				));

				//redirect to index page
				header('Location: users.php?action=added');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

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
          <div class="panel panel-warning">
            <div class="panel-heading">Add New Blog Users.</div>
            <div class="panel-body">
	<form role="form" action="" method="POST">
                <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" class="form-control" name="username" required="required" placeholder="Enter New Username" value='<?php if(isset($error)){ echo $_POST['username'];}?>'>
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" name="password" required="required" placeholder="Enter password" value='<?php if(isset($error)){ echo $_POST['password'];}?>'>
                </div>
                <div class="form-group">
                  <label for="pwd">Confirm Password:</label>
                  <input type="password" class="form-control" name="passwordConfirm" required="required" placeholder="Repeat Password" value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'>
                </div>
                <div class="form-group">
                  <label for="email">User Email:</label>
                  <input type="email" class="form-control" name="email" required="required" placeholder="Enter User Email Address" value='<?php if(isset($error)){ echo $_POST['email'];}?>'>
                </div>
                <button type="submit" class="btn btn-block btn-warning" name="submit">Add New User</button>
            </form>
            </div>
            <div class="panel-footer alert-warning"><strong>Warning: bad things may happen.</strong><br>Every user added at the moment will be having all the admin previledges. They have all the power to mess things around.</div>
          </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12">
        </div>
      </div>
    </div>
    </div>
    </section>

</div>
