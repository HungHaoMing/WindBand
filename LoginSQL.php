<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>會員登入</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php include("header.php") ?>
<div align=center>
<?php
	require_once("DB_config_MySQL.php");
	require_once("DB_Class_MySQL.php");
	$db = new DBMySQL();
	$db->connect_db($_DBMySQL['host'], $_DBMySQL['username'], $_DBMySQL['password'], $_DBMySQL['dbname'],'0');
	$db->query("set names utf8");


	$id = $_POST['Account'];
	$pw = $_POST['Passwd'];
	$sql = "select name,MemberID from member where account = '$id' and passwd = '$pw';";
	$db->query($sql);
	if ($results=$db->query($sql))
	{
		$rs=mysql_fetch_array($results);
		$name = $rs['name'];
		echo "歡迎$name 使用本系統";
		$_SESSION['account'] = $id;
		$_SESSION['MID'] = $rs['MemberID'];
		echo '<meta http-equiv=REFRESH CONTENT=2;url=ManagementSystem.php>';
	}
	else
	{
		echo '帳號密碼錯誤，請重新登入！';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=Login.php>';
	}
?>
</div>