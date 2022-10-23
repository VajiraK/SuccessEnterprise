<?php
/* ------------------------------------------------------------------------------------------------------------------- */
function JQ_DocReady_Start(){
	echo "$(document).ready(function(){ ";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function JQ_DocReady_End(){
	echo "});";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function IsEmail(){
	echo "function IsEmail(email) {
			var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!regex.test(email)){
				alert('Invalid Email!')
				return false;
			}
			return true;
		}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function CheckPasswords(){
	echo "function CheckPasswords(p1,p2){
			if(p1!=p2){
				alert('Passwords did not match!');
				return false;
			}
			return true;
		}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function FeedbackFormValidate($frmName){
	echo "function FeedbackFormValidate(){
		if(ValidateMyForm($frmName)){
			var frmEle = document.$frmName.elements;
			if(!IsEmail(frmEle[1].value))
					return false;
			if(frmEle[3].value==''){
				alert('Please type your message!');
				return false;
			}
		}else{
			return false;
		}
		return true;
	}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function RegisterFormValidate($frmName){
	echo "function RegisterFormValidate(){
			if(ValidateMyForm($frmName)){
				var frmEle = document.$frmName.elements;
				if(!CheckPasswords(frmEle[1].value,frmEle[2].value))
					return false;
				if(!IsEmail(frmEle[4].value))
					return false;
				if(frmEle[6].value==''){
					alert('Please type an address!');
					return false;
				}
			}else{
				return false;
			}
			return true;
		}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DeleteStock($id){
	echo "$('$id').click(
			function(){
				r = confirm('Are you sure you want to delete item ' + $('#hidden_text').val() + '?');
				if (r)
					return true;
				else
					return false;
			}
		);";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function ChangePassValidate($frmName){
	echo "function ChangePassValidate(){
			if(ValidateMyForm($frmName)){
				var frmEle = document.$frmName.elements;
				if(!CheckPasswords(frmEle[1].value,frmEle[2].value))
					return false;
			}else{
				return false;
			}
			return true;
		}";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function DeleteConfirmation($id){
	echo "$('$id').click(
			function(){
				r = confirm('Are you sure you want to delete user ' + $('#hidden_text').val() + '?');
				if (r)
					return true;
				return false;
			}
		);";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function SliderJS(){
	echo "$('#basicFeatures').jshowoff({ 
				speed:5000,
				changeSpeed:1000,
				links: false,
				controls: false,
				effect: 'fade',
				cssClass: 'basicFeatures',
				hoverPause: false 
			});";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function NavigationBarJS(){
echo 	"$(function(){
				$('#1, #2, #3').lavaLamp({
					fx: 'backout',
					speed: 700,
				});
		});";
}
/* ------------------------------------------------------------------------------------------------------------------- */
function ValidateForm($frmName){
	echo "function ValidateMyForm(){
			var frmEle = document.$frmName.elements;
			for(var e = 0; e < frmEle.length; e++){
				if((frmEle[e].type == 'text')||(frmEle[e].type == 'password')){
					if(frmEle[e].value==''){
						alert('Required textbox empty!');
						return false;
					}
				}
			}
			return true;
		}";
}
?>