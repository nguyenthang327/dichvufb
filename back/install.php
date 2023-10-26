<?php
require("system/connect.php");
// Chuyển miền chính
mysqli_query($ketnoi,"UPDATE `chietkhau` SET 
webdinhdanh = 'www.electricsub.vn'
WHERE webdinhdanh !='www.electricsub.vn'");

mysqli_query($ketnoi,"UPDATE `accounts` SET 
webdinhdanh = 'www.electricsub.vn'
WHERE webdinhdanh !='www.electricsub.vn'");

mysqli_query($ketnoi,"UPDATE `banker` SET 
webdinhdanh = 'www.electricsub.vn'
WHERE webdinhdanh !='www.electricsub.vn'");

mysqli_query($ketnoi,"UPDATE `function` SET 
webdinhdanh = 'www.electricsub.vn'
WHERE webdinhdanh !='www.electricsub.vn'");

mysqli_query($ketnoi,"UPDATE `history` SET 
webdinhdanh = 'www.electricsub.vn'
WHERE webdinhdanh !='www.electricsub.vn'");
mysqli_query($ketnoi,"UPDATE `system` SET 
webdinhdanh = 'www.electricsub.vn'
WHERE webdinhdanh !='www.electricsub.vn'");
mysqli_query($ketnoi,"UPDATE `historynaptien` SET 
webdinhdanh = 'www.electricsub.vn'
WHERE webdinhdanh !='www.electricsub.vn'");

echo 'Đã cài đặt chiết khấu 100% <br>';
echo 'Đã cài đặt giá gốc 100%<br>';
echo 'Đã cài đặt bank 100%<br>';
echo 'Đã cài đặt hệ thống 100%<br>';
echo 'Đã cài mọi thứ 100%<br>';
?>