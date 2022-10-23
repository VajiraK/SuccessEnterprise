
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
		BackButton("< " . $_SESSION['user_name'],'../admin/adm_home.php');
	?>

	<div id='round_div'>
		<p id='order_det_title'>Users Feedbacks</p>
		<?php 
			include_once('adm_helper.php');
			GetAllFeedbacks('customers'); 
		?>
	</div>
</div>
</body>
</html>