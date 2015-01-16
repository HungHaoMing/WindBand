<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>帳號申請</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script>
function passwordChange()
{
	var passwd1 = document.getElementById("Passwd").value;
	var passwd2 = document.getElementById("Passwd2").value;
	var passwdPS = document.getElementById("passwdPS");
	if(passwd1 != passwd2)
	{
		passwdPS.innerHTML += "兩次輸入密碼不同喔！";
		document.getElementById("CheckBtn").disabled = true;
	}
	else
	{
		passwdPS.innerHTML = "";
		document.getElementById("CheckBtn").disabled = false;
	}
	
	if(passwd1.length < 8)
	{
		passwdPS.innerHTML += "密碼長度需大於8！";
		document.getElementById("CheckBtn").disabled = true;
	}
	else
	{
		passwdPS.innerHTML = "";
		document.getElementById("CheckBtn").disabled = false;
	}
}

function Check()
{
	if(form1.EMail.value == "" ||form1.Passwd.value == "" ||form1.Passwd2.value == "" ||form1.Name.value == "" ||form1.ID.value == "" ||form1.StudentID.value == "" ||form1.Phone.value == "" ||form1.Address.value == "" ||form1.ParentName.value == "" ||form1.ParentPhone.value == "" ||form1.Gender.value == "")
	{
		alert("上有欄位未填寫！");
	}
	else if(form1.Passwd.value.length < 8)
	{
		alert("密碼需大於八位數");
	}
	else
	{
		form1.submit();
	}
}

County = new Array("臺北市", "基隆市", "新北市", "宜蘭縣", "新竹市", "新竹縣", "桃園市", "苗栗縣", "臺中市", "彰化縣","南投縣", "嘉義市", "嘉義縣", "雲林縣", "臺南市", "高雄市","澎湖縣", "屏東縣", "臺東縣", "花蓮縣","金門縣", "連江縣", "南海諸島","釣魚台列嶼");

