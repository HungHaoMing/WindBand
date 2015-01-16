<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>設定成員</title>

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
		$sql = "select SID,CName from Segment order by Segment.order;";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);//搜尋資料庫資料表 
		$num = $rs->recordcount();
		
		echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"SetMemberSQL.php\">";
		echo "<p1>設定部員</p1>";
		echo "<label for=\"Play\">部別：</label>";
        echo "<select name=\"Play\" id=\"Play\">";
		for($x=0 ; $x<$num ; $x++)
		{
			echo '<option value="'.iconv("big5","UTF-8",$rs['SID']).'">'.iconv("big5","UTF-8",$rs['CName']).'</option>';
			$rs->MoveNext();
		}
		echo "</select></p>學年度：";
		echo "<input type=\"text\" name=\"year\" id=\"year\" value=\"1021\" readonly/><br>";
		$sql2 = "select MemberID,Name from Member where MemberID<>'admin';";
		$rs2 = @new COM("ADODB.RecordSet");
		$rs2->Open($sql2,$conn,1,3);//搜尋資料庫資料表 
		$num2 = $rs2->recordcount();
		for($i=0 ; $i<(int)$num2 ; $i++)
		{
			$sql3 = "select CName from Member,Belong,Segment where Member.MemberID='".iconv("big5","UTF-8",$rs2['MemberID'])."' and Member.MemberID=Belong.MemberID and Belong.year=1021 and Belong.SID=Segment.SID;";
			$rs3 = @new COM("ADODB.RecordSet");
			$rs3->Open($sql3,$conn,1,3);//搜尋資料庫資料表 
			$num3 = $rs3->recordcount();
			echo "<input type=\"checkbox\" value=\"".iconv("big5","UTF-8",$rs2['MemberID'])."\" name=\"MemberArray[]\">";
			echo iconv("big5","UTF-8",$rs2['Name'])."{";
			for($j=0 ; $j<$num3 ; $j++)
			{
				if($j != $num3-1)
					echo iconv("big5","UTF-8",$rs3[CName]).",";
				else
					echo iconv("big5","UTF-8",$rs3[CName]);
				$rs3->MoveNext();
			}
			echo '}<br>';
			$rs2->MoveNext();
		}
		echo " <input type=\"submit\" name=\"CheckBtn\" id=\"CheckBtn\" value=\"設定\" />";
        echo " <input type=\"button\" name=\CancelBtn\" id=\"CancelBtn\" value=\"取消\" onclick=\"javascript:location.href='ManagementSystem.php'\"/>";
		echo " </form>";
		?>
	</td>
  </tr>
</table>
</body>