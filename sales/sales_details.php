<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsAdmin');
	
	$_SESSION['pre_fix'] = "../";//Path pre_fix
	include_once('../lib/feeder.php');
	Head_Section();
?>

<body>
<div id='wrapper'>

<?php
	PageHeading("Success Enterprise");
	BackButton('< Back to Sales','../sales/sales_home.php');
?>

	<div id='round_div'>
	<?php
		include_once('sales_helper.php');
			echo "<p id='order_det_title'>";
			SalesDetailsTitle($_GET['code']);
			echo "</p>";
			SalesDetails('customers',$_GET['code']);
	?>
	</div>
	<?php Footer();?>
</div><!--Wrapper DIV -->		
</body>
<html>