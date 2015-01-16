<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改個人資料</title>

</head>
<?php include("header.php") ?>
<body>
<?php
if($_SESSION['account'] == null)
{
	echo '請先登入謝謝！';
	echo '<meta http-equiv=REFRESH CONTENT=2;url=Login.php>';
}

	
?>
</body>