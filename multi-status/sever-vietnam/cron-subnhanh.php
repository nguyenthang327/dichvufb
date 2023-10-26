<?php
require('../../system/config.php');
require('../../system/check-uid.php'); 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `tinhnang` = '13' AND `status`='inprogess'"));
if($dem > 0){
$tokendichvu = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='subgiare'"));
$token = $tokendichvu['token'];
$url = "https://$g/api/service/facebook/sub-speed/list";
$referer="https://$g/service/facebook/sub-speed/list";
$datadonhangv3 = mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `tinhnang` ='13' AND `status` !='success' AND  `status` !='refund' AND  `status` !='error'");
$results = array();
while($datadonhang = mysqli_fetch_array($datadonhangv3))
{
$results[] = $datadonhang['codeoder'];
}
$b = json_encode($results);
$response = trim($b,'["');
$codeoder = str_replace('","', ',', $response); // mã đơn đã xử lý
$responsev = trim($codeoder,'"]');

$resuft1 = checksubgiare($url,$referer,$token,$responsev);    
$result = json_decode($resuft1,true);
$data = [];
$data = $result['data'];
$soluong = count($data);
for ($j = 0; $j < $soluong; $j++) {
     $status =  $data[$j]['status']; // Trạng thái đơn
     $codeoder1 =  $data[$j]['code_order']; // mã đơn chưa xử lý
     $soluongoder =  $data[$j]['amount']; // số lượng oder
     $soluongdabuff =  $data[$j]['buff']; // đã buff
     $goc =  $data[$j]['start'];
    $dem1 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `codeoder` ='$codeoder1' AND `status`!='success' AND `status`!='error' AND `status`!='refund' AND  `tinhnang` ='13'")); // Như vậy là còn đang chạy  Active hoặc chưa có kết quả
     // Đếm mã đơn hàng có tồn tại không ? ( comment)
    if($dem1  > 0){
    if($status == 'Success'){
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'success',`dachay`='$soluongdabuff',`goc`='$goc' WHERE `codeoder` ='$codeoder1' AND  `tinhnang` ='13'");
    }elseif($status == 'Report'){
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'error',`dachay`='$soluongdabuff',`goc`='$goc' WHERE `codeoder` ='$codeoder1' AND  `tinhnang` ='13'");
    }elseif($status == 'Active'){
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'inprogess',`dachay`='$soluongdabuff',`goc`='$goc' WHERE `codeoder` ='$codeoder1' AND  `tinhnang` ='13'");
    }elseif($status == 'Refund'){
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'error',`dachay`='$soluongdabuff',`goc`='$goc' WHERE `codeoder` ='$codeoder1' AND  `tinhnang` ='13'");        
    }    
    }
}
    }
echo "Đã xử lý lịch sử đơn sub nhanh xong ! <br>";
?>