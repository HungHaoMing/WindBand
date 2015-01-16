<?php session_start(); ?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>建立社團分部</title>

</head>
<?php include("header.php") ?>
<body>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="ckeditor/ckeditor.js" type="text/javascript"><!--mce:2--></script>
<table width="1000" border="2">
  <tr>
	<td width="1000">
		<form id="form1" name="form1" method="post" action="InsertSegmentSQL.php">
		<p>建立分部</p>
        <p><label for="CName">中文名稱：</label>
        <input type="text" name="CName" id="CName" /></p>
		<p>分部介紹：</p>
		<p><textarea id="Description" class="ckeditor" cols="80" rows="30" name="Description"></textarea></p>
		 <input type="submit" name="CheckBtn" id="CheckBtn" value="送出" />
         <input type="button" name="CancelBtn" id="CancelBtn" value="取消">
		</form>
	</td>
  </tr>
</table>
</body>