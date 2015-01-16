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
		$arr = explode(" ",$PracticeDay);
		$arr2 = explode(":",$arr[2]);
		$PracticeDay = $arr[0].' '.sprintf("%d",((int)$arr2[0]+12)).':'.$arr2[1].':'.$arr2[2];
		$sql = "select SID,CName from Segment order by Segment.order;";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);
		$num = $rs->recordcount();
		for($x=0 ; $x < $num ; $x++)
		{
			$sql2 = "select Member.name,Member.MemberID from Belong,Member where Member.MemberID=Belong.MemberID and SID=".iconv("big5","UTF-8",$rs['SID']).";";
			$rs2 = @new COM("ADODB.RecordSet");
			$rs2->Open($sql2,$conn,1,3);
			$num2 = $rs2->recordcount();
			for($y=0 ; $y < $num2 ; $y++)
			{
				$MemberID = iconv("big5","UTF-8",$rs2['MemberID']);
				$MemberID = base64_encode(gzdeflate($MemberID));
				$test = $_POST[$MemberID."rad"];
				$test2 = $_POST[$MemberID."txt"];
				
				
				$MemberID_encode = base64_decode($MemberID);
				$MemberID_encode = @gzinflate($MemberID_encode);
				$sql3 = "select Attend,Why from MemberAttendPractice where MemberID='$MemberID_encode' and PracticeDay=#$PracticeDay#;";
				$rs3 = @new COM("ADODB.RecordSet");
				$rs3->Open($sql3,$conn,1,1);
				$num3 = $rs3->recordcount();
				if($num3 == 0)
				{
					$sql4 = "insert into MemberAttendPractice (PracticeDay,MemberID,Attend,Why) values ('$PracticeDay','".$MemberID_encode."',$test,'$test2');";
					$conn->Execute($sql4);
				}
				else
				{
					$sql4 = "update MemberAttendPractice set Attend=$test , Why='$test2' where MemberID='$MemberID_encode' and PracticeDay=#$PracticeDay#;";
					$conn->Execute($sql4);
				}
				$rs2->MoveNext();
			}
			$rs->MoveNext();
		}
		echo "修改完成！<br>";
		echo "<meta http-equiv=REFRESH CONTENT=2;url=ManagementSystem.php>";
		?>
	</td>
  </tr>
</table>
</body>