<?php //include connection config
require_once('../includes/connect.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <title>Admin - Edit Post</title>

  <?php include("includes/segments/metaEnLinks.php"); ?>

  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>
</head>
<body>

<div id="wrapper">

	<?php
	$active = 'blog';
	include('includes/segments/navigationBar.php');?>
	<div class="container">
	<a href="./" class="btn btn-default">Blog Admin Index</a>
	<h2><center>Edit Post - Rippen it.</center></h2><hr>
	</div>
	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($postID ==''){
			$error[] = 'This post is missing a valid id!.';
		}

		if($postTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($postDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($postCont ==''){
			$error[] = 'Please enter the content.';
		}

                         // Upload image
                        include("uploadImg.php");

		if(!isset($error)){

			try {

				//insert into database
                                                $imgUploadDir = "uploads/";
                                                $pathToImg = $imgUploadDir. basename($_FILES["fileToUpload"]["name"]);
				$stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postImg = :postImg, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID') ;
				$stmt->execute(array(
					':postTitle' => $postTitle,
                                                            ':postImg' => $pathToImg,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postID' => $postID
				));

				//redirect to index page
				header('Location: index.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>

	<div class="col-md-12 col-sm-12 col-xs-12">
<?php
        //check for any errors and display them.
    if(isset($error)){
        foreach($error as $error){
            echo '<div class="alert alert-danger">';
              echo '<strong><center>'.$error.'.</center></strong>';
            echo '</div>';
        }
    }
        try {

            $stmt = $db->prepare('SELECT postID, postTitle, postDesc, postCont FROM blog_posts WHERE postID = :postID') ;
            $stmt->execute(array(':postID' => $_GET['id']));
            $row = $stmt->fetch();

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

?>
          <!--Post Editing Form-->
          <div class="panel panel-info">
            <div class="panel-heading"><center>What's Happening? 'Leta Maneno! Tunapenda Mushene..'</center></div>
            <div class="panel-body">
            <form role="form" action="" method="POST" enctype="multipart/form-data">
            <input type='hidden' name='postID' value='<?php echo $row['postID'];?>'>
                <div class="form-group">
                  <label for="postTitle">Post Title: (Two to three words)</label>
                  <input type="text" class="form-control" required="required" name='postTitle' placeholder="Shorter Titles are the best." value='<?php echo $row['postTitle'];?>'>
                </div>
                <div class="form-group">
                  <label for="headLineImg">Headline Image.</label>
                  <input type="file" class="form-control" required="required" name='fileToUpload'  id = "fileToUpload">
                </div>
                <div class="form-group">
                  <label for="postDesc">Post Headlines: (A short post description, maybe only the first two lines of the post.)</label>
                  <textarea name='postDesc' cols='60' rows='4' placeholder="A short post description, maybe only the first few lines of the post."><?php echo $row['postDesc'];?></textarea>
                </div>
                <div class="form-group">
                  <label for="postCont">Post Content:</label>
                  <textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont'];?></textarea>
                </div>
                <button type="submit" class="btn btn-block btn-info" name="submit">Publish Edits Online!</button>
            </form>
            </div>
            <div class="panel-footer alert-danger"><strong>Once it's online, you're accountable!</strong><br>Any posts you publish on this blog will have that additional clause of published by YOU. Feature coming soon.</div>
          </div>
        </div>

</div>

</body>
</html>
