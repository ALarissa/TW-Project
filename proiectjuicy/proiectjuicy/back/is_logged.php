<?php
	function is_logged(){
		if(isset($_COOKIE["uid"]) && isset($_COOKIE["security"])){
			$uid = $_COOKIE["uid"];
			$security = $_COOKIE["security"];
		}else{
			return 0;
		}
		$id = filter_var($id, FILTER_SANITIZE_STRING);
		$security = filter_var($security, FILTER_SANITIZE_STRING);
		$result=mysql_query("SELECT * FROM users WHERE user_id=".$uid." AND security='".$security."'");
		if($rez=mysql_fetch_array($result))
			return 1;
		return 0;
	}	function is_logged_admin(){		if(isset($_COOKIE["uid"]) && isset($_COOKIE["security"])){			$uid = $_COOKIE["uid"];			$security = $_COOKIE["security"];		}else{			return 0;		}		$id = filter_var($id, FILTER_SANITIZE_STRING);		$security = filter_var($security, FILTER_SANITIZE_STRING);		$result=mysql_query("SELECT * FROM admin WHERE user_id=".$uid." AND security='".$security."'");		if($rez=mysql_fetch_array($result))			return 1;		return 0;	}
?>