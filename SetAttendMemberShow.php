<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>選擇團練時間</title>

</head>
<?php include("header.php") ?>
<body>
<table width="1000" border="2">
  <tr>
	<td width="1000">
	<p>請選擇團練時間：</p>
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
		
		$sql = "select PracticeDay from ClubPracticeItem where PracticeDay>#".date("Y/m/d")."#;";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);
		$num = $rs->recordcount();
		for($i=0 ; $i<(int)$num ; $i++)
		{
			echo '<p><a href="SetAttendMember.php?PracticeDay='.iconv("big5","UTF-8",$rs['PracticeDay']).'">';
			echo "練習時間：".iconv("big5","UTF-8",$rs['PracticeDay'])."</a></p><br>\n";
			$rs->MoveNext();
		}
		?>
	</td>
  </tr>
</table>
</body>