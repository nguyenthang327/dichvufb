<?php
require('../../system/config.php');
require('../../system/check-uid.php'); 
// lấy token traodoisub
$datatoken = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='autofb' AND `webdinhdanh` ='$domain'"));
$token = $datatoken['token'];
$datatoken1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='traodoisub' AND `webdinhdanh` ='$domain'"));
$token1 = $datatoken1['token'];
// tính năng 1 là like rẻ nhé
$kiemtratinhnang = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuccon` WHERE `webnguon` ='traodoisub' AND `webdinhdanh` ='$domain' AND `id` = '44'"));
$action = $kiemtratinhnang['action'];
if($action =='on'){
$dem =  mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `tinhnang`='44' AND `status` = 'pending'"));   
if($dem > 0){
// chống đúp đơn
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'off' WHERE `webnguon` ='traodoisub' AND `webdinhdanh` ='$domain' AND `id` = '44'");
// lấy danh sách đơn hàng - giới hạn tối đa 20 đơn / phút
$datadonhang = mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `tinhnang`='44' AND `status` = 'pending' LIMIT 20");
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
$reaction = $row['reaction'];    
$dayvip = $row['dayvip']; 
$id = $row['id']; 
$checkgiagoc = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `madichvu` ='44' AND `server` = '$server' AND `webdinhdanh` ='$domain'"));
$giagoc = $checkgiagoc['giagoc'];
$pos = strpos($link, 'facebook.com');
if ($pos !== false) {
$link = uid('uid',$link,$token);
}
$code_oder = $row['codeodergoc']; 
$date = date("Y-m-d H:i:sa");
$date1 = date("Y-m-d"); 
$date2 = date("H:i:sa");
$tido = strpos($date2, 'am');
$tido2 = strpos($date2, 'pm');
if($tido !== false) {
$date2 = str_replace("am", "", $date2);
}else{
$date2 = str_replace("pm", "", $date2);    
}
$checktkmk =  explode("/", $token1);
$taikhoantds = $checktkmk['0'];
$matkhautds = $checktkmk['1'];
$dateendcode = urlencode($date1);
$dateendcode2 = urlencode($date2);
$comment  = explode( "\n", $comment );
$comment  = json_encode($comment, JSON_UNESCAPED_UNICODE);
$comment  = str_replace("\r", "", $comment);
$encode = "$dateendcode+$dateendcode2";
$cookitds = get_cookie($taikhoantds,$matkhautds);  
$cookitdsv3 = "PHPSESSID=".$cookitds["PHPSESSID"];
$data = 'maghinho='.$code_oder.'&id='.$link.'&sl='.$soluong.'&noidung='.$comment.'&dateTime='.$encode.'';
$refff = 'https://traodoisub.com/mua/review/';
$res = curl_sendtds($cookitdsv3,"https://traodoisub.com/mua/review/themid.php",$data,$refff);
    if(strpos($res,"thành công")){
mysqli_query($ketnoi,"UPDATE `function` SET `note` = 'Đặt đơn thành công',`codeoder` = '$code_oder',`status` = 'inprogess',`uid` = '$link',`respondapi` = 'Đặt đơn thành công' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");        
}else{mysqli_query($ketnoi,"UPDATE `function` SET `status` = 'error',`note`='Đã xảy ra lỗi, vui lòng kiểm tra lại thông tin nhập vào hoặc liên hệ admin để biết thêm chi tiết',`respondapi` = '$res' WHERE `id` ='$id' AND `webdinhdanh` ='$domain'");}    
}
// kích hoạt lại phiên mới
mysqli_query($ketnoi,"UPDATE `danhmuccon` SET `action` = 'on' WHERE `webnguon` ='traodoisub' AND `webdinhdanh` ='$domain' AND `id` = '44'");
echo "Đã xử lý dánh giá page traodoisub xong <br>";
}else{
echo 'Không có đơn dánh giá page traodoisub nào đang chờ xử lý !';        
}
}else{
echo 'Tính năng đang thực hiện tiến trình hoặc bị treo - nếu đợi quá lâu (> 10p) chạy cron không chạy đơn thì vui lòng kích hoạt lại ở danhmuccon-> action => on !';    
}
?>