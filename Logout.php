<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登出....</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php include("header.php") ?>


<?php
//將session清空
unset($_SESSION['account']);
unset($_SESSION['MID']);
echo '登出中......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=Login.php>';
?>