<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增譜本資訊</title>
<script src="js/jquery.js" type="text/javascript"></script>
</head>

<body>
<?php
	require_once("DB_config_MySQL.php");
	require_once("DB_Class_MySQL.php");
	$db = new DBMySQL();
	$db->connect_db($_DBMySQL['host'], $_DBMySQL['username'], $_DBMySQL['password'], $_DBMySQL['dbname'],'0');
	$db->query("set names utf8");

	$SID = $_POST['SID'];

	$sql = "delete from score where SID=$SID;";
	$db->query($sql);
	echo "資料刪除成功";
	echo "<meta http-equiv=REFRESH CONTENT=3;url=ScoreManagementSystem.php>";
	
?>
		
