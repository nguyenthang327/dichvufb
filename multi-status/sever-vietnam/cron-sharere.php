<?php
require('../../system/config.php');
require('../../system/check-uid.php'); 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `tinhnang` = '8' AND `status`='inprogess'"));
if($dem > 0){
$tokendichvu = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='autofb'"));
$token = $tokendichvu['token'];
 $url = 'https://autofb.pro/api/facebook_buff/list/?type_api=buff_likecommentshare&limit=0&obj_search=share,share_sv2,share_sv3,share_sv4,share_sv5,share_sv6';
    $patch ='/api/facebook_buff/list/?type_api=buff_likecommentshare&limit=0&obj_search=share,share_sv2,share_sv3,share_sv4,share_sv5,share_sv6';
    $referer='https://autofb.pro/tool/Bufflikecommentshare_share';
    $data = 'type_api=buff_likecommentshare&limit=0&obj_search=share,share_sv2,share_sv3,share_sv4,share_sv5,share_sv6';
$resuft1 = checkstatus($url,$token,$patch,$referer,$data);    
$result = json_decode($resuft1,true);
$data = [];
$data = $result['data'];
$soluong = count($data);
for ($j = 0; $j < $soluong; $j++) {
$id =  $data[$j]['id']; // Trạng thái đơn
$dachay =  $data[$j]['count_success']; 
$status = $data[$j]['status'];
$oder = $data[$j]['quantity'];
$goc = $data[$j]['start_like'];

$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `codeoder` ='$id' AND `tinhnang` = '8'  AND `status`!='success' AND `status`!='error' AND `status`!='refund'"));
if($dem  > 0){
if($status == '0'){
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'success',`dachay`='$dachay',`goc` = '$goc' WHERE `codeoder` ='$id'  AND `tinhnang` = '8'");    
}else{
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'inprogess',`dachay`='$dachay',`goc` = '$goc' WHERE `codeoder` ='$id'  AND `tinhnang` = '8'");      
    } 
    }
}
}
echo "Đã xử lý lịch sử đơn share rẻ xong ! <br>";
?>