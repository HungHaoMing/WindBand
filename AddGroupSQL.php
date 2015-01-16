<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php
	$db_file = "app_data\\ClubSystem.mdb";
	$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
	if($conn->Open($connstr))
		die("無法連接至Access資料庫");
	
	$GID = $_POST['GID'];
	$Name = $_POST['Name'];
	$Description = $_POST['Description'];
	//判斷帳號密碼是否為空值
	//確認密碼輸入的正確性 
	//新增資料進資料庫語法
	$sql = "insert into [Group] (GID,Name,Description) values ('$GID','$Name','$Description');";
	echo $sql;
	$conn->Execute($sql);
	echo '成功<br>'.'<meta http-equiv=REFRESH CONTENT=3;url=AddGroup.php>';
	
?>