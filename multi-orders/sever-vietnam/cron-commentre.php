<?php
require('../../system/config.php');
require('../../system/check-uid.php'); 
// lấy token autofb
$datatoken = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain'"));
$token = $datatoken['token'];
$datatoken1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='subgiare' AND `webdinhdanh` ='$domain'"));
$token1 = $datatoken1['token'];
// tính năng 1 là like rẻ nhé
$kiemtratinhnang = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuccon` WHERE `webnguon` ='subgiare' AND `webdinhdanh` ='$domain' AND `id` = '5'"));
$action = $kiemtratinhnang['action'];
if($action =='on'){
$dem =  mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `tinhnang`='5' AND `status` = 'pending'"));   
if($dem > 0){
// chống đúp đơn
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'off' WHERE `webnguon` ='subgiare' AND `webdinhdanh` ='$domain' AND `id` = '5'");
// lấy danh sách đơn hàng - giới hạn tối đa 20 đơn / phút
$datadonhang = mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `tinhnang`='5' AND `status` = 'pending' LIMIT 20");
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
if($comment == 'no'){$comment ='';}
$reaction = $row['reaction'];  if($reaction == 'no'){$reaction ='';}  
$dayvip = $row['dayvip'];       if($dayvip == 'no'){$dayvip ='';}
$id = $row['id']; 
$checkgiagoc = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `madichvu` ='5' AND `server` = '$server' AND `webdinhdanh` ='$domain'"));
$giagoc = $checkgiagoc['giagoc'];

$number =  substr_count($comment, "\n") + 1;
$data = urldecode("server_order=$server&link_post=$link&comment=$comment&amount=$number&note=API");
$res = curl_send1("/api/service/facebook/comment-sale/order","https://$g/api/service/facebook/comment-sale/order",$data,$token1);
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
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'on' WHERE `webnguon` ='subgiare' AND `webdinhdanh` ='$domain' AND `id` = '5'");
echo "Đã xử lý comment clone xong <br>";
}else{
echo 'Không có đơn comment clone nào đang chờ xử lý !';        
}
}else{
echo 'Tính năng đang thực hiện tiến trình hoặc bị treo - nếu đợi quá lâu (> 10p) chạy cron không chạy đơn thì vui lòng kích hoạt lại ở danhmuccon-> action => on !';    
}
?>