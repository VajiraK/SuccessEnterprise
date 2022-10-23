<?php
	session_start();
	
	if($_SESSION['user_type']=='Administrator')
		header('Location: ../admin/adm_home.php');
	else if($_SESSION['user_type']=='Customer')
		header('Location: ../customer/cus_home.php');
	else if($_SESSION['user_type']=='SalesAgent')
		header('Location: ../sales_agent/sales_agent_home.php');
	else	
		header('Location: ../lib/sign_out.php');
?>