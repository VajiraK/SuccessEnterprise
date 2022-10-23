
<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsCustomer');
	
	include_once('../lib/feeder.php');
	include_once('cus_helper.php');
	Head_Section("../");
?>

<body>
<div id='wrapper'>

	<?php 
		PageHeading("Success Enterprise");
		BackButton('< Back to orders','cus_orders.php'); 
	?>

	<div id='round_div'>
		<p id='order_det_title'><?php OrderDetailsTitle($_GET['code']);?></p>
		<?php OrderDetails('customers',$_GET['code']); ?>
	</div>
</div>
</body>
</html>