
<?php 
/* -------------------------------------------------------------------------------------- */
function OrderDetailsTitle($oid)
{
	include_once('../lib/mysql.php');
	include_once('../lib/helper.php');
	$row = GetOneRowEx("SELECT * FROM orders WHERE OrderID='$oid'");
	echo "Order : $oid | Date : " . FormatDate($row['OrderDate']) . " | Status : " . $row['OrderStatus'] . " | placed by : " . $_GET['user'];
}
/* -------------------------------------------------------------------------------------- */
function OrderDetails($styleid,$oid)
{
try{
	include_once('../lib/feeder.php');
	include_once('../lib/mysql.php');
	$sql = "SELECT * FROM order_details WHERE OrderID='$oid'";
	$con = OpenConnection();
	$result = ExecuteSQL($sql);
	$b = false;
	$n = 1;

	echo "<form id='form1' name='form1' method='post' action='order_details.php?code=$oid'>";
	TabelHeader($styleid,array('#','Code','Item Name','Price','Available Quantity','Ordered Quantity'));
	
	while($row = mysql_fetch_array($result))
	{
		ZeebraStripes($b,$n,'alt');
		$item = GetOneRowWithCon($con,"SELECT * FROM stock WHERE ItemID='" . $row['ItemCode'] . "'");
		echo "<td>" . $item['ItemID'] . "</td><td>" . 
			$item['ItemName'] . "</td><td>" . 
			$item["RT_Price"] . "</td><td>" .
			$item["Quantity"] . "</td><td>" . 
			$row["Quantity"] . "</td></tr>";
	}
	
	echo "<tr><td align='right' colspan=6><input type='submit' name='btnRelease' 
			value='Release'/></td></tr></table></form>";

	mysql_close($con);
	echo "</table>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}
/* -------------------------------------------------------------------------------------- */
function PendingOrders($styleid)
{
try{
	include_once('../lib/feeder.php');
	include_once('../lib/mysql.php');
	
	$sql = "SELECT COUNT(OrderID) FROM orders WHERE OrderStatus='Pending'";
	$con = OpenConnection();
	if(!IsRecordExist($sql,'OrderID',$con)){
		echo "<p id='cur_order_para'>There are no pending orders</p>";
		return;
	}
	
	$sql = "SELECT * FROM orders WHERE OrderStatus='Pending'";
	$result = ExecuteSQL($sql);
	$b = false;
	$n = 1;

	TabelHeader($styleid,array('#','Order ID','User Name','OrderDate','Ordere Details'));

	while($row = mysql_fetch_array($result))
	{
		ZeebraStripes($b,$n,'alt');
		echo "<td>" . $row['OrderID'] . "</td><td>" . 
			$row['UserName'] . "</td><td>" . 
			FormatDate($row["OrderDate"]) . "</td><td align='center'>" . 
			"<a href='order_details.php?code=" . $row['OrderID'] . "&user=" . $row['UserName'] . "'>Details</a></td></tr>";
	}

	mysql_close($con);
	echo "</table>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}
/* -------------------------------------------------------------------------------------- */
function StockRelease($styleid,$oid)
{
try{
	include_once('../lib/feeder.php');
	include_once('../lib/mysql.php');
	//Reduce quantity
	
	$sql = "SELECT * FROM order_details WHERE OrderID='$oid'";
	$con = OpenConnection();
	$result = ExecuteSQL($sql);
	$i = 0;
	$released;
	
	while($order = mysql_fetch_array($result))
	{
		$stock = GetOneRowWithCon($con,"SELECT * FROM stock WHERE ItemID='" . $order['ItemCode'] . "'");
		$released[$i]['ItemID'] = $stock['ItemID'];
		$released[$i]['ItemName'] = $stock['ItemName'];
		$released[$i]['Orderes_Quantity'] = $order["Quantity"];
		$released[$i]['Rem_Quantity'] = 0;
		
		//Quantity ******************
		if($stock["Quantity"]==0){
			$released[$i]['Quantity'] = 0;
		}elseif($stock["Quantity"]>=$order["Quantity"]){
			$released[$i]['Quantity'] = $order["Quantity"];
			$released[$i]['Rem_Quantity'] = $stock["Quantity"] - $order["Quantity"];
		}else{
			$released[$i]['Quantity'] = $stock["Quantity"];
		}
		//Quantity ******************
		$released[$i]['Profit'] = ($stock['RT_Price'] - $stock['HS_Price']) * $released[$i]['Quantity'];
		$i++;
	}

	//Mark as released
	$tm = time();
	$sql = "UPDATE orders SET OrderStatus='Released', ReleaseDate='$tm' WHERE OrderID='$oid'";
	UpdateWithCon($sql);
	
	//Display  results
	$b = false;
	$n = 1;
	
	//$row = GetOneRowEx("SELECT * FROM orders WHERE OrderID='$oid'");
	//echo "Order : $oid | Released | placed by : " . $_GET['user'];

	TabelHeader($styleid,array('#','Code','Item Name','Ordered Quantity','Released Quantity','Remaining Stock','Profit'));
	for($x=0;$x<$i;$x++){
		ZeebraStripes($b,$n,'alt');
		
		echo "<td>" . $released[$x]['ItemID'] . "</td><td>" . 
			$released[$x]['ItemName'] . "</td><td>" . 
			$released[$x]['Orderes_Quantity'] . "</td><td>" .
			$released[$x]['Quantity'] . "</td><td>" .
			$released[$x]['Rem_Quantity'] . "</td><td>" . 
			$released[$x]['Profit'] . "</td></tr>";
		//Insert to sales
		$sql = "INSERT INTO sales (OrderID, ItemCode, OrderedQuantity,ReleasedQuantity, Profit)VALUES 
								('$oid','" . $released[$x]['ItemID'] . "','" . 
								$released[$x]['Orderes_Quantity']  . "','" .
								$released[$x]['Quantity']  . "','" .
								$released[$x]['Profit'] . "')";
		InsertWithCon($sql);
		//Update stock
		$sql = "UPDATE stock SET Quantity = '" . $released[$x]['Rem_Quantity'] . 
				"' WHERE ItemID='" . $released[$x]['ItemID'] . "'";
		UpdateWithCon($sql);
	}
	
	mysql_close($con);
	echo "</table>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}
?>