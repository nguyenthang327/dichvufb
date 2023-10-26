<?php
require('../../system/config.php');
require('../../system/check-uid.php'); 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `tinhnang` = '46' AND `status`='inprogess'  AND `webdinhdanh` = '$domain'"));
if($dem > 0){
$tokendichvu = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='traodoisub'  AND `webdinhdanh` = '$domain'"));
$token = $tokendichvu['token'];
$checktkmk =  explode("/", $token);
$taikhoantds = $checktkmk['0'];
$matkhautds = $checktkmk['1'];
$cookitds = get_cookie($taikhoantds,$matkhautds);  
$cookitdsv3 = "PHPSESSID=".$cookitds["PHPSESSID"];
$data = "page=1&query=";
$refff = 'https://traodoisub.com/mua/share/';
$res = curl_sendtds($cookitdsv3,"https://traodoisub.com/mua/share/fetch.php",$data,$refff);
$obj = json_decode($res);
$data = $obj->data;
$soluong = count($data);

for($i = 0;$i < $soluong; $i++ ){
     $codeoder  = $data[$i]-> note;
     $soluongoder = $data[$i] -> sl;
    $soluongdabuff = $data[$i] -> datang;
     $goc =  $data[$i] -> start;// đã buff// cái này ko quan trọng
    // Đếm mã đơn hàng có tồn tại không ? (không comment)
    $dem1 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `codeoder` ='$codeoder' AND `status`!='success' AND `status`!='error' AND `status`!='refund' AND `tinhnang` = '46' AND `webdinhdanh` = '$domain'")); // Như vậy là còn đang chạy  Active hoặc chưa có kết quả
     // Đếm mã đơn hàng có tồn tại không ? ( comment)
    if($dem1  > 0){
    if($soluongdabuff >= $soluongoder){
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'success',`goc` = '$goc',`dachay`='$soluongdabuff' WHERE `codeoder` ='$codeoder'  AND `tinhnang` = '46' AND `webdinhdanh` = '$domain'");
    }else{
    mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'inprogess',`goc` = '$goc',`dachay`='$soluongdabuff' WHERE `codeoder` ='$codeoder' AND `tinhnang` = '46' AND `webdinhdanh` = '$domain'");        
                    }    
                }
            }     
        
    }
echo "Đã xử lý lịch sử đơn share tds xong ! <br>";
?>