<?php 
	include_once('generique/applications.php');
	session_unset();
	session_destroy();
	unset($openid, $_SESSION['id']);
	$_SESSION = array();
	header('Location: ' . BASE_URL . 'signin');
?>