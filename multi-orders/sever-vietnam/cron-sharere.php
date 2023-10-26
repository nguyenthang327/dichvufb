<?php
require('../../system/config.php');
require('../../system/check-uid.php'); 
// lấy token autofb
$datatoken = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain'"));
$token = $datatoken['token'];
// tính năng 1 là like rẻ nhé
$kiemtratinhnang = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuccon` WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain' AND `id` = '8'"));
$action = $kiemtratinhnang['action'];
if($action =='on'){
$dem =  mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `tinhnang`= '8' AND `status` = 'pending'"));   
if($dem > 0){
// chống đúp đơn
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'off' WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain' AND `id` = '8'");
// lấy danh sách đơn hàng - giới hạn tối đa 20 đơn / phút
$datadonhang = mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `tinhnang`= '8' AND `status` = 'pending' LIMIT 20");
while($row = mysqli_fetch_array($datadonhang))
{
$link = $row['link'];    
$soluong = $row['soluong'];    
$server = $row['server'];    
$comment = $row['comment'];    
$reaction = $row['reaction'];    
$dayvip = $row['dayvip']; 
$id = $row['id']; 
$checkgiagoc = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `madichvu` = '8' AND `server` = '$server' AND `webdinhdanh` ='$domain'"));
$giagoc = $checkgiagoc['giagoc'];
$pos = strpos($link, 'facebook.com');
if ($pos !== false) {
$link = uid('bv',$link,$token);
}
$date1 = date("Y-m-d"); 
$url = 'https://autofb.pro/api/facebook_buff/create';
$path = '/api/facebook_buff/create';
$referer = 'https://autofb.pro/tool/Bufflikecommentshare_share';

$data = '{"dataform":{"locnangcao":0,"locnangcao_gt":0,"locnangcao_dotuoi_start":0,"locnangcao_dotuoi_end":13,"locnangcao_banbe_start":0,"locnangcao_banbe_end":100,"profile_user":"'.$link.'","loaiseeding":"'.$server.'","baohanh":0,"sltang":'.$soluong.',"giatien":'.$giagoc.',"ghichu":"API","startDatebh":"'.$date1.'T09:41:41.857Z","EndDatebh":"'.$date1.'T09:41:41.857Z","type":"","list_messages":[]},"type_api":"buff_likecommentshare"}';
$checkin = oder($url,$token,$path,$referer,$data);
$obj = json_decode($checkin);
$status = $obj-> status;
$code_oder = $obj-> data -> insertId;
$tinnhan = $obj-> message;
if($status == 200){
mysqli_query($ketnoi,"UPDATE `function` SET `note` = '$tinnhan',`codeoder` = '$code_oder',`status` = 'inprogess',`uid` = '$link',`respondapi` = '$tinnhan' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");        
}else{
mysqli_query($ketnoi,"UPDATE `function` SET `respondapi` = '$tinnhan',`status` = 'error' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");    
}    
}
// kích hoạt lại phiên mới
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'on' WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain' AND `id` = '8'");
echo "Đã xử lý share rẻ xong <br>";
}else{
echo 'Không có đơn share rẻ nào đang chờ xử lý !';        
}
}else{
echo 'Tính năng đang thực hiện tiến trình hoặc bị treo - nếu đợi quá lâu (> 10p) chạy cron không chạy đơn thì vui lòng kích hoạt lại ở danhmuccon-> action => on !';    
}
?>