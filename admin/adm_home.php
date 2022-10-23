<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsAdmin');
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
			<p id='pannel_title' >Control Pannel</p>
			<?php
			BeginCentCon(670);
				PutControlPanelItem('All Users','user.png','adm_all_users.php','');
				PutControlPanelItem('Stocks','graph.png','../stocks/stocks.php','');
				PutControlPanelItem('Sales','salse.png','../sales/sales_home.php','');
			EndCentCon();
			BeginCentCon(450);
				PutControlPanelItem('Pending orders','pending.jpg','../orders/orders.php','');
				PutControlPanelItem('Feedbacks','feedback.png','feedbacks.php','');
			EndCentCon();
			?>
		</div>
		<?php Footer();?>
</div><!--Wrapper DIV -->		
</body>
<html>