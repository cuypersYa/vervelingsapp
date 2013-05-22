<?php 
	session_start();
	session_destroy();
	//setcookie("login", "", time()-60*60*24);
	header("Location: index.php");

 ?>