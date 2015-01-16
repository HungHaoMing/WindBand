<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看小號部譜</title>

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
				
		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
		$SID = htmlspecialchars($_GET["SID"]);
		$sql = "select SID,filename,AName,CName,Part,Description from Sheet where SID=".$SID.";";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);//搜尋資料庫資料表 
		$num = $rs->recordcount();
		
		echo "<p><label for=\"AName\">名稱：</label>";
		echo "<input type=\"text\" name=\"AName\" id=\"AName\" value=\"".iconv("big5","UTF-8",$rs['AName'])."\"readonly=\"readonly\"/></p>";
		
		echo "<p><label for=\"CName\">中文名稱：</label>";
		echo "<input type=\"text\" name=\"CName\" id=\"CName\" value=\"".iconv("big5","UTF-8",$rs['CName'])."\"readonly=\"readonly\"/></p>";
		echo "<p><label for=\"Part\">分部：</label>";
		echo "<input type=\"text\" name=\"Part\" id=\"Part\" value=\"".iconv("big5","UTF-8",$rs['Part'])."\"readonly=\"readonly\"/></p>";
		
		echo "<p>內容：</p>";
		echo "<p><textarea id=\"Description\"cols=\"80\" rows=\"10\" name=\"Description\">";
		echo iconv("big5","UTF-8",$rs['Description']);
		echo "</textarea></p>";
		
		echo '<p>譜：<a href="sheet/'.iconv("big5","UTF-8",$rs['filename']).'" target=_blank>我是連結</a></p><br>';
		
		
		?>
	</td>
  </tr>
</table>
</body>