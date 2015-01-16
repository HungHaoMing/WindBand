
<?php


		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
		$sql =  "";
		echo "Insert SQL!<br>";
		echo $sql.'<br>';
		$conn->Execute(/**/);
		echo '成功';
?>
