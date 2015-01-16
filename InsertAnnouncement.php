
<?php session_start(); ?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增公告</title>

</head>
<?php include("header.php") ?>
<body>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js" type="text/javascript"><!--mce:2--></script>
<table width="1000" border="2">
  <tr>
	<td width="1000">
		<?php
		//此判斷為判定觀看此頁有沒有權限
		//說不定是路人或不相關的使用者
		//因此要給予排除
		if($_SESSION['account'] == null)
		{
			echo '請先登入謝謝！';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=Login.php>';
		}
		?>
		<form id="form1" name="form1" method="post" action="InsertAnnouncementSQL.php">
		<p>新增公告</p>
        <p><label for="CID">類別：</label>
        <select name="CID" id="CID">
		<?php
			$db_file = "app_data\\ClubSystem.mdb";
			$conn = @new COM("ADODB.Connection", NULL, CP_UTF8)  or die ("無法建立COM元件!");
			$connstr = "DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".realpath($db_file);
			if($conn->Open($connstr))
				die("無法連接至Access資料庫");
			$sql = "select CID,Name from Class;";
			$rs = @new COM("ADODB.RecordSet");
			$rs->Open($sql,$conn,1,3);//搜尋資料庫資料表 
			$num = $rs->recordcount();
			for($x=0 ; $x<$num ; $x++)
			{
				echo "<option value=".iconv("big5","UTF-8",$rs['CID']).'>'.iconv("big5","UTF-8",$rs['Name'])."</option>\n";
				$rs->MoveNext();
			}
		?>
        </select>
		<p><label for="Title">標題：</label>
        <input type="text" name="Title" id="Title"/></p>
		<p><label for="StartDay">開始時間：</label>
		<select name="SYYYY" id="SYYYY">
			<?php
				for($x=(int)date("Y") ; $x<(int)date("Y")+5 ; $x++)
					echo '<option value="'.$x.'">'.$x."</option>\n";
			?>
		</select>
		<select name="SMM" id="SMM">
			<?php
				for($x=1 ; $x<=12; $x++)
				{
					if((int)date("n") == $x)
						echo '<option selected value="'.$x.'">'.$x."</option>\n";
					else
						echo '<option value="'.$x.'">'.$x."</option>\n";
				}
			?>
		</select>
		<select name="SDD" id="SDD">
			<?php
				for($x=1 ; $x<=31; $x++)
				{
					if((int)date("j") == $x)
						echo '<option selected value="'.$x.'">'.$x."</option>\n";
					else
						echo '<option value="'.$x.'">'.$x."</option>\n";
				}
			?>
		</select>
		<p><label for="EndDay">結束時間：</label>
		<select name="EYYYY" id="EYYYY">
			<?php
				for($x=(int)date("Y") ; $x<(int)date("Y")+5 ; $x++)
					echo '<option value="'.$x.'">'.$x."</option>\n";
			?>
		</select>
		<select name="EMM" id="EMM">
			<?php
				for($x=1 ; $x<=12; $x++)
				{
					if((int)date("n") == $x)
						echo '<option selected value="'.$x.'">'.$x."</option>\n";
					else
						echo '<option value="'.$x.'">'.$x."</option>\n";
				}
			?>
		</select>
		<select name="EDD" id="EDD">
			<?php
				for($x=1 ; $x<=31; $x++)
				{
					if((int)date("j") == $x)
						echo '<option selected value="'.$x.'">'.$x."</option>\n";
					else
						echo '<option value="'.$x.'">'.$x."</option>\n";
				}
			?>
		</select>
		<p>內容：</p>
		<p><textarea id="AnnouncementContent" class="ckeditor" cols="80" rows="30" name="AnnouncementContent"></textarea></p>
		<script type="text/javascript">
			CKEDITOR.replace( "AnnouncementContent",{
			uiColor: "#14B8C4"  //指定的底色
			});
		</script>
		 <input type="submit" name="CheckBtn" id="CheckBtn" value="送出" />
         <input type="button" name="CancelBtn" id="CancelBtn" value="取消" onclick="javascript:location.href=\'ManagementSystem.php\'"/>
		 ps.新增後會將您的姓名及Email作為聯絡資訊！
		</form>
	</td>
  </tr>
</table>
</body>