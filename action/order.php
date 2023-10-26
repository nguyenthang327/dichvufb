<?php
require('../system/config.php');
$expa2 = date('Y-m-d');
if ($_POST && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
if(isset($_POST['link']) && isset($_POST['server']) && isset($_POST['amount']) && isset($_SESSION['username'])){
$link = xss($_POST['link']);   
$server = xss($_POST['server']);
$amount = xss($_POST['amount']);
if(empty($link)){
   echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Vui lòng nhập Link cần tăng"));
 exit();     
}elseif($activeacc == 0){
   echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Tài khoản của bạn đã bị cấm, không thể sử dụng dịch vụ vui lòng liên hệ Admin"));
 exit();         
}
// check xem server đó có trên hệ thống không ?
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `chietkhau` WHERE `id` ='$server' AND `webdinhdanh` ='$domain'"));
if($dem == 0){
   echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Vui lòng chọn máy chủ trong danh sách"));
 exit(); 
}else{
$datauserbuff = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `id`='$server' AND `webdinhdanh` ='$domain'"));
$min = $datauserbuff['min'];
$madichvu = $datauserbuff['madichvu'];
$max = $datauserbuff['max'];
$statussv = $datauserbuff['status'];
$server2 = $datauserbuff['server'];
$loaihinh = $datauserbuff['loaihinh'];
$giagoc = $datauserbuff['giagoc'];
$giabuff = $datauserbuff[$giatri];
$reaction = $datauserbuff['reaction'];
$comment = $datauserbuff['comment'];
$minutes = $datauserbuff['minutes'];
$dayvip = $datauserbuff['dayvip'];
$type = $datauserbuff['tinhnang'];
$area = $datauserbuff['type'];
$limitday = $datauserbuff['exchange'];
if($reaction =='yes'){
$reaction = xss($_POST['reaction']);   
switch ($reaction) {
  case 'like':
    break;
  case 'haha':
    break;
  case 'wow':
    break;
  case 'care':
    break;
  case 'love':
    break;
  case 'sad':
    break;
  case 'angry':
    break;
  default:
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Cảm xúc không hợp lệ, vui lòng chọn biểu cảm trong danh sách  "));
 exit(); 
}
}
if($comment =='yes'){
$comment = $_POST['comment']; 
$comment1 = addslashes($comment);
$soluongcmt =  substr_count($comment, "\n") + 1;
if($soluongcmt - $amount !== 0 and $area!='dontay'){
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Số dòng comment phải bằng số lượng (số dòng hiện tại = $soluongcmt, số lượng yêu cầu = $amount)"));
 exit();         
}
}if($minutes =='yes'){
$minutes = xss($_POST['minutes']);  
if($minutes < 30){
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Số phút tối thiểu là 30 phút"));
 exit();      
}elseif($minutes > 1200){
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Số phút tối đa là 1200 phút"));
 exit();      
}
$tiengio = $minutes;
}else{
$tiengio = 1;    
}

if($dayvip == 'yes'){
if($datauserbuff['comment'] !== 'yes'){    
$dayvip = xss($_POST['dayvip']);  
if($dayvip < 7){
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Số ngày tăng VIP tối thiểu là 7 ngày"));
 exit();      
}elseif($dayvip > 180){
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Số ngày tăng VIP tối đa là 180 ngày"));
 exit();      
}
$ngayvip = $dayvip / 30;
}else{
$dayvip = xss($_POST['dayvip']);  
if($dayvip < 15){
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Số ngày tăng VIP tối thiểu là 15 ngày"));
 exit();      
}elseif($dayvip > 90){
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Số ngày tăng VIP tối đa là 90 ngày"));
 exit();      
}
$ngayvip = $dayvip / 30;
    
}
}else{
$ngayvip = 1;    
}
if(isset($_POST['dayvip']) && isset($_POST['minutes'])){
$ngayvip = 1 * 10;     // 5 lượt live mỗi ngày và 10 lần live trong quá trình dùng
}
if($amount < $min || $amount > $max){
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Số lượng không hợp lệ"));
 exit();     
}
$demluongdon = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `tinhnang` ='$madichvu' AND `webdinhdanh` = '$domain' AND `date` >= '$expa2 00:00:00'"));
if($limitday < $demluongdon){
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Số lượng đơn đã đến giới hạn, xin vui lòng quay lại vào ngày mai !"));
 exit();      
}
if($cheat == 'off'){
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Hệ thống đang bận, xin thử lại sau 5 phút"));
 exit();     
}elseif($statussv == 'off'){
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Server này đang đóng, vui lòng thử lại sau "));
 exit();     
}else{
$giagoc = $amount * $tiengio * $ngayvip * $giagoc;
$giatien = $amount * $tiengio * $ngayvip * $giabuff;
$exp = $giatien - $giagoc;
$cashmoi = $cash - $giatien;
if($cash > $giatien){
// antibug & trừ tiền
mysqli_query($ketnoi,"UPDATE `accounts` SET 
cheat = 'off', `cash` = '$cashmoi' WHERE username='$username'");
// thêm lịch sử đơn
$code_oder = floor(microtime(true) * 1000);
$date = date("Y-m-d H:i:sa");
mysqli_query($ketnoi, "INSERT INTO `function` (`username`, `type`,`tinhnang`,`root`,`server`, `link`,`uid`, `comment`,`sophut`,`reaction`, `dayvip`, `goc`, `soluong`, `dachay`, `cashtru`,`rate`, `exp`, `codeodergoc`, `codeoder`, `respondapi`, `status`, `date`, `note`,`area`, `webdinhdanh`) 
VALUES ('$username','$type','$madichvu','$server','$server2','$link','','$comment1','$minutes','$reaction','$dayvip','','$amount','','$giatien','$giabuff','$exp','$code_oder','','','pending','$date','','$area', '$domain')"); 
// thêm lịch sử dùng
mysqli_query($ketnoi, "INSERT INTO `history` (`username`, `type`, `coinfirst`, `coinsecond`,`coin`,`codeoder`, `date`, `note`, `webdinhdanh`)
VALUES ('$username','$type','$cash','$cashmoi','$giatien','$code_oder','$date','$loaihinh', '$domain')"); 
// reactive
mysqli_query($ketnoi,"UPDATE `accounts` SET 
cheat = 'on' WHERE username='$username'");
 if($area == 'dontay'){
 $datamainsys = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon`= 'dontay'"));
$padt = $datamainsys['token'];
$dataabs = explode("/",$padt);
$one = $dataabs[0];
$two = $dataabs[1];
$responsea = file_get_contents("https://api.telegram.org/bot$one/sendMessage?chat_id=$two&text=Đơn tay $type mới , vào xử lý nhé Admin !");    
}
if($comment !== 'no'){
$ghi = fopen( "temp/$code_oder.txt", "w" );
            fwrite($ghi,$comment);
            fclose($ghi);
}
 echo json_encode(array('status' => "success", 'title' => "SUCCESS", 'msg' => "Đặt đơn thành công !"));

 exit();
// cập nhật kích hoạt

}else{
 echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Số dư hiện tại của quý khách không đủ để thực hiện thao tác, quý khách cần ".number_format($giatien)." VNĐ!"));
 exit();      
        }
    }
}
    }else{
echo json_encode(array('status' => "error", 'title' => "ERROR", 'msg' => "Vui lòng tải lại trang và thử gửi lại ."));
 exit();               
    }
}

?>