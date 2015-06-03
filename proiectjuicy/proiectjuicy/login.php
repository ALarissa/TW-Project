<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/login.css">

<link href='http://fonts.googleapis.com/css?family=Roboto:200,300,400' rel='stylesheet' type='text/css'>

</head>

<body>

<?php 

	include "back/connect.php";

	include "back/is_logged.php";

	$logged=is_logged();

	if($logged==0){?>

		<div id="loginc">

			<form action="back/login.php" method="post">

				<h1>LOG IN</h1>
				
				<input type="text" name="email" placeholder="E-mail"/>

				<input type="password" name="pass" placeholder="Password"/>

				<input type="submit" style="background-color:#c0392b;border:0;color:#fff;cursor:pointer;" value="Log in"/>

				

				<a id="reg" href = 'http://localhost/back/register.php'>REGISTER</a>

			</form>

		</div>

	<?php

	}else{

		?>

		<script>window.location.replace("http://localhost/dashboard.php");</script>

	<?php 

	}

?>

</body>

</html>