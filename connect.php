<?php
$server="localhost";
$user="root";
$dp_name="blog";
$pwd="";

$conn = mysqli_connect($server,$user,$pwd,$dp_name);
if(!$conn){
	//echo "Connection error...".mysqli_connect();
}
else{
	//echo "<h3>Connection successful".'</h3>';
}
?>