<?php
require('../../system/config.php');
require('../../system/check-uid.php'); 
// lấy token autofb
$datatoken = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain'"));
$token = $datatoken['token'];
// tính năng 1 là like rẻ nhé
$kiemtratinhnang = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuccon` WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain' AND `id` = '24'"));
$action = $kiemtratinhnang['action'];
if($action =='on'){
$dem =  mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `tinhnang`='24' AND `status` = 'pending'"));   
if($dem > 0){
// chống đúp đơn
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'off' WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain' AND `id` = '24'");
// lấy danh sách đơn hàng - giới hạn tối đa 20 đơn / phút
$datadonhang = mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `tinhnang`='24' AND `status` = 'pending' LIMIT 20");
while($row = mysqli_fetch_array($datadonhang))
{
$link = $row['link'];    
$soluong = $row['soluong'];    
$server = $row['server'];    
$comment = $row['comment'];    
$reaction = $row['reaction'];    
$dayvip = $row['dayvip']; 
$id = $row['id']; 
$checkgiagoc = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `madichvu` ='24' AND `server` = '$server' AND `webdinhdanh` ='$domain'"));
$giagoc = $checkgiagoc['giagoc'];
$pos = strpos($link, 'tiktok.com');
if ($pos !== false) {
$link = uid('bvtiktok',$link,$token);
}
$date1 = date("Y-m-d");    
$data = array(
"data" => "$link",
"loaiseeding" => "like"
); 
$data = json_encode($data);
$checkin1 = check_tiktok($data,$token);
$obj1 = json_decode($checkin1);
$statuscheckinfo = $obj1-> status;
if($statuscheckinfo !== 200){
mysqli_query($ketnoi,"UPDATE `function` SET `respondapi` = 'Hệ thống không nhận diện được thông tin bạn nhập vào ',`status` = 'error' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");    
}else{
$avatarMedium_tiktok = $obj1-> data -> avatarMedium_tiktok;
$avatarThumb_tiktok = $obj1-> data -> avatarThumb_tiktok;
$cmt_count = $obj1-> data -> cmt_count;
$fans_tiktok = $obj1-> data -> fans_tiktok;
$id_video = $obj1-> data -> id_video;
$like_tiktok = $obj1-> data -> like_tiktok;
$playCount = $obj1-> data -> playCount;
$relation_tiktok = $obj1-> data -> relation_tiktok;
$secUid_tiktok = $obj1-> data -> secUid_tiktok;
$shareCount = $obj1-> data -> shareCount;
$uniqueId_tiktok = $obj1-> data -> uniqueId_tiktok;
$userid_tiktok = $obj1-> data -> userid_tiktok;
$verified_tiktok = $obj1-> data -> verified_tiktok;    
$url = 'https://autofb.pro/api/tiktok_buff/create';
$path = '/api/tiktok_buff/create';
$referer = 'https://autofb.pro/tool/tiktokbufflike';
$data2 = array(
    "dataform" => array (
        "EndDatebh" => ''.$date1.'T00:14:45.563Z',        
        "baohanh" => 0,
        "ghichu" => "API",
        "giatien" => $giagoc,
        "infoTiktok" => array (
        "avatarMedium_tiktok" => "$avatarMedium_tiktok",
        "avatarThumb_tiktok" => "$avatarThumb_tiktok",        
        "cmt_count" => $cmt_count,
        "fans_tiktok" => $fans_tiktok,
        "id_video" => "$id_video",        
        "like_tiktok" => $like_tiktok,
        "playCount" => $playCount,
        "relation_tiktok" => $relation_tiktok,
        "secUid_tiktok" => "$secUid_tiktok",
        "shareCount" => $shareCount, 
        "uniqueId_tiktok" => "$uniqueId_tiktok",
        "userid_tiktok" => "$userid_tiktok",
        "verified_tiktok" => $verified_tiktok
        ),
         "link"=>"$link",
        "list_messages"=>[],
         "loaiseeding"=>"$server",
        "profile_user"=>"$link",
        "sltang"=>$soluong,
        "startDatebh" => ''.$date1.'T00:14:45.563Z'    
        ));
$data = json_encode($data2);
$checkin = oder($url,$token,$path,$referer,$data);
$obj = json_decode($checkin);
$status = $obj-> status;
$tinnhan = $obj-> message;
if($status == 200){
$code_oder = $obj-> data -> insertId;
mysqli_query($ketnoi,"UPDATE `function` SET `note` = '$tinnhan',`codeoder` = '$code_oder',`status` = 'inprogess',`uid` = '$link',`respondapi` = '$tinnhan' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");        
}else{
mysqli_query($ketnoi,"UPDATE `function` SET `respondapi` = '$tinnhan',`status` = 'error' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");    
}  
}
}
// kích hoạt lại phiên mới
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'on' WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain' AND `id` = '24'");
echo "Đã xử lý tim tiktok xong <br>";
}else{
echo 'Không có đơn tim tiktok nào đang chờ xử lý !';        
}
}else{
echo 'Tính năng đang thực hiện tiến trình hoặc bị treo - nếu đợi quá lâu (> 10p) chạy cron không chạy đơn thì vui lòng kích hoạt lại ở danhmuccon-> action => on !';    
}
?>