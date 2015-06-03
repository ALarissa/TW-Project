<?php
	include "connect.php";	
	$email = $_POST["email"]; 
	$pass = $_POST["pass"];
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$pass = filter_var($pass, FILTER_SANITIZE_STRING);
	$result=mysql_query('SELECT * FROM users WHERE email="'.$email.'" AND password="'.$pass.'"');
	if($rez=mysql_fetch_array($result)){
		$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$randstring = '';
		for ($i = 0; $i < 50; $i++) {
			$randstring .= $characters[rand(0, strlen($characters))];
		}
		setcookie("uid", $rez['user_id'], time()+3600, "/");
		setcookie("security", $randstring, time()+3600, "/");
		mysql_query("UPDATE users SET security='".$randstring."' WHERE user_id=".$rez['id']);
		header('Location: http://localhost');
	}else{
		echo "Wrong username or password.";
	}
?>