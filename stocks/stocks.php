<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsAdminOrSalesAgent');
	
	include_once('../lib/feeder.php');
	include_once('stocks_helper.php');
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
		<p id='pannel_title'>Stocks</p>
		<?php DisplayStock('customers');?>
	</div>
	<?php Footer();?>
	</div><!--Wrapper DIV -->
</body>
</html>