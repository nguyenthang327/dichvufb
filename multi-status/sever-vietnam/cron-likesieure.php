<?php
require('../../system/config.php');
require('../../system/check-uid.php'); 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `tinhnang` = '30' AND `status`='inprogess'"));
if($dem > 0){
$tokendichvu = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='baostar'"));
$token = $tokendichvu['token'];
 function checkbao($url,$token,$data){
$curl = curl_init();    
curl_setopt_array($curl, array(
      CURLOPT_URL => "$url",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"$data",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/json",
        "api-key: $token"),
    ));  
    curl_setopt($curl, CURLOPT_HEADER, 0);
    $response = curl_exec($curl); 
    curl_close($curl);
    return $response; 
        }
    $url = 'https://api.baostar.pro/api/logs-order';
    $data = '{
    "type":"facebook"
}';
$resuft1 = checkbao($url,$token,$data);    
$result = json_decode($resuft1,true);
$data = [];
$data = $result['data'];
$soluong = count($data);
for ($j = 0; $j < $soluong; $j++) {
$codeoder1 =  $data[$j]['id']; // Trạng thái đơn
$dachay =  $data[$j]['count_is_run']; // mã đơn chưa xử lý
$oder =  $data[$j]['quantity']; // mã đơn chưa xử lý
$status = $data[$j]['status_string'];// mã đơn đã xử lý
$goc = $data[$j]['start_like'];// mã đơn đã xử lý
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `codeoder` ='$codeoder1' AND `status`!='success' AND `status`!='report' AND `status`!='refund' AND `tinhnang` ='30'"));
if($dem  > 0){
if($dachay >= $oder){
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'success',`dachay`='$dachay',`goc`='$goc' WHERE `codeoder` ='$codeoder1' AND `tinhnang` ='30'");       
}elseif($status == 'Chạy xong'){
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'success',`dachay`='$dachay',`goc`='$goc' WHERE `codeoder` ='$codeoder1' AND `tinhnang` ='30'");    
}else{
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'inprogess',`dachay`='$dachay',`goc`='$goc' WHERE `codeoder` ='$codeoder1' AND `tinhnang` ='30'");      
    } 
}else{
#do nothing   
}
}
}
echo "Đã xử lý lịch sử đơn like siêu rẻ xong ! <br>";
?>