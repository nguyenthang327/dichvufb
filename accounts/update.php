<?php
require("../system/config.php"); // Kết nối database
if ($_POST && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_SESSION['username'])){
require_once('../system/thongke.php');    
if(isset($_POST['type'])){
$type = xss($_POST['type']);
if($type == 'update1'){
if($tongnap < $cap1){    
	die('<script type="text/javascript">swal("ERROR","Tổng nạp tiền chưa đủ để nâng cấp lên CTV PRO","error");</script>'); 
exit();	
            }elseif($ctv > 1){
    
	die('<script type="text/javascript">swal("ERROR","Cấp độ của bạn đã hơn nhà CTV PRO hãy nâng cấp cấp độ tiếp theo","error");</script>'); 
exit();	
        }else{
mysqli_query($ketnoi,"UPDATE `accounts` SET 
`ctv` = '1'
WHERE `username`='$username'"); 
	die('<script type="text/javascript">swal("SUCCESS","Bạn đã được nâng cấp lên CTV PRO","success");</script>'); 
            }
        }elseif($type == 'update2'){
if($tongnap < $cap2){    
	die('<script type="text/javascript">swal("ERROR","Tổng nạp tiền chưa đủ để nâng cấp lên CTV VIP","error");</script>'); 
exit();	
            }elseif($ctv > 2){
    
	die('<script type="text/javascript">swal("ERROR","Cấp độ của bạn đã hơn CTV VIP hãy nâng cấp cấp độ tiếp theo","error");</script>'); 
exit();	
        }else{
mysqli_query($ketnoi,"UPDATE `accounts` SET 
`ctv` = '2'
WHERE `username`='$username'"); 
	die('<script type="text/javascript">swal("SUCCESS","Bạn đã được nâng cấp lên CTV VIP","success");</script>'); 
            }
        }elseif($type == 'update3'){
if($tongnap < $cap3){    
	die('<script type="text/javascript">swal("ERROR","Tổng nạp tiền chưa đủ để nâng cấp lên Đại Lý PRO","error");</script>'); 
exit();	
            }elseif($ctv > 3){
    
	die('<script type="text/javascript">swal("ERROR","Cấp độ của bạn đã hơn Đại Lý PRO hãy nâng cấp cấp độ tiếp theo","error");</script>'); 
exit();	
        }else{
mysqli_query($ketnoi,"UPDATE `accounts` SET 
`ctv` = '3'
WHERE `username`='$username'"); 
	die('<script type="text/javascript">swal("SUCCESS","Bạn đã được nâng cấp lên Đại Lý PRO","success");</script>'); 
            }
        }elseif($type == 'update4'){
if($tongnap < $cap4){    
	die('<script type="text/javascript">swal("ERROR","Tổng nạp tiền chưa đủ để nâng cấp lên Đại Lý VIP","error");</script>'); 
exit();	
            }elseif($ctv > 4){
    
	die('<script type="text/javascript">swal("ERROR","Cấp độ của bạn đã hơn Đại Lý VIP hãy nâng cấp cấp độ tiếp theo","error");</script>'); 
exit();	
        }else{
mysqli_query($ketnoi,"UPDATE `accounts` SET 
`ctv` = '4'
WHERE `username`='$username'"); 
	die('<script type="text/javascript">swal("SUCCESS","Bạn đã được nâng cấp lên Đại Lý VIP","success");</script>'); 
            }
        }elseif($type == 'update5'){
if($tongnap < $cap4){    
	die('<script type="text/javascript">swal("ERROR","Tổng nạp tiền chưa đủ để nâng cấp lên Nhà Phân Phối VIP","error");</script>'); 
exit();	
            }elseif($ctv == 5){
	die('<script type="text/javascript">swal("ERROR","Cấp độ của bạn đã là cao nhất","error");</script>'); 
exit();	
        }else{
mysqli_query($ketnoi,"UPDATE `accounts` SET 
`ctv` = '5'
WHERE `username`='$username'"); 
	die('<script type="text/javascript">swal("SUCCESS","Bạn đã được nâng cấp lên Nhà Phân Phối VIP","success");</script>'); 
            }
        }elseif($type == 'update6'){
$APIkey = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 25);            
mysqli_query($ketnoi,"UPDATE `accounts` SET 
`api` = '$APIkey'
WHERE `username`='$username'"); 
	die('<script type="text/javascript">swal("SUCCESS","Bạn đã đổi API token thành công","success"); setTimeout(function(){ location.href = "/clound/infomation.html" },2000);</script>'); 
            }elseif($type == 'update7'){
if(empty($_POST['oldpass']) || empty($_POST['newpass'])){
	die('<script type="text/javascript">swal("ERROR","Vui lòng nhập mật khẩu mới và nhập lại","error");</script>'); 
}elseif(strlen($_POST['oldpass']) < 6 || strlen($_POST['newpass']) > 32){
	die('<script type="text/javascript">swal("ERROR","Mật khẩu mới quá ngắn hoặc quá dài (6-32 ký tự)","error");</script>'); 
}else{
$newpass1 = md5(md5($_POST['oldpass']));
$newpass2 = md5(md5($_POST['newpass']));
if($newpass1 !== $newpass2){
	die('<script type="text/javascript">swal("ERROR","Mật khẩu mới và mật khẩu nhập lại không giống nhau","error");</script>'); 
        }else{
mysqli_query($ketnoi,"UPDATE `accounts` SET 
`password` = '$newpass1'
WHERE `username`='$username'"); 
	die('<script type="text/javascript">swal("SUCCESS","Bạn đã đổi mật khẩu thành công","success"); setTimeout(function(){ location.href = "/clound/infomation.html" },2000);</script>');
               
            
        }
    } 
                
            }else{

	die('<script type="text/javascript">swal("ERROR","Không có tính năng này","error");</script>'); 
exit();	
                    
        }
    }
}
?>    