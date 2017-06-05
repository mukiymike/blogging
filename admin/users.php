<?php
//include connect  config
require_once('../includes/connect.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['deluser'])){

	//if user id is 1 ignore
	if($_GET['deluser'] !='1'){

		$stmt = $db->prepare('DELETE FROM blog_members WHERE memberID = :memberID') ;
		$stmt->execute(array(':memberID' => $_GET['deluser']));

		header('Location: users.php?action=deleted');
		exit;

	}
}

?>
<!doctype html>
<html lang="en">
<head>
  <title>MMU Shadows Admin - Users</title>
  <?php include("includes/segments/metaEnLinks.php"); ?>
  <script language="JavaScript" type="text/javascript">
  function deluser(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'users.php?deluser=' + id;
	  }
  }
  </script>
</head>
<body>
    <?php include("includes/segments/navigationBar.php"); ?>

<div id="wrapper">
    <div class="container">
	<?php
		//show message from add / edit page
		if(isset($_GET['action'])){
			echo '<div class="alert alert-info">';
			  echo '<strong><center>User '.$_GET['action'].'.</center></strong>';
			echo '</div>';
		}
	?>
	<table class="table table-striped table-hover table-bordered">
	<tr>
		<th>Username</th>
		<th>Email</th>
		<th>Action</th>
	</tr>
	<?php
		try {

			$stmt = $db->query('SELECT memberID, username, email FROM blog_members ORDER BY username');
			while($row = $stmt->fetch()){

				echo '<tr>';
				echo '<td>'.$row['username'].'</td>';
				echo '<td>'.$row['email'].'</td>';
				?>

				<td>
					<?php if($row['memberID'] > 2 ){?>
					<a href="edit-user.php?id=<?php echo $row['memberID'];?>">Edit</a> | <a href="javascript:deluser('<?php echo $row['memberID'];?>','<?php echo $row['username'];?>')">Delete</a>
					<?php } else { echo "Super User";}?>
				</td>

				<?php
				echo '</tr>';

			}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
	</table>

	<p><a href='add-user.php'>Add User</a></p>
    </div>

</div>

</body>
</html>
