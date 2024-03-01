<?php
if(!isset($_SESSION['uid'])){
	header("Location: index.php");
}
if(isset($_POST['logout'])){
	session_start();
	session_destroy();
	header("Location: index.php");
}
?>