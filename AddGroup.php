<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>增加Group(開發時用)</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php include("header.php") ?>
<table width="468" border="2" id="ApplyTable">
  <tr>
	<td width="389">
		<form name="form" method="post" action="AddGroupSQL.php">
		<p>GID(int)<input type="text" name="GID" /></p>
		<p>Name(中文)<input type="text" name="Name" /></p>
		<p>描述<input type="text" name="Description" /></p>
		<p><input type="submit" name="button" value="登入" />
	</form>
	</td>
  </tr>
</table>