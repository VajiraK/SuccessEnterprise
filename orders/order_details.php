
<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsAdminOrSalesAgent');//Admin or Sales
	include_once('../lib/feeder.php');
	include_once('orders_helper.php');
	$_SESSION['pre_fix'] = '../';
	Head_Section();
?>

<body>
<div id='wrapper'>

	<?php 
		PageHeading("Success Enterprise");
		BackButton('< Back to Orders','orders.php');
	?>

	<div id='round_div'>
	<?php
		if(!isset($_POST['btnRelease'])){
			echo "<p id='order_det_title'>";
			OrderDetailsTitle($_GET['code']);
			echo "</p>";
			OrderDetails('customers',$_GET['code']);
		}else{
			StockRelease('customers',$_GET['code']);
		}
	?>
	</div>
	<?php Footer();?>
</div>
</body>
</html>