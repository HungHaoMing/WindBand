<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增公告</title>

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
		
		$CID = $_POST['CID'];
		$Title = $_POST['Title'];
		$SYYYY = $_POST['SYYYY'];
		$SMM = $_POST['SMM'];
		$SDD = $_POST['SDD'];
		$EYYYY = $_POST['EYYYY'];
		$EMM = $_POST['EMM'];
		$EDD = $_POST['EDD'];
		$Content = $_POST['AnnouncementContent'];

		$Account = $_SESSION['account'];
		$sql = "select * from Member where Account='$Account'";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);//搜尋資料庫資料表 
		$Contact = iconv("big5","UTF-8",$rs['Name']).','.iconv("big5","UTF-8",$rs['Email']);
		$ID = $rs['MemberID'];
		
		
		$sql = "insert into Announcement (MemberID,CID,StartDay,EndDay,Content,Title,Contact) values ('$ID','$CID','$SYYYY/$SMM/$SDD','$EYYYY/$EMM/$EDD','$Content','$Title','$Contact');";
		$conn->Execute($sql);
		echo "新增成功！";
		echo "<meta http-equiv=REFRESH CONTENT=2;url=ManagementSystem.php>";
		?>
		
	</td>
  </tr>
</table>
</body>