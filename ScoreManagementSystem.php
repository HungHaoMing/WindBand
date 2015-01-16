<?php session_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>存譜管理系統</title>
<script src="js/jquery.js" type="text/javascript"></script>
</head>

<body>

<script>
//global
var state=1;
function newInsert(){
	var DIV='subDiv';
	document.getElementById(DIV).innerHTML = 
		"<form method=\"post\" enctype=\"multipart/form-data\" action=\"InsertScoreSQL.php\" >"+
		"<table id=\"tableInsert\" border=\"1\">"+
		"<tr><td>編號</td><td><input type=text size=\"50\" name=\"Number\" value=\"\"></td></tr>"+
		"<tr><td>原名</td><td><input type=text size=\"50\" name=\"OriginalName\" value=\"\"></td></tr>"+
		"<tr><td>中文名稱</td><td><input type=text size=\"50\" name=\"ChineseName\" value=\"\"></td></tr>"+
		"<tr><td>作曲</td><td><input type=text size=\"50\" name=\"Author\" value=\"\"></td></tr>"+
		"<tr><td>編曲</td><td><input type=text size=\"50\" id=\"Arranger\" name=\"Arranger\" value=\"\"></td></tr>"+
		"<tr><td>曾使用時間</td><td><input type=text size=\"50\" name=\"WhenUse\" value=\"\"></td></tr>"+
		"<tr><td>原始檔案</td><td><input id=\"Source\" name=\"Source\" type=\"file\" ></td></tr>"+
		"<tr><td>入手時間</td><td><input type=date size=\"50\" name=\"GetDay\" value=\"\"></td></tr>"+
		"<tr><td>來源</td><td><input type=text size=\"50\" name=\"GetSource\" value=\"\"></td></tr>"+
		"<tr><td>總譜狀態</td><td><input type=text size=\"50\" name=\"ScoreState\" value=\"\"></td></tr>"+
		"<tr><td>等級</td><td><input type=number size=\"50\" name=\"Level\" value=\"\"></td></tr>"+
		"<tr><td>示範帶</td><td><input type=url size=\"50\" name=\"Music\" value=\"\"></td></tr>"+
		"<tr><td>備註</td><td><input type=text size=\"50\" name=\"Note\" value=\"\"></td></tr>"+
		"</table>"+
		"<input type=\"submit\" value=\"送出\">"+
		"<input type=\"reset\" value=\"重新設定\">"+
		"<input type=\"button\" onclick=\"cancelInsert()\" value=\"取消\">"+
		"</form>";
}

function cancelInsert()
{
	var DIV='subDiv';
	document.getElementById(DIV).innerHTML = "";
}

function loadMsg(id,event,bool) {
	
	if(bool){
		$.ajax({
				url: 'ViewScore.php',
				dataType: 'html',
				type: 'POST',
				data: { id: id},
				error: function(xhr) {
					$('#'+DIV).html(xhr);
					},
				success: function(response) {
					//console.log(response);
					var tbl1 = document.getElementById("table1");
					var rIndex = event.srcElement.parentElement.parentElement.rowIndex;
					var oTr=tbl1.insertRow(rIndex+1);
					oTr.insertCell();//colspan=2
					var oTd = oTr.insertCell();
					oTd.setAttribute("colspan",6);
					oTd.innerHTML = response;
					//$('#'+DIV).html(response); //set the html content of the object msg
					event.srcElement.setAttribute("onclick","loadMsg("+id+",event,false)");
					}
			});
	}
	else{
		var index = window.document.activeElement.parentElement.parentElement.rowIndex;
		var tbl1 = document.getElementById("table1");
		tbl1.deleteRow(index+1);
		window.document.activeElement.setAttribute("onclick","loadMsg("+id+",event,true)");
	}
}

function deleteMsg(id,event)
{
	var tbl1 = document.getElementById("table1");
	var parentnum = event.srcElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.rowIndex-1;
//	var num = event.srcElement.parentElement.parentElement.cells[0].innerText;
//	var name = event.srcElement.parentElement.parentElement.cells[1].innerText;
	var num = document.getElementById("table1").rows[parentnum].cells[0].innerText;
	var name = document.getElementById("table1").rows[parentnum].cells[1].innerText
	if(confirm("您確定要刪除編號："+num+"名字："+name+"的資料嗎？"))
	{
		$.ajax({
			url: 'DeleteScoreSQL.php',
			dataType: 'html',
			type: 'POST',
			data: { SID: id},
			error: function(xhr) {
				$('#'+DIV).html(xhr);
				},
			success: function(response) {
				//console.log(response);
				var index = parentnum+1;
				tbl1.deleteRow(index);
				tbl1.deleteRow(parentnum);
				}
		});
	}
}

function Search()
{
	ReSearch();
	var table = document.getElementById("table1");
	var searchText = document.getElementById("search").value;
	var num = document.getElementById("table1").rows.length;
	var selected = 1;
	if(document.getElementById("searchSelect").value == "編號")
	{
		selected = 0;
	}
	else if(document.getElementById("searchSelect").value == "原文名稱")
	{
		selected = 1;
	}
	else if(document.getElementById("searchSelect").value == "中文名稱")
	{
		selected = 2;
	}
	else if(document.getElementById("searchSelect").value == "作者")
	{
		selected = 3;
	}
	else if(document.getElementById("searchSelect").value == "編者")
	{
		selected = 4;
	}
	state = selected;
	if(searchText != "")
	{
		for(var i=1 ; i<num ; i++)
		{
			//strip_tags()
			//console.log(document.getElementById("table1").rows[i].cells[selected].innerText.indexOf(searchText) + document.getElementById("table1").rows[i].cells[selected].innerText);
			if(document.getElementById("table1").rows[i].cells[selected].innerText.indexOf(searchText) >= 0)
			{
				document.getElementById("table1").rows[i].cells[selected].innerHTML = document.getElementById("table1").rows[i].cells[selected].innerText;
				var arr = document.getElementById("table1").rows[i].cells[selected].innerText.split(searchText);
				//<font color="blue">文字顏色為藍色</font>
				document.getElementById("table1").rows[i].cells[selected].innerHTML = arr[0] + "<font color=\"red\">" + searchText + "</font>" + arr[1];
				document.getElementById("table1").rows[i].style.display = "table-row";
			}
			else
			{
				document.getElementById("table1").rows[i].style.display = "none";
			}
		}
	}
	
}

function ReSearch()
{
	var num = document.getElementById("table1").rows.length;
	for(var i=1 ; i<num ; i++)
	{
		document.getElementById("table1").rows[i].cells[state].innerHTML = document.getElementById("table1").rows[i].cells[state].innerText;
		document.getElementById("table1").rows[i].style.display = "table-row";	
	}
}

function TableMouseOver()
{
	event.srcElement.parentElement.style.background = "#FFFFBB";
}

function TableMouseOut()
{
	event.srcElement.parentElement.style.background = "white";
}
</script>

<?php 
if(@$_SESSION['account'] == null)
{
	echo '<div align=center>請先登入謝謝！</div>';
	echo '<meta http-equiv=REFRESH CONTENT=2;url=Login.php>';
	return;
}
require_once("DB_config_MySQL.php");
require_once("DB_Class_MySQL.php");
$db = new DBMySQL();
$db->connect_db($_DBMySQL['host'], $_DBMySQL['username'], $_DBMySQL['password'], $_DBMySQL['dbname'],'0');
$db->query("set names utf8");
$data=$db->query("select SID,Number,OriginalName,ChineseName,Author,Arranger from score order by Number");

?>
<div style="text-align:center;">
<div id="allDiv" style="margin:0 auto;text-align:center;">
<input type="text" id="search" style="width:350px;">
<select id="searchSelect">
<option>編號</option>
<option selected>原文名稱</option>
<option>中文名稱</option>
<option>作者</option>
<option>編者</option>
</select>
<input type="button" onclick="Search()" value="搜尋">
<input type="button" onclick="ReSearch()" value="上一層">
<input type="button" onclick="newInsert()" value="新增">

<div id="subDiv"></div>
<table id="table1" border="1" width="1000" style="margin:0 auto;">
<tr>
<td>編號</td>
<td>原文名稱</td>
<td width="100px">中文名稱</td>
<td>作者</td>
<td>編者</td>
<td>詳</td>
</tr>
<?php

for($i=1;$i<=mysql_num_rows($data);$i++)
{ $rs=mysql_fetch_array($data);
?><tr onmouseover="TableMouseOver(event)" onmouseout="TableMouseOut()">
<td><?php echo $rs["Number"]?></td>
<td><?php echo $rs["OriginalName"]?></td>
<td><?php echo $rs["ChineseName"]?></td>
<td><?php echo $rs["Author"]?></td>
<td><?php echo $rs["Arranger"]?></td>
<td><input type="button" value="詳" onclick="loadMsg(<?php echo  $rs["SID"];?>,event,true)" style="width:30px"></td>

</tr>
<?php }?>


</table>
</div>
</div>
</html>
</body>