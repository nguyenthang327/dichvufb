<?php
require('../../system/config.php');
require('../../system/check-uid.php'); 
// lấy token subgiare
$datatoken = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain'"));
$token = $datatoken['token'];
$datatoken1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='subgiare' AND `webdinhdanh` ='$domain'"));
$token1 = $datatoken1['token'];
// tính năng 1 là like speed nhé
$kiemtratinhnang = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuccon` WHERE `webnguon` ='subgiare' AND `webdinhdanh` ='$domain' AND `id` = '10'"));
$action = $kiemtratinhnang['action'];
if($action =='on'){
$dem =  mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `tinhnang`='10' AND `status` = 'pending'"));   
if($dem > 0){
// chống đúp đơn
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'off' WHERE `webnguon` ='subgiare' AND `webdinhdanh` ='$domain' AND `id` = '10'");
// lấy danh sách đơn hàng - giới hạn tối đa 20 đơn / phút
$datadonhang = mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `tinhnang`='10' AND `status` = 'pending' LIMIT 20");
while($row = mysqli_fetch_array($datadonhang))
{
$link = $row['link'];    
$soluong = $row['soluong'];    
$server = $row['server'];    
$comment = $row['comment'];    
$reaction = $row['reaction'];    
$dayvip = $row['dayvip']; 
$id = $row['id']; 
$checkgiagoc = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `madichvu` ='10' AND `server` = '$server' AND `webdinhdanh` ='$domain'"));
$giagoc = $checkgiagoc['giagoc'];
$pos = strpos($link, 'facebook.com');
if ($pos !== false) {
$link = uid('uid',$link,$token);
}
$data = urldecode("idpage=$link&amount=$soluong&note=API&server_order=$server");
$res = curl_send1("/api/service/facebook/like-page-speed/order","https://$g/api/service/facebook/like-page-speed/order",$data,$token1);
$obj = json_decode($res);
$status = $obj-> status;

$tinnhan = $obj-> message;
if($status == true){
    $code_oder = $obj-> data -> code_order;
mysqli_query($ketnoi,"UPDATE `function` SET `note` = '$tinnhan',`codeoder` = '$code_oder',`status` = 'inprogess',`uid` = '$link',`respondapi` = '$tinnhan' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");        
}else{
mysqli_query($ketnoi,"UPDATE `function` SET `respondapi` = '$tinnhan',`status` = 'error' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");    
}    
}
// kích hoạt lại phiên mới
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'on' WHERE `webnguon` ='subgiare' AND `webdinhdanh` ='$domain' AND `id` = '10'");
echo "Đã xử lý like page nhanh xong <br>";
}else{
echo 'Không có đơn like page nhanh nào đang chờ xử lý !';        
}
}else{
echo 'Tính năng đang thực hiện tiến trình hoặc bị treo - nếu đợi quá lâu (> 10p) chạy cron không chạy đơn thì vui lòng kích hoạt lại ở danhmuccon-> action => on !';    
}
?>