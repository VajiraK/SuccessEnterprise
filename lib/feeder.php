<?php
/* ------------------------------------------------------------------------------------------------------------------- */
function PlaceLoginForm($frmName,$err){
	if(isset($_SESSION['user_type'])) return;
		
	echo "<div id='loging'>
			<form id='form1' name='$frmName' method='post' action='index.php?err=1' onSubmit='return ValidateMyForm();'>
			<table>";
			
			FormField('User name','text','txtUserName');
			FormField('Password','password','txtPassword');
			
	echo	"<tr>
				<td align='right' colspan=2>
					<a href='register.php'>Register</a><input type='submit' name='btnLogin' value='Sign in'/>
				</td>
			</tr>";
			
	if($err!='') echo "<tr><td align='right' colspan=2><p id='invalid_pass'>$err</p></td></tr>";
		echo "</tr></table></form></div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function GoogleMapLocation(){
	echo "<a href='http://goo.gl/maps/2PWqN' 
		title='Click to show in google maps' target='_blank'>
		<img id='map' src='img/map.png'/>
		</a>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function PageHeading($title){
	echo "<div id='header_footer'><h1>Success Enterprise<h1></div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function BackButton($title,$target){
	echo "<div id='buttom_div'><a href='$target'>$title</a></div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function BeginCentCon($width){
	echo "<div style='margin:auto;width:$width" . "px;'>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function EndCentCon(){
	echo "</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function PutControlPanelItem($title,$image,$target,$id){
	echo "<a href='$target' id='$id'>
			<div id='adm_pannel_item'><p><img src='../img/$image'/><br/>$title</p></div>
		</a>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function FormField($caption,$type,$name,$value=''){
	echo "<tr>
			<td width=300>$caption</td>
			<td> <input type='$type' name='$name' value='$value'/></td>
		</tr>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function Footer(){
	echo "<div id='header_footer'><p>Success Enterprise Stock System &#xA9; 2013</p></div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function ZeebraStripes(&$b,&$n,$styleid){//pass by ref
	if($b)
		echo "<tr class='$styleid'><td>" . $n++ . "</td>";
	else
		echo "<tr><td>" . $n++ . "</td>";
	$b = !$b;
}
/* ------------------------------------------------------------------------------------------------------------------- */
function TabelHeader($styleid,$headers){
	echo "<table id='$styleid' border=1><tr>";
	foreach ($headers as $i => $value) 
		echo "<th>$value</th>";
	echo "</tr>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function Head_Section(){
	$prefix = $_SESSION['pre_fix'];
	echo "<!DOCTYPE html>";
    echo "<html lang='en' xml:lang='en' xmlns='http://www.w3.org/1999/xhtml'>";
    echo "<head>";
    echo "<title>Success Enterprise</title>";
	echo "<meta charset=utf-8 />";
	//CSS
    echo "<link rel='stylesheet' type='text/css' href='" . $prefix . "css/main.css'>";
    echo "<link rel='stylesheet' type='text/css' href='" . $prefix . "css/nav.css'>";
    echo "<link rel='stylesheet' type='text/css' href='" . $prefix . "css/data_tables.css'>";
    //Script
	echo "<script src='" . $prefix . "js/jquery-1.2.3.min.js' type='text/javascript'></script>";
	echo "<script src='" . $prefix . "js/jquery.easing.min.js' type='text/javascript'></script>";
	echo "<script src='" . $prefix . "js/jquery.lavalamp.min.js' type='text/javascript'></script>";
	echo "<script src='" . $prefix . "js/jquery.jshowoff.min.js' type='text/javascript'></script>";
	echo "<script src='" . $prefix . "js/jquery.jshowoff.js' type='text/javascript'></script>";
	echo "<script type='text/javascript' src='" . $prefix . "js/jquery.jshowoff.min.js'></script>";
	echo "<script type='text/javascript' src='" . $prefix . "js/jquery.jshowoff.min.js'></script>";
	//Favicon
	echo "<link rel='shortcut icon' href='" . $prefix . "img/favicon.ico' type='image/x-icon' />";
	echo "</head>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function Slider(){
	echo "<div id='basicFeatures'>
			<div><img src='img/j1.jpg'/></div>
			<div><img src='img/j2.jpg'/></div>	
			<div><img src='img/js3.jpg'/></div>
			<div><img src='img/js4.jpg'/></div>
		</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function NavigationBar($active){
	$prefix = $_SESSION['pre_fix'];
	$home='';$operations='';$contacts='';$about='';$gallary='';$user='';
	$act = "class='current'";
	
	switch($active){
		case 'Home':$home=$act;break;
		case 'Contacts':$contacts=$act;break;
		case 'About':$about=$act;break;
		case 'Gallary':$gallary=$act;break;
		case 'User':$user=$act;break;
	}
	
	echo 	"<div class='lavaLampNoImage' id='2'>
			 <ul>
				 <li $home><a href='" . $prefix . "index.php'>Home</a></li>
				 <li $contacts><a href='" . $prefix . "contacts.php'>Contacts</a></li>
				 <li $about><a href='" . $prefix . "about.php'>About Us</a></li>
				 <li $gallary><a href='" . $prefix . "gallary.php'>Gallary</a></li>";
				 
				if(isset($_SESSION['user_name'])) {
					echo 	"<li $user><a href='" . $prefix . "lib/user_poxy.php'>". $_SESSION['user_name'] . "</a></li>
							<li><a id='sign_out' href='" . $prefix . "lib/sign_out.php'>Sign out</a></li>";
				}
	echo 	"</ul>
			</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DisplayFild($title,$text,$height=18,$scroll=false){
	$s = '';
	if($scroll) $s = 'overflow:scroll;';
	echo "$title <div id='display_field' style='height:$height" . "px;$s'>$text</div>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function Form_Head($id,$method,$action,$onSubmit){
	echo "<form id='" . $id . "' name='"  . $id .  "' method='" . $method . "' action='" . $action . "' onSubmit='" . $onSubmit . "'>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function Space($n){
	for($i=0;$i<=$n;$i++)
		echo '&nbsp;';
}
/* ------------------------------------------------------------------------------------------------------------------- */
function TextBox($lable,$name){
	echo $lable . ' <input name=' . $name . " type='text'/>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function SubmitBtn($text,$name){
	echo "<input type='submit' name='$name' value='$text'/>";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function RadioGroup($lable,$name){
	echo "<input type='radio' name='" . $name . " value='radio' id='" . $name . "'/> " . $lable;                              
}
?>