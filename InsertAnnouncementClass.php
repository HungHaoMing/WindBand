<?php session_start(); ?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增公告類別</title>

</head>
<?php include("header.php") ?>
<body>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js" type="text/javascript"><!--mce:2--></script>
<table width="1000" border="2">
  <tr>
	<td width="1000">
		<?php
		if($_SESSION['account'] == null)
		{
			echo '請先登入謝謝！';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=Login.php>';
		}
		?>
		<form id="form1" name="form1" method="post" action="InsertAnnouncementClassSQL.php">
		<p>新增公告類別</p>
		<p><label for="CID">CID</label>
        <input type="text" name="CID" id="CID"/></p>
		<p><label for="Name">內容</label>
        <input type="text" name="Name" id="Name"/></p>
		 <input type="submit" name="CheckBtn" id="CheckBtn" value="送出" />
         <input type="button" name="CancelBtn" id="CancelBtn" value="取消" onclick="javascript:location.href='ManagementSystem.php'"/>
		</form>
	</td>
  </tr>
</table>
</body>