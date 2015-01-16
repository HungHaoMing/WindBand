<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增團練通知</title>

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
		
		$Place = $_POST['Place'];
		$YYYY = $_POST['YYYY'];
		$MM = $_POST['MM'];
		$DD = $_POST['DD'];
		$TT = $_POST['TT'];
		$PracticeDay = "$YYYY/$MM/$DD $TT";
		date_default_timezone_set('Asia/Taipei');
		$NoticeDay= date("Y/m/d h:i:s");
		
		$Account = $_SESSION['account'];
		$sql = "select * from Member where Account='$Account'";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);//搜尋資料庫資料表 
		$MemberID = $rs['MemberID'];
		
		
		$sql2 = "insert into ClubPracticeItem (MemberID,NoticeDay,PracticeDay,Plase) values ('$MemberID','$NoticeDay','$PracticeDay','$Place');";
		$conn->Execute($sql2);
		
		echo "新增成功！";
		echo "<meta http-equiv=REFRESH CONTENT=2;url=ManagementSystem.php>";
		?>
		
	</td>
  </tr>
</table>
</body>