<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改社團歷史</title>

</head>
<?php include("header.php") ?>
<body>
<script src="ckeditor/ckeditor.js" type="text/javascript"><!--mce:2--></script>
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
		echo '	<form id="form1" name="form1" method="post" action="UpdateHistorySQL.php">';
		echo '社團歷史：';
		echo '<textarea id="History" class="ckeditor" cols="80" rows="30" name="History">';
		
		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
			
			
		$sql = "select HID,Description from History order by HID desc;";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);//搜尋資料庫資料表 
		echo iconv("big5","UTF-8",$rs['Description']);
		echo "</textarea>\n";
		echo ' <input type="submit" name="CheckBtn" id="CheckBtn" value="送出" />';
        echo ' <input type="button" name="CancelBtn" id="CancelBtn" value="取消" onclick="javascript:location.href=\'ManagementSystem.php\'"/>';
		?>
		<script type="text/javascript">
		CKEDITOR.replace( "History",{uiColor: "#14B8C4"});
		</script>
	</td>
  </tr>
</table>
</body>