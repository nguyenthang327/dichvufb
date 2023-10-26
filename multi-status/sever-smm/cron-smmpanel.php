<?php
require('../../system/config.php');
require('../../system/check-uid.php'); 
// kết nối database
$dem =  mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `token` != '' AND `type`='smm' AND `status` = 'active'"));  
if($dem > 0){
// kiểm tra xem có đấu nối smm panel nào không
$datasmm = mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `token` != '' AND `type`='smm' AND `status` = 'active'");
while($rowsmm = mysqli_fetch_array($datasmm))
{
$webnguon =  $rowsmm['webnguon'];  
$token =  $rowsmm['token'];
$dem =  mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `apitoken` WHERE `webnguon` = '$webnguon' AND `status`='active'"));  
if($dem !== 1){
echo "Token API của web smm nguồn $webnguon chưa có hoặc đang ngưng kích hoạt, không thể check đơn ! <br>";    
}else{
$datacraws = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `apitoken` WHERE `webnguon` = '$webnguon' AND `status`='active'")); 
$linkapi = $datacraws['function'];
$dem =  mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `area` = '$webnguon' AND `status` !='pending' AND  `status` !='success' AND  `status` !='refund'  AND  `status` !='error'"));  
if($dem == 0){
echo "Không có đơn hàng nào của smm nguồn $webnguon đang chờ được gửi đi ! <br>";        
}else{
$datadonhang = mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `area` = '$webnguon' AND `status` !='pending' AND  `status` !='success' AND  `status` !='refund'  AND  `status` !='error'  ORDER BY RAND() LIMIT 200");
while($row = mysqli_fetch_array($datadonhang))
{
$results[] = $row['codeoder'];
}
$b = json_encode($results);
$response = trim($b,'["');
$codeoder = str_replace('","', ',', $response); // mã đơn đã xử lý
$responsev = trim($codeoder,'"]');
if($dem == 1){
$post = array(
    'key' => $token, 
    'action' => 'status',
    'orders' => "$responsev,$responsev");
}else{
$post = array(
    'key' => $token, 
    'action' => 'status',
    'orders' => implode(",", (array)$responsev));    
}    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $linkapi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        $result = curl_exec($ch);
        $obj = json_decode($result);        
        curl_close($ch);
$soluong = count($results);
$response = explode(",", $responsev); 
for($i = 0;$i <$soluong; $i++ ){
$ma = $response[$i];
$status = $obj -> $ma-> status;
$conlai = $obj -> $ma-> remains;
$goc = $obj -> $ma-> start_count;
$datausear = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `codeoder` ='$ma'"));
$donodera = $datausear['soluong'];
$dachay = $donodera - $conlai;
if($status == 'Canceled'){
mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'error',`dachay`='$dachay',`goc`='$goc' WHERE `codeoder`= '$ma'");    
}elseif($status == 'Completed'){
mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'success',`dachay`='$dachay',`goc`='$goc' WHERE `codeoder`= '$ma'");    
}elseif($status == 'In progress'){
mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'inprogess',`dachay`='$dachay',`goc`='$goc' WHERE `codeoder`= '$ma'");    
}elseif($status == 'Processing'){
mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'inprogess',`dachay`='$dachay',`goc`='$goc' WHERE `codeoder`= '$ma'");    
}elseif($status == 'Partial'){
mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'partial',`dachay`='$dachay',`goc`='$goc' WHERE `codeoder`= '$ma'");    
}
}
echo "Đã check đơn cho $webnguon thành công !<br>";
        }
    }
}
}else{
echo 'Không có panel smm nào đang đấu nối !<br>';   
}
?>