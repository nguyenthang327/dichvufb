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
echo "Token API của web smm nguồn $webnguon chưa có hoặc đang ngưng kích hoạt, không thể gửi đơn ! <br>";    
}else{
$datacraws = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `apitoken` WHERE `webnguon` = '$webnguon' AND `status`='active'")); 
$linkapi = $datacraws['function'];
$dem =  mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `area` = '$webnguon' AND `status`='pending'"));  
if($dem == 0){
echo "Không có đơn hàng nào của smm nguồn $webnguon đang chờ được gửi đi ! <br>";        
}else{
$datadonhang = mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `area` = '$webnguon' AND `status`='pending' LIMIT 20");
while($row = mysqli_fetch_array($datadonhang))
{
$link = $row['link'];    
$soluong = $row['soluong'];    
$server = $row['server'];    
$comment = $row['comment']; 
if($row['comment'] !== 'no' && file_exists("../../action/temp/".$row['codeodergoc'].".txt")){
    $filename = "../../action/temp/".$row['codeodergoc'].".txt";
                                                   $fp = fopen($filename, "r");//mở file ở chế độ đọc
                                                    $comment = fread($fp, filesize($filename));//đọc file 
                                                    fclose($fp);
}
//$comment = str_replace("\n", '\n', $comment);
$id = $row['id'];   
$tinhnang = $row['tinhnang']; 
$kiemtratinhnang = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuccon` WHERE `webnguon` ='$webnguon' AND `webdinhdanh` ='$domain' AND `id` = '$tinhnang'"));
$action = $kiemtratinhnang['action'];
if($action =='on'){
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'off' WHERE `id` = '$tinhnang'");
$post = array(
    'key' => $token, 
    'action' => 'add',
    'service' => $server,
    'link' => ''.$link.'',
    'comments' => ''.$comment.'',
    'quantity' => $soluong);
$api = respawnver4($linkapi, $post);
$response = json_decode($api, true);
$order = $response['order'];
if (!empty($order)) {
mysqli_query($ketnoi,"UPDATE `function` SET `note` = 'Đặt đơn thành công',`codeoder` = '$order',`status` = 'inprogess',`uid` = '$link',`respondapi` = 'Đặt đơn thành công' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");            
}else{
$loi = $response['error'];    
mysqli_query($ketnoi,"UPDATE `function` SET `respondapi` = '$loi',`status` = 'error' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");       
}   
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'on' WHERE `id` = '$tinhnang'");
}else{
echo 'Tính năng '.$tinhnang.' đang thực hiện tiến trình hoặc bị treo  - nếu đợi quá lâu (> 10p) chạy cron không chạy đơn thì vui lòng kích hoạt lại ở danhmuccon-> action => on !';        
}    
}
echo "Đã gửi đơn cho $webnguon thành công !<br>";  
        }
    }
}
}else{
echo 'Không có panel smm nào đang đấu nối !<br>';   
}
?>