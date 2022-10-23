<?php 
function GetUserType($username){
	include_once('../lib/mysql.php');
	$sql = "SELECT user_type FROM users WHERE user_name='$username'";
	$row = GetOneRowEx($sql);
	return $row['user_type'];
}
/* -------------------------------------------------------------------------------------- */
function GetUserDetails($user){
	include_once('../lib/mysql.php');
	$sql = "SELECT name,email,contact,address FROM users WHERE user_name='$user'";
	return GetOneRowEx($sql);
}
?>