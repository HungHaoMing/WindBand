<?php
	$db_file = "app_data\\ClubSystem.mdb";
	$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
	if($conn->Open($connstr))
		die("無法連接至Access資料庫");
	$AID = htmlspecialchars($_GET["AID"]);
	
	$sql = "select * from Announcement where AID=$AID;";
	$rs = @new COM("ADODB.RecordSet");
	$rs->Open($sql,$conn,1,3);
	
	$sql2 = "select Name from Class where CID=".iconv("big5","UTF-8",$rs['CID']).";";
	$rs2 = @new COM("ADODB.RecordSet");
	$rs2->Open($sql2,$conn,1,3);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo iconv("big5","UTF-8",$rs['Title']); ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="style2.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#apDiv7 {
	position:relative;
	width:520px;
	height:100%;
	z-index:6;
	left: 17%;
	top: -117%;
}
#Announcement{
position: relative;
margin-top: -67%;
margin-right: 17%;
}
</style>
</head>

<body>

<div class="header"><img src="images/announcement.jpg" width="100%" height="600" />
<div id="ClubTeacher"><a href="ClubTeacher.php"><img src="images/nodeorganzie.gif" width="100%" /></a></div>
<div id="ClubAnnouncement"><a href="ClubAnnouncement.php"><img src="images/PenAnnouncement.gif" width="100%" /></a></div>
<div id="ClubActivity"><a href="ClubActivity.php"><img src="images/PenClubActivity.gif" width="100%" /></a></div>
<div id="ElementIntroduction"><a href="ElementIntroduction.php"><img src="images/PenElementIntro.gif" width="100%" /></a></div>
<div id="Login"><a href="Login.php"><img src="images/PenManagement.gif" width="100%" /></a></div>
<div id="Announcement">
<table width="650" border="2">
  <tr>
	<td width="650">
	<?php
		echo '<h1>[';
		echo substr(iconv("big5","UTF-8",$rs['StartDay']),5,5);
		echo ']['.iconv("big5","UTF-8",$rs2['Name']).']'.iconv("big5","UTF-8",$rs['Title']).'</h1><br>';
		echo '<p>'.iconv("big5","UTF-8",$rs['Content']).'</p><br><br>';
		echo '<p>'.iconv("big5","UTF-8",$rs['Contact']).'</p><br><br>';
	?>
	</td>
  </tr>
</table>
</div>


</div>


</body>
