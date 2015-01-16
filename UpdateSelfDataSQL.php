<?php session_start(); ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>更改個人資料</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php include("header.php") ?>
<table width="468" border="2" id="ApplyTable">
  <tr>
	<td width="389">
<?php
	$db_file = "app_data\\ClubSystem.mdb";
	$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
	if($conn->Open($connstr))
		die("無法連接至Access資料庫");
	

	$Name = $_POST['Name'];
	$EMail = $_POST['EMail'];
	$Phone = $_POST['Phone'];
	$Address = $_POST['Address'];
	//判斷帳號密碼是否為空值
	//確認密碼輸入的正確性 
	//新增資料進資料庫語法
	$ID = $_SESSION['account'];
	$sql = "update Member set Name='$Name',EMail='$EMail',CellPhone='$Phone',Address='$Address' where Account='$ID';";
	$rs = $conn->Execute($sql);
	echo '更改中......';
	echo '<meta http-equiv=REFRESH CONTENT=2;url=ManagementSystem.php>';
	
	
?>
	</td>
  </tr>
</table>