Zone = new Array(24);
// for "臺北市"
Zone[0] = new Array("中正區","大同區","中山區","松山區","大安區","萬華區","信義區","士林區","北投區","內湖區","南港區","文山區(木柵)","文山區(景美)");
// for "基隆市"
Zone[1] = new Array("仁愛區","信義區","中正區","中山區","安樂區","暖暖區","七堵區");
// for "新北市"
Zone[2] = new Array("萬里區","金山區","板橋區","汐止區","深坑區","石碇區","瑞芳區","平溪區","雙溪區","貢寮區","新店區","坪林區","烏來區","永和區","中和區","土城區","三峽區","樹林區","鶯歌區","三重區","新莊區","泰山區","林口區","蘆洲區","五股區","八里區","淡水區","三芝區","石門區");
// for "宜蘭縣"
Zone[3] = new Array("宜蘭市","頭城鎮","礁溪鄉","壯圍鄉","員山鄉","羅東鎮","三星鄉","大同鄉","五結鄉","冬山鄉","蘇澳鎮","南澳鄉");
// for "新竹市"
Zone[4] = new Array("");
// for "新竹縣"
Zone[5] = new Array("竹北市","湖口鄉","新豐鄉","新埔鄉","關西鎮","芎林鄉","寶山鄉","竹東鎮","五峰鄉","橫山鄉","尖石鄉","北埔鄉","峨嵋鄉");
// for "桃園縣"
Zone[6] = new Array("中壢區","平鎮區","龍潭區","楊梅區","新屋區","觀音區","桃園區","龜山區","八德區","大溪區","復興區","大園區","蘆竹區");
// for "苗栗縣"
Zone[7] = new Array("竹南鎮","頭份鎮","三灣鄉","南庄鄉","獅潭鄉","後龍鎮","通霄鎮","苑裡鎮","苗栗市","造橋鄉","頭屋鄉","公館鄉","大湖鄉","泰安鄉","鉰鑼鄉","三義鄉","西湖鄉","卓蘭鄉");
// for "臺中市"
Zone[8] = new Array("中區","東區","南區","西區","北區","北屯區","西屯區","南屯區","太平區","大里區","霧峰區","烏日區","豐原區","后里區","石岡區","東勢區","和平區","新社區","潭子區","大雅區","神岡區","大肚區","沙鹿區","龍井區","梧棲區","清水區","大甲區","外圃區","大安區");
// for "彰化縣"
Zone[9] = new Array("彰化市","芬園鄉","花壇鄉","秀水鄉","鹿港鎮","福興鄉","線西鄉","和美鎮","伸港鄉","員林鎮","社頭鄉","永靖鄉","埔心鄉","溪湖鎮","大村鄉","埔鹽鄉","田中鎮","北斗鎮","田尾鄉","埤頭鄉","溪州鄉","竹塘鄉","二林鎮","大城鄉","芳苑鄉","二水鄉");
// for "南投縣"
Zone[10] = new Array("南投市","中寮鄉","草屯鎮","國姓鄉","埔里鎮","仁愛鄉","名間鄉","集集鄉","水里鄉","魚池鄉","信義鄉","竹山鎮","鹿谷鄉");
// for "嘉義市"
Zone[11] = new Array("");
// for "嘉義縣"
Zone[12] = new Array("番路鄉","梅山鄉","竹崎鄉","阿里山鄉","中埔鄉","大埔鄉","水上鄉","鹿草鄉","太保市","朴子市","東石鄉","六腳鄉","新港鄉","民雄鄉","大林鎮","漢口鄉","義竹鄉","布袋鎮");
// for "雲林縣"
Zone[13] = new Array("斗南鎮","大埤鄉","虎尾鎮","土庫鎮","褒忠鄉","東勢鄉","臺西鄉","崙背鄉","麥寮鄉","斗六市","林內鄉","古坑鄉","莿桐鄉","西螺鎮","二崙鄉","北港鎮","水林鄉","口湖鄉","四湖鄉","元長鄉");
// for "臺南市"
Zone[14] = new Array("中西區","東區","南區","北區","安平區","安南區","永康區","歸仁區","新化區","左鎮區","玉井區","楠西區","南化區",
"仁德區","關廟區","龍崎區","官田區","麻豆區","佳里區","西港區","七股區","將軍區","學甲區","北門區","新營區","後壁區","白河區","東山區","六甲區","下營區","柳營區","鹽水區","善化區","大內區","山上區","新市區","安定區");
// for "高雄市"
Zone[15] = new Array("新興區","前金區","苓雅區","鹽埕區","鼓山區","旗津區","前鎮區","三民區","楠梓區","小港區","左營區","仁武區","大社區","岡山區","路竹區","阿蓮區","田寮區","燕巢區","橋頭區","梓官區","彌陀區","永安區","湖內區","鳳山區","大寮區","林園區","鳥松區","大樹區","旗山區","美濃區","六龜區","內門區","杉林區","甲仙區","桃源區","三民區","茂林區","茄萣區");
// for "澎湖縣"
Zone[16] = new Array("馬公市","西嶼鄉","望安鄉","七美鄉","白沙鄉","湖西鄉");
// for "屏東縣"
Zone[17] = new Array("屏東市","三地門鄉","霧臺鄉","瑪家鄉","九如鄉","里港鄉","高樹鄉","鹽埔鄉","長治鄉","麟洛鄉","竹田鄉","內埔鄉","萬丹鄉","潮州鎮","泰武鄉","來義鄉","萬巒鄉","嵌頂鄉","新埤鄉","南州鄉","林邊鄉","東港鎮","琉球鄉","佳冬鄉","新園鄉","枋寮鄉", "枋山鄉","春日鄉","獅子鄉","車城鄉","牡丹鄉","恆春鎮","滿州鄉");
// for "臺東縣"
Zone[18] = new Array("臺東市","綠島鄉","蘭嶼鄉","延平鄉","卑南鄉","鹿野鄉","關山鎮","海端鄉","池上鄉","東河鄉","成功鎮","長濱鄉","太麻里鄉","金峰鄉","大武鄉","達仁鄉");
// for "花蓮縣"
Zone[19] = new Array("花蓮市","新城鄉","秀林鄉","吉安鄉","壽豐鄉","鳳林鎮","光復鄉","豐濱鄉","瑞穗鄉","萬榮鄉","玉里鎮","卓溪鄉","富里鄉");
// for "金門縣"
Zone[20] = new Array("金沙鎮","金湖鎮","金寧鄉","金城鎮","烈嶼鄉","烏坵鄉");
// for "連江縣"
Zone[21] = new Array("南竿鄉","北竿鄉","莒光鄉","東引");
// for "南海諸島"
Zone[22] = new Array("東沙","西沙");
// for "釣魚台列嶼"
Zone[23] = new Array("");

