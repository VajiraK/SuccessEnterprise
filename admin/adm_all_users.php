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
	BackButton('< Admin','adm_home.php'); 
?>
	<div id='round_div'>
	<p id='pannel_title'>All users</p>
	<?php 
		include_once('adm_helper.php');
		$_SESSION['back_address'] = '../admin/adm_all_users.php';
		$_SESSION['back_title'] = '< All users';
		GetAllUsers('customers');
	?>
	</div>
	
	<?php Footer();?>
</div><!--Wrapper DIV -->		
</body>
<html>