<?php
include("../connection.php");
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form
$username=mysqli_real_escape_string($connection,$_POST['username']); 
$password=mysqli_real_escape_string($connection,$_POST['password']); 
$password=md5($password); // Encrypted Password
$sql="Insert into admin(user,pass) values('$username','$password')";
$result=mysqli_query($connection,$sql);
echo "Registration Successfully";
}
?>
<html>
<body>
<form action="registration.php" method="post">
<label>UserName :</label>
<input type="text" name="username"/><br />


<label>Password :</label>
<input type="password" name="password"/><br/>

<input type="submit" value=" Registration "/><br />
</form>
</body>
</html>