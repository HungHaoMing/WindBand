<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>帳號申請</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php 
	include("header.php");
	require_once("DB_config_MySQL.php");
	require_once("DB_Class_MySQL.php");
	$db = new DBMySQL();
	$db->connect_db($_DBMySQL['host'], $_DBMySQL['username'], $_DBMySQL['password'], $_DBMySQL['dbname'],'0');
	$db->query("set names utf8");
		
	$EMail = $_GET['email'];//$Account = $_POST['Account'];
	$AuthenticationKey = $_GET['authkey'];

	
	$sql = "select Name from member where EMail='$EMail' and authenticationkey='$AuthenticationKey'";
	if($results=$db->query($sql) ) 
	{
		$rs=mysql_fetch_array($results);
		$sql2 = "update member set authentication=1 where account='$EMail' and email='$EMail';";
		$db->query($sql2);
		echo "<div align=center>帳號認證成功！</br>";
		echo "<a href=\"login.php\">登入<a></div>";
		
	}
	else
	{
		echo "<div align=center>驗證有誤。請聯繫管理員！</div>";
	}
	
?>