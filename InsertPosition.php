<?php session_start(); ?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>建立社團幹部</title>

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
		<form id="form1" name="form1" method="post" action="InsertPositionSQL.php">
		<p>建立幹部</p>
        <p><label for="CName">中文名稱：</label>
        <input type="text" name="CName" id="CName" /></p>
		<p>幹部工作：</p>
		<p><textarea id="Jobs" class="ckeditor" cols="80" rows="30" name="Jobs"></textarea></p>
		<script type="text/javascript">
			CKEDITOR.replace( "Jobs",{
			uiColor: "#14B8C4"  //指定的底色
			});
		</script>
		 <input type="submit" name="CheckBtn" id="CheckBtn" value="送出" />
         <input type="button" name="CancelBtn" id="CancelBtn" value="取消" onclick="javascript:location.href=\'ManagementSystem.php\'"/>
		</form>
	</td>
  </tr>
</table>
</body>