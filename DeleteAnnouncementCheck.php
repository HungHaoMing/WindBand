<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>確認刪除公告</title>
</head>

<?php include("header.php"); ?>
</html>

<body>
<div Class="Announcement">
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
			
		$CheckDelete =  $_POST['CheckDelete'];
		
		$id = $_SESSION['account'];
		
		echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"DeleteAnnouncementSQL.php\">";
		echo "<h1>即將刪除</h1>";
		for($i=0 ; $i<count($CheckDelete) ; $i++)
		{
			$sql = "select AID,CID,Title,StartDay from Announcement where AID=".$CheckDelete[$i].";";
			$rs = @new COM("ADODB.RecordSet");
			$rs->Open($sql,$conn,1,3);
			
			$sql2 = "select Name from Class where CID=".iconv("big5","UTF-8",$rs['CID']).";";
			$rs2 = @new COM("ADODB.RecordSet");
			$rs2->Open($sql2,$conn,1,3);
			
			echo "<input type=\"checkbox\" value=\"".iconv("big5","UTF-8",$rs['AID'])."\" name=\"CheckDelete[]\" checked  >[";
			echo substr(iconv("big5","UTF-8",$rs['StartDay']),5,5);
			echo ']['.iconv("big5","UTF-8",$rs2['Name']).']'.iconv("big5","UTF-8",$rs['Title']).'</p><br>';
			$rs->MoveNext();
		}
		echo " <input type=\"submit\" name=\"CheckBtn\" id=\"CheckBtn\" value=\"確定刪除\" />";
        echo " <input type=\"button\" name=\CancelBtn\" id=\"CancelBtn\" value=\"取消\" onclick=\"javascript:location.href='DeleteAnnouncement.php'\"/>";
		echo " </form>";
	?>
	
	</td>
  </tr>
</table>
</body>
</div>