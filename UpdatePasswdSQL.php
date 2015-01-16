<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改密碼</title>

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
		$OldPasswd = $_POST['OldPasswd'];
		$NewPasswd = $_POST['NewPasswd'];
		
		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
			
		$Account = $_SESSION['account'];
		$sql = "select * from Member where Account='$Account' and Passwd='$OldPasswd';";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);//搜尋資料庫資料表 
		$num = $rs->recordcount();
		
		if( (int)$num <1 )
		{
			echo "舊密碼錯誤，請重新輸入";
			echo "<meta http-equiv=REFRESH CONTENT=2;url=UpdatePasswd.php>";
		}
		elseif((int)$num>1)
		{
			echo "發生例外狀況，請聯絡管理員！";
		}
		else
		{
			$ID = $rs['MemberID'];
			$sql2 = "update Member set Passwd='$NewPasswd' where Account='$Account';";
			$rs2 = @new COM("ADODB.RecordSet");
			$rs2->Open($sql2,$conn,1,3);
			
			date_default_timezone_set('Asia/Taipei');
			$date= date("Y/m/d h:i:s");
			
			if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			   $myip = $_SERVER['HTTP_CLIENT_IP'];
			}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			   $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
			   $myip= $_SERVER['REMOTE_ADDR'];
			}
			
			$sql3 = "insert into ChangePassLog (MemberID,IP,TheTime,OldPasswd) values ('$ID','$myip','$date','$OldPasswd');";
			$conn->Execute($sql3);
			echo "密碼更改成功.......";
			unset($_SESSION['account']);
			echo '<meta http-equiv=REFRESH CONTENT=1;url=Login.php>';
		}
		?>
	</td>
  </tr>
</table>
</body>