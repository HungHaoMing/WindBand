<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>設定幹部</title>

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
		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
			
		$MemberID =  $_POST['MemberID'];
		$year =  $_POST['year'];
		$PID =  $_POST['Position'];
		
		$sql3 = "select * from PBelong where MemberID='".$MemberID."' and year=1021 and PID=".$PID.";";
		$rs3 = @new COM("ADODB.RecordSet");
		$rs3->Open($sql3,$conn,1,3);
		$num3 = $rs3->recordcount();

		if($num3 == 1)
		{
			echo "不可重複設定！";
			echo "<meta http-equiv=REFRESH CONTENT=2;url=ManagementSystem.php>";
		}
		else
		{
			$sql = "insert into PBelong (MemberID,PID,year) values ('$MemberID',$PID,$year)";
			$conn->Execute($sql);
			
			echo "設定成功";
			echo "<meta http-equiv=REFRESH CONTENT=2;url=ManagementSystem.php>";
		}
		?>
	</td>
  </tr>
</table>
</body>