<?php require('includes/connect.php');

$stmt = $db->prepare('SELECT postID, postImg, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if($row['postID'] == ''){
    header('Location: ./');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en-US">
   <head>
      <title>Multimedia Shadows - Discover </title>
      <?php include("includes/segments/metaEnLinks.php"); ?>
   </head>
   <body class="size-1140">
   <!--facebook-->
   <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9&appId=108980153033685";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-98708265-1', 'auto');
  ga('send', 'pageview');

</script>
      <!-- TOP NAV WITH LOGO -->
      <?php include("includes/segments/navigationBar.php"); ?>
      <!-- MAIN SECTION -->
      <section id="article-section" class="line">
         <div class="margin">
            <!-- ARTICLES -->
            <div class="s-12 l-9">
               <!-- ARTICLE 1 -->
               <article class="margin-bottom">
                  <?php
                  // Manipulating classes for cool CSS
                           $postID = $row['postID'];
                           if ($row['postID'] > 5) {
                              $postID = $row['postID'] % 5 + 1;
                           }

                           // Outputting articles
                           echo '<div class="post-'.$postID.' line">';
                    ?>
                     <!-- image -->
                     <div class="s-12 l-11 post-image">
                        <?php echo '<img src="'.$row['postImg'].'" alt="MMU Shadows." style="max-height: 600px;">'; ?>
                     </div>
                     <?php
                        echo '<div class="s-12 l-1 post-date">';
                          echo '<p class="date">'.date('d', strtotime($row['postDate'])).'</p>';
                          echo '<p class="month">'.date('M', strtotime($row['postDate'])).'</p>';
                       echo '</div>';
                       ?>
                  </div>
                  <!-- text -->
                  <div class="post-text">
                    <?php
                        echo '<div>';
                            echo '<h1>'.$row['postTitle'].'</h1>';
                            echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
                            echo '<p>'.$row['postCont'].'</p>';
                        echo '</div>';
                    ?>
                     <p class="author">Author: Anonymous</p>
                    </div>
               </article>
               <!-- AD REGION -->
               <div class="line">
                  <div class="advertising horizontal">
                     <img src="img/Screenshot (2).png" alt="ad banner">
                  </div>
               </div>
            </div>
            <!-- SIDEBAR -->
            <div class="s-12 l-3">
               <aside>
                  <!-- NEWS 1 -->
                  <img src="img/Screenshot_20170519-004151.png" alt="News 1">
                  <div class="aside-block margin-bottom">
                     <h3>Entertainment Blog</h3>
                     <p>This is the realest site that posts on what is hot and trending in MMU Kenya.This blog gives you the sneack sniff on the top ten prettiest chicks and top five hot dudes in Multimedia.Being the number one media and technology university,this blog gives you a diverse events line up and the best places to hang out.</p>
                  </div>
                  <!-- AD REGION -->
                  <div class="advertising margin-bottom">
                     <img src="img/Unrestrained night🔥🔥 20170529_231154.jpg" alt="ad banner">
                  </div>
                  <!-- LATEST POSTS -->
                  <div class="aside-block margin-bottom">
                     <h3>Latest posts</h3>
                     <a class="latest-posts" href="post-1.html">
                        <h5>Multimedia Top Ten Finest Divas</h5>
                        <p>
                     With its high number of diverse courses Multimedia University...
                        </p>
                     </a>
                     <a class="latest-posts" href="post-2.html">
                        <h5>Trend Setters</h5>
                        <p>These gentlemen and ladies define the elegance of dressing
                        </p>
                     </a>
                     <a class="latest-posts" href="post-3.html">
                        <h5>Finest Photography</h5>
                        <p>
                          Ever found a hard time looking for the perfect photographers?..
                        </p>
                     </a>
                     <a class="latest-posts" href="post-4.html">
                        <h5>Multimedia Forbes List</h5>
                        <p>Ever thought of the richest kids in the campus..
                        </p>
                     </a>
                     <a class="latest-posts" href="post-5.html">
                        <h5>Just for ladies!Mmu Hot Dudes</h5>
                        <p>
                           Ladies we bring you the hottest gentlemen in the campus..
                        </p>
                     </a>
                  </div>
                   <!-- AD REGION -->
                  <div class="advertising margin-bottom">
                     <img src="img/Unrestrained night🔥🔥 20170529_231154.jpg" alt="ad banner">
                  </div>
               </aside>
            </div>
         </div>
      </section>
      <!-- FOOTER -->
      <div class="line">
         <?php include("includes/segments/footerSect.php"); ?>
      </div>
   </body>
</html>
