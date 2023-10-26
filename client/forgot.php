<?php
require("../system/config.php");
require 'smtpmail/PHPMailerAutoload.php';
if ($_POST && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
if(empty($_POST['username']) || empty($_POST['email'])){
	die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong> Vui lòng không bỏ trống bất kỳ dữ liệu nào .</div>'); 	
exit();
}
$username = htmlspecialchars(addslashes($_POST['username']));
$email = htmlspecialchars(addslashes($_POST['email']));
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `username` ='$username' AND `email` ='$email'"));
if($dem == 0){
   	die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong> Tài khoản hoặc email liên kết không đúng .</div>'); 
exit();	
}else{
$rdpw = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCD EFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,6);    
$md5 = md5(md5($rdpw));    
mysqli_query($ketnoi,"UPDATE `accounts` SET 
password = '".mysqli_real_escape_string($ketnoi,$md5)."'
WHERE username='$username'");
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "system.nonreplyrespawndeveloper@gmail.com";

//Password to use for SMTP authentication
    $mail->Password = "xrwiiuvxchvnfann";
	$mail->addAddress(''.$email.'', 'Reset Password '.$domain.' ');
    $mail->setFrom('system.nonreplyrespawndeveloper@gmail.com', 'Reset Password  '.$domain.'');
    $mail->addReplyTo('system.nonreplyrespawndeveloper@gmail.com', 'Reset Password '.$domain.'');
    $mail->Subject = 'Reset Password '.$domain.'';
    $mail->msgHTML('<h3>Reset password : '.$domain.' </h3><h3>Your new password by '.$username.' is: ['.$rdpw.']</h3><h3>Thank you !</h3>');
if(!$mail->send()){
 
     	die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong> Lỗi hệ thống, không gửi được email khôi phục mật khẩu .</div>');  
exit();	
}else{   
	die('<div class="alert success"><span class="closebtn" onclick="spawn()">&times;</span><strong>Thành công !</strong> Một email chứa mật khẩu mới đã được gửi đến email liên kết của bạn, vui lòng tiến hành đăng nhập và đổi lại mật khẩu .</div><script type="text/javascript"> setTimeout(function(){ location.href = "/clound/login.html" },2000);</script>');

exit();	
        }
    }
}
?>