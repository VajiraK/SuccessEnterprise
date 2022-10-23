<?php
function DisplaySales($styleid)
{
try{
	include_once('../lib/mysql.php');
	$sql = "SELECT COUNT(OrderID) FROM orders WHERE ReleaseDate!='NULL'";
	$con = OpenConnection();
	if(!IsRecordExist($sql,'OrderID',$con)){
		echo "<p id='cur_order_para'>There are no sales to display</p>";
		return;
	}

	$sql = "SELECT * FROM orders WHERE ReleaseDate!='NULL'";
	$result = ExecuteSQL($sql);
	$b = false;
	$n = 1;
	
	TabelHeader($styleid,array('#','Code','User Name','Ordered Date','Released Date','Details'));

	while($row = mysql_fetch_array($result)){
		ZeebraStripes($b,$n,'alt');
		echo "<td>" . $row['OrderID'] . "</td><td>" . 
			$row['UserName'] . "</td><td>" . 
			FormatDate($row["OrderDate"]) . "</td><td>" . 
			FormatDate($row["ReleaseDate"]) . "</td>";
		echo "<td align='center'><a href='sales_details.php?code=" . $row['OrderID'] . "&user=" . $row['UserName'] . "'>Details</a></td></tr>";
	}
	mysql_close($con);
	echo "</table>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}  
/* -------------------------------------------------------------------------------------- */
function SalesDetailsTitle($oid){
	include_once('../lib/mysql.php');
	include_once('../lib/helper.php');
	$row = GetOneRowEx("SELECT * FROM orders WHERE OrderID='$oid'");
	echo "Order : $oid | Ordered Date : " . FormatDate($row['OrderDate']) . " | Released Date : " . $row['ReleaseDate'] . " | placed by : " . $_GET['user'];
}
/* -------------------------------------------------------------------------------------- */
function SalesDetails($styleid,$oid){
try{
	include_once('../lib/feeder.php');
	include_once('../lib/mysql.php');
	$sql = "SELECT * FROM sales WHERE OrderID='$oid'";
	$con = OpenConnection();
	$result = ExecuteSQL($sql);
	$b = false;
	$n = 1;
	$net_profit = 0;

	echo "<form id='form1' name='form1' method='post' action='sales_details.php?code=$oid'>";
	TabelHeader($styleid,array('#','Code','Item Name','Ordered Quantity','Released Quantity','Remaining Quantity','Profit'));
	
	while($sale = mysql_fetch_array($result))
	{
		ZeebraStripes($b,$n,'alt');
		$stock = GetOneRowWithCon($con,"SELECT ItemName,Quantity FROM stock WHERE ItemID='" . $sale['ItemCode'] . "'");
		echo "<td>" . $sale['ItemCode'] . "</td><td>" . 
			$stock['ItemName'] . "</td><td>" . 
			$sale["OrderedQuantity"] . "</td><td>" .
			$sale["ReleasedQuantity"] . "</td><td>" . 
			$stock["Quantity"] . "</td><td>" . 
			$sale["Profit"] . "</td></tr>";
			$net_profit = $net_profit + $sale["Profit"];
	}
	
	echo "<tr>
			<td align='right' colspan=6>Net Profit</dt>
			<td>$net_profit</dt>
		</table>
		</form>";

	mysql_close($con);
	echo "</table>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}
?>