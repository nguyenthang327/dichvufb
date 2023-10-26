<?php
require('../system/config.php');
require 'smtpmail/PHPMailerAutoload.php';
if ($_POST && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
if(isset($_POST['usernamecu']) && isset($_POST['passcu'])){
$usernamecu = xss($_POST['usernamecu']);   
$passcu = md5(md5($_POST['passcu']));
if(empty($_SESSION['username'])){
   echo json_encode(array('status' => "danger", 'title' => "Lỗi", 'msg' => "Vui lòng đăng nhập trước"));
 exit();     
}else{
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `oldaccounts` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$usernamecu)."' AND `password` = '$passcu' AND `webdinhdanh` = 'app.dichvuonline.vn'"));
if($dem == 1){
$datauserbuff = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `oldaccounts` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$usernamecu)."' AND `password` = '$passcu' AND `webdinhdanh` = 'app.dichvuonline.vn'"));
$cash1 = $datauserbuff['cash'];
$sode = $datauserbuff['username'];
$active1 = $datauserbuff['active']; 
if($cash1 < 1 || $active1 == 0){
   echo json_encode(array('status' => "danger", 'title' => "Lỗi", 'msg' => "Số dư tài khoản này hết tiền hoặc đã bị cấm, vui lòng liên hệ admin !"));
 exit();     
}else{
$cashmoi = $cash +  $cash1;
$code_oder = floor(microtime(true) * 1000);
$date = date("Y-m-d H:i:sa");
// ghi lại lịch sử cộng tiền
mysqli_query($ketnoi, "INSERT INTO `history` (`username`, `type`, `coinfirst`, `coinsecond`, `coin`, `codeoder`, `date`,`webdinhdanh`,`note`) 
VALUES ('$username','Cộng Tiền','$cash','$cashmoi','$cash1','$code_oder','$date','$domain','Cộng lại tiền từ: $sode')"); 
// cộng tiền
mysqli_query($ketnoi,"UPDATE `accounts` SET 
cash = '$cashmoi' WHERE username='$username'");
// trừ tiền cũ
mysqli_query($ketnoi,"UPDATE `oldaccounts` SET 
cash = '0' WHERE username='$usernamecu'");
// thông báo thành công
   echo json_encode(array('status' => "danger", 'title' => "Thành công", 'msg' => "Thành công, bạn đã khôi phục thành công số dư cũ, xin chúc mừng !"));
 exit();  
}
}else{
   echo json_encode(array('status' => "danger", 'title' => "Lỗi", 'msg' => "Thông tin đăng nhập không chính xác"));
 exit();  
}
}    
}if(isset($_POST['email']) && isset($_POST['usernamecu1'])){
    
$usernamecu1 = xss($_POST['usernamecu1']);  
$usernamecu12 = xss($_POST['email']); 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `oldaccounts` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$usernamecu1)."' AND `email` = '$usernamecu12' AND `webdinhdanh` = 'app.dichvuonline.vn'"));
if($dem == 1){
$rdpw = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCD EFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,6);    
$md5 = md5(md5($rdpw));    
mysqli_query($ketnoi,"UPDATE `oldaccounts` SET 
password = '".mysqli_real_escape_string($ketnoi,$md5)."'
WHERE username='$usernamecu1'");

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
	$mail->addAddress(''.$email.'', 'Reset Password app.dichvuonline.vn ');
    $mail->setFrom('system.nonreplyrespawndeveloper@gmail.com', 'Reset Password  app.dichvuonline.vn');
    $mail->addReplyTo('system.nonreplyrespawndeveloper@gmail.com', 'Reset Password app.dichvuonline.vn');
    $mail->Subject = 'Reset Password app.dichvuonline.vn';
    $mail->msgHTML('<h3>Reset password : app.dichvuonline.vn </h3><h3>Your new password by '.$usernamecu1.' is: ['.$rdpw.']</h3><h3>Thank you !</h3>');
if(!$mail->send()){
 echo json_encode(array('status' => "danger", 'title' => "Lỗi", 'msg' => "Không gửi được email !"));
 exit(); 
}else{   
   echo json_encode(array('status' => "danger", 'title' => "Thành công", 'msg' => "Một email chứa mật khẩu mới đã được gửi đến email liên kết của bạn, vui lòng tiến hành đăng nhập và tiến hành khôi phục số dư !"));
 exit();  

        }
}else{
  echo json_encode(array('status' => "danger", 'title' => "Lỗi", 'msg' => "Vui lòng nhập đúng thông tin !"));
 exit();    
}    
}else{
    
   echo json_encode(array('status' => "danger", 'title' => "Lỗi", 'msg' => "Vui lòng nhập thông tin !"));
 exit();  
}
}
?>