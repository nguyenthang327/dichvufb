<?php
/* CODE ĐƯỢC VIẾT BỞI RESPAWN DEVELOPER HOTLINE : 0983647058 */
session_start();
/* KẾT NỐI DATABASE */
define("DATABASE", "xotssmvjhosting_webdichvumangxahoi");
define("USERNAME", "root");
define("PASSWORD", "");
define("LOCALHOST", "localhost");
$ketnoi = mysqli_connect(LOCALHOST,USERNAME,PASSWORD,DATABASE);
mysqli_query($ketnoi,"set names 'utf8'");
date_default_timezone_set("Asia/Ho_Chi_Minh");
if(!$ketnoi){die('');    
}
$domainchinh = 'dichvufb24h.com';
$domain = $_SERVER['HTTP_HOST']; 
$pos = strpos($domain, 'www.');
if ($pos !== false) {
 $domain = str_replace("www.", "", $domain);   
}
// thêm cái này
$domain = 'dichvufb24h.com';

if(isset($_SESSION['username'])){
$username = $_SESSION['username'];    
$datauser = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `accounts` WHERE `username`='$username' AND `webdinhdanh` ='$domain'"));
$email = $datauser['email'];
$api = $datauser['api'];
$idacc = $datauser['id'];
$cash = $datauser['cash'];
$admin = $datauser['admin'];
$activeacc = $datauser['active'];
$ctv = $datauser['ctv'];
if($ctv == '0'){
$giatri ='cap0';    
$rate = 'Member';    
}elseif($ctv == '1'){
$giatri ='cap1';    
$rate = 'NPP1';    
}elseif($ctv == '2'){
$giatri ='cap2';     
$rate = 'NPP2';    
}elseif($ctv == '3'){
$giatri ='cap3';     
$rate = 'ĐL1';    
}elseif($ctv == '4'){
$giatri ='cap4';     
$rate = 'ĐL2';    
}elseif($ctv == '5'){
$giatri ='cap5';     
$rate = 'ĐL3';    
}
$ip = $datauser['ip'];
$hash = $datauser['hash'];
$thietbi = $datauser['thietbi'];
$date = $datauser['date'];
$cheat = $datauser['cheat'];
if($hash !== $_SESSION['login']){
header('location:/logout.html');
exit();
}elseif($thietbi !== $_SESSION['thietbi']){
header('location:/logout.html');
exit();
}
}
$demdomain = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `system` WHERE `webdinhdanh` ='$domain' AND `token` !=''"));

if($demdomain == 0){
die();
exit();
}
$datasite = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `system` WHERE `webdinhdanh` ='$domain'"));
$mota = $datasite['derc']; //
$tukhoa = $datasite['tukhoa']; //
$tieude = $datasite['title']; // 
$hotline = $datasite['phoneadmin'];//
$cap1 = $datasite['cap1'];//
$cap2 = $datasite['cap2'];//
$cap3 = $datasite['cap3'];//
$cap4 = $datasite['cap4'];//
$cap5 = $datasite['cap5'];//
$namesite = $datasite['namesite']; //
$logo = $datasite['logo']; //
$favicon = $datasite['favicon'];//
$fbadmin = $datasite['fbadmin']; //
$nameadmin = $datasite['tenadmin']; //
$active = $datasite['active'];//
$nhanvienhotro = $datasite['nhanvienhotro'];
$kenhthongbao = $datasite['kenhthongbao']; // 
$webkichhoat = $datasite['webdinhdanh'];
$tokenweb = $datasite['token']; // 
$ratecard = $datasite['ratecard'];   //?
$partnerid = $datasite['partnerid']; //?
$partnerkey = $datasite['partnerkey']; //?
$mode = $datasite['mode'];
if(isset($_SESSION['mode'])){
$mode = $_SESSION['mode'];  
}
$script = $datasite['script']; //
$chietkhau = 100 - $ratecard;
if(isset($_SERVER ['HTTP_USER_AGENT'])){
$agent = $_SERVER ['HTTP_USER_AGENT'];    
    }
if(isset($_SERVER['REMOTE_ADDR'])){
$ip = $_SERVER['REMOTE_ADDR'];    
}    
if (!empty($_SERVER['WWW_HTTP_CLIENT_IP']))
{
    $ip = $SERVER['WWW_HTTP_CLIENT_IP'];
} elseif
(!empty($_SERVER['WWW_HTTP_X_FORWARDED_FOR'])){
    $ip = $_SERVER['WWW_HTTP_X-FORWARDED_FOR'];
}
$g = 'thuycute.hoangvanlinh.vn';
function xss($div){
$b = htmlspecialchars(addslashes($div));
return $b;
}
?>