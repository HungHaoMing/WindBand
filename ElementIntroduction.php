<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>樂器介紹</title>
</head>

<?php include("header.php"); ?>
</html>

<body>
<table width="1000" border="2">
  <tr>
	<td width="1000">
	分部介紹<br>
	<?php
		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
		
		//判斷帳號密碼是否為空值
		//確認密碼輸入的正確性 
		//新增資料進資料庫語法
		$sql = "select SID,CName from Segment order by Segment.order;";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);//搜尋資料庫資料表   
		$num = $rs->recordcount();//取得指標總數目
		for($i=0 ; $i<(int)$num ; $i++)
		{
			echo '<input type="button" value="'.iconv("big5","UTF-8",$rs['CName']).'" onclick="location.href= \'SegmentIntroduction.php?Segment='.iconv("big5","UTF-8",$rs['SID'])."'\"><br>\n";
			$rs->MoveNext();
		}
		//當使用多筆資料查詢時，可以使用$rs->MoveNext();  來跳換下一筆資料
	?>
	</td>
  </tr>
</table>
</body>