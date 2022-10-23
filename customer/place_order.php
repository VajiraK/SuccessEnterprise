<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsCustomer');
	
	$oid = GetOrderID();

	include_once('../lib/mysql.php');
	$tm = time();
	$con = OpenConnection();
	$sql = "INSERT INTO orders (OrderID, UserName,OrderStatus,OrderDate)VALUES 
								('$oid','" . $_SESSION['user_name'] . "', 'Pending','$tm')";
	InsertWithCon($sql);
	
	$code = "";
	$txt = "";
	for($x=0;$x<$_SESSION['ItemCount'];$x++){
		$code =  $_SESSION["'" . $x . "'"][0];
		if($code!=-1)
		{//Not a removed item
			$txt = "txt" . $code;
			$sql = "INSERT INTO order_details (OrderID, ItemCode,Quantity)VALUES ('$oid','$code','$_POST[$txt]')";
			InsertWithCon($sql);
		}
		//Remove this item
		$_SESSION["'" . $x . "'"] = array();
	}
	
	mysql_close($con);
	//Clear current order
	$_SESSION['ItemCount'] = 0;
	header('Location: cus_orders.php');
?>