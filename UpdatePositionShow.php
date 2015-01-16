<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改幹部資訊</title>

</head>
<?php include("header.php") ?>
<body>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js" type="text/javascript"><!--mce:2--></script>
<div Class="content">
<table width="1000" border="2">
  <tr>
	<td width="1000">
	<?php
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
		$PID = htmlspecialchars($_GET["PID"]);
		
		$sql = "select * from Position where PID=$PID;";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);//搜尋資料庫資料表   
		$num = $rs->recordcount();//取得指標總數目
		
		echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"UpdatePositionSQL.php\">";
		echo "<p>修改幹部資訊</p>";
		echo "<p><label for=\"PID\">幹部編號：</label>";
		echo "<input type=\"text\" name=\"PID\" id=\"PID\" value=\"".iconv("big5","UTF-8",$rs['PID'])."\"readonly=\"readonly\"/>(此欄位不可修改！)</p>";
		echo "<p><label for=\"CName\">名稱：</label>";
        echo "<input type=\"text\" name=\"CName\" id=\"CName\" value=\"".iconv("big5","UTF-8",$rs['CName'])."\"/></p>";
		echo "<p>工作：</p>";
		echo "<p><textarea id=\"Jobs\" class=\"ckeditor\" cols=\"80\" rows=\"30\" name=\"Jobs\">";
		echo iconv("big5","UTF-8",$rs['Jobs']);
		echo "</textarea></p>";
		echo " <input type=\"submit\" name=\"CheckBtn\" id=\"CheckBtn\" value=\"修改\" />";
        echo " <input type=\"button\" name=\CancelBtn\" id=\"CancelBtn\" value=\"取消\" onclick=\"javascript:location.href='UpdatePosition.php'\"/>";
		echo " </form>";
		
	?>
		<script type="text/javascript">
			CKEDITOR.replace( "Jobs",{
			uiColor: "#14B8C4"
			});
		</script>
	</td>
  </tr>
</table>
</body>
</div>