<?php 
	include "back/connect.php";
	include "back/is_logged.php";
	$logged=is_logged_admin();
	if($logged==0){?>
		<script>window.location.replace("http://localhost/admin_login.php");</script>
	<?php
	}else{
		$results=mysql_query("SELECT order_id,user_id,data,adresa,complete,locatie FROM orders");
		$file = fopen("orders.csv","w");
		while($rez=mysql_fetch_array($results)){
				fputcsv($file,$rez);
		}
		fclose($file);
}
?>