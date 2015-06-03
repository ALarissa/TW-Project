<html>
<head>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/catalog.css">
<script src="scripts/jquery-2.1.4.min.js"></script>
<script src="scripts/cart.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<script>
	function getUrlParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}  
//http://stackoverflow.com/questions/19491336/get-url-parameter-jquery
function setpage(a){
		var link="http://localhost/catalog.php";
		var k=0;
		var order = getUrlParameter('order');
		var cat = getUrlParameter('cat');
		var pag = getUrlParameter('pag');
		if(cat){
			link=link+"?cat="+cat;
			k=1;
		}
		if(order){
			if(k==0){
				link=link+"?order="+order;
				k=1;
			}else
				link=link+"&order="+order;
		}
		if(k==0)
			link=link+"?pag="+a;
		else
			link=link+"&pag="+a;
		window.location.href = link;
	}
	function setorder(a){
		var link="http://localhost/catalog.php";
		var k=0;
		var order = getUrlParameter('order');
		var cat = getUrlParameter('cat');
		var pag = getUrlParameter('pag');
		if(cat){
			link=link+"?cat="+cat;
			k=1;
		}
		if(pag){
			if(k==0){
				link=link+"?pag="+pag;
				k=1;
			}else
				link=link+"&pag="+pag;
		}
		if(a!=""){
			if(k==0)
				link=link+"?order="+a;
			else
				link=link+"&order="+a;
			}
		window.location.href = link;
	}
</script>
</head>
<body>
<div id="meniu">
		<div id="meniu_inside">
			<img id="logo" src="images/logo.jpg" />
			<div id="meniu_items">
				<a href="/">Home</a>
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
	<div id="filtre">
		<span onclick="setorder('')">Magic</span>
		<span onclick="setorder('pret_asc')">Pret Asc</span>
		<span onclick="setorder('pret_desc')">Pret Desc</span>
		<span onclick="setorder('date')">Date</span>
	</div>
	<div id="submenu">
			<?php 
				$result=mysql_query("SELECT * FROM categories");
				while($rez=mysql_fetch_array($result)){
					echo '<a class="submenuitem" href="catalog.php?cat='.$rez['category_id'].'">'.$rez['category_name'].'</a>';
				}
			?>
		</div>
	<div id="catalog">
	<?php
		if(isset($_GET['pag'])){
			$page=$_GET['pag'];
		}else{
			$page=1;
		}
		$frompage=($page-1)*6;
		$magic="";
		if(!isset($_GET['order']) && isset($_COOKIE['uid'])){
			$uid=$_COOKIE['uid'];
			$rez2=mysql_fetch_array(mysql_query("SELECT hashtags FROM users WHERE user_id=".$uid));
			$hash=$rez2['hashtags'];
			$hash=str_replace(",","+",$hash);
			$sql="SELECT a.*,product_info.*,products.product_name,products.descriere,( (1.3 * (MATCH(products.hashtags) AGAINST ('+".$hash."' IN BOOLEAN MODE)))) AS relevance  
			FROM product_info,products,(SELECT product_id FROM product_category) AS a 
			WHERE a.product_id=product_info.prod_id AND a.product_id=products.product_id ORDER BY relevance DESC LIMIT ".$frompage.",6";
			if(isset($_GET['cat'])){
				$cat=$_GET['cat'];
				$sql="SELECT a.*,product_info.*,products.product_name,products.descriere,( (1.3 * (MATCH(products.hashtags) AGAINST ('+".$hash."' IN BOOLEAN MODE)))) AS relevance 
				FROM product_info,products,(SELECT product_id FROM product_category WHERE category_id=".$cat.") AS a 
				WHERE a.product_id=product_info.prod_id AND a.product_id=products.product_id ORDER BY relevance DESC LIMIT ".$frompage.",6";
			}
//http://stackoverflow.com/questions/15026244/mysql-order-by-relevance
			$results=mysql_query($sql);
			while($rez=mysql_fetch_array($results)){
				$rez5=mysql_fetch_array(mysql_query("SELECT cantitate FROM weight WHERE w_id=".$rez['w_id']));
				echo '<div class="produs"><div class="prodimg" style="background-image:url('."'images/".$rez['product_name'].".jpg'".')"></div><div class="prodtitle">'.$rez['product_name'].'</div><div class="proddesc">'.$rez['descriere'].'</div><div class="pretprod">'.$rez['price'].'RON </div><div class="cantprod">'.$rez5['cantitate'].'L</div><a class="linkprod" href="product.php?id='.$rez['piid'].'">Vezi produs</a><br></div>';
			}
		}else{
			$sql="SELECT a.*,product_info.*,products.product_name,products.descriere 
			FROM product_info,products,(SELECT product_id FROM product_category) AS a 
			WHERE a.product_id=product_info.prod_id AND a.product_id=products.product_id";	
			if(isset($_GET['cat'])){
				$cat=$_GET['cat'];
				$sql="SELECT a.*,product_info.*,products.product_name,products.descriere 
				FROM product_info,products,(SELECT product_id FROM product_category WHERE category_id=".$cat.") AS a 
				WHERE a.product_id=product_info.prod_id AND a.product_id=products.product_id";
			}
			$ord='';
			if($_GET['order']=='date')
				$ord='ORDER BY data DESC';
			else
				if($_GET['order']=='pret_asc')
					$ord='ORDER BY price ASC';
				else
					$ord='ORDER BY price DESC';
			$sql=$sql.' '.$ord." LIMIT ".$frompage.",6";
			$results=mysql_query($sql);
			while($rez=mysql_fetch_array($results)){
				$rez5=mysql_fetch_array(mysql_query("SELECT cantitate FROM weight WHERE w_id=".$rez['w_id']));
				echo '<div class="produs"><div class="prodimg" style="background-image:url('."'images/".$rez['product_name'].".jpg'".')"></div><div class="prodtitle">'.$rez['product_name'].'</div><div class="proddesc">'.$rez['descriere'].'</div><div class="pretprod">'.$rez['price'].'RON </div><div class="cantprod">'.$rez5['cantitate'].'L</div><a class="linkprod" href="product.php?id='.$rez['piid'].'">Vezi produs</a><br></div>';
			}
		}
	?>
	</div>
	<div id="pagini">
	<?php
		$sqlcount="SELECT COUNT(a.product_id) 
			FROM product_info,products,(SELECT product_id FROM product_category) AS a 
			WHERE a.product_id=product_info.prod_id AND a.product_id=products.product_id";
		if(isset($_GET['cat'])){
				$cat=$_GET['cat'];
				$sqlcount="SELECT COUNT(a.product_id) 
				FROM product_info,products,(SELECT product_id FROM product_category WHERE category_id=".$cat.") AS a 
				WHERE a.product_id=product_info.prod_id AND a.product_id=products.product_id";
			}
		$rez=mysql_fetch_array(mysql_query($sqlcount));
		$paginitotal=$rez['COUNT(a.product_id)'];
		if($page!=1)
			echo '<span onclick="setpage('. ($page-1) .')" id="back">Back</span>';
		if($paginitotal/6>$page)
			echo '<span onclick="setpage('. ($page+1) .')" id="next">Next</span>';
	?></div>
	</div>
	<div id="footer">&copy;2015 Juicy </div>
</body>
</html>