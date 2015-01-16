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
		
		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
	
		$sql = "select Segment.CName,Segment.SID,Member.Name,Belong.MemberID,Belong.year,Belong.SID from Belong,Member,Segment where Belong.MemberID=Member.MemberID and Belong.SID=Segment.SID and year=1021 order by Segment.SID;";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);
		$num = $rs->recordcount();
		echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"DeleteSetMemberSQL.php\">";
		echo "<h1>即將刪除成員：</h1>";
		for($x=0 ; $x<$num ; $x++)
		{
			echo "<p><input type=checkbox value=\"".base64_encode(gzdeflate(iconv("big5","UTF-8",$rs['MemberID']))).'_'.iconv("big5","UTF-8",$rs['year']).'_'.iconv("big5","UTF-8",$rs['SID'])."\" name=\"memberlist[]\" >".'{'.iconv("big5","UTF-8",$rs['CName']).'}{'.iconv("big5","UTF-8",$rs['Name'])."}</p><br>\n";
			$rs->MoveNext();
		}
		echo " <input type=\"submit\" name=\"CheckBtn\" id=\"CheckBtn\" value=\"確定刪除\" />";
        echo " <input type=\"button\" name=\CancelBtn\" id=\"CancelBtn\" value=\"取消\" onclick=\"javascript:location.href=DeleteAnnouncement.php\"/>";
		echo " </form>";
		?>
	</td>
  </tr>
</table>
</body>