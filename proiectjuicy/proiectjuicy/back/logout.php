<?php
	setcookie("uid", $rez['id'], time()-3600, "/");
	setcookie("security", $randstring, time()-3600, "/");
	header('Location: http://localhost');
?>