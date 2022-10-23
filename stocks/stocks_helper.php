<?php
function DisplayStock($styleid)
{
try{
	include_once('../lib/mysql.php');
	$con = OpenConnection();
	$sql = "SELECT * FROM stock";
	$result = ExecuteSQL($sql);
	$b = false;
	$n = 1;
	
	echo "<form id='form1' name='form1' method='post' action='add_edit_item.php'>";
	TabelHeader($styleid,array('#','Code','Name','HS_Price','RT_Price','Quantity','Edit'));

	while($row = mysql_fetch_array($result))
	{
		ZeebraStripes($b,$n,'alt');
		
		echo "<td>" . $row['ItemID'] . "</td><td>" . 
			$row['ItemName'] . "</td><td>" . 
			$row["HS_Price"] . "</td><td>" . 
			$row["RT_Price"] . "</td><td>" . 
			$row["Quantity"] . "</td>";
		echo "<td align='center'><a href='add_edit_item.php?id=" . $row['ItemID'] . "'>Edit</a></td></tr>";
	}
	mysql_close($con);
	echo "<tr><td align='right' colspan=7><input type='submit' name='btnAdd' value='Add'/></td></tr></table></form>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}  
/* -------------------------------------------------------------------------------------- */
function GetStockItem($code){
try{
	include_once('../lib/mysql.php');
	$sql = "SELECT * FROM stock WHERE ItemID='$code'";
	return GetOneRowEx($sql);
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}
?>