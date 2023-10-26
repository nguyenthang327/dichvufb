<?php
require('../../system/config.php');
require('../../system/check-uid.php'); 
// lấy token autofb
$datatoken = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain'"));
$token = $datatoken['token'];
// tính năng 1 là Vip Like nhé
$kiemtratinhnang = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuccon` WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain' AND `id` = '16'"));
$action = $kiemtratinhnang['action'];
if($action =='on'){
$dem =  mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `tinhnang`='16' AND `status` = 'pending'"));   
if($dem > 0){
// chống đúp đơn
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'off' WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain' AND `id` = '16'");
// lấy danh sách đơn hàng - giới hạn tối đa 20 đơn / phút
$datadonhang = mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `tinhnang`='16' AND `status` = 'pending' LIMIT 20");
while($row = mysqli_fetch_array($datadonhang))
{
$link = $row['link'];    
$soluong = $row['soluong'];    
$server = $row['server'];    
$comment = $row['comment'];    
$reaction = $row['reaction'];    
$dayvip = $row['dayvip']; 
$id = $row['id']; 
$checkgiagoc = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `madichvu` ='16' AND `server` = '$server' AND `webdinhdanh` ='$domain'"));
$giagoc = $checkgiagoc['giagoc'];
$pos = strpos($link, 'facebook.com');
if ($pos !== false) {
$link = uid('uid',$link,$token);
}
$date1 = date("Y-m-d"); 
$url = "https://autofb.pro/api/fbvip/add?fbvip_type=viplike_clone";
$path = "/api/fbvip/add?fbvip_type=viplike_clone";
$referer = "https://autofb.pro/tool/vip-like-clone";

$data = '{"dataform":{"lsct":'.$server.',"profile_user":"'.$link.'","usernamefb":"API","day_sale":'.$dayvip.',"min_like":'.$soluong.',"max_like":'.$soluong.',"slbv":5,"ghichu":"","giatien":'.$giagoc.'},"id_user":13128}';
$checkin = oder($url,$token,$path,$referer,$data);
$obj = json_decode($checkin);
$status = $obj-> status;

$tinnhan = $obj-> message;
if($status == 200){
    $code_oder = $obj-> data -> insertId;
mysqli_query($ketnoi,"UPDATE `function` SET `note` = '$tinnhan',`codeoder` = '$code_oder',`status` = 'success',`dachay` = '$soluong',`uid` = '$link',`respondapi` = '$tinnhan' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");        
}else{
mysqli_query($ketnoi,"UPDATE `function` SET `respondapi` = '$tinnhan',`status` = 'error' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");    
}    
}
// kích hoạt lại phiên mới
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'on' WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain' AND `id` = '16'");
echo "Đã xử lý Vip Like xong <br>";
}else{
echo 'Không có đơn Vip Like nào đang chờ xử lý !';        
}
}else{
echo 'Tính năng đang thực hiện tiến trình hoặc bị treo - nếu đợi quá lâu (> 10p) chạy cron không chạy đơn thì vui lòng kích hoạt lại ở danhmuccon-> action => on !';    
}
?>