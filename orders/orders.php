
<?php 
	session_start();
	include_once('../lib/feeder.php');
	include_once('../lib/helper.php');
	Authenticate('IsAdminOrSalesAgent');//Admin or Sales
	$_SESSION['pre_fix'] = '../';
	Head_Section();
?>

<body>
<div id='wrapper'>

	<?php 
		PageHeading("Success Enterprise");
		if($_SESSION['user_type']=='Administrator')
			BackButton('< Back','../admin/adm_home.php');
		else
			BackButton('< Back','../sales_agent/sales_agent_home.php');
	?>

	<div id='round_div'>
		<p id='order_det_title'>Pending Orders</p>
		<?php 
			include_once('orders_helper.php');
			PendingOrders('customers'); 
		?>
	</div>
</div>
</body>
</html>