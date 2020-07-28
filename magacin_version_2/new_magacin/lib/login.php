<?php
include("../connection.php");
session_start();
if(isSet($_POST['username']) && isSet($_POST['password']))
{
// username and password sent from Form
$username=mysqli_real_escape_string($connection,$_POST['username']); 
$password=md5(mysqli_real_escape_string($connection,$_POST['password'])); 

$result=mysqli_query($connection,"SELECT id FROM admin WHERE user='$username' and pass='$password'");
$count=mysqli_num_rows($result);

$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
	$_SESSION['login_user']=$row['id'];
	echo $row['id'];
}else
{
	echo 0;	
	
}

}
?>