<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PO出席文</title>

</head>
<?php include("header.php") ?>
<body>
<table width="1000" border="2" class="content">
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
			
		$PracticeDay = htmlspecialchars($_GET["PracticeDay"]);
		$sql = "select SID,CName from Segment order by Segment.order;";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);
		$num = $rs->recordcount();
		echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"SetAttendMemberSQL.php?PracticeDay=".$PracticeDay."\">";
		
		$arr = explode(" ",$PracticeDay);
		$arr2 = explode(":",$arr[2]);
		$PracticeDay = $arr[0].' '.sprintf("%d",((int)$arr2[0]+12)).':'.$arr2[1].':'.$arr2[2];
		
		echo "<h1><label >".$PracticeDay."出席文</label></h1>";
		for($x=0 ; $x < $num ; $x++)
		{
			echo "<h1><label>".iconv("big5","UTF-8",$rs['CName'])."：</label></h1>";
			$sql2 = "select Member.name,Member.MemberID from Belong,Member where Member.MemberID=Belong.MemberID and SID=".iconv("big5","UTF-8",$rs['SID']).";";
			$rs2 = @new COM("ADODB.RecordSet");
			$rs2->Open($sql2,$conn,1,3);
			$num2 = $rs2->recordcount();
			for($y=0 ; $y < $num2 ; $y++)
			{
				$MemberID = iconv("big5","UTF-8",$rs2['MemberID']);
				$sql3 = "select Attend,Why from MemberAttendPractice where MemberID='$MemberID' and PracticeDay=#$PracticeDay#;";
				$rs3 = @new COM("ADODB.RecordSet");
				$rs3->Open($sql3,$conn,1,1);
				$num3 = $rs3->recordcount();
				$MemberID = base64_encode(gzdeflate($MemberID));
				echo '<p>'.iconv("big5","UTF-8",$rs2['Name']).':';
				if($num3 == 0)
				{
					echo "<input type=\"radio\" value=\"true\" name=\"".$MemberID."rad\" checked>出席\n";
					echo "<input type=\"radio\" value=\"false\" name=\"".$MemberID."rad\">缺席\n";
					echo "<input type=\"text\" name=\"".$MemberID."txt\"size=\"75\"/></p>\n";
				}
				else
				{
					if((int)iconv("big5","UTF-8",$rs3['Attend']) == -1)
					{
						echo "<input type=\"radio\" value=\"true\" name=\"".$MemberID."rad\" checked>出席\n";
						echo "<input type=\"radio\" value=\"false\" name=\"".$MemberID."rad\">缺席\n";
					}
					else
					{
						echo "<input type=\"radio\" value=\"true\" name=\"".$MemberID."rad\" >出席\n";
						echo "<input type=\"radio\" value=\"false\" name=\"".$MemberID."rad\" checked>缺席\n";
					}
					echo "<input type=\"text\" name=\"".$MemberID."txt\"size=\"75\" value=\"".iconv("big5","UTF-8",$rs3['why'])."\"/></p>";
				
				}
				
				
				$rs2->MoveNext();
			}
			$rs->MoveNext();
		}
		echo "<p><input type=\"submit\" name=\"CheckBtn\" id=\"CheckBtn\" value=\"送出\" />";
        echo " <input type=\"button\" name=\CancelBtn\" id=\"CancelBtn\" value=\"取消\" onclick=\"javascript:location.href='ManagementSystem.php'\"/></p>";
		echo " </form>";
		?>
	</td>
  </tr>
</table>
</body>