ZipCode = new Array(24);
// for "臺北市"
ZipCode[0] = new Array("100","103","104","105","106","108","110","111","112","114","115","116","117");
// for "基隆市"
ZipCode[1] = new Array("200","201","202","203","204","205","206");
// for "新北市"
ZipCode[2] = new Array("207","208","220","221","222","223","224","226","227","228","231","232","233","234","235","236","237","238","239","241","242","243","244","247","248","249","251","252","253");
// for "宜蘭縣"
ZipCode[3] = new Array("260","261","262","263","264","265","266","267","268","269","270","272");
// for "新竹市"
ZipCode[4] = new Array("300");
// for "新竹縣"
ZipCode[5] = new Array("302","303","304","305","306","307","308","310","311","312","313","314","315");
// for "桃園縣"
ZipCode[6] = new Array("320","324","325","326","327","328","330","333","334","335","336","337","338");
// for "苗栗縣"
ZipCode[7] = new Array("350","351","352","353","354","356","357","358","360","361","362","363","364","365","366","367","368","369");
// for "臺中市"
ZipCode[8] = new Array("400","401","402","403","404","406","407","408","411","412","413","414","420","421","422","423","424","426","427","428","429","432","433","434","435","436","437","438","439");
// for "彰化縣"
ZipCode[9] = new Array("500","502","503","504","505","506","507","508","509","510","511","5112","513","514","515","516","520","521","522","523","524","525","526","527","528","530");
// for "南投縣"
ZipCode[10] = new Array("540","541","542","544","545","546","551","552","553","555","556","557","558");
// for "嘉義市"
ZipCode[11] = new Array("600");
// for "嘉義縣"
ZipCode[12] = new Array("602","603","604","605","606","607","608","611","612","613","614","615","616","621","622","623","624","625");
// for "雲林縣"
ZipCode[13] = new Array("630","631","632","633","634","635","636","637","638","640","643","646","647","648","649","651","652","653","654","655");
// for "臺南市"
ZipCode[14] = new Array("705","701","702","704","708","709","710","711","712","713","714","715","716","717","718","719","720","721","722","723","724","725","726","727","730","731","732","733","734","735","736","737","741","742","743","744","745");

// for "高雄市"
ZipCode[15] = new Array("800","801","802","803","804","805","806","807","811","812","813","814","815","820","821","822","823","824","825","826","827","828","829","830","831","832","833","840","842","843","844","845","846","847","848","849","851","852");
// for "澎湖縣"
ZipCode[16] = new Array("880","881","882","883","884","885");
// for "屏東縣"
ZipCode[17] = new Array("900","901","902","903","904","905","906","907","908","909","911","912","913","920","921","922","923","924","925","926","927","928","929","931","932","940","941","942","943","944","945","946","947");
// for "臺東縣"
ZipCode[18] = new Array("950","951","952","953","954","955","956","957","958","959","961","962","963","964","965","966");
// for "花蓮縣"
ZipCode[19] = new Array("970","971","972","973","974","975","976","977","978","979","981","982","983");
// for "金門縣"
ZipCode[20] = new Array("890","891","892","893","894","896");
// for "連江縣"
ZipCode[21] = new Array("209","210","211","212");
// for "南海諸島"
ZipCode[22] = new Array("817","819","290");
// for "釣魚台列嶼"
ZipCode[23] = new Array("290");


function initCounty(countyInput)
{
	countyInput.length = County.length;
	for (i = 0; i < County.length; i++) 
	{
		countyInput.options[i].value = County[i];
		countyInput.options[i].text = County[i];
	}
	countyInput.selectedIndex = 0;
}

function initZone(countyInput, zoneInput, post)
{
	changeZone(countyInput, zoneInput, post);
}

function initCounty2(countyInput, countyValue)
{
	countyInput.length = County.length;
	for (i = 0; i < County.length; i++) 
	{
		countyInput.options[i].value = County[i];
		countyInput.options[i].text = County[i];

		if (countyValue == County[i])
			countyInput.selectedIndex = i;
	}
}

function initZone2(countyInput, zoneInput, post, zoneValue)
{

	selectedCountyIndex = countyInput.selectedIndex;

	zoneInput.length = Zone[selectedCountyIndex].length;
	for (i = 0; i < Zone[selectedCountyIndex].length; i++) 
	{
		zoneInput.options[i].value = Zone[selectedCountyIndex][i];
		zoneInput.options[i].text = Zone[selectedCountyIndex][i];

		if (zoneValue == Zone[selectedCountyIndex][i])
			zoneInput.selectedIndex = i; 
	}
	showZipCode(countyInput, zoneInput, post);
}

function changeZone(countyInput, zoneInput, post) 
{
	selectedCountyIndex = countyInput.selectedIndex;

	zoneInput.length = Zone[selectedCountyIndex].length;
	for (i = 0; i < Zone[selectedCountyIndex].length; i++) 
	{
		zoneInput.options[i].value = Zone[selectedCountyIndex][i];
		zoneInput.options[i].text = Zone[selectedCountyIndex][i];
	}
	zoneInput.selectedIndex = 0;

	showZipCode(countyInput, zoneInput, post);
}

function showZipCode(countyInput, zoneInput, post) 
{
	post.value = ZipCode[countyInput.selectedIndex][zoneInput.selectedIndex];
}
</script>
<?php include("header.php"); ?>
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
<br/>
<form id="form1" name="form1" method="post" action="AccountApplySQL.php">
<fieldset style="width:600px;margin:0 auto">
	<legend>管樂社帳號申請</legend><br/>
    <!-- 帳號：<input name="Account" type="text" id="Account"/> -->
	<p class="ps" style="font-size:12px"><span style="color:red;">*</span>為必填之項目</p>
	<p class="input"><span style="color:red;">*</span>E-Mail：<input type="email" name="EMail" id="EMail" Maxlength=100/></p>
	<p class="ps">將會為登入之帳號，請盡量使用常用之信箱。</p>
    <p class="input"><span style="color:red;">*</span>密碼：<input type="password" name="Passwd" id="Passwd" Maxlength=100/></p>
    <p class="input"><span style="color:red;">*</span>確認密碼：<input type="password" name="Passwd2" id="Passwd2" onchange="passwordChange()" Maxlength=100/><p class="ps" id="passwdPS" style="color:red;"></p>
	</p>
</fieldset>

<br/>
<fieldset style="width:600px;margin:0 auto">
<legend>基本資料</legend><br/>
	<p class="input"><span style="color:red;">*</span>姓名：<input type="text" name="Name" id="Name"  Maxlength=50/></p>
	<p class="input"><span style="color:red;">*</span>身分證字號：<input type="text" name="ID" id="ID"  Maxlength=20/></p>
	<p class="ps">無身分證字號者，請填寫居留證號碼。</p>
	<p class="input"><span style="color:red;">*</span>學號：<input type="text" name="StudentID" id="StudentID"  Maxlength=10/></p>
	<p class="input"><span style="color:red;">*</span>性別：<input type="radio" name="Gender" value="M">男<input type="radio" name="Gender" value="F">女</p>
	<p class="input"><span style="color:red;">*</span>生日：<input type="date" name="Birthday" value="1990-01-01"></p>
	<p class="input"><span style="color:red;">*</span>電話：<input type="text" name="Phone" id="Phone"  Maxlength=15/></p>
	<p class="input"><span style="color:red;">*</span>地址：
	<input name="Zip" size="5" />
	<select name="City" onchange="changeZone(document.form1.City, document.form1.Canton, document.form1.Zip)" size="1"></select>
	<select name="Canton" onchange="showZipCode(document.form1.City, document.form1.Canton, document.form1.Zip)" size="1"></select>
	<input type="text" name="Address" id="Address"  Maxlength=200/></p>
	<p class="input"><span style="color:red;">*</span>就讀科系：
	<select name="CollegeSelect" id="CollegeSelect" onchange="renew(this.selectedIndex);">
	  <option value="人文學院">人文學院</option>
	  <option value="教育學院">教育學院</option>
	  <option value="科技學院">科技學院</option>
	  <option value="管理學院">管理學院</option>
	  <option value="其他">其他</option>
	</select>
	<select name="Department">
	  <option value="">請先選取學院 </option>
	</select></p>
    <p class="input"><span style="color:red;">*</span>部別：<select name="Play" id="Play">
	  <?php
		require_once("DB_config_MySQL.php");
		require_once("DB_Class_MySQL.php");
		$db = new DBMySQL();
		$db->connect_db($_DBMySQL['host'], $_DBMySQL['username'], $_DBMySQL['password'], $_DBMySQL['dbname'],'0');
		$db->query("set names utf8");
		$sql = "select SID,CName from segment;";
		if ($results=$db->query($sql) ) {
			while($rs=mysql_fetch_array($results))
			{
				echo '<option value="'.$rs['SID'].'">'.$rs['CName'].'</option>';
			}
		}
	
	  ?>
        </select></p>
	<p class="input"><span style="color:red;">*</span>身分：<input type="radio" name="graduate" value=0>在校生<input type="radio" name="graduate" value=1>校友</p>
</fieldset>

<br/>
<fieldset style="width:600px;margin:0 auto">
<legend>保險用資料</legend><br/>
	<p class="input"><span style="color:red;">*</span>監護人/緊急聯絡人姓名：<input type="text" name="ParentName" id="ParentName"  Maxlength=50/></p>
	<p class="input"><span style="color:red;">*</span>監護人/緊急聯絡人電話：<input type="text" name="ParentPhone" id="ParentPhone"  Maxlength=15/></p>
    <p class="input"><input type="button" name="CheckBtn" id="CheckBtn" value="送出" onclick="Check()" />
    <input type="button" name="CancelBtn" id="CancelBtn" value="取消" onclick="javascript:location.href='Login.php'"/>
    <input name="ClearBtn" type="reset" id="ClearBtn" value="重新填寫" /></p>
    
	
</fieldset>
</form></br>



</body>
	<script>
	Department=new Array();
	Department[0]=["中國語文學系","外國語文學系","社會政策與社會工作學系","公共行政與政策學系","歷史學系","東南亞研究所","人類學研究所","華語文教學研究所"];	// 人文學院
	Department[1]=["國際文教與比較教育學系","教育政策與行政學系","成人與繼續教育研究所","輔導與諮商研究所","課程教學與科技研究所","終生學習與人力資源發展碩士學位學程"];	// 教育學院
	Department[2]=["土木工程學系","資訊工程學系","電機工程學系","應用化學系","應用材料及光電工程學系","地震與防災工程研究所","光電科技碩士學位學程"];			// 科技學院
	Department[3]=["國際企業學系","經濟學系","資訊管理學系","財務金融學系","休閒學與觀光管理學系","餐旅管理學系","經營管理學位學程","新興產業策略與番展博士學位學程"];				// 管理學院
   Department[4]=["教師","行政人員","校外人士","其他"]//其他
	
	function renew(index){
		for(var i=0;i<Department[index].length;i++)
			document.form1.Department.options[i]=new Option(Department[index][i], Department[index][i]);	// 設定新選項
		document.form1.Department.length=Department[index].length;	
	}
	renew(0);//讓預設為人院，跟自我介紹無關
	initCounty(document.form1.City)
	initZone(document.form1.City, document.form1.Canton, document.form1.Zip);
	</script>
</html>