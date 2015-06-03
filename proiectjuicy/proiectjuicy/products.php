<html>
<head>
<link rel="stylesheet" href="css/style.css">
<script src="scripts/jquery-2.1.4.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<script>
	var margine_slider=0;
	setInterval(function(){
		margine_slider-=1000;
		if(margine_slider==-3000)
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
				<a href="#" style="color:orange">Home</a>
				<a href="#">Produse</a>
				<a href="#">Contact Us</a>
				<?php 
					include "back/connect.php";
					include "back/is_logged.php";
					$logged=is_logged();
					if($logged==0){?>
						<a href="login.php">Log in</a>
						<a href="register.php">Register</a>
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
	<div id="content">
		<div id="submenu">
			<?php 
				$result=mysql_query("SELECT * FROM categories");
				while($rez=mysql_fetch_array($result)){
					echo '<a class="submenuitem" href="products.php?cat='.$rez['category_id'].'"><div class="smii"><img src="images/c'.$rez['category_id'].'.jpg"/><span>'.$rez['category_name'].'</span></div></a>';
				}
			?>
		</div>
	</div>
</body>
</html>