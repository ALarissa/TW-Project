<?php
	$con=mysql_connect('localhost','root','');
	if(!$con)
	{
		die('Nu s-a putut conecta: '.mysql_error());
	}
	mysql_select_db("juicydb",$con);
	mysql_query("SET NAMES utf8");  
?>