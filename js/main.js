function validateMyForm(){

	if ((document.form1.txtUserName.value=="")||(document.form1.txtPassword.value=="")){
		alert ( "Required textbox empty !" );
		return false;
	}
	
	return true;
}