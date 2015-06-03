<?php
	include "connect.php";
	$user = $_POST["user"];
	$email = $_POST["email"];
	$pass = $_POST["pass"];
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$user= filter_var($user, FILTER_SANITIZE_STRING);
	$pass = filter_var($pass, FILTER_SANITIZE_STRING);
	$result=mysql_query("SELECT * FROM users WHERE email='".$email."'");
	if($rez=mysql_fetch_array($result)){
		echo "E-mail already exists.";
	}else{
		$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$randstring = '';
		for ($i = 0; $i < 50; $i++) {
			$randstring .= $characters[rand(0, strlen($characters))];
		}
		mysql_query("INSERT INTO users (email,password,name,security) VALUES ('".$email."','".$pass."','".$user."','".$randstring."')");
		$rez=mysql_fetch_array(mysql_query("SELECT user_id FROM users WHERE email='".$email."'"));		header('Location: http://localhost');
	}
	
?>