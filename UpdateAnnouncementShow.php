<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改公告</title>

</head>
<?php include("header.php") ?>
<body>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js" type="text/javascript"><!--mce:2--></script>
<div Class="content">
<table width="1000" border="2">
  <tr>
	<td width="1000">
	<?php
		if($_SESSION['account'] == null)
		{
			echo '請先登入謝謝！';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=Login.php>';
		}
				
		$db_file = "app_data\\ClubSystem.mdb";
		$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
		$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
		if($conn->Open($connstr))
			die("無法連接至Access資料庫");
		$AID = htmlspecialchars($_GET["AID"]);
		//判斷帳號密碼是否為空值
		//確認密碼輸入的正確性 
		//新增資料進資料庫語法
		$id = $_SESSION['account'];
		$sql2 = "select account,MemberID from Member where account='$id';";
		$rs2 = @new COM("ADODB.RecordSet");
		$rs2->Open($sql2,$conn,1,3);
		$MemberID = iconv("big5","UTF-8",$rs2['MemberID']);
		
		if($id == 'admin')
			$sql = "select * from Announcement where AID=$AID";
		else
			$sql = "select * from Announcement where AID=$AID and MemberID='$MemberID';";
		$rs = @new COM("ADODB.RecordSet");
		$rs->Open($sql,$conn,1,3);//搜尋資料庫資料表   
		$num = $rs->recordcount();//取得指標總數目
		if($num == 0)
		{
			echo "此網頁您無權觀看！";
			die('<meta http-equiv=REFRESH CONTENT=2;url=UpdateAnnouncement.php>');
		}
		echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"UpdateAnnouncementSQL.php\">";
		echo "<p>修改公告</p>";
		echo "<p><label for=\"AID\">文章編號：</label>";
		echo "<input type=\"text\" name=\"AID\" id=\"AID\" value=\"".iconv("big5","UTF-8",$rs['AID'])."\"readonly=\"readonly\"/>(此欄位不可修改！)</p>";
        echo "<p><label for=\"CID\">類別</label>";
        echo " <select name=\"CID\" id=\"CID\">";
		
		$sql3 = "select CID,Name from Class;";
		$rs3 = @new COM("ADODB.RecordSet");
		$rs3->Open($sql3,$conn,1,3);
		$num = $rs3->recordcount();
		for($x=0 ; $x<$num ; $x++)
		{
			if($rs3['CID'] == $rs['CID'])
				echo "<option selected value=".iconv("big5","UTF-8",$rs3['CID']).'>'.iconv("big5","UTF-8",$rs3['Name'])."</option>\n";
			else
				echo "<option value=".iconv("big5","UTF-8",$rs3['CID']).'>'.iconv("big5","UTF-8",$rs3['Name'])."</option>\n";
			$rs3->MoveNext();
		}

        echo "</select>";
		
		echo "<p><label for=\"Title\">標題</label>";
        echo "<input type=\"text\" name=\"Title\" id=\"Title\" value=\"".iconv("big5","UTF-8",$rs['Title'])."\"/></p>";
		
		echo "<p><label for=\"StartDay\">開始時間：</label>";
		echo "<select name=\"SYYYY\" id=\"SYYYY\">";
		for($x=(int)date("Y") ; $x<(int)date("Y")+5 ; $x++){
			if( (int)substr($rs['StartDay'],0,4) == $x)
				echo '<option selected value="'.$x.'">'.$x."</option>\n";
			else
				echo '<option value="'.$x.'">'.$x."</option>\n";
		}
		echo "</select>";
		echo "<select name=\"SMM\" id=\"SMM\">";
		for($x=1 ; $x<=12; $x++)
		{
			if((int)substr($rs['StartDay'],5,2) == $x)
				echo '<option selected value="'.$x.'">'.$x."</option>\n";
			else
				echo '<option value="'.$x.'">'.$x."</option>\n";
		}

		echo "</select>";
		echo "<select name=\"SDD\" id=\"SDD\">";
		for($x=1 ; $x<=31; $x++)
		{
			if((int)substr($rs['StartDay'],8,2) == $x)
				echo '<option selected value="'.$x.'">'.$x."</option>\n";
			else
				echo '<option value="'.$x.'">'.$x."</option>\n";
		}
		echo "</select>";
		
		echo "<p><label for=\"EndDay\">結束時間：</label>";
		echo "<select name=\"EYYYY\" id=\"EYYYY\">";
		for($x=(int)date("Y") ; $x<(int)date("Y")+5 ; $x++){
			if( (int)substr($rs['EndDay'],0,4) == $x)
				echo '<option selected value="'.$x.'">'.$x."</option>\n";
			else
				echo '<option value="'.$x.'">'.$x."</option>\n";
		}
		echo "</select>";
		echo "<select name=\"EMM\" id=\"EMM\">";
		for($x=1 ; $x<=12; $x++)
		{
			if((int)substr($rs['EndDay'],5,2) == $x)
				echo '<option selected value="'.$x.'">'.$x."</option>\n";
			else
				echo '<option value="'.$x.'">'.$x."</option>\n";
		}

		echo "</select>";
		echo "<select name=\"EDD\" id=\"EDD\">";
		for($x=1 ; $x<=31; $x++)
		{
			if((int)substr($rs['EndDay'],8,2) == $x)
				echo '<option selected value="'.$x.'">'.$x."</option>\n";
			else
				echo '<option value="'.$x.'">'.$x."</option>\n";
		}
		echo "</select>";
		
		echo "<p>內容：</p>";
		echo "<p><textarea id=\"Content\" class=\"ckeditor\" cols=\"80\" rows=\"30\" name=\"Content\">";
		echo iconv("big5","UTF-8",$rs['Content']);
		echo "</textarea></p>";
		echo " <input type=\"submit\" name=\"CheckBtn\" id=\"CheckBtn\" value=\"修改\" />";
        echo " <input type=\"button\" name=\CancelBtn\" id=\"CancelBtn\" value=\"取消\" onclick=\"javascript:location.href='UpdateAnnouncement.php'\"/>";
		echo " </form>";
		
	?>
		<script type="text/javascript">
			CKEDITOR.replace( "Content",{
			uiColor: "#14B8C4"
			});
		</script>
	</td>
  </tr>
</table>
</body>
</div>