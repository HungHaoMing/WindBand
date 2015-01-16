<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改譜本資訊</title>
<script src="js/jquery.js" type="text/javascript"></script>
</head>
<script>
</script>
<body>
<?php 
require_once("DB_config_MySQL.php");
require_once("DB_Class_MySQL.php");
$db = new DBMySQL();
$db->connect_db($_DBMySQL['host'], $_DBMySQL['username'], $_DBMySQL['password'], $_DBMySQL['dbname'],'0');
$db->query("set names utf8");
$id=(int)$_REQUEST['SID'];
$sql="select SID,Number,OriginalName,ChineseName,Author,Arranger,Source,GetDay,GetSource,Level,Music,WhenUse,ScoreState,Note,UpdateTime from score where SID=" . $id . ";";
$data=$db->query($sql);
$rs=mysql_fetch_array($data);
?>
<div id="subDiv"></div>
<form method="post" enctype="multipart/form-data" action="UpdateScoreSQL.php" >
<table id="table1" border="1">
<tr><td>編號</td><td><input type=text size="50" name="Number" value="<?php echo $rs['Number'];?>"></td></tr>
<tr><td>原名</td><td><input type=text size="50" name="OriginalName" value="<?php echo $rs['OriginalName']; ?>"></td></tr>
<tr><td>中文名稱</td><td><input type=text size="50" name="ChineseName" value="<?php echo  $rs['ChineseName'];?>"></td></tr>
<tr><td>作曲</td><td><input type=text size="50" name="Author" value="<?php echo  $rs['Author'];?>"></td></tr>
<tr><td>編曲</td><td><input type=text size="50" id="Arranger" name="Arranger" value="<?php echo $rs['Arranger'];?>"></td></tr>
<tr><td>曾使用時間</td><td><input type=text size="50" name="WhenUse" value="<?php echo $rs['WhenUse'];?>"></td></tr>
<tr><td>原始檔案</td><td>
<?php 
	if( $rs['Source'] != "")
	{
		echo "<a href=\"ScoreFiles/".$rs['Source'] ."\" target=_blank>".$rs['Source']."</a><br/>"; 
		echo "上傳新檔案：<input id=\"Source\" name=\"Source\" type=\"file\" >";
	}
	else
	{
		echo "<input id=\"Source\" name=\"Source\" type=\"file\" >";
	}
?> </td></tr>
<tr><td>入手時間</td><td><input type=date size="50" name="GetDay" value="<?php echo  $rs['GetDay'];?>"></td></tr>
<tr><td>來源</td><td><input type=text size="50" name="GetSource" value="<?php echo  $rs['GetSource'];?>"></td></tr>
<tr><td>總譜狀態</td><td><input type=text size="50" name="ScoreState" value="<?php echo  $rs['ScoreState'];?>"></td></tr>
<tr><td>等級</td><td><input type=number size="50" name="Level" value="<?php echo $rs['Level'];?>"></td></tr>
<tr><td>示範帶</td><td><input type=url size="50" name="Music" value="<?php echo $rs['Music'];?>"></td></tr>
<tr><td>備註</td><td><input type=text size="50" name="Note" value="<?php echo $rs['Note'];?>"></td></tr>
<tr><td>上次修改時間</td><td><?php echo $rs['UpdateTime'];?></td></tr>
</table>
<input type="hidden" name="SID" value=<?php echo $rs['SID']; ?>>
<input type="submit" value="送出">
<input type="reset" value="重新設定">
</form>
</html>
</body>
