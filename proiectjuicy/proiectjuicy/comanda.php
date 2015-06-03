<?php 
	include "back/connect.php";
	include "back/is_logged.php";
	$logged=is_logged();
	if($logged==0){
		header('Location: http://localhost/login.php');
	}else{
		if(isset($_COOKIE['id']) && isset($_COOKIE['cantitate']) && isset($_GET['adresa']) && isset($_GET['coordonate']) && isset($_COOKIE['uid'])){
			mysql_query("INSERT INTO orders (user_id,adresa,locatie) VALUES (".$_COOKIE['uid'].",'".$_GET['adresa']."','".$_GET['coordonate']."')");
			$oid=mysql_insert_id();
			$piids = $_COOKIE['id'];
			$piid = strtok($piids, ",");
			$i=0;
			while ($piid !== false) {
				$piidarray[$i++]=$piid;
				$piid = strtok(",");
			}
			$i=0;
			$cants = $_COOKIE['cantitate'];
			$cant = strtok($cants, ",");
			while ($cant !== false) {
				$cantarray[$i++]=$cant;
				$cant = strtok(",");
			}
			for($j=0;$j<$i;$j++){
				mysql_query("INSERT INTO produse_comandate (piid,oid,cantitate) VALUES (".$piidarray[$j].",".$oid.",".$cantarray[$j].")");
			}
			setcookie("id", "", time()-3600);
			setcookie("cantitate", "", time()-3600);
			setcookie("pret", "", time()-3600);
			setcookie("produs", "", time()-3600);
			$hashnou=[];
			for($j=0;$j<$i;$j++){
				$results=mysql_query("SELECT hashtags FROM products,(SELECT prod_id FROM product_info WHERE piid=".$piidarray[$j].") AS a
							WHERE products.product_id=a.prod_id");
				$rez=mysql_fetch_array($results);
				$hasharray = explode(",", $rez['hashtags']);
				foreach($hasharray as $value){
					if(!in_array($value, $hashnou))
						array_push($hashnou,$value);
				}
			}
			$hashtags = implode(",", $hashnou);
			mysql_query("UPDATE users SET hashtags='".$hashtags."' WHERE user_id=".$_COOKIE['uid']);
		}
		header('Location: http://localhost');
	}
?>