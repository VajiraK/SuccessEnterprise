<?php
function IsRecordExist($sql,$field,$con){
	$row = mysql_fetch_array(ExecuteSQL($sql));
	if($row['COUNT(OrderID)']==0)
		return false;
	else
		return true;
}
/* -------------------------------------------------------------------------------------- */
function IsNewItem($file,&$new){
	$new = substr($file,0,4)=="new-";
	$temp = substr($file,0,-4);
	
	if($new)
		$temp = substr($temp,4,strlen($temp)-4);
	
	return $temp;
}
/* -------------------------------------------------------------------------------------- */
function LogIn($username,$password){
	include_once('mysql.php');
	//Get data from users table
	$sql = "SELECT salted_hash,salt,user_type FROM users WHERE user_name='" . $username . "'";
	$row = GetOneRowEx($sql);

	$shash = hash('sha256', $password . $row['salt']); 
	
	if($shash==$row['salted_hash'])
		return $row['user_type'];
	else	
		return false;
}
/* -------------------------------------------------------------------------------------- */
function FormatDate($date){
	return substr(date('r',$date), 0, 25);
}
/* -------------------------------------------------------------------------------------- */
function Authenticate($type){
	if($type=='IsCustomer'){
		if($_SESSION['user_type']=='Customer')
			return;
	}elseif($type=='IsAdmin'){
		if($_SESSION['user_type']=='Administrator')
			return;
	}elseif($type=='IsSalesAgent'){
		if($_SESSION['user_type']=='SalesAgent')
			return;
	}elseif($type=='IsAdminOrSalesAgent'){
		if(($_SESSION['user_type']=='SalesAgent')||($_SESSION['user_type']=='Administrator'))
			return;
	}elseif($type=='IsLogin'){
		if(isset($_SESSION['user_type']))
			return;
	}
		
	header('Location: ../lib/sign_out.php');
}
/* -------------------------------------------------------------------------------------- */
function Randomize(){
	$seed = floor(time());
	srand($seed);
}
/* -------------------------------------------------------------------------------------- */
function GetOrderID()
{
	Randomize();
	$id = "OR-";
	for($x=0;$x<3;$x++)
		$id  .= chr(rand(65,90));
	return $id;
}
/* -------------------------------------------------------------------------------------- */
function GetItemID()
{
	Randomize();
	$id = "ST-";
	for($x=0;$x<3;$x++)
		$id  .= chr(rand(65,90));
	return $id;
}
/* -------------------------------------------------------------------------------------- */
function GetSalt()
{
	Randomize();
	$salt = "";
	for($x=0;$x<5;$x++)
		$salt  .= chr(rand(65,90));
	return $salt;
}
/* -------------------------------------------------------------------------------------- */
?>