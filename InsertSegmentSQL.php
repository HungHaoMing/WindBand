<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增社團分部</title>

</head>
<?php include("header.php") ?>
<body>
<table width="1000" border="2">
  <tr>
	<td width="1000">
		<?php

		require_once("DB_config_MySQL.php");
		require_once("DB_Class_MySQL.php");
		$db = new DBMySQL();
		$db->connect_db($_DBMySQL['host'], $_DBMySQL['username'], $_DBMySQL['password'], $_DBMySQL['dbname'],'0');
		$db->query("set names utf8");
		
		$CName = $_POST['CName'];
		$Description = $_POST['Description'];
		//判斷帳號密碼是否為空值
		//確認密碼輸入的正確性 
		//新增資料進資料庫語法
		$sql = "insert into segment (CName,Description) values ('$CName','$Description');";
		$db->query($sql);
		
		echo "新增成功！";
		?>
		
	</td>
  </tr>
</table>
</body>