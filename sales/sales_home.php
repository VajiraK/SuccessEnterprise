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
	BackButton('< Admin','../admin/adm_home.php');
?>

	<div id='round_div'>
	<p id='order_det_title'>Sales</p>
	<?php
		include_once('sales_helper.php');
		DisplaySales('customers');
	?>
	</div>
	<?php Footer();?>
</div><!--Wrapper DIV -->		
</body>
<html>