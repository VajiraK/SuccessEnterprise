<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsCustomer');
	include_once('cus_helper.php');
	include_once('../lib/feeder.php');
	$_SESSION['pre_fix'] = '../';
	if(!isset($_SESSION['ItemCount']))
		$_SESSION['ItemCount'] = 0;
	Head_Section();
?>
<body>

<script type="text/javascript">	
<?php
	include_once('../lib/js_feeder.php');
	ValidateForm('frmCurrentOrder');
?>
</script>

<div id='wrapper'>
<?php
	PageHeading("Success Enterprise");
	BackButton('< Back','cus_home.php'); 
?>

	<div id='round_div'>
		<p id='pannel_title'>Your previous orders</p>
		<?php OrderHistory('customers');?>
	</div>
	
	<div id='round_div'>
		<p id='pannel_title'>Items in your current order</p>
		<?php CurrentOrder('customers');?>
	</div>
	
	<div id='round_div'>
		<p id='pannel_title'>Available Items</p>
		<?php DisplayStock('customers');?>
	</div>
	<?php Footer();?>
	</div><!--Wrapper DIV -->
</body>
</html>