<?php 
require_once("DB_config_MySQL.php");
require_once("DB_Class_MySQL.php");
$db = new DBMySQL();
$db->connect_db($_DBMySQL['host'], $_DBMySQL['username'], $_DBMySQL['password'], $_DBMySQL['dbname'],'0');
$db->query("set names utf8");
$id=(int)$_REQUEST['id'];
$sql="select SID,Source,ScoreState,GetDay,GetSource,Level,Music,Note,WhenUse,UpdateTime from score where SID=" . $id . ";";
if ($results=$db->query($sql) ) {
	$rs=mysql_fetch_array($results);
?>
<table border=1>
<tr><td>原始檔案</td><td><?php if( $rs['Source'] != ""){ echo "<a href=\"ScoreFiles/".$rs['Source'] ."\" target=_blank>".$rs['Source']."</a>"; }?></td></tr>
	<tr><td>入手時間</td><td><?php echo  $rs['GetDay'];?></td></tr>
	<tr><td>來源</td><td><?php echo  $rs['GetSource'];?></td></tr>
	<tr><td>總譜狀態</td><td><?php echo  $rs['ScoreState'];?></td></tr>
	<tr><td>等級</td><td><?php echo $rs['Level'];?></td></tr>
	<tr><td>示範帶</td><td><?php if($rs['Music']!="") echo "<a  target=_blank href=\"". $rs['Music'] . "\">示範音樂</a>";?></td></tr>
	<tr><td>備註</td><td><?php echo $rs['Note'];?></td></tr>
	<tr><td>曾使用時間</td><td><?php echo $rs['WhenUse'];?></td></tr>
	<tr><td>最後修改時間</td><td><?php echo $rs['UpdateTime'];?></td></tr>
	<tr><td colspan=2><form action="UpdateScore.php" method="post"><input type="hidden" name="SID" value=<?php echo $rs['SID']; ?>><input name="submit" type="submit" value="修改"></form><input type="button" value="刪除" onclick="deleteMsg(<?php echo  $rs["SID"];?>,event)" style="width:40px"></td></tr>
</table>
<?php
}
?>

