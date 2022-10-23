<?php 
	session_start();
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
	NavigationBar("About");
	Slider();
?>
<div id='div_about'>
	<h1>Vision and Mission</h1>
	<table id='list_table'>
	<tr>
		<th>Vision : </th>
		<td>To be the best Arpico distributor in the country.</td>
	</tr>
	<tr>
		<th>Mission : </th>
		<td>We aim to offer high-quality service in order to increase the sales and become the best distributor</td>
	</tr>
	</table>
	<h1>The Company</h1>
	<p id='p_company'>
	Success enterprises established in 2002 with few staff members. This is a distribution center<br>
	of Arpico products & situated in Warathenna, Gohagoda. The company is targeting the hardware sector.<br>
	 Marketing area is from Akurana to Pussellawa. We sale from nails to water tanks etc.  
	</P>
	
	<h1>Achievements</h1> 
		<ul id='ul_achievements'>
		<li>Achieved “Reaching new heights” award in 2011 for Arpico hardware sector.</li>
		<li>Achieved 3rd place in best distributor in hardware sector.</li>
		</ul>
	<h1>About Staff</h1>

	<table id='list_table'>
	<tr>
		<th>Proprietor :</th> 
		<td>S.A.Amila Ruwan Samaraweera</td> 
	</tr>
	<tr>
		<th>Manager :</th>  
		<td>Lesly</td> 
	</tr>
	<tr>
		<th>Store keeper :</th>
		<td>Mithun Piyadigama</td> 
	</tr>
	<tr>
		<th>Clerk :</th>  
		<td>Mr.Samantha</td> 
	</tr>
	</table>
</div>
	<?php Footer();?>
</div>
</body>
</html>
