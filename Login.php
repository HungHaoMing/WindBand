<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員登入</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<style  type="text/css">
fieldset {
	border:0;
	padding:10px;
	margin-bottom:
	10px;background:#EEE;

	border-radius: 8px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;

	background:-webkit-liner-gradient(top,#EEEEEE,#FFFFFF);
	background:linear-gradient(top,#EFEFEF,#FFFFFF);

	box-shadow:3px 3px 10px #666;
	-moz-box-shadow:3px 3px 10px #666;
	-webkit-box-shadow:3px 3px 10px #666;

	position:relative;
	}

legend {
	padding:5px 10px;
	background-color:#4F709F;
	color:#FFF;

	border-radius:3px;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;

	box-shadow:2px 2px 4px #666;
	-moz-box-shadow:2px 2px 4px #666;
	-webkit-box-shadow:2px 2px 4px #666;

	position:absolute;
	left:10px;top:-11px;
	}
	
.input { 
  line-height:40px; 
}

.ps {
	font-size:16px;
	margin-left:20px;
}
</style>
<?php
	include("header.php");
	if(@$_SESSION['account'] != null)
	{
		echo '<meta http-equiv=REFRESH CONTENT=0;url=ManagementSystem.php>';
	}
?>
</br>
<form id="form1" name="form1" method="post" action="LoginSQL.php">
<fieldset style="width:600px;margin:0 auto">
	<legend>管樂社系統登入</legend><br/>
	<p class="input">帳號：<input type="email" name="Account" id="Account" Maxlength=100/></p>
    <p class="input">密碼：<input type="password" name="Passwd" id="Passwd" Maxlength=100/></p>
	<p class="input"><input type="submit" name="CheckBtn" id="CheckBtn"  value="登入"/>
    <input type="button" name="CancelBtn" id="CancelBtn" value="取消" onclick="javascript:location.href='index.php'"/></p>	
</fieldset>
</form></br>

<fieldset style="width:600px;margin:0 auto">
	<legend>帳號申請</legend><br/>
	<p class="ps"><a href="AccountApply.php">帳號申請</a></p>
</fieldset>
</body>
</html>