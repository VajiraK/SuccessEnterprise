<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsSalesAgent');
	$_SESSION['pre_fix'] = "../";//Path pre_fix
	include_once('../lib/feeder.php');
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
			$_SESSION['back_address'] = '../sales_agent/sales_agent_home.php';
			$_SESSION['back_title'] = '< ' . $_SESSION['user_name'];
			BeginCentCon(670);
				PutControlPanelItem('Stocks','graph.png','../stocks/stocks.php','');
				PutControlPanelItem('Pending orders','pending.jpg','../orders/orders.php','');
				PutControlPanelItem('Profile','user.png','../user/profile.php','');
			EndCentCon();
			?>
		</div>
		<?php Footer();?>
</div><!--Wrapper DIV -->		
</body>
<html>