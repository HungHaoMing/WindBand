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
	$OriginalName = $_POST['OriginalName'];
	$ChineseName = $_POST['ChineseName'];
	$Author = $_POST['Author'];
	$Arranger = $_POST['Arranger'];
	$WhenUse = $_POST['WhenUse'];
	$GetSource = $_POST['GetSource'];
//	$Source = $_POST['Source'];
	$GetDay = $_POST['GetDay'];
	$ScoreState = $_POST['ScoreState'];
	$Level = $_POST['Level'];
	$Music = $_POST['Music'];
	$Note = $_POST['Note'];
	date_default_timezone_set('Asia/Taipei');
	$date = date("Y-m-d H:i:s");
	
	$FileName = $_FILES['Source']['name'];

	if($_FILES['Source']['error']>0)
	{
		switch($_FILES['Source']['error'])
		{
			case 1:
				echo "檔案大小超出了伺服器上傳限制 UPLOAD_ERR_INI_SIZE。檔案尚未上傳，";
				break;
			case 2:
				echo "要上傳的檔案大小超出瀏覽器限制 UPLOAD_ERR_FORM_SIZE。檔案尚未上傳，";
				break;
			case 3:
				echo "檔案僅部分被上傳 UPLOAD_ERR_PARTIAL。檔案尚未上傳，";
				break;	
		//	case 4:
		//		echo "沒有找到要上傳的檔案 UPLOAD_ERR_NO_FILE。檔案尚未上傳，";
		//		break;
			case 5:
				echo "檔伺服器臨時檔案遺失。檔案尚未上傳，";
				break;
			case 6:
				echo "檔案寫入到站存資料夾錯誤 UPLOAD_ERR_NO_TMP_DIR。檔案尚未上傳，";
				break;
			case 7:
				echo "無法寫入硬碟 UPLOAD_ERR_CANT_WRITE。檔案尚未上傳，";
				break;
			case 8:
				echo "UPLOAD_ERR_EXTENSION 。檔案尚未上傳，";
				break;
		}		
		$sql = "update score set Number='$Number',OriginalName='$OriginalName',ChineseName='$ChineseName',Author='$Author',Arranger='$Arranger',WhenUse='$WhenUse',ScoreState='$ScoreState',Level='$Level',Music='$Music',Note='$Note',UpdateTime='$date',GetSource='$GetSource' where SID=$SID;";
		$db->query($sql);
		echo "其他資料已更新。";
		echo "<meta http-equiv=REFRESH CONTENT=3;url=ScoreManagementSystem.php>";
	}
	else
	{
		$sql = "update score set Number='$Number',OriginalName='$OriginalName',ChineseName='$ChineseName',Author='$Author',Arranger='$Arranger',WhenUse='$WhenUse',Source='$FileName',ScoreState='$ScoreState',Level='$Level',Music='$Music',Note='$Note',UpdateTime='$date',GetSource='$GetSource' where SID=$SID;";
		$db->query($sql);
		move_uploaded_file($_FILES['Source']['tmp_name'],'ScoreFiles/'.$_FILES['Source']['name']);//複製檔案
		echo "上傳及資料更新成功！";
		echo "<meta http-equiv=REFRESH CONTENT=3;url=ScoreManagementSystem.php>";
	}
	
//	echo '<a href="ScoreFiles/'.$_FILES['Source']['name'].'">ScoreFiles/'.$_FILES['Source']['name'].'</a>';//顯示檔案路徑
//	echo "<meta http-equiv=REFRESH CONTENT=2;url=ScoreManagementSystem.php>";
?>
		
