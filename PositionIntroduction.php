<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>幹部介紹</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="style2.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#apDiv7 {
	position:relative;
	width:520px;
	height:100%;
	z-index:6;
	left: 17%;
	top: -119%;
}
#apDiv8 {
	position:relative;
	width:120px;
	height:30px;
	z-index:6;
	left: 50%;
	top: -223%;
}
</style>
</head>
<body>
<div class="header"><img src="images/organization.jpg" width="100%" height="600" />
  <div id="ClubTeacher"><a href="ClubTeacher.php"><img src="images/nodeorganzie.gif" width="100%" /></a></div>
<div id="ClubAnnouncement"><a href="ClubAnnouncement.php"><img src="images/PenAnnouncement.gif" width="100%" /></a></div>
<div id="ClubActivity"><a href="ClubActivity.php"><img src="images/PenClubActivity.gif" width="100%" /></a></div>
<div id="ElementIntroduction"><a href="ElementIntroduction.php"><img src="images/PenElementIntro.gif" width="100%" /></a></div>
<div id="Login"><a href="Login.php"><img src="images/PenManagement.gif" width="100%" /></a></div>
<div class="list">
	<div class="menu">
		<ul>
			<li> <a href="#">幹部介紹</a>
				<ul>
					<li><a href="ClubTeacher.php">老師介紹</a></li>
					<li><a href="ClubHistory.php">社團歷史</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<div id="apDiv7">
<?php
		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
		$PID = htmlspecialchars($_GET["PID"]);
		if($PID != NULL)
		{
			$sql = "select PID,CName,Jobs from Position where PID=$PID;";
			$rs2 = @new COM("ADODB.RecordSet");
			$rs2->Open($sql,$conn,1,3);
			echo '<h1>'.iconv("big5","UTF-8",$rs2['CName']).'</h1><br>';
			echo '<p>'.iconv("big5","UTF-8",$rs2['Jobs']).'</p><br>';
		}
?>
</div>
<div id="apDiv8">
<a href="ClubPosition.php">選擇其他幹部</a>
</div>
</div>
<div class="content2"><img src="images/content.jpg" width="1024" height="100" /></div>
<div id="test" class="footer"><img src="images/bottom.jpg" width="1024" height="300" /></div>
</body>

