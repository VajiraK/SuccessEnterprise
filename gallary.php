<?php 
	session_start();

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
	NavigationBar("Gallary");
	Slider();
	
	include_once('/lib/helper.php');
	$directory  = $_SERVER["DOCUMENT_ROOT"] . "/SuccessEnterprise/img/gallary/";
	$files = array_diff(scandir($directory), array('..', '.'));
	$n = 1;
	$div_open = false;
	$new = false;
	
	echo "<div id='div_gal'>";
	foreach($files as $f){
		if(is_file($directory . $f )) {
			if($n==1){/*This group each 4 gal items together, this is nesassary
						place fotter in proper place*/
				echo "<div id='div_gal_con'>";
				$div_open = true;
			}

			echo "<div id='div_gal_item'>
					<p>". IsNewItem($f,$new) . "</p>
					<img id='div_gal_img' src='img/gallary/" . $f . "'/>";
				if($new)//New item
					echo "<img id='new_overlay' src='img/new.png'/>";
			echo "</div>";
				
			if($n++==4){
				echo "</div>";
				$n = 1;
				$div_open = false;
			}
		}
	}
	
	if($div_open)echo "</div>";
	
	echo "</div>";//div_gal
?>

<?php Footer();?>
</div><!--Wrapper DIV -->
</body>
</html>