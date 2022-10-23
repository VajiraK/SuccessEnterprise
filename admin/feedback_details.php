<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsAdmin');
	
	$_SESSION['pre_fix'] = "../";//Path pre_fix
	
	//------------------------------------------------------
	if(isset($_POST['btnDelete'])){
		include_once('../lib/mysql.php');
		Delete("DELETE FROM feedbacks WHERE Date='" . $_GET['date'] . "'");
		header("Location: feedbacks.php");
	}
	//------------------------------------------------------
	
	include_once('../lib/feeder.php');
	Head_Section();
?>

<body>
<div id='wrapper'>
<?php
	PageHeading("Success Enterprise");
	BackButton('< To Feedbacks','feedbacks.php'); 
?>
	<div id='round_div'>
		<p id='pannel_title'>Feedback made on <?php echo FormatDate($_GET['date']); ?></p>
		<div id='change_password'>
		<form id='form1' name='form1' method='post' action='feedback_details.php?date= <?php echo $_GET['date']?> '>
			<?php
				include_once('adm_helper.php');
				$row = GetFeedback($_GET['date']);
				BeginCentCon(210);
					DisplayFild('Name',$row['Name']);
					DisplayFild('Email',$row['Email']);
					DisplayFild('Contact',$row['Contact']);
					DisplayFild('Message',$row['Message'],100,true);
					echo "<input style='margin-left:158px;' 
						type='submit' name='btnDelete' value='Delete'/>";
				EndCentCon();
				
			 ?>
			
		</form>	
		</div>
	</div>

	<?php Footer();?>
</div><!--Wrapper DIV -->		
</body>
<html>