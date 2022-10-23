<?php 
/* -------------------------------------------------------------------------------------- */
function GetFeedback($date)
{
	include_once('../lib/mysql.php');
	$sql = "SELECT * FROM feedbacks WHERE Date='$date'";
	return GetOneRowEx($sql);
}
/* -------------------------------------------------------------------------------------- */
function GetAllFeedbacks($styleid){
try{
	include_once('../lib/feeder.php');
	include_once('../lib/mysql.php');
	
	$con = OpenConnection();
	$sql = "SELECT * FROM feedbacks";
	$result = ExecuteSQL($sql);

	$b = false;
	$n = 1;

	TabelHeader($styleid,array('#','Name','Email','Contact','Date','Message','Details'));
	
	while($row = mysql_fetch_array($result))
	{
		ZeebraStripes($b,$n,'alt');
		echo "<td>" . $row['Name'] . "</td><td>" . 
			$row["Email"] . "</td><td>" .
			$row["Contact"] . "</td><td>" .
			FormatDate($row["Date"]) . "</td><td>" .
			substr($row["Message"], 0, 20) . "...</td>
			<td align='center'><a href='feedback_details.php?date=" . $row['Date'] . "'>view</a></td></tr>";
	}
	mysql_close($con);
	echo "</table>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}
/* -------------------------------------------------------------------------------------- */
function GetAllUsers($styleid){
try{
	include_once('../lib/feeder.php');
	include_once('../lib/mysql.php');
	
	$con = OpenConnection();
	$sql = "SELECT * FROM users";
	$result = ExecuteSQL($sql);

	$b = false;
	$n = 1;

	TabelHeader($styleid,array('#','User Name','User Type','Manage User'));
	
	while($row = mysql_fetch_array($result))
	{
		ZeebraStripes($b,$n,'alt');
		echo "<td>" . $row['user_name'] . "</td><td>" . 
			$row["user_type"] . "</td>
			<td align='center'><a href='../user/profile.php?user=" . $row['user_name'] . "'>profile</a></td></tr>";
	}
	mysql_close($con);
	echo "</table>";
}catch(Exception $e){mysql_close($con);SQLErrorPage();}
}
/* -------------------------------------------------------------------------------------- */
?>
