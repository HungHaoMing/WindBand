<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>社團幹部</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="style2.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#apDiv7 {
	position:relative;
	width:522px;
	height:315px;
	z-index:6;
	left: 15%;
	top: -120%;
	
}
#apDiv7 a { color: #4D2078; PADDING-RIGHT: 2px; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; PADDING-TOP: 2px; background-color:#EEEBFF; height: 20px; width: 120px; text-align: center; ; border: #A498BD; border-style: outset; border-top-width: 2px; border-right-width: 2px; border-bottom-width: 2px; border-left-width: 2px;margin:3px 3px 3px 3px;}
#apDiv7 a:hover { BORDER-RIGHT: ##605080 1px outset; PADDING-RIGHT: 2px; BORDER-TOP: #605080 1px outset; PADDING-LEFT: 2px; PADDING-BOTTOM: 2px; BORDER-LEFT: #605080 1px outset; PADDING-TOP: 2px; BORDER-BOTTOM: #605080 1px outset;background-color:#BDAAE2; height: 20px; width: 120px; text-align: center;margin:3px 3px 3px 3px; } 
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
            <li> <a href="ClubPosition.php">幹部介紹</a>
              <ul>
                <li><a href="ClubTeacher.php">老師介紹</a></li>
                <li><a href="ClubHistory.php">社團歷史</a></li>
              </ul>
            </li>
          </ul>
        </div>
    </div>
    <div id="apDiv7">	<?php

		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
		
		//判斷帳號密碼是否為空值
		//確認密碼輸入的正確性 
		//新增資料進資料庫語法
		$sql = "select PID,CName from Position;";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);//搜尋資料庫資料表   
		$num = $rs->recordcount();//取得指標總數目
		$count=0;
		for($i=0 ; $i<(int)$num ; $i++)
		{
			echo '<a href=PositionIntroduction.php?PID='.iconv("big5","UTF-8",$rs['PID'])."><".iconv("big5","UTF-8",$rs['CName'])."></a>\n";
			$rs->MoveNext();
			$count++;
			if($count%4==0)
				echo "<br><br>";
		}
	?>
    </div>
</div>
<div class="content2"><img src="images/content.jpg" width="1024" height="100" /></div>
<div id="test" class="footer"><img src="images/bottom.jpg" width="1024" height="300" /></div>
</body>