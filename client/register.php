<?php
require("../system/config.php");
if ($_POST && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
if(empty($_POST['username']) || empty($_POST['password'])|| empty($_POST['repassword'])|| empty($_POST['email']) ){
	die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong> Vui lòng điền đầy đủ thông tin đăng ký .</div>'); 
exit();	
}
$username = addslashes(strtolower($_POST['username']));
$password = addslashes($_POST['password']);
$repassword = addslashes($_POST['repassword']);
$mail = addslashes($_POST['email']);
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$username)."'"));
if(!preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{5,20}$/',$username)){
	die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong> Tài khoản chỉ gồm chữ ,số. Không được sử dụng kí tự đặc biệt .</div>'); 	
exit();	
}elseif(strlen($password) < 6 || strlen($password) > 32 || strlen($username) < 6 || strlen($username) > 32)
{

	die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong> Bạn nhập tài khoản và mật khẩu quá ngắn hoặc quá dài sẽ ảnh hưởng tới bảo mật (6-32) .</div>'); 	
exit();	
}elseif (strcmp($_POST['password'], $_POST['repassword']) != 0) {
  	die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong>Vui lòng nhập lại mật khẩu trùng khớp với mật khẩu .</div>'); 	 
exit();	
}elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL))
{
		die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong>Vui lòng nhập đúng định dạng email .</div>'); 	
exit();	

}elseif($dem > 0){
		die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong>Tài Khoản này đã có trên hệ thống, có thể trước đó bạn đã đăng ký thành công rồi, hãy thử đăng nhập .</div><script type="text/javascript">setTimeout(function(){ location.href = "/clients/login.html" },2000);</script>'); 	
exit();	
}else{
$date = date("Y-m-d H:i:sa");    
$pass1change = md5(md5($password)); // Mã hóa md5 2 nhát
$_SESSION['login'] = md5($date);
$_SESSION['thietbi'] = $agent;
$APIkey = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 25);
mysqli_query($ketnoi,"INSERT INTO accounts SET 
`username` = '".mysqli_real_escape_string($ketnoi,$username)."',
`password` = '".mysqli_real_escape_string($ketnoi,$pass1change)."',
`api` = '".mysqli_real_escape_string($ketnoi,$APIkey)."',
`email` = '".mysqli_real_escape_string($ketnoi,$mail)."',
`cash` = '0',
`active` = '1',
`ctv` = '0',
`ip` = '$ip',
`hash` = '".$_SESSION['login']."',
`thietbi` = '".$_SESSION['thietbi']."',
`webdinhdanh` = '$domain',
`date` = '$date'");

$_SESSION['username'] = $username;
	die('<div class="alert success"><span class="closebtn" onclick="spawn()">&times;</span><strong>Thành công !</strong> Đăng ký thành công .</div><script type="text/javascript"> setTimeout(function(){ location.href = "/clound/home.html" },2000);</script>');

}
}
?>