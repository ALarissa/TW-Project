<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" href="css/style.css"><link rel="stylesheet" type="text/css" href="css/register.css">
<link href='http://fonts.googleapis.com/css?family=Roboto:200,300,400' rel='stylesheet' type='text/css'>
</head>
<body>
<?php 
	include "back/connect.php";
	include "back/is_logged.php";
	$logged=is_logged();
	if($logged==0){?>
	<div id="loginc">
		<form action="back/register.php" method="post">					<h1>REGISTER</h1>
			<input type="text" name="user" placeholder="Username"/>
			<input type="text" name="email" placeholder="E-mail"/>
			<input type="password" name="pass" placeholder="Password"/>
			<input type="submit" style="background-color:#c0392b;border:0;color:#fff;cursor:pointer;margin-top:40px;" value="Register"/>
		</form>
	</div>
	<?php
	}else{
		header('Location: localhost');
	}
?>
</body>
</html>