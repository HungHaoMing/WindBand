<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>帳號申請</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php 
	include("header.php");
	include("class.phpmailer.php");   // 匯入PHPMailer類別      
	require_once("DB_config_MySQL.php");
	require_once("DB_Class_MySQL.php");
	$db = new DBMySQL();
	$db->connect_db($_DBMySQL['host'], $_DBMySQL['username'], $_DBMySQL['password'], $_DBMySQL['dbname'],'0');
	$db->query("set names utf8");
		
	$EMail = $_POST['EMail'];//$Account = $_POST['Account'];
	$Passwd = $_POST['Passwd'];
	$Name = $_POST['Name'];
	$ID = $_POST['ID'];
	$StudentID = $_POST['StudentID'];
	$Gender = $_POST['Gender'];
	$Birthday = $_POST['Birthday'];
	$Phone = $_POST['Phone'];
	$Address = $_POST['Address'];
	$Zip = $_POST['Zip'];
	$City = $_POST['City'];
	$Canton = $_POST['Canton'];
	
	$Address = $Zip.$City.$Canton.$Address;
	$College = $_POST['CollegeSelect'];
	$Department = $_POST['Department'];
	$Play = $_POST['Play'];
	$graduate = $_POST['graduate'];
	$ParentName = $_POST['ParentName'];
	$ParentPhone = $_POST['ParentPhone'];
	date_default_timezone_set('Asia/Taipei');
	$date= date("Y/m/d h:i:s");
	$AuthenticationKey = md5($ID.$Passwd.$EMail);
	$sql = "insert into member (MemberID,Account,Passwd,Name,Gender,CellPhone,BirthDay,Address,Email,Department,Since,Mode,StudentID,ParentPhone,ParentName,college,graduate,authenticationkey) values ('$ID','$EMail','$Passwd','$Name','$Gender','$Phone','$Birthday','$Address','$EMail','$Department','$date','10','$StudentID','$ParentPhone','$ParentName','$College','$graduate','$AuthenticationKey');";
	
	$sql2 = "insert into belong (MemberID,SID,Year) values ('$ID','$Play',2015);";

      
    $mail = new PHPMailer();                        // 建立新物件        

    $mail->IsSMTP();                                // 設定使用SMTP方式寄信        
    $mail->SMTPAuth = true;                         // 設定SMTP需要驗證
    $mail->SMTPSecure = "ssl";                      // Gmail的SMTP主機需要使用SSL連線   
    $mail->Host = "smtp.gmail.com";                 // Gmail的SMTP主機        
    $mail->Port = 465;                              // Gmail的SMTP主機的port為465      
    $mail->CharSet = "utf-8";                       // 設定郵件編碼   
    $mail->Encoding = "base64";
    $mail->WordWrap = 50;                           // 每50個字元自動斷行
    $mail->Username = "d3764291@gmail.com";    		// 設定驗證帳號        
    $mail->Password = "ocjxjskbqwjjcutk";           //必須用應用程式密碼

    $mail->From = "d3764291@gmail.com";       		// 設定寄件者信箱        
    $mail->FromName = "暨大管樂社";                 // 設定寄件者姓名      
    $mail->IsHTML(true);                            // 設定郵件內容為HTML   
	//$mail->SMTPKeepAlive = TRUE;
	//$mail->SMTPDebug = 2; // 1: message, 2: full result	
	
	$mail->Subject = "暨大管樂社帳號申請認證";                          //郵件標題
	$mail->Body = 
	"您好$Name ：<br>".
	"　　歡迎您申請國立暨南國際大學管樂社帳號<br>".
	"　　為了保障您帳戶安全，請點選下列連結認證。<br>".
	"　　http://163.22.21.169/HaoMing/WindBand/Authentication.php?email=$EMail&authkey=$AuthenticationKey <br>".
	"謝謝您！<br>";

	$mail->IsHTML(true); //郵件內容為html ( true || false)
	$mail->AddAddress($EMail); //收件者郵件及名稱
	$db->query($sql);
	$db->query($sql2);
	
	if(!$mail->Send()) {
		echo "發送錯誤: " . $mail->ErrorInfo;
	} else {
		echo "<div align=center>帳號申請成功，已發送認證信件。</div>";
	} 
	
?>