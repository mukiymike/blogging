 <!-- TOP NAV WITH LOGO -->
<header class="margin-bottom">
   <nav class="navbar navbar-default navbar-fixed-top">
     <div class="container-fluid">
       <div class="navbar-header">
         <a class="navbar-brand" href="../">MMU Shadows - Admin.</a>
       </div>
       <ul class="nav navbar-nav">
       </ul>
     </div>
   </nav>
</header>

<header>
   <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../">MMU Shadows - Admin.</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!-- Get the state of the active class -->
         <li <?php
                if ($active=="blog") {
                  echo "class='active'";
                } else {
                  echo " ";
                }
               ?> class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="index.php">Blog Posts.<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php">Blog Post Index.</a></li>
            <li><a href="add-post.php">Create New Post.</a></li>
          </ul>
        </li>
        <li <?php
                if ($active=="users") {
                  echo "class='active'";
                } else {
                  echo " ";
                }
               ?> class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="users.php">Blog Admins.<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="users.php">Blog Admins Index.</a></li>
            <li><a href="add-user.php">Add New Admin.</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
         <li ><a href="../">View Website</a></li>
         <li ><a href="logout.php">Logout&nbsp;&nbsp;<span class="glyphicon glyphicon-log-in"></span></a></li>
         <li ><a href="../">"                "</a></li>
      </ul>
    </div>
  </div>
</nav>
<br><br><br><br>
</header>
