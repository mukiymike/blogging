<?php
//include connection config
require_once('../includes/connect.php');

//log user out
$user->logout();
header('Location: index.php'); 

?>
