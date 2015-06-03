<html>
<?php
	include "back/connect.php";
	$sql="SELECT products.*,product_info.price,product_info.w_id,product_info.piid 
	FROM products INNER JOIN product_info ON product_id=prod_id AND piid=".$_GET['id'];
	$results=mysql_query($sql);
	if($rez=mysql_fetch_array($results)){
?>
<head>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/produs.css">
<script src="scripts/jquery-2.1.4.min.js"></script>
<script src="scripts/cart.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<script>

</script>
</head>
<body>
<div id="meniu">
		<div id="meniu_inside">
			<img id="logo" src="images/logo.jpg" />
			<div id="meniu_items">
				<a href="/" >Home</a>
				<a href="catalog.php" style="color:#F39C12">Produse</a>
				<a href="contact.php">Contact Us</a>
				<a onclick="displaycart();" style="cursor:pointer;"><img style="margin-top:23px;" src="images/cart.png"/></a>
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
	<div id="cart"></div>
	<div id="content">
	<div style="position:relative;float:left;">
	<?php
		
			$rez2=mysql_fetch_array(mysql_query("SELECT cantitate FROM weight WHERE w_id=".$rez['w_id']));
			$rez3=mysql_fetch_array(mysql_query("SELECT procent FROM oferta WHERE piid=".$_GET['id']));
			$reducere="";
			if($rez3['procent']) {
				$price=$rez['price']-($rez['price']*$rez3['procent']/100);
				$reducere="(-".$rez3['procent']."%)";
			}else
				$price=$rez['price'];
			echo '<div id="idprod">'.$rez['piid'].'</div><div id="imagine" style="background-image:url('."'images/".$rez['product_name'].".jpg'".')"></div><div id="right"><div id="nume">'.$rez['product_name'].'</div><div id="desc">'.$rez['descriere'].'</div><span id="price">Pret: <span id="pret">'.$price.'</span>RON '.$reducere.'</span><span id="grj">Gramaj: '.$rez2['cantitate'].'L</span>';
			echo '<input id="cant" placeholder="Cantitate" type="text"/><div id="send" onclick="addtocart()">Add to cart</div></div>';
		}else{
			//header('Location: http://localhost/catalog.php');
		}
	?>
	</div>
	</div>
	<div id="footer">&copy;2015 Juicy </div>
</body>
</html>