<?php
require("../system/config.php"); // Kết nối database
if ($_POST && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
if(empty($_POST['username']) || empty($_POST['password'])){
	die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong> Vui lòng điền đầy đủ thông tin đăng nhập .</div>');
exit();	
}
$username = addslashes(strtolower($_POST['username']));
$password = addslashes($_POST['password']);
    if(isset($_SESSION['username'])) {
   	die('<div class="alert success"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong> Bạn đã đăng nhập rồi .</div><script type="text/javascript">setTimeout(function(){ location.href = "/clound/home.html" },2000);</script>');
// Kiểm tra User đã đăng nhập chưa :))	
	}elseif(!preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{5,20}$/',$username)){
	    
	    	die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong>Tài khoản gồm chữ, số, ít nhất 6 ký tự .</div>');
	}
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$username)."'"));
if($dem == 1){
	$dem2 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$username)."' AND `active` = '1'"));
//	// Kiểm tra xem tài khoản này có bị cấm bởi Admin chưa nhỉ
    if($dem2 == 1){
// Kiểm tra xem tài khoản này có trong database chưa nhỉ 
    $checkpass = md5(md5($password)); // Mã hóa md5 2 nhát
	$dem3 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$username)."' AND `password` = '".mysqli_real_escape_string($ketnoi,$checkpass)."' AND `webdinhdanh` = '$domain'"));
// Kiểm tra mật khẩu nhập vào có đúng chưa nhỉ	
	if($dem3 == 1){
	$_SESSION['username'] = $username;
		$date = date("Y-m-d H:i:sa");  
	$_SESSION['login'] = md5($date);
	$_SESSION['thietbi'] = $agent;
	mysqli_query($ketnoi,"UPDATE `accounts` SET 
`hash` = '".$_SESSION['login']."',
`thietbi` = '".$_SESSION['thietbi']."'
WHERE username='$username'");
	die('<div class="alert success"><span class="closebtn" onclick="spawn()">&times;</span><strong>Thành công !</strong> Đăng nhập thành công .</div><script type="text/javascript"> setTimeout(function(){ location.href = "/clound/home.html" },2000);</script>');
// Login thành công	
	}else{
		die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong>Tài khoản hoặc mật khẩu không đúng  .</div>');
	    }
	}else{
  		die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong>Tài khoản này đã bị cấm khỏi hệ thống, vui lòng liên hệ Admin .</div>'); 
	}
}else{die('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong>Tài khoản không tồn tại .</div>');}
}
?>