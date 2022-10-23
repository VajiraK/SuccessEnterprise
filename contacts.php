<?php 
	session_start();

	if(isset($_POST['btnSubmit'])){
		include_once('/lib/mysql.php');
		include_once('/lib/helper.php');
		$sql = "INSERT INTO feedbacks (Name, Email,Contact,Message,Date)VALUES('" . 
				$_POST['txtName'] . "','" . 
				$_POST['txtEmail'] . "','" .			
				$_POST['txtContact'] . "','" .			
				$_POST['txtMessage'] . "','" .			
				time() . "')";

		Insert($sql);
		header("Location: contacts.php");
	}
	
	$_SESSION['pre_fix'] = "";//Path pre_fix
	include_once('/lib/feeder.php');
	Head_Section();
?>

<body>

<script type="text/javascript">	
<?php
	include_once('/lib/js_feeder.php');
	JQ_DocReady_Start();
		SliderJS();
	JQ_DocReady_End();
	NavigationBarJS();
?>
</script>

<div id='wrapper'>
	<?php
		PageHeading("Success Enterprise");
		NavigationBar("Contacts");
	?>
	
	<script type="text/javascript">
	<?php
		include_once('/lib/js_feeder.php');
		ValidateForm('form1');
		IsEmail();
		FeedbackFormValidate('form1');
	?>
	</script> 

	<div id='contact_div_left'>
	<!-- ********************************************* -->
	<div id='round_border_div'>
	
		<h1>Contact us</h1>
		<form id='form1' name='form1' method='post' action='contacts.php' onSubmit='return FeedbackFormValidate();'>
		<table>
			<?php 
			BeginCentCon(450);
				FormField('Name','text','txtName');
				FormField('Email','text','txtEmail');
				FormField('Contact','text','txtContact');
			EndCentCon();
			?>
			<tr>
				<td>Message</td>
				<td><textarea rows='4' cols='20' name='txtMessage'></textarea></td>
			</tr>
			<tr>
				<td align='right' colspan=2><input type='submit' name='btnSubmit' value='Submit'/></td>
			</tr>
		</table>
		</form>	
	</div>
	<!-- ********************************************* -->
	<div id='round_border_div'>
		<h1>Contact details</h1>
<pre>
Proprietor
Mr.S.A.A.R.Samaraweera,
#310/1A, Warathenna,
Haloluwa,
Matale.

Tel No
Office: 081-4935724
Mobile: 077-3312679
Email: s.amilaruwan@gmail.com
Fax: 081-4935724

Manager
Mr.Lesly Kumara
Tel No: 077-123456
</pre>
	</div>
	</div><!-- contact_div_left -->
	<?php echo GoogleMapLocation();?>
	<?php Footer();?>
	
</div>
</body>
</html>
