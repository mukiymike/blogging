 <!-- TOP NAV WITH LOGO -->
<header class="margin-bottom">
   <nav class="navbar navbar-default">
     <div class="container-fluid">
       <div class="navbar-header">
         <a class="navbar-brand" href="../">MMU Shadows - Admin.</a>
       </div>
       <ul class="nav navbar-nav">
         <!-- Get the state of the active class -->
         <li <?php
                if ($active=="blog") {
                  echo "class='active'";
                } else {
                  echo " ";
                }
               ?>><a href="index.php">Blog</a></li>
         <li <?php
                if ($active=="users") {
                  echo "class='active'";
                } else {
                  echo " ";
                }
               ?>><a href="users.php">Users</a></li>
         <li ><a href="../">View Website</a></li>
         <li ><a href="logout.php">Logout&nbsp;&nbsp;<span class="glyphicon glyphicon-log-in"></span></a></li>
       </ul>
     </div>
   </nav>
</header>
