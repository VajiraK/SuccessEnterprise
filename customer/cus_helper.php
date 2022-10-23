<?php
function IsItemAdded($code){
	if(!isset($_SESSION['ItemCount']))
		return false;//No order created
		
	for($x=0;$x<$_SESSION['ItemCount'];$x++){
		if($_SESSION["'" . $x . "'"][0]==$code)
			return true;
	}
	return false;
}
/* -------------------------------------------------------------------------------------- */
function OrderDetailsTitle($oid){
	include_once('../lib/mysql.php');
	include_once('../lib/helper.php');
	$row = GetOneRowEx("SELECT * FROM orders WHERE OrderID='$oid'");
	echo "Order : $oid | Date : " . FormatDate($row['OrderDate']) . " | Status : " . $row['OrderStatus'] . " | placed by : " . $_SESSION['user_name'];
}
/* -------------------------------------------------------------------------------------- */
function OrderDetails($styleid,$oid){
try{
	include_once('../lib/feeder.php');
	include_once('../lib/mysql.php');
	$sql = "SELECT * FROM order_details WHERE OrderID='$oid'";
	$con = OpenConnection();
	$result = ExecuteSQL($sql);
	$b = false;
	$n = 1;

	TabelHeader($styleid,array('#','Code','Item Name','Unit Price(Rs)','Available Quantity','Ordered Quantity'));
	
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
		
	mysql_close($con);
	echo "</table>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}
/* -------------------------------------------------------------------------------------- */
function CurrentOrder($styleid){
	for($x=0;$x<$_SESSION['ItemCount'];$x++){
		if($_SESSION["'" . $x . "'"][0]!=-1)
			goto has_items;
	}
	
	echo "<p id='cur_order_para'>There are no items in your current order. Click buy to add items</p>";
	return;
	
has_items:
	Form_Head('frmCurrentOrder','post','place_order.php','return ValidateMyForm();');
	TabelHeader($styleid,array('#','Code','Item Name','Unit Price(Rs)','Available Quantity','Quantity'));

	$b = false;
	$n = 1;
	for($x=0;$x<$_SESSION['ItemCount'];$x++){
		$code = $_SESSION["'" . $x . "'"][0];
		
		if($code==-1) continue;//Removed item
		ZeebraStripes($b,$n,'alt');
		for($y=0;$y<4;$y++){
			echo "<td>" . $_SESSION["'" . $x . "'"][$y] . "</td>";
			if($y==3){
				echo "<td align='center'>
					<div id='order_quantity_div'>
						<input type='text' name ='txt$code' value='1'/>
						<a href='add_remove_item.php?flag=1&id=$code'>
							<img src='../img/delete.png' title='Remove item $code'/>
						</a>
					</div>
					</td>";
			}
		}
		echo "</tr>";
	}

	echo "<tr><td colspan=6 	 align='right'><input type='submit' name='btnPlaceOrder' value='Place order'/></td></tr></table>";
	echo "</form>";
}
/* -------------------------------------------------------------------------------------- */
function OrderHistory($styleid){
try{
	include_once('../lib/mysql.php');
	
	$sql = "SELECT COUNT(OrderID) FROM orders WHERE UserName='" .  $_SESSION['user_name'] . "'";
	$con = OpenConnection();
	if(!IsRecordExist($sql,'OrderID',$con)){
		echo "<p id='cur_order_para'>There are no previous orders</p>";
		return;
	}
	
	$sql = "SELECT * FROM orders WHERE UserName='" .  $_SESSION['user_name'] . "' ORDER BY 'OrderDate' ASC";
	$result = ExecuteSQL($sql);
	
	$b = false;
	$n = 1;
	
	TabelHeader($styleid,array('#','Code','Date','Status','Details'));
	
	while($row = mysql_fetch_array($result))
	{
		ZeebraStripes($b,$n,'alt');
			
		echo "<td>" . $row['OrderID'] . "</td><td>" . 
			substr(date('r',$row['OrderDate']), 0, 25) . "</td><td>" . 
			$row["OrderStatus"] . "</td><td align='center'><a href='order_details.php?code=" . $row['OrderID'] . "'>view</a></td></tr>";
	}
	mysql_close($con);
	
	echo "</table>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}
/* -------------------------------------------------------------------------------------- */
function DisplayStock($styleid){
try{
	include_once('../lib/mysql.php');
	$con = OpenConnection();
	$sql = "SELECT * FROM stock";
	$result = ExecuteSQL($sql);
	$b = false;
	$n = 1;
	
	TabelHeader($styleid,array('#','Code','Item Name','Unit Price(Rs)','Available Quantity','Order'));

	while($row = mysql_fetch_array($result))
	{
		ZeebraStripes($b,$n,'alt');
		
		echo "<td>" . $row['ItemID'] . "</td><td>" . 
			$row['ItemName'] . "</td><td>" . 
			$row["RT_Price"] . "</td><td>" . 
			$row["Quantity"] . "</td>";
			
		if(IsItemAdded($row['ItemID']))
			echo "<td align='center'><img src='../img/tick.png'/></td></tr>";
		else
			echo "<td align='center'><a href='add_remove_item.php?flag=0&id=" . $row['ItemID'] . "'>buy</a></td></tr>";
	}
	mysql_close($con);
	echo "</table>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}  
?>