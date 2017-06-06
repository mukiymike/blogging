<?php require('includes/connect.php'); ?>
<!DOCTYPE html>
<html lang="en-US">
   <head>
   <title> Multimedia Shadows </title>

   <?php
   include("includes/segments/metaEnLinks.php");
   ?>

   <!-- PageSpeed and Google Ads. -->
   <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
   <script>
     (adsbygoogle = window.adsbygoogle || []).push({
       google_ad_client: "ca-pub-5385801574160018",
       enable_page_level_ads: true
     });
   </script>

   </head>
   <body class="size-1140">

   <!-- Page Views by google analytics -->
   <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

     ga('create', 'UA-98708265-1', 'auto');
     ga('send', 'pageview');
   </script>

     <?php
      include "includes/segments/navigationBar.php";
      ?>

      <!-- MAIN SECTION -->
      <section id="home-section" class="line">
         <div class="margin">
            <!-- ARTICLES -->
         <div class="s-12 l-9">
            <?php
                     try {
                        // Displaying either text or image in functions for implementation in the design
                        // display text
                        function displayText($row, $postID, $postTitle, $postDesc, $postDate){
                           // The Text
                           echo '<div class = "s-12 l-5 post-text">';
                              echo '<H2><a href="viewpost.php?id='.$row[$postID].'">'.$row[$postTitle].'</a></H2>';
                              echo '<p>Posted on '.date('jS M', strtotime($row[$postDate])).'</p>';
                              echo '<p>'.$row[$postDesc].'</p>';
                              echo '<p><a class="continue-reading" href="viewpost.php?id='.$row[$postID].'">Continue Reading</a></p>';
                           echo '</div>';
                           // Display Date
                           echo '<div class="s-12 l-1 post-date">';
                              echo '<p class="date">'.date('d', strtotime($row[$postDate])).'</p>';
                              echo '<p class="month">'.date('M', strtotime($row[$postDate])).'</p>';
                           echo '</div>';
                        }

                        // display image
                        function displayImage(){
                           echo '<div class="s-12 l-6 post-image">';
                              echo '<a href = "#">';
                              echo '<img src="img/IMG-20170511-WA0002.jpg" alt="Fashion 1">';
                              echo '</a>';
                           echo '</div>';
                        }

                        // Fetching posts from database and displaying.
                        $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
                        while($row = $stmt->fetch()){
                           // Manipulating classes for cool CSS
                           $postID = $row['postID'];
                           if ($row['postID'] > 5) {
                              $postID = $row['postID'] % 5 + 1;
                           }

                           // Alignment for the images
                           $alignment = 'left-align';
                           if ($postID % 2 == 0) {
                              // Display image with text alongside
                              $alignment = 'right-align';
                           }


                           // Outputting articles
                           echo '<article class="post-'.$postID.' line '.$alignment.'">';
                           // Display image
                           displayImage();
                           // Display text
                           displayText($row, 'postID', 'postTitle', 'postDesc', 'postDate');
                           echo '</article>';

                        }

                     } catch(PDOException $e) {
                         echo $e->getMessage();
                     }
                  ?>



               <!-- ARTICLE 5 -->
               <article class="post-5 line">
                  <!-- text -->
                  <div class="s-12 l-11 post-text">
                     <a href="comments.html">
                        <h2>Comments</h2>
                     </a>
                     <p>Your comments and views will be highly appreciated</p>
                     <a class="continue-reading" href="comments.html">Comment</a>
                  </div>
                  <!-- date -->
                  <div class="s-12 l-1 post-date">
                     <p class="date">03</p>
                     <p class="month">June</p>
                  </div>

               </article>
         </div>


            <!-- SIDEBAR -->
            <div class="s-12 l-3">
               <aside>

                  <!-- NEWS 1 -->
                  <img src="img/Screenshot_20170519-004151.png" alt="fashion">
                  <div class="aside-block margin-bottom">
                     <h3>Entertainment Blog</h3>
                     <p>This is the realest site that posts on what is hot and trending in MMU Kenya.This blog gives you the sneack sniff on the top ten prettiest chicks and top five hot dudes in Multimedia.Being the number one media and technology university,this blog gives you a diverse events line up and the best places to hang out.</p>
                  </div>
                  <!-- NEWS 2 -->
                  <img src="img/v1.dDsyMDE4MzQ7ajsxNzMyNzsxMjAwOzE3NzI7MjY1OA" alt="News 2">
                  <div class="aside-block margin-bottom">
                     <h3>Scandal Slot!!</h3>
                     <p>This is a special segment that gives you all the udaku and the mpashoz. Stay tuned for the heartbreaks or any guy caught cheating behind the blocks or the streets of Rongai.We dont spare looses chilez either. </p>
                  </div>

                  <!-- AD REGION -->
                  <div class="advertising margin-bottom">
                     <img src="img/IMG-20170531-WA0006.jpg" alt="ad banner">
                  </div>
               </aside>
            </div>
         </div>
      </section>

      <?php
      include "includes/segments/footerSect.php";
      ?>

   </body>
</html>
