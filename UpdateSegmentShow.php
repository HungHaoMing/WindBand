<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改部別</title>

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
		$SID = htmlspecialchars($_GET["SID"]);
		$id = $_SESSION['account'];
		
		$sql = "select * from Segment where SID=$SID;";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);  
		$num = $rs->recordcount();
		echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"UpdateSegmentSQL.php\">";
		echo "<p>修改分部資訊</p>";
		echo "<p><label for=\"SID\">分部編號：</label>";
		echo "<input type=\"text\" name=\"SID\" id=\"SID\" value=\"".iconv("big5","UTF-8",$rs['SID'])."\"readonly=\"readonly\"/>(此欄位不可修改！)</p>";
		echo "<p><label for=\"CName\">中文名：</label>";
        echo "<input type=\"text\" name=\"CName\" id=\"CName\" value=\"".iconv("big5","UTF-8",$rs['CName'])."\"/></p>";
		echo "<p>內容：</p>";
		echo "<p><textarea id=\"Description\" class=\"ckeditor\" cols=\"80\" rows=\"30\" name=\"Description\">";
		echo iconv("big5","UTF-8",$rs['Description']);
		echo "</textarea></p>";
		echo " <input type=\"submit\" name=\"CheckBtn\" id=\"CheckBtn\" value=\"修改\" />";
        echo " <input type=\"button\" name=\CancelBtn\" id=\"CancelBtn\" value=\"取消\" onclick=\"javascript:location.href='UpdateAnnouncement.php'\"/>";
		echo " </form>";
		
	?>
		<script type="text/javascript">
			CKEDITOR.replace( "Description",{
			uiColor: "#14B8C4"
			});
		</script>
	</td>
  </tr>
</table>
</body>
</div>