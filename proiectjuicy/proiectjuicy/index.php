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
	<div id="slider">
		<div id="slider_all">
			<div class="slide" id="slide1"><div class="subtitle">HELLO,</div><div class="title">Welcome to juicy</div></div>
			<div class="slide" id="slide2"></div>
			<div class="slide" id="slide3"></div>
		</div>
	</div>
	<div id="offers">
	<?php
		$result=mysql_query("SELECT * FROM oferta");
		while($rez=mysql_fetch_array($result)){
			$rez2=mysql_fetch_array(mysql_query("SELECT products.product_name,a.w_id FROM products,(SELECT prod_id,w_id FROM product_info WHERE piid=".$rez['piid'].") AS a WHERE products.product_id=a.prod_id"));
			$rez3=mysql_fetch_array(mysql_query("SELECT cantitate FROM weight WHERE w_id=".$rez2['w_id']));
			echo '<a href="product.php?id='.$rez['piid'].'"><div class="offer"><div style="background-image:url(images/promo'.$rez['oferta_id'].'.jpg)" class="promoimg"></div><span class="numeoffer">'.$rez2['product_name'].' '. $rez3['cantitate'].'l</span><span class="procentoffer">-'.$rez['procent'].'%</span></div></a>';
		}
	?>
	</div>
	<div id="footer">&copy;2015 Juicy </div>
</body>
</html>