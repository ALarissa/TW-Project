 <html>
<head>
<link rel="stylesheet" href="css/style.css">
<script src="scripts/jquery-2.1.4.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<script>
	var margine_slider=0;
	setInterval(function(){
		var w = $('body').innerWidth();
		margine_slider-=w;
		if(margine_slider==-3*w)
			margine_slider=0;
		$('#slider_all').css('margin-left',margine_slider);
	}, 3000);
</script>
</head>
<body>
<div id="meniu">
		<div id="meniu_inside">
			<img id="logo" src="images/logo.jpg" />
			<div id="meniu_items">
				<a href="/" style="color:#F39C12">Home</a>
				<a href="catalog.php">Produse</a>
				<a href="contact.php">Contact Us</a>
<?php 
	include "back/connect.php";
	include "back/is_logged.php";
	$logged=is_logged();
	if($logged==0){?>
		<a style="text-decoration:underline;font-weight:400;color:#c0392b" href="login.php">Log in</a>
		<a style="background-color:#F89406;color:#fff;font-weight:400;padding-left:10px;padding-right:10px;" href="register.php">Register</a>
	<?php
	}else{
		?>
		<a href="back/logout.php">Log out</a>
	<?php 
	}
?>
			</div>
		</div>
	</div>
	<form id="contact" action="contact.php" method="get">
	<h2>Contact Us!</h2>
	<input type="text" placeholder="Nume"/>
	<input type="text" placeholder="E-mail"/>
	<textarea></textarea>
	<input id="subcon" type="submit"/>
	</form>
	<div id="footer">&copy;2015 Juicy </div>
</body>
</html>