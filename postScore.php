<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改譜本資訊</title>
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
	$Number = $_POST['Number'];
	
	$FileName = $_FILES['Source']['name'];
	$sql = "update score set Number='$Number',OriginalName='$OriginalName',ChineseName='$ChineseName',Author='$Author',Arranger='$Arranger',WhenUse='$WhenUse',Source='$FileName',ScoreState='$ScoreState',Level='$Level',Music='$Music',Note='$Note',UpdateTime='$date' where SID=$SID;";
//	$db->query($sql);


	echo "修改成功！";
?>
		
