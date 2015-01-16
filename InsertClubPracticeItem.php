<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增團練通知</title>

</head>
<?php include("header.php") ?>
<body>
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
		<form id="form1" name="form1" method="post" action="InsertClubPracticeItemSQL.php">
		<p>新增團練通知</p>
		<p><label >練習時間：</label>
        <select name="YYYY"	id="YYYY">
		<?php
			for($x=(int)date("Y") ; $x<(int)date("Y")+2 ; $x++){
				echo '<option value="'.$x.'">'.$x."</option>\n";
			}
		?>
		</select>
		<select name="MM"	id="MM">
		<?php
			for($x=1 ; $x<=12 ; $x++){
				if($x == (int)date("m"))
					echo '<option selected value="'.$x.'">'.$x."</option>\n";
				else
					echo '<option value="'.$x.'">'.$x."</option>\n";
			}
		?>
		</select>
		<select name="DD"	id="DD">
		<?php
			for($x=1 ; $x<=31 ; $x++){
				if($x == (int)date("d"))
					echo '<option selected value="'.$x.'">'.$x."</option>\n";
				else
					echo '<option value="'.$x.'">'.$x."</option>\n";
			}
		?>
		</select>
		<select name="TT"	id="TT">
			<option value="14:00">14:00</option>
			<option value="18:30">18:30</option>
		</select>
		<p><label for="Place">地點</label>
        <input type="text" name="Place" id="Place" value="學生活動中心 團練室"/></p>
		 <input type="submit" name="CheckBtn" id="CheckBtn" value="送出" />
         <input type="button" name="CancelBtn" id="CancelBtn" value="取消" onclick="javascript:location.href='ManagementSystem.php'"/>
		</form>
	</td>
  </tr>
</table>
</body>