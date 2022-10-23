<?php 
	session_start();

	if(isset($_POST['btnLogin'])){
		include_once('lib/helper.php');
		$ret = LogIn($_POST['txtUserName'],$_POST['txtPassword']);
		if($ret!=false){
			$_SESSION['user_name'] =  $_POST['txtUserName'];
			$_SESSION['user_type'] =  $ret;
			header('Location: lib/user_poxy.php');
		}
	}

	include_once('/lib/feeder.php');
	$_SESSION['pre_fix'] = "";//Path pre_fix
	Head_Section();
?>

<body>

<script type="text/javascript">	
<?php
	include_once('/lib/js_feeder.php');
	JQ_DocReady_Start();
		SliderJS();
		NavigationBarJS();
	JQ_DocReady_End();
	
	ValidateForm('frmLog');
?>
</script>

<div id='wrapper'>
<?php
	PageHeading("Success Enterprise");
	NavigationBar("Home");
	Slider();
	if(isset($_GET['err']))
		PlaceLoginForm('frmLog',"Invalid username or password...");
	else
		PlaceLoginForm('frmLog',"");
?>

	<div id="home_content">
		<h1>Message of the proprietor</h1>

		<p>Starting of this was a massive challenge for me. I started learning how to do & develop the business step
		by step. Therefore I believe "If anyone wants to do something successfully & if the person has enough
		confidence definitely he/she will achieve the targets" .

		We especially consider on offering high-quality service to the customer. Developing the online system is
		also in a way make ease for consumers to get the job done faster (place an order & receive items).By the
		time we have create a link with good consumers. As a result we offer discounts for consumers who are
		trustworthy.

		There is a significant increment in employees & I believe they also should be satisfied in their jobs.
		Granting them a reasonable salary, incentives, hamper for Sinhala/Tamil aluth avurudu , sports meets
		are things that I have done to make them merry.

		Finally I expect to grow my company by adding values like integrating the business with information
		technology etc. The company has a clear growth not only because of my decisions and effort but also with
		the effort that my team has done. I expect it in future to make our company successful.</p>
	</div>
	<?php Footer();?>
</div><!--Wrapper DIV -->
</body>
</html>