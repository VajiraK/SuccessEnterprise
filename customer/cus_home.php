<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsCustomer');
	
	include_once('cus_helper.php');
	include_once('../lib/feeder.php');
	$_SESSION['pre_fix'] = '../';
	Head_Section();
?>
<body>

<script type="text/javascript">	
<?php
	include_once('../lib/js_feeder.php');
	JQ_DocReady_Start();
		NavigationBarJS();
	JQ_DocReady_End();
?>
</script>

<div id='wrapper'>
<?php
	PageHeading("Success Enterprise");
	NavigationBar("User");
?>

	<div id='round_div'>
		<p id='pannel_title'>Control Pannel</p>
		<?php
			$_SESSION['back_address'] = '../customer/cus_home.php';
			$_SESSION['back_title'] = '< ' . $_SESSION['user_name'];
			BeginCentCon(450);
				PutControlPanelItem('Profile','user.png','../user/profile.php','');
				PutControlPanelItem('Buy','shopping_cart.png','cus_orders.php','');
			EndCentCon();
		?>
	</div>
	<?php Footer();?>
	</div><!--Wrapper DIV -->
</body>
</html>