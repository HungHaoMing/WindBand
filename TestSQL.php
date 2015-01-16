<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php
	$db_file = "app_data\\ClubSystem.mdb";
	$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
	$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
	if($conn->Open($connstr))
		die("無法連接至Access資料庫");
	
	//判斷帳號密碼是否為空值
	//確認密碼輸入的正確性 
	//新增資料進資料庫語法
	$sql = "
select Attend,Why,MemberID,PracticeDay from MemberAttendPractice where PracticeDay='2013/12/4 18:30:00';";
	$rs = @new COM("ADODB.RecordSet");
	echo $sql.'<br>';
    $rs->Open($sql,$conn,1,3);//搜尋資料庫資料表  
    $num = $rs->recordcount();//取得指標總數目
	echo $num;
	//當使用多筆資料查詢時，可以使用$rs->MoveNext();  來跳換下一筆資料  ".$rs["MemberID"]."
	
?>