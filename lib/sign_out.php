<?php
	// Unset all of the session variables.
	session_start();
	$_SESSION = array();
	unset($_SESSION['user_type']);
	session_destroy();
	header('Location: ../index.php');
?>