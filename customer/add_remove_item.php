<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsCustomer');
	
	if($_GET['flag']==0){//Add item
		include_once('../lib/mysql.php');
		$sql = "SELECT ItemID,ItemName,HS_Price,Quantity FROM stock WHERE ItemID='" . $_GET['id'] . "'";
		$row = GetOneRowEx($sql);
		
		$_SESSION["'" . $_SESSION['ItemCount'] . "'"] = array($row['ItemID'],$row['ItemName'],$row["HS_Price"],$row["Quantity"]);		
		$_SESSION['ItemCount']++;
	}
	
	if($_GET['flag']==1){//Remove item
		for($x=0;$x<$_SESSION['ItemCount'];$x++){
			if($_SESSION["'" . $x . "'"][0]==$_GET['id']){
				$_SESSION["'" . $x . "'"][0] = -1;//Make it invalied
			}
		}
	}
	
	header('Location: cus_orders.php');
?>