<?php
session_start();
if(!empty($_SESSION['login_user']))
{
header('Location: home.php');
}

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>WareHouse</title>
<link rel="stylesheet" href="css/login.css"/>
<link rel="stylesheet" href="css/css.css"/>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.shake.js"></script>
	<script>
			$(document).ready(function() {
			
			$('#login').click(function()
			{
			var username=$("#username").val();
			var password=$("#password").val();
		    var dataString = 'username='+username+'&password='+password;
			if($.trim(username).length>0 && $.trim(password).length>0)
			{
			
 
			$.ajax({
            type: "POST",
            url: "lib/login.php",
            data: dataString,
            cache: false,
            beforeSend: function(){ $("#login").val('Connecting...');},
            success: function(data){
            if(data!=0)
            {
				
            $(location).attr('href', 'home.php');
            }
            else
            {
             $('#box').shake();
			 $("#login").val('Login')
			 $("#error").html("<span style='color:#cc0000'>Error:</span> Погрешно корисничко име или лозинка. ");
            }
            }
            });
			
			}
			return false;
			});
			
				
			});
		</script>
</head>

<body>
<div id="main">

    <div id="img"><img src="images/logo.jpg" style="width:150px; height:90px"> </div>
	<h1>ЛОГИН</h1>

	<div id="box">
		<form action="" method="post">
		<label>Корисник</label> 
			<input type="text" name="username" class="input" autocomplete="off" id="username"/>
		<label>Лозинка </label>
			<input type="password" name="password" class="input" autocomplete="off" id="password"/><br/>
		<input type="submit" class="button button-primary" value="Логирај се!" id="login"/> 
		<span class='msg'></span> 

		<div id="error">

		</div>	

		</div>
		</form>	
</div>
</body>
</html>