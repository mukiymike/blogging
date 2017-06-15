<?php
//include connect.php for db configs
require_once('../includes/connect.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//show message from add / edit page
if(isset($_GET['delpost'])){

	$stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID') ;
	$stmt->execute(array(':postID' => $_GET['delpost']));

	header('Location: index.php?action=deleted');
	exit;
}

?>
<!doctype html>
<html lang="en">
<head>
  <title>Admin - MMU Shadows</title>
  <?php include("includes/segments/metaEnLinks.php"); ?>
  <script language="JavaScript" type="text/javascript">
  function delpost(id, title)
  {
	  if (confirm("Are you sure you want to delete '" + title + "'"))
	  {
	  	window.location.href = 'index.php?delpost=' + id;
	  }
  }
  </script>
</head>
<body>

	<div id="wrapper">
	<?php $active = "blog" ?>
	<?php include("includes/segments/navigationBar.php");?>

	<div class="container">
	<?php
		//show message from add / edit page
		if(isset($_GET['action'])){
			echo '<div class="alert alert-info">';
			  echo '<strong><center>Post has been '.$_GET['action'].'.</center></strong>';
			echo '</div>';
		}
	?>
	<table class="table  table-striped  table-bordered table-hover">
	<tr>
		<th>Article Title</th>
		<th>Publication Date</th>
		<th>Actions Available</th>
	</tr>
	<?php
		try {

			$stmt = $db->query('SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC');
			while($row = $stmt->fetch()){

				echo '<tr>';
				echo '<td>'.$row['postTitle'].'</td>';
				echo '<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
				?>

				<td>
					<a href="edit-post.php?id=<?php echo $row['postID'];?>">Edit</a> |
					<a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
				</td>

				<?php
				echo '</tr>';

			}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
	?>
	</table>

	<p><a href='add-post.php' class="btn btn-success">Add Post</a></p>
	</div>

</div>

</body>
</html>
