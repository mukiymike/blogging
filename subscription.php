<?php
	//Start session
	session_start();
	
	//Connect to mysql server
	require "connect.php";
	//Sanitize the POST values
   if (isset($_POST['submit'])) {
		$Name=$_POST['Name'];
		$Email=$_POST['Email'];
		
		$submit="INSERT into subscribe (`Name`,`Email`,`Type`) 
		          values ('$Name','$Email',2)";
		$submit_run=mysqli_query($conn,$submit);
		if ($submit_run) {
			echo '<div class="alert alert-success">Registration successful</div>';
		}
    else{
			echo '<div class="alert alert-danger">could not register</div>';
		 }
	 
  }

?>
	
<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width" />
      <title> Multimedia Shadows
      </title>
      <meta name="description" content="Download free amazing responsive Fashion Blog template."/>
      <meta name="keywords" content="free, responsive, blog, fashion, web site, template"/>
      <link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/responsee.css">
      <!-- CUSTOM STYLE -->       
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="css/template-style.css">
      <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>    
      <script type="text/javascript" src="js/modernizr.js"></script>
      <script type="text/javascript" src="js/responsee.js"></script>          
      <!--[if lt IE 9]> 
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
      <![endif]-->     
   </head>
   <body class="size-1140">
      <!-- TOP NAV WITH LOGO -->          
      <header class="margin-bottom">
         <div class="line">
            <nav>
               <div class="top-nav">
                  <p class="nav-text"></p>
                  <a class="logo" href="index.html">            
                  Multimedia<span>Shadows</span>
                  </a>            
                  <h1>Multimedia Blogspot</h1>
                  <ul class="top-ul right">
                     <li>            
                        <a href="index.html">Blog</a>            
                     </li>
                     <li>            
                        <a href="about.html">Trending</a>            
                     </li>
                      <li>            
                        <a href="event.html">Events</a>            
                     </li>
                     <li>            
                        <a href="archive.html">Archive</a>            
                     </li>
                      
                      <div class="social right">	           
                        <a target="_blank" href="https://www.facebook.com/mmushadows">
                        <i class="icon-facebook_circle icon2x"></i>
                        </a>          
                        <a target="_blank" href="https://twitter.com/mmushadows">
                        <i class="icon-twitter_circle icon2x"></i>
                        </a>          
                     </div>
                  </ul>
               </div>
            </nav>
         </div>
      </header>
        <form class="customform" action="subscription.php" method="POST">
                                 <div class="s-12"><input name="Email" placeholder="Email" title="Your e-mail" type="email" /></div>
                                 <div class="s-12"><input name="Name" placeholder="Name" title="Your name" type="text" /></div>
                           
                                 <input type="submit" name="submit" value="	submit"/>
                                 </form>
   </body>
   </html>