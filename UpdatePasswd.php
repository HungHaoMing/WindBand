<?php session_start(); ?>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改密碼</title>

</head>
<?php include("header.php") ?>
<body>
<table width="1000" border="2">
  <tr>
	<td width="1000">
		<?php
		//此判斷為判定觀看此頁有沒有權限
		//說不定是路人或不相關的使用者
		//因此要給予排除
		if($_SESSION['account'] == null)
		{
			echo '請先登入謝謝！';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=Login.php>';
		}
		?>
		<p><form id="form1" name="form1" method="post" action="UpdatePasswdSQL.php"></p>
		<p><label for="OldPasswd">請輸入舊密碼：</label>
		  <span id="sprypassword1">
		  <input type="password" name="OldPasswd" id="OldPasswd"/>
		  <span class="passwordRequiredMsg">需要有一個值。</span></span></p>
		<p><label for="NewPasswd">新密碼：</label>
		  <span id="sprypassword2">
          <input type="password" name="NewPasswd" id="NewPasswd"/>
          <span class="passwordRequiredMsg">需要有一個值。</span><span class="passwordMinCharsMsg">未達到字元數目的最小值。</span></span></p>
		<p><label for="CheckPasswd">確認新密碼</label>
		  <span id="spryconfirm1">
		  <input type="password" name="CheckPasswd" id="CheckPasswd"/>
		  <span class="confirmRequiredMsg">需要有一個值。</span><span class="confirmInvalidMsg">值不相符。</span></span></p>
        <input type="submit" name="CheckBtn" id="CheckBtn" value="更改" />
        <input type="button" name="CancelBtn" id="CancelBtn" value="取消" onClick="javascript:location.href='ManagementSystem.php'"/>
        </form>
	</td>
  </tr>
</table>
<script type="text/javascript">
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2", {minChars:6});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "NewPasswd");
</script>
</body>