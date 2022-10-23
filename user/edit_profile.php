<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsLogin');
	
	$_SESSION['pre_fix'] = "../";//Path pre_fix
	
	//------------------------------------------------------
	if(isset($_POST['btnUpdate'])){
		include_once('../lib/mysql.php');
		$sql = "UPDATE users SET name='" . $_POST['txtName'] .
				"',email='" . $_POST['txtEmail'] .
				"',contact='" . $_POST['txtContact'] .
				"',Address='" . $_POST['txtAddress'] . "' WHERE user_name='" . $_SESSION['manage'] . "'";
		Insert($sql);
		header("Location: profile.php");
	}
	//------------------------------------------------------
	
	include_once('../lib/feeder.php');
	Head_Section();
?>

<body>
<div id='wrapper'>
<?php
	PageHeading("Success Enterprise");
	BackButton('< To Profile','profile.php'); 
?>
	<div id='round_div'>
		<p id='pannel_title'>Edit profile of <?php echo $_SESSION['manage']; ?></p>
		<div id='change_password'>
		<form id='form1' name='form1' method='post' action='edit_profile.php?err=1' onSubmit='return ChangePassValidate();'>
			<table>
			<?php
				include_once('profile_helper.php');
				$row = GetUserDetails($_SESSION['manage']);
				FormField('Name','text','txtName',$row['name']);
				FormField('Email','text','txtEmail',$row['email']);
				FormField('Contact','text','txtContact',$row['contact']);
				FormField('Address','text','txtAddress',$row['address']);
			 ?>
			<tr><td align='right' colspan=2><input type='submit' name='btnUpdate' value='Update'/></td></tr>
			<?php if(isset($_GET['err'])) echo "<tr><td align='right' colspan=2><p id='invalid_pass'>Invalied password...</p></td></tr>";?>
			</table>
		</form>	
		</div>
	</div>

	<?php Footer();?>
</div><!--Wrapper DIV -->		
</body>
<html>