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
			
		$MemberArray =  $_POST['MemberArray'];
		$year =  $_POST['year'];
		$Play =  $_POST['Play'];
		$counter = 0;
		
		for($i=0 ; $i<count($MemberArray) ; $i++)
		{
			$sql3 = "select * from Belong where MemberID='".$MemberArray[$i]."' and year=1021 and SID=".$Play."";
			$rs3 = @new COM("ADODB.RecordSet");
			$rs3->Open($sql3,$conn,1,3);//搜尋資料庫資料表 
			$num3 = $rs3->recordcount();
			if((int)$num3 == 0)
			{
				$sql = "insert into Belong (MemberID,SID,year) values ('".$MemberArray[$i]."',$Play,$year)";
				$conn->Execute($sql);
			}
			elseif((int)$num3 == 1)
			{
				$counter++;
			}
		}
		if($counter>0)
			echo "共有".$counter."人重複設定，不可重複設定！<br>";
		$count2 = count($MemberArray)-$counter;
		echo "共有".$count2."人設定成功！<br>";
		echo "<meta http-equiv=REFRESH CONTENT=2;url=ManagementSystem.php>";
		
		?>
	</td>
  </tr>
</table>
</body>