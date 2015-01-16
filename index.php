<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="shortcut icon" href="http://studentweb.ncnu.edu.tw/99321024/images/favicon.ico" type="image/x-icon" />
<link href="style.css" rel="stylesheet" type="text/css" />
<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
<style type="text/css">
#apDiv2 {
	position:absolute;
	width:1024px;
	height:650px;
	z-index:1;
	left: 80px;
	top: 0;
}
#apDiv4 {
	position:absolute;
	width:150px;
	z-index:2;
	left: 991px;
	top: 301px;
}
#apDiv5 {
	position:absolute;
	width:150;
	z-index:2;
	left: 978px;
	top: 353px;
}
#apDiv6 {
	position:absolute;
	width:150;
	z-index:2;
	left: 982px;
	top: 461px;
}
#apDiv7 {
	position:absolute;
	width:150;
	z-index:2;
	left: 996px;
	top: 323px;
}
#apDiv8 {
	position:absolute;
	width:150;
	z-index:2;
	left: 1011px;
	top: 246px;
}
#apDiv1 {
	position:absolute;
	width:150;
	z-index:2;
	left: 998px;
	top: 409px;
}
#apDiv3 {
	position: absolute;
	width: 400px;
	z-index: 2;
	left: 350px;
	top: 160px;
	height: 260px;
	border-color: #0000FF;
	background-color: rgba(255, 255, 255, 0.57);
}
</style>
<title>國立暨南國際大學管樂社</title>
<div id="apDiv2"><img src="images/peple.jpg" height="100%" /></div>
<div id="apDiv1"><a href="ElementIntroduction.php"><img src="images/PenElementIntro.gif" width="150" /></a></div>
<div id="apDiv4"><a href="ClubActivity.php"><img src="images/PenClubActivity.gif" width="140" /></a></div>
<div id="apDiv6"><a href="Login.php"><img src="images/PenManagement.gif" width="150" /></a></div>
<div id="apDiv8"><a href="ClubAnnouncement.php"><img src="images/PenAnnouncement.gif" width="150" /></a></div>
<div id="apDiv5"><a href="ClubTeacher.php"><img src="images/nodeorganzie.gif" width="150" /></a></div>
<div id="apDiv3" class="Announcement">	<?php
		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
		
		$sql = "select Top 6 AID,CID,Title,StartDay from Announcement  order by AID DESC;";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3); 
		$num = $rs->recordcount();
		for($i=0 ; $i<(int)$num ; $i++)
		{
			$sql2 = "select Name from Class where CID=".iconv("big5","UTF-8",$rs['CID']).";";
			$rs2 = @new COM("ADODB.RecordSet");
			$rs2->Open($sql2,$conn,1,3); 
			
			echo '<p><a href="ClubAnnouncementShow.php?AID='.iconv("big5","UTF-8",$rs['AID']).'">[';
			echo substr(iconv("big5","UTF-8",$rs['StartDay']),5,5);
			echo ']['.iconv("big5","UTF-8",$rs2['Name']).']'.iconv("big5","UTF-8",$rs['Title']).'</a></p><br>';
			$rs->MoveNext();
		}
		//當使用多筆資料查詢時，可以使用$rs->MoveNext();  來跳換下一筆資料
	?></div>

</html>