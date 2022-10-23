<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsLogin');
	$user = $_SESSION['manage'];
	
	if(isset($_POST['btnChange'])){
		include_once('../lib/mysql.php');
		$ret = LogIn($_SESSION['user_name'],$_POST['txtOldPassword']);
		if($ret!=false){
			$salt = GetSalt();
			$shash = hash('sha256',$_POST['txtNewPassword'] . $salt); 
			$sql = "UPDATE users SET salted_hash='$shash', salt='$salt' WHERE user_name='$user'";
			Update($sql);
			header("Location: profile.php");
		}
	}
	
	$_SESSION['pre_fix'] = "../";//Path pre_fix
	include_once('../lib/feeder.php');
	Head_Section();
?>

<body>
	<script type='text/javascript'>
	<?php
		include_once('../lib/js_feeder.php');
		ValidateForm('form1');
		ChangePassValidate('form1');
	?>
	</script>

<div id='wrapper'>

<?php
	PageHeading("Success Enterprise");
	BackButton('< To Profile','profile.php'); 
?>
	<div id='round_div'>
		<p id='pannel_title'>Change password of <?php echo $user ?></p>
		<div id='change_password'>
			<form id='form1' name='form1' method='post' action='change_password.php?err=1' onSubmit='return ChangePassValidate();'>
			<table>
			<?php 
				FormField('Old password','password','txtOldPassword');
				FormField('New password','password','txtNewPassword');
				FormField('Confirm','password','txtConPassword');
			?>
			<tr><td align='right' colspan=2><input type='submit' name='btnChange' value='Change'/></td></tr>
			<?php if(isset($_GET['err'])) echo "<tr><td align='right' colspan=2><p id='invalid_pass'>Invalied password...</p></td></tr>";?>
			</table>
			</form>	
		</div>
	</div>
	<?php Footer();?>
</div><!--Wrapper DIV -->		
</body>
<html>