<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>社團資料管理</title>
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
</head>
<?php include("header.php") ?>
<body>
<div class="content">
<?php
	if(@$_SESSION['account'] == null)
	{
		echo '請先登入謝謝！';
		echo '<meta http-equiv=REFRESH CONTENT=2;url=Login.php>';
	}
	else
	{
		?>
		</br>
		<fieldset style="width:600px;margin:0 auto">
		<legend>管樂社管理系統</legend><br/>
		<p class="ps"><a href="ScoreManagementSystem.php">存譜管理</a></p>
		</fieldset>

		</br>
		<fieldset style="width:600px;margin:0 auto">
		<legend>基本資料管理</legend><br/>
		<p class="ps"><a href="UpdateSelfData.php">修改基本資料</a></p>
		<p class="ps"><a href="Logout.php">登出</a></p>
		</fieldset>
		<?php
	}
?>
</div>
</body>
