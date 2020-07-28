<?php
	
	$db_host     = "localhost";
	$db_user     = "root";
	$db_password = "";
	$db_name     = "new_warehouse";
	
	
	$connection=mysqli_connect($db_host,$db_user,$db_password);
	mysqli_query($connection, "SET NAMES utf8");
    if(!$connection){
	  die("Database connection failed:");
    }
    $db_select=mysqli_select_db($connection, $db_name);
    if (!$db_select){
	   die("Database selection failed");
    }
     
	

?>