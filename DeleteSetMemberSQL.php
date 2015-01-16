<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>刪除部員</title>

</head>
<?php include("header.php") ?>
<body>
<table width="1000" border="2">
  <tr>
	<td width="1000">
		<?php
		//此判斷為判定觀看此頁有沒有權限
		//說不定是路人或不相關的使用者
		//因此要給予排除
		if($_SESSION['account'] == null)
		{
			echo '請先登入謝謝！';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=Login.php>';
		}
		
		$memberlist =  $_POST['memberlist'];		
		
		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
		
		for($i=0 ; $i<count($memberlist) ; $i++)
		{
			$arr = explode("_",$memberlist[$i]);
			$MemberID = base64_decode($arr[0]);
			$MemberID = @gzinflate($MemberID);
			$sql = "delete from Belong where MemberID=\"".$MemberID."\" and year=".$arr[1]." and SID=".$arr[2].";";
			echo $sql;
			$conn->Execute($sql);
		}
		echo "刪除成功！";
		echo "<meta http-equiv=REFRESH CONTENT=2;url=ManagementSystem.php>";

		?>
	</td>
  </tr>
</table>
</body>