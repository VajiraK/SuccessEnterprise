<?php 
	session_start();

	if(isset($_POST['btnRegister'])){
		include_once('/lib/mysql.php');
		include_once('/lib/helper.php');
		$salt = GetSalt();
		$shash = hash('sha256',$_POST['txtPassword'] . $salt); 
		$sql = "INSERT INTO users (user_name, salted_hash,salt,user_type,name,email,contact,address)VALUES('" . 
				$_POST['txtUserName'] . "','" . 
				$shash . "','" .
				$salt . "','Customer','" .
				$_POST['txtName'] . "','" .			
				$_POST['txtEmail'] . "','" .			
				$_POST['txtContact'] . "','" .			
				$_POST['txtAddress'] . "')";

		Insert($sql);
		header("Location: index.php");
	}

	include_once('/lib/feeder.php');
	$_SESSION['pre_fix'] = "";//Path pre_fix
	Head_Section();
?>

<body>
<div id='wrapper'>

<?php
	PageHeading("Success Enterprise");
	NavigationBar("Home");
?>

<script type="text/javascript">
<?php
	include_once('/lib/js_feeder.php');
	CheckPasswords();
	ValidateForm('form1');
	IsEmail();
	RegisterFormValidate('form1');
?>
</script> 
	<div id='round_div'>
		<p id='pannel_title'>User Registration</p>
		<div id='change_password'>
			<form id='form1' name='form1' method='post' action='register.php' onSubmit='return RegisterFormValidate();'>				<table border=0>
				<table>
				<?php 
					FormField('User Name','text','txtUserName');
					FormField('Passward','password','txtPassword');
					FormField('Confirm','password','txtConfirm');
					echo '<tr><td colspan=2><hr></td></tr>';
					FormField('Name','text','txtName');
					FormField('Email','text','txtEmail');
					FormField('Contact','text','txtContact');
				?>
					<tr><td>Address</td><td><textarea rows='4' cols='20' name='txtAddress'></textarea></td></tr>
				<tr>
					<td align='right' colspan=2><input type='submit' name='btnRegister' value='Register'/></td>
				</tr>
				</table>
			</form>	
		</div>
	</div>
	<?php Footer();?>
</div><!--Wrapper DIV -->
</body>
</html>