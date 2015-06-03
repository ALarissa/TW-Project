<html>
<?php  
	include 'back/connect.php';
	include 'back/is_logged.php';
	$logged=is_logged_admin();
	if($logged==0){
		header('Location: http://localhost/admin_login.php');
	}else{
?>
<head>
<script src="scripts/jquery-2.1.4.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<style>
      html, body, #map-canvas {
        height: 500px;
		width:500px;
        margin: 0px;
        padding: 0px
      }
    </style>
<script>
function update_pret(link,i){
	var pretnou = $('#pretcontor'+i).val();
	link=link+'&price='+pretnou;
	$('#modificalink'+i).attr('href',link);
}
var lat;
var lng;
function vezilocatie(latitudine,longitudine){
	lat=latitudine;
	lng=longitudine;
	initialize();
}
var map;
function initialize() {
  var mapOptions = {
    zoom: 16,
    center: new google.maps.LatLng(lat,lng)
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
}

</script>
</head>
<body>
<?php
	if(isset($_GET['do']) && $_GET['do']=='addcat'){
		$nume=$_GET['nume'];
		mysql_query("INSERT INTO categories (category_name) VALUES ('". $nume."')");
		header('Location: http://localhost/dashboard.php');
	}
	if(isset($_GET['do']) && $_GET['do']=='delcat'){
		$id=$_GET['id'];
		mysql_query("DELETE FROM categories WHERE category_id=".$id);
		header('Location: http://localhost/dashboard.php');
	}
	if(isset($_GET['do']) && $_GET['do']=='addgrj'){
		$nume=$_GET['nume'];
		mysql_query("INSERT INTO weight (cantitate) VALUES ('". $nume."')");
		header('Location: http://localhost/dashboard.php');
	}
	if(isset($_GET['do']) && $_GET['do']=='delgrj'){
		$id=$_GET['id'];
		mysql_query("DELETE FROM weight WHERE w_id=".$id);
		header('Location: http://localhost/dashboard.php');
	}
	if(isset($_GET['do']) && $_GET['do']=='addprod'){
		$nume=$_GET['nume'];
		$cat=$_GET['cat'];
		$hash=$_GET['hashtags'];
		$desc=$_GET['desc'];
		mysql_query("INSERT INTO products (product_name,descriere,hashtags) VALUES ('". $nume."','". $desc."','". $hash."')");
		$result=mysql_query("SELECT product_id FROM products WHERE product_name='".$nume."'");
		$rez=mysql_fetch_array($result);
		$id=$rez['product_id'];
		mysql_query("INSERT INTO product_category (product_id,category_id) VALUES (". $id.",".$_GET['cat'].")");
		$results=mysql_query("SELECT w_id FROM weight");
		while($rez=mysql_fetch_array($results)){
			if(isset($_GET['g'.$rez['w_id']]) && $_GET['g'.$rez['w_id']]==$rez['w_id']){
				mysql_query("INSERT INTO product_info (prod_id,price,w_id) VALUES (".$id.",".$_GET['pret'.$rez['w_id']].",".$rez['w_id'].")");
			}
		}
		header('Location: http://localhost/dashboard.php');
	}
	if(isset($_GET['do']) && $_GET['do']=='modifpret'){
		$id=$_GET['id'];
		$w_id=$_GET['w_id'];
		$price=$_GET['price'];
		mysql_query("UPDATE product_info SET price=".$price." WHERE prod_id=".$id." AND w_id=".$w_id);
		header('Location: http://localhost/dashboard.php');
	}
	if(isset($_GET['do']) && $_GET['do']=='delprod'){
		$id=$_GET['id'];
		$w_id=$_GET['w_id'];
		mysql_query("DELETE FROM product_info WHERE prod_id=".$id." AND w_id=".$w_id);
		header('Location: http://localhost/dashboard.php');
	}
	if(isset($_GET['do']) && $_GET['do']=='complete'){
		$id=$_GET['id']; 
		mysql_query("UPDATE orders SET complete=1");
		header('Location: http://localhost/dashboard.php');
	}
	if(isset($_GET['do']) && $_GET['do']=='delorder'){
		$id=$_GET['id']; 
		mysql_query("DELETE FROM orders WHERE order_id=".$id);
		header('Location: http://localhost/dashboard.php');
	}
	if(isset($_GET['do']) && $_GET['do']=='offer'){
		if(isset($_GET['pid1'])&&isset($_GET['pid2'])&&isset($_GET['pid3'])&&isset($_GET['procent1'])&&isset($_GET['procent2'])&&isset($_GET['procent3']))
		$pid1=$_GET['pid1']; 
		$procent1=$_GET['procent1']; 
		$pid2=$_GET['pid2']; 
		$procent2=$_GET['procent2']; 
		$pid3=$_GET['pid3']; 
		$procent3=$_GET['procent3']; 
		mysql_query("UPDATE oferta SET piid=".$pid1.", procent=".$procent1." WHERE oferta_id=1");
		mysql_query("UPDATE oferta SET piid=".$pid2.", procent=".$procent2." WHERE oferta_id=2");
		mysql_query("UPDATE oferta SET piid=".$pid3.", procent=".$procent3." WHERE oferta_id=3");
		header('Location: http://localhost/dashboard.php');
	}
?>
	<h3>Categorii</h3>
	<form class="insert" method="get" action="dashboard.php">
		<input type="hidden" name="do" value="addcat" />
		<input type="text" placeholder="Nume categorie" name="nume"/>
		<input type="submit"/>
	</form>
	<table>
		<tr><td>Categorie</td><td></td></tr>
		<?php 
			$results=mysql_query("SELECT * FROM categories");
			while($rez=mysql_fetch_array($results)){
				echo '<tr><td>'.$rez['category_name'].'</td><td><a href="dashboard.php?do=delcat&id='.$rez['category_id'].'">Sterge</a></td></tr>';
			}
		?>
	</table>
	<h3>Gramaje</h3>
		<form class="insert" method="get" action="dashboard.php">
		<input type="hidden" name="do" value="addgrj" />
		<input type="text" placeholder="Gramaj" name="nume"/>
		<input type="submit"/>
	</form>
	<table>
		<tr><td>Gramaj</td><td></td></tr>
		<?php 
			$results=mysql_query("SELECT * FROM weight");
			while($rez=mysql_fetch_array($results)){
				echo '<tr><td>'.$rez['cantitate'].'</td><td><a href="dashboard.php?do=delgrj&id='.$rez['w_id'].'">Sterge</a></td></tr>';
			}
		?>
	</table>
	<h3>Produse</h3>
		<form class="insert" method="get" action="dashboard.php">
		<input type="hidden" name="do" value="addprod" />
		<input type="text" placeholder="Nume produs" name="nume"/>
		<textarea name="desc"/>Descriere</textarea>
		<select name="cat">
			<option>Categorie</option>
			<?php 
			$results=mysql_query("SELECT * FROM categories");
			while($rez=mysql_fetch_array($results)){
				echo '<option value="'.$rez['category_id'].'">'.$rez['category_name'].'</option>';
			}
		?>
		</select>
		<input type="text" placeholder="Hashtags" name="hashtags"/>
		<?php 
			$results=mysql_query("SELECT * FROM weight");
			while($rez=mysql_fetch_array($results)){
				echo '<div><input type="checkbox" name="g'.$rez['w_id'].'" value="'.$rez['w_id'].'"/><span>'.$rez['cantitate'].'</span><input name="pret'.$rez['w_id'].'" type="text"/></div>';
			}
		?>
		<input type="submit"/>
	</form>
	<table>
		<tr><td>PID</td><td>Produs</td><td>Categorie</td><td>Gramaj</td><td>Pret</td><td>Hashtags</td><td></td><td></td></tr>
		<?php 
			$results=mysql_query("SELECT * FROM products");
			$pretcontor=1;
			while($rez=mysql_fetch_array($results)){
				$rez2=mysql_fetch_array(mysql_query("SELECT category_id FROM product_category WHERE product_id=".$rez['product_id']));
				$catid=$rez2['category_id'];
				@$rez2=mysql_fetch_array(mysql_query("SELECT category_name FROM categories WHERE category_id=".$catid));
				$categorie=$rez2['category_name'];
				$results3=mysql_query("SELECT w_id,price,piid FROM product_info WHERE prod_id=".$rez['product_id']);
				while($rez3=mysql_fetch_array($results3)){
					$gramajid=$rez3['w_id'];
					$pret=$rez3['price'];
					$rez2=mysql_fetch_array(mysql_query("SELECT cantitate FROM weight WHERE w_id=".$gramajid));
					$gramaj=$rez2['cantitate'];
					echo '<tr><td>'.$rez3['piid'].'</td><td>'.$rez['product_name'].'</td><td>'.$categorie.'</td><td>'.$gramaj.' L</td><td><input id="pretcontor'. $pretcontor .'" type="text" value="'.$pret.'"/> RON</td><td>'.$rez['hashtags'].'</td><td><a id="modificalink'.$pretcontor.'" onclick="update_pret(this,'.$pretcontor++.');" href="dashboard.php?do=modifpret&id='.$rez['product_id'].'&w_id='.$gramajid.'">Modifica pret</a></td><td><a href="dashboard.php?do=delprod&id='.$rez['product_id'].'&w_id='.$gramajid.'">Sterge</a></td></tr>';
				}
			}
		?>
	</table>
	<h2>Oferte</h2>
	<form action="dashboard.php">
		<input type="hidden" value="offer" name="do"/>
		<?php
			$result=(mysql_query("SELECT * FROM oferta"));
			$i=1;
			while($rez=mysql_fetch_array($result)){
				echo 'PID<input type="text" placeholder="PID" name="pid'.$i.'" value="'.$rez['piid'].'" />
					Procent<input type="text" placeholder="Procent" name="procent'.$i.'" value="'.$rez['procent'].'" /></br>';
				$i++;
			}
		?>
		<input type="submit" value="Set Offer"/>
	</form>
	<h3>Comenzi</h3>
	<table>
		<tr><td>Comanda ID</td><td>Nume utilizator</td><td>E-mail</td><td>Telefon</td><td>Produs</td><td>Data</td><td>Adresa</td></tr>
		<?php 
			$results=mysql_query("SELECT * FROM orders INNER JOIN users ON users.user_id=orders.user_id");
			//prod_id,price,w_id
			while($rez=mysql_fetch_array($results)){
				$produs="";
				$color='red';
				if($rez['complete']) 
					$color='green';
				$results4=mysql_query("SELECT piid,cantitate FROM produse_comandate WHERE oid=".$rez['order_id']);
				while($rez4=mysql_fetch_array($results4)){
					$results2=mysql_query("SELECT products.product_name,product_info.w_id FROM product_info INNER JOIN products ON products.product_id=product_info.prod_id AND piid=".$rez4['piid']);
					$rez2=mysql_fetch_array($results2);
					$produs=$produs.$rez2['product_name'];
					$results3=mysql_query("SELECT cantitate FROM weight WHERE w_id=".$rez2['w_id']);
					$rez3=mysql_fetch_array($results3);
					$produs=$produs.' '.$rez3['cantitate']. 'L '.$rez4['cantitate'].' BUC<br>';
				}
				echo '<tr style="color:'.$color.'"><td>'.$rez['order_id'].'</td><td>'.$rez['name'].'</td><td>'.$rez['email'].'</td><td>'.$rez['phone'].'</td><td>'.$produs.'</td><td>'.$rez['data'].'</td><td>'.$rez['adresa'].'</td><td><a href="dashboard.php?do=complete&id='.$rez['order_id'].'">Finalizare</a></td><td><div onclick="vezilocatie('.$rez['locatie'].')">Vezi locatie</div></td><td><a href="dashboard.php?do=delorder&id='.$rez['order_id'].'">Sterge</a></td></tr>';
			}
		?>
	</table>
	<a href="exportcsv.php">Make CSV</a>
	<div id="map-canvas">
	
	</div>
	
</body>
	<?php } ?>
</html>