<?php //include connect config
require_once('../includes/connect.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <title>Admin - Add Post</title>
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
     include("includes/segments/navigationBar.php");
?>
    <div class="container">
	<a href="./" class="btn btn-default">Blog Admin Index</a>

	<h2><center>Post Publication Arena - Where stuff cooks.</center></h2><hr>
    </div>
	<?php

	//if form has been submitted process it
	if(isset($_POST['submit'])){

		$_POST = array_map( 'stripslashes', $_POST );

		//collect form data
		extract($_POST);

		//very basic validation
		if($postTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if($postDesc ==''){
			$error[] = 'Please enter the description.';
		}

		if($postCont ==''){
			$error[] = 'Please enter the content.';
		}

		if(!isset($error)){

			try {

                        // Upload image
                        include("uploadImg.php");

				//insert into database
                        $imgUploadDir = "uploads/";
                        $pathToImg = $imgUploadDir. basename($_FILES["fileToUpload"]["name"]);
				$stmt = $db->prepare('INSERT INTO blog_posts (postTitle,postImg,postDesc,postCont,postDate) VALUES (:postTitle, :postImg, :postDesc, :postCont, :postDate)') ;
				$stmt->execute(array(
					':postTitle' => $postTitle,
                              ':postImg' => $pathToImg,
					':postDesc' => $postDesc,
					':postCont' => $postCont,
					':postDate' => date('Y-m-d H:i:s')
				));

				//redirect to index page
				header('Location: index.php?action=added');
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
    ?>
          <!--Post Editing Form-->
          <div class="panel panel-info">
            <div class="panel-heading"><center>What's Happening? 'Leta Maneno! Tunapenda Mushene..'</center></div>
            <div class="panel-body">
            <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="postTitle">Post Title: (Two to three words)</label>
                  <input type="text" class="form-control" required="required" name='postTitle' placeholder="Shorter Titles are the best." value='<?php if(isset($error)){ echo $_POST['postTitle'];}?>'>
                </div>
                <div class="form-group">
                  <label for="headLineImg">Headline Image.</label>
                  <input type="file" class="form-control" required="required" name='fileToUpload'  id = "fileToUpload">
                </div>
                <div class="form-group">
                  <label for="postDesc">Post Headlines: (A short post description, maybe only the first two lines of the post.)</label>
                  <textarea name='postDesc' cols='60' rows='4' placeholder="A short post description, maybe only the first few lines of the post."><?php if(isset($error)){ echo $_POST['postDesc'];}?></textarea>
                </div>
                <div class="form-group">
                  <label for="postCont">Post Content:</label>
                  <textarea name='postCont' cols='60' rows='10'><?php if(isset($error)){ echo $_POST['postCont'];}?></textarea>
                </div>
                <button type="submit" class="btn btn-block btn-info" name="submit">Publish Online!</button>
            </form>
            </div>
            <div class="panel-footer alert-danger"><strong>Once it's online, you're accountable!</strong><br>Any posts you publish on this blog will have that additional clause of published by YOU.</div>
          </div>
        </div>
</div>
