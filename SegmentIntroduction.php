<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>樂器介紹</title>

</head>
<?php include("header.php") ?>
<body>
<div Class="content">
<table width="1000" border="2">
  <tr>
	<td width="1000">
	<?php
		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
		$SID = htmlspecialchars($_GET["Segment"]);
		//判斷帳號密碼是否為空值
		//確認密碼輸入的正確性 
		//新增資料進資料庫語法
		$sql = "select SID,CName,Description from Segment where SID=$SID;";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);//搜尋資料庫資料表   
		$num = $rs->recordcount();//取得指標總數目
		
		echo '<h1>'.iconv("big5","UTF-8",$rs['CName']).'</h1><br>';
		echo '<p>'.iconv("big5","UTF-8",$rs['Description']).'</p><br>';
	?>
	</td>
  </tr>
</table>
</body>
</div>