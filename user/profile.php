<?php 
	session_start();
	include_once('../lib/helper.php');
	
	if(isset($_GET['user'])&&($_SESSION['user_type']=='Administrator')){
		$_SESSION['manage'] = $_GET['user'];
	}elseif($_SESSION['user_type']!='Administrator'){
		Authenticate('IsLogin');
		$_SESSION['manage'] = $_SESSION['user_name'];
	}
	//*********** DELETE *************************************
	include_once('../lib/mysql.php');
	if((isset($_GET['flag']))&&($_GET['flag']=='delete_user')){
		Delete("DELETE FROM users WHERE user_name='" . $_SESSION['manage'] . "'");
		header("Location: ../lib/sign_out.php");
	}
	//*********** DELETE *************************************
	include_once('../lib/feeder.php');
	$_SESSION['pre_fix'] = '../';
	Head_Section();
?>
<body>
<?php echo "<input id='hidden_text' type='text' style='display: none;' value='" . $_SESSION['manage'] . "'/>";?> 
	<script type='text/javascript'>
	<?php
		include_once('../lib/js_feeder.php');
		JQ_DocReady_Start();
			DeleteConfirmation('#user_del');
		JQ_DocReady_End();
	?>
	</script>
<div id='wrapper'>
<?php
	PageHeading("Success Enterprise");
	BackButton($_SESSION['back_title'],$_SESSION['back_address']); 
?>

	<div id='round_div'>
		<p id='pannel_title'>Profile of <?php echo $_SESSION['manage']?></p>
		<?php
			include_once('profile_helper.php');
			if(GetUserType($_SESSION['manage'])=='Customer'){
				BeginCentCon(670);
				PutControlPanelItem('Delete Account','delete_ac.png','../user/profile.php?flag=delete_user','user_del');
			}else
				BeginCentCon(450);
				
					PutControlPanelItem('Edit Profile','edit_profile.png','../user/edit_profile.php','');
					PutControlPanelItem('Change Password','change_pass.png','../user/change_password.php','');
			EndCentCon();
		?>
	</div>
	<?php Footer();?>
	</div><!--Wrapper DIV -->
</body>
</html>