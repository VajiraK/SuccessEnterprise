<?php 
	session_start();
	include_once('../lib/helper.php');
	Authenticate('IsAdminOrSalesAgent');//Admin or Sales
	//------------------------------------------------------
	if(isset($_POST['btnUpdate'])){
		include_once('../lib/mysql.php');
		$sql = "UPDATE stock SET ItemName='" . $_POST['txtItemName'] .
				"',HS_Price='" . $_POST['txtHSPrice'] .
				"',RT_Price='" . $_POST['txtRetailPrice'] .
				"',Quantity='" . $_POST['txtQuantity'] . "' WHERE ItemID='" . $_SESSION['item_id'] . "'";
		Insert($sql);
		header("Location: stocks.php");
	}
	//------------------------------------------------------
	if(isset($_POST['btnDelete'])){
		include_once('../lib/mysql.php');
		Delete("DELETE FROM stock WHERE ItemID='" . $_SESSION['item_id'] . "'");
		header("Location: stocks.php");
	}
	//------------------------------------------------------
	if(isset($_POST['btnAddFinal'])){
		include_once('../lib/mysql.php');
		$id = GetItemID();
		$sql = "INSERT INTO stock (ItemID,ItemName,HS_Price,RT_Price,Quantity)VALUES('" .
								$id . "','" . 
								$_POST['txtItemName'] . "','" . 
								$_POST['txtHSPrice'] . "','" . 
								$_POST['txtRetailPrice'] . "','" . 
								$_POST['txtQuantity'] . "')";
		Insert($sql);
		header("Location: stocks.php");
	}
	
	if(isset($_GET['id']))
		$_SESSION['item_id'] = $_GET['id'];
	include_once('../lib/feeder.php');
	include_once('stocks_helper.php');
	$_SESSION['pre_fix'] = '../';
	Head_Section();
?>
<body>
<script type='text/javascript'>
<?php
	include_once('../lib/js_feeder.php');
	JQ_DocReady_Start();
		DeleteStock('#DeleteButton');
	JQ_DocReady_End();
	ValidateForm('form1');
?>
			
</script>

<div id='wrapper'>

<?php
	PageHeading("Success Enterprise");
	BackButton('< Back to stocks','stocks.php'); 
	$row = 0;
	
	if(isset($_POST['btnAdd'])){
		echo "<div id='round_div'><p id='pannel_title'>Add New Item</p>";
	}else{
		echo "<input id='hidden_text' type='text' style='display: none;' value='" . $_SESSION['item_id'] . "'/>";
		echo "<div id='round_div'><p id='pannel_title'>Update item : " . $_SESSION['item_id'] . "</p>";
		$row = GetStockItem($_SESSION['item_id']);
	}
?>
		<div id='Add_stock_item'>
			<form id='form1' name='form1' method='post' action='add_edit_item.php' onSubmit='return ValidateMyForm();'>				<table border=0>
				<table>
				<?php 
					FormField('Item Name','text','txtItemName',$row['ItemName']);
					FormField('H/S Price','text','txtHSPrice',$row['HS_Price']);
					FormField('Retail Price','text','txtRetailPrice',$row['RT_Price']);
					FormField('Quantity','text','txtQuantity',$row['Quantity']);
					
					echo '<tr>';
					
					if(isset($_POST['btnAdd'])){
						echo "<td align='right' colspan=2>
								<input type='submit' name='btnAddFinal' value='Add'/>
							</td>";
					}else{
						echo "<td align='right' colspan=2>
								<input id='DeleteButton' type='submit' name='btnDelete' value='Delete'/>
								<input type='submit' name='btnUpdate' value='Update'/>
							</td>";
					}
				?>
				</tr>
				</table>
			</form>	
		</div>
	</div><!--round_div -->
	
	<?php Footer();?>
	</div><!--Wrapper DIV -->
</body>
</html>