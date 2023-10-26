<?php
require('../../system/config.php');
require('../../system/check-uid.php'); 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `tinhnang` = '1' AND `status`='inprogess'"));
if($dem > 0){
$tokendichvu = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='autofb'"));
$token = $tokendichvu['token'];
 $url = 'https://autofb.pro/api/facebook_buff/list/?type_api=buff_likecommentshare&page=1&type=like&obj_search=';
    $patch ='/api/facebook_buff/list/?type_api=buff_likecommentshare&page=1&type=like&obj_search=';
    $referer='https://autofb.pro/tool/Bufflikecommentshare_like';
    $data = 'type_api=buff_likecommentshare&page=1&type=like&obj_search=';
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
$goc = $data[$j]['subscribers'];

$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `codeoder` ='$id' AND `tinhnang` = '1'  AND `status`!='success' AND `status`!='error' AND `status`!='refund'"));
if($dem  > 0){
if($status == '0'){
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'success',`dachay`='$dachay',`goc` = '$goc' WHERE `codeoder` ='$id'  AND `tinhnang` = '1'");    
}else{
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'inprogess',`dachay`='$dachay',`goc` = '$goc' WHERE `codeoder` ='$id'  AND `tinhnang` = '1'");      
    } 
    }
}
}
echo "Đã xử lý lịch sử đơn like rẻ xong ! <br>";
?>