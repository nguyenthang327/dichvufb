<?php
require_once('../system/config.php');
$expa2 = date('Y-m-d');
if(isset($_POST['key']) && isset($_POST['action'])){
$data['key'] =  $_POST['key'];
$data['action'] = $_POST['action'];
if(isset($_POST['order'])){
$data['order'] = $_POST['order'];    
}if(isset($_POST['service'])){
$data['service'] = $_POST['service'];       
}if(isset($_POST['link'])){
$data['link'] = $_POST['link'];       
}if(isset($_POST['quantity'])){
$data['quantity'] = $_POST['quantity'];       
}if(isset($_POST['reaction'])){
$data['reaction'] = $_POST['reaction'];       
}
if(isset($_POST['minutes'])){
$data['minutes'] = $_POST['minutes'];       
}
if(isset($_POST['dayvip'])){
$data['dayvip'] = $_POST['dayvip'];       
}
if(isset($_POST['orders'])){
$data['orders'] = $_POST['orders'];       
}
if(isset($_POST['comments'])){
$data['comments'] = $_POST['comments'];       
}

$key = htmlspecialchars($data['key']);
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `api` ='$key' AND `webdinhdanh` ='$domain'"));
if($dem == 1){
$datauser1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `accounts` WHERE `api` ='$key' AND `webdinhdanh` ='$domain'"));    
$ctv = $datauser1['ctv'];
$cheat = $datauser1['cheat'];
$activeacc = $datauser1['active'];
$username1 = $datauser1['username'];
if($ctv == '0'){
$giatri ='cap0';    
}elseif($ctv == '1'){
$giatri ='cap1';    
}elseif($ctv == '2'){
$giatri ='cap2';     
}elseif($ctv == '3'){
$giatri ='cap3';     
}elseif($ctv == '4'){
$giatri ='cap4';     
}elseif($ctv == '5'){
$giatri ='cap5';     
}    
$action = htmlspecialchars($data['action']);
if($action == 'balance'){
$cash1 = $datauser1['cash'];   
 echo json_encode(array('balance' => "$cash1",'currency' => "VND"));   
 exit();   
    
}elseif($action == 'add'){
if(!empty($data['service'])){    
$service = htmlspecialchars($data['service']); 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `chietkhau` WHERE `id` ='$service'"));
if($dem == 1){
$datauserbuff = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `id` ='$service'")); 
$min = $datauserbuff['min'];
$madichvu = $datauserbuff['madichvu'];
$max = $datauserbuff['max'];
$server2 = $datauserbuff['server'];
$loaihinh = $datauserbuff['loaihinh'];
$giagoc = $datauserbuff['giagoc'];
$giabuff = $datauserbuff[$giatri];
$statussv = $datauserbuff['status'];
$reaction = $datauserbuff['reaction'];
$comment = $datauserbuff['comment'];
$minutes = $datauserbuff['minutes'];
$dayvip = $datauserbuff['dayvip'];
$type = $datauserbuff['tinhnang'];
$area = $datauserbuff['type'];
$limitday = $datauserbuff['exchange'];
$link = htmlspecialchars($data['link']); 
if(!empty($data['link'])){
if($activeacc !== 0){
if($reaction == 'yes'){
if(!empty($data['reaction'])){
switch ($data['reaction']) {
  case 'like':
      $reaction = $data['reaction'];
    break;
  case 'haha':
      $reaction = $data['reaction'];
    break;
  case 'wow':
      $reaction = $data['reaction'];
    break;
  case 'care':
      $reaction = $data['reaction'];
    break;
  case 'love':
      $reaction = $data['reaction'];
    break;
  case 'sad':
          $reaction = $data['reaction'];
    break;
  case 'angry':
          $reaction = $data['reaction'];
    break;
  default:
     $reaction = 'like';
        }    
    }else{
  $reaction = 'like';      
    }    
} 
if($comment =='yes'){
if(!empty($data['comments'])){
$comment = addslashes($data['comments']);
$quantity =  substr_count($data['comments'], "\n") + 1;    
}else{
echo json_encode(array('error' => "Invalid Comments !"));     
exit();    
}    
}else{
$quantity = htmlspecialchars($data['quantity']);   
}

if($minutes =='yes'){
if(!empty($data['minutes'])){
if($data['minutes'] < 30 || $data['minutes'] > 1200){
echo json_encode(array('error' => "Invalid minutes min 30, max 1200 !"));     
exit();     
}else{
$tiengio = $minutes;    
}    
}else{
$tiengio = 30;    
}
}else{
$tiengio = 1;    
}
if($dayvip =='yes' && $datauserbuff['comment'] == 'yes'){
if(!empty($data['dayvip'])){
$dayvip = $data['dayvip'];    
if($data['dayvip'] < 7 || $data['dayvip'] > 180){
echo json_encode(array('error' => "Invalid dayvip min 7, max 180 !"));     
exit();     
}else{
$ngayvip = $data['dayvip'] / 30;    
}    
}else{
$data['dayvip'] = 30;  
$dayvip = $data['dayvip'];  
$ngayvip = $data['dayvip'] / 30;    
    }    
}elseif($dayvip =='yes' && $minutes == 'yes'){
if(!empty($data['dayvip'])){
$dayvip = $data['dayvip'];    
$ngayvip = 1 * 10;    
}else{
$data['dayvip'] = 30;  
$dayvip = $data['dayvip'];  
$ngayvip = $data['dayvip'] / 30;    
}    
}elseif($dayvip =='yes'){
if(!empty($data['dayvip'])){
$dayvip = $data['dayvip'];    
if($data['dayvip'] < 15 || $data['dayvip'] > 90){
echo json_encode(array('error' => "Invalid dayvip min 15, max 90 !"));     
exit();     
}else{
$ngayvip = $data['dayvip'] / 30;    
}    
}else{
$data['dayvip'] = 30;  
$dayvip = $data['dayvip'];  
$ngayvip = $data['dayvip'] / 30;    
    }      
}else{
$ngayvip = 1;    
}    

if($quantity < $min || $quantity > $max){
echo json_encode(array('error' => "Invalid quantity !"));     
exit();      
}else{
$demluongdon = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `tinhnang` ='$madichvu' AND `webdinhdanh` = '$domain' AND `date` >= '$expa2 00:00:00'"));
if($limitday < $demluongdon){
echo json_encode(array('error' => "Limit order day, please use in next day !"));     
exit();      
} 
if($statussv == 'off'){
echo json_encode(array('error' => "Server maintenance !")); 
 exit();     
}
if($cheat == 'off'){
echo json_encode(array('error' => "Sever is busy !"));     
exit();     
}else{
$giagoc = $quantity * $tiengio * $ngayvip * $giagoc;
$giatien = $quantity * $tiengio * $ngayvip * $giabuff;
$exp = $giatien - $giagoc;
$cash = $datauser1['cash'];
if($cash >= $giatien){
$cashmoi = $cash - $giatien;
mysqli_query($ketnoi,"UPDATE `accounts` SET 
cheat = 'off', `cash` = '$cashmoi' WHERE `username` ='$username1'");
$code_oder = floor(microtime(true) * 1000);
$date = date("Y-m-d H:i:sa");
mysqli_query($ketnoi, "INSERT INTO `function` (`username`, `type`,`tinhnang`,`root`,`server`, `link`,`uid`, `comment`,`sophut`,`reaction`, `dayvip`, `goc`, `soluong`, `dachay`, `cashtru`,`rate`, `exp`, `codeodergoc`, `codeoder`, `respondapi`, `status`, `date`, `note`,`area`, `webdinhdanh`) 
VALUES ('$username1','$type','$madichvu','$service','$server2','$link','','$comment','$minutes','$reaction','$dayvip','','$quantity','','$giatien','$giabuff','$exp','$code_oder','','','pending','$date','','$area', '$domain')"); 
// thêm lịch sử dùng
mysqli_query($ketnoi, "INSERT INTO `history` (`username`, `type`, `coinfirst`, `coinsecond`,`coin`,`codeoder`, `date`, `note`, `webdinhdanh`)
VALUES ('$username1','$type','$cash','$cashmoi','$giatien','$code_oder','$date','$loaihinh', '$domain')"); 
// reactive
mysqli_query($ketnoi,"UPDATE `accounts` SET 
cheat = 'on' WHERE username='$username1'");
 if($area == 'dontay'){
 $datamainsys = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon`= 'dontay'"));
$padt = $datamainsys['token'];
$dataabs = explode("/",$padt);
$one = $dataabs[0];
$two = $dataabs[1];
$responsea = file_get_contents("https://api.telegram.org/bot$one/sendMessage?chat_id=$two&text=Đơn tay $type mới , vào xử lý nhé Admin !");    
}
if($comment !== 'no'){
$ghi = fopen( "../action/temp/$code_oder.txt", "w" );
            fwrite($ghi,$data['comments']);
            fclose($ghi);
}
 echo json_encode(array('order' => "$code_oder"));

 exit();
// cập nhật kích hoạt
}else{
echo json_encode(array('error' => "Balance not enough !"));     
exit();     
}
}    
}    


}else{
echo json_encode(array('error' => "Your account has been Baned !"));     
exit();     
}    
}else{
echo json_encode(array('error' => "Invalid Link"));     
exit();      
}
}else{
echo json_encode(array('error' => "Invalid service"));     
exit();     
}
}else{
echo json_encode(array('error' => "Invalid service"));     
exit();    
}
}elseif($action == 'status'){
if(!empty($data['orders'])){
$data1 = explode(",", htmlspecialchars($data['orders'])); 
$soluong = count($data1);
if($soluong < 201){
$hash = '';    
for($i = 0;$i < $soluong;$i++){
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `username` ='$username1' AND `webdinhdanh` ='$domain' AND `codeodergoc` = '$data1[$i]'"));
if($dem == 0){
$ketqua[$i] = array('error' => 'Incorrect order ID');
}else{
$dataorder = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `username` ='$username1' AND `webdinhdanh` ='$domain' AND `codeodergoc` = '$data1[$i]'")); 
if($dataorder['status'] == 'pending'){
$stt = 'Pending';    
}elseif($dataorder['status'] == 'inprogess'){
$stt = 'In progress';    
}elseif($dataorder['status'] == 'success'){
$stt = 'Completed';    
}elseif($dataorder['status'] == 'refund'){
$stt = 'Canceled';    
}elseif($dataorder['status'] == 'error'){
$stt = 'Partial';    
} 
$conlai = $dataorder['soluong'] - $dataorder['dachay'];
$ketqua[$i] =  array('charge' => $dataorder['cashtru'],'start_count' => $dataorder['goc'],'status' => $stt,'remains' => $conlai); 
    }
}
echo json_encode(array_combine($data1, $ketqua));
}else{
echo json_encode(array('error' => "Maximum orders is 200 one time"));     
exit();
    }
}elseif(!empty($data['order'])){
$data1 = htmlspecialchars($data['order']); 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `username` ='$username1' AND `webdinhdanh` ='$domain' AND `codeodergoc` = '$data1'"));
if($dem == 0){
$ketqua = array('error' => 'Incorrect order ID');    
}else{
$dataorder = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `username` ='$username1' AND `webdinhdanh` ='$domain' AND `codeodergoc` = '$data1' LIMIT 1")); 
if($dataorder['status'] == 'pending'){
$stt = 'Pending';    
}elseif($dataorder['status'] == 'inprogess'){
$stt = 'In progress';    
}elseif($dataorder['status'] == 'success'){
$stt = 'Completed';    
}elseif($dataorder['status'] == 'refund'){
$stt = 'Canceled';    
}elseif($dataorder['status'] == 'error'){
$stt = 'Partial';    
}  
$conlai = $dataorder['soluong'] - $dataorder['dachay'];
$ketqua =  array('charge' => $dataorder['cashtru'],'start_count' => $dataorder['goc'],'status' => $stt,'remains' => $conlai); 

        }
echo json_encode($ketqua);          
    }
}elseif($action == 'services'){
$datadonhang1 = mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `webdinhdanh` = '$domain'");
$results = array();
while($datadonhang = mysqli_fetch_array($datadonhang1))
{
if($datadonhang['comment'] == 'yes'){
$type1 = 'Custom Comments';     
}else{
$type1 = 'Default';        
}   
$results[] = array(
    'service' => $datadonhang['id'], 
    'name' => $datadonhang['tendichvu'], 
    'type' => $type1, 
    'category' => $datadonhang['loaihinh'], 
    'rate' => $datadonhang[$giatri], 
    'min' => $datadonhang['min'],	
    'max' => $datadonhang['max']); 
		
}
echo json_encode($results);
 exit();
}else{
 echo json_encode(array('error' => "Invalid action"));      
 exit();    
}
}else{
 echo json_encode(array('error' => "Invalid API key"));      
 exit();
}

}else{
$data = json_decode(file_get_contents('php://input'), true);
if(empty($data)){
 echo json_encode(array('error' => "Incorrect request"));   
 exit();
}else{
$key = htmlspecialchars($data['key']);
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `api` ='$key' AND `webdinhdanh` ='$domain'"));
if($dem == 1){
$datauser1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `accounts` WHERE `api` ='$key' AND `webdinhdanh` ='$domain'"));    
$ctv = $datauser1['ctv'];
$cheat = $datauser1['cheat'];
$activeacc = $datauser1['active'];
$username1 = $datauser1['username'];
if($ctv == '0'){
$giatri ='cap0';    
}elseif($ctv == '1'){
$giatri ='cap1';    
}elseif($ctv == '2'){
$giatri ='cap2';     
}elseif($ctv == '3'){
$giatri ='cap3';     
}elseif($ctv == '4'){
$giatri ='cap4';     
}elseif($ctv == '5'){
$giatri ='cap5';     
}    
$action = htmlspecialchars($data['action']);
if($action == 'balance'){
$cash1 = $datauser1['cash'];   
 echo json_encode(array('balance' => "$cash1",'currency' => "VND"));   
 exit();   
    
}elseif($action == 'add'){
if(!empty($data['service'])){    
$service = htmlspecialchars($data['service']); 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `chietkhau` WHERE `id` ='$service'"));
if($dem == 1){
$datauserbuff = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `id` ='$service'")); 
$min = $datauserbuff['min'];
$madichvu = $datauserbuff['madichvu'];
$max = $datauserbuff['max'];
$server2 = $datauserbuff['server'];
$loaihinh = $datauserbuff['loaihinh'];
$statussv = $datauserbuff['status'];
$giagoc = $datauserbuff['giagoc'];
$giabuff = $datauserbuff[$giatri];
$reaction = $datauserbuff['reaction'];
$comment = $datauserbuff['comment'];
$minutes = $datauserbuff['minutes'];
$dayvip = $datauserbuff['dayvip'];
$type = $datauserbuff['tinhnang'];
$area = $datauserbuff['type'];
$limitday = $datauserbuff['exchange'];
$link = htmlspecialchars($data['link']); 
if(!empty($data['link'])){
if($activeacc !== 0){
if($reaction == 'yes'){
if(!empty($data['reaction'])){
switch ($data['reaction']) {
  case 'like':
      $reaction = $data['reaction'];
    break;
  case 'haha':
      $reaction = $data['reaction'];
    break;
  case 'wow':
      $reaction = $data['reaction'];
    break;
  case 'care':
      $reaction = $data['reaction'];
    break;
  case 'love':
      $reaction = $data['reaction'];
    break;
  case 'sad':
          $reaction = $data['reaction'];
    break;
  case 'angry':
          $reaction = $data['reaction'];
    break;
  default:
     $reaction = 'like';
        }    
    }else{
  $reaction = 'like';      
    }    
} 
if($comment =='yes'){
if(!empty($data['comments'])){
$comment = addslashes($data['comments']);
$quantity =  substr_count($data['comments'], "\n") + 1;    
}else{
echo json_encode(array('error' => "Invalid Comments !"));     
exit();    
}    
}else{
$quantity = htmlspecialchars($data['quantity']);   
}

if($minutes =='yes'){
if(!empty($data['minutes'])){
if($data['minutes'] < 30 || $data['minutes'] > 1200){
echo json_encode(array('error' => "Invalid minutes min 30, max 1200 !"));     
exit();     
}else{
$tiengio = $minutes;    
}    
}else{
$tiengio = 30;    
}
}else{
$tiengio = 1;    
}
if($dayvip =='yes' && $datauserbuff['comment'] == 'yes'){
if(!empty($data['dayvip'])){
$dayvip = $data['dayvip'];    
if($data['dayvip'] < 7 || $data['dayvip'] > 180){
echo json_encode(array('error' => "Invalid dayvip min 7, max 180 !"));     
exit();     
}else{
$ngayvip = $data['dayvip'] / 30;    
}    
}else{
$data['dayvip'] = 30;  
$dayvip = $data['dayvip'];  
$ngayvip = $data['dayvip'] / 30;    
    }    
}elseif($dayvip =='yes' && $minutes == 'yes'){
if(!empty($data['dayvip'])){
$dayvip = $data['dayvip'];    
$ngayvip = 1 * 10;    
}else{
$data['dayvip'] = 30;  
$dayvip = $data['dayvip'];  
$ngayvip = $data['dayvip'] / 30;    
}    
}elseif($dayvip =='yes'){
if(!empty($data['dayvip'])){
$dayvip = $data['dayvip'];    
if($data['dayvip'] < 15 || $data['dayvip'] > 90){
echo json_encode(array('error' => "Invalid dayvip min 15, max 90 !"));     
exit();     
}else{
$ngayvip = $data['dayvip'] / 30;    
}    
}else{
$data['dayvip'] = 30;  
$dayvip = $data['dayvip'];  
$ngayvip = $data['dayvip'] / 30;    
    }      
}else{
$ngayvip = 1;    
}    

if($quantity < $min || $quantity > $max){
echo json_encode(array('error' => "Invalid quantity !"));     
exit();      
}else{
$demluongdon = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `tinhnang` ='$madichvu' AND `webdinhdanh` = '$domain' AND `date` >= '$expa2 00:00:00'"));
if($limitday < $demluongdon){
echo json_encode(array('error' => "Limit order day, please use in next day !"));     
exit();      
}  
if($statussv == 'off'){
echo json_encode(array('error' => "Server maintenance !")); 
 exit();     
}
if($cheat == 'off'){
echo json_encode(array('error' => "Sever is busy !"));     
exit();     
}else{
$giagoc = $quantity * $tiengio * $ngayvip * $giagoc;
$giatien = $quantity * $tiengio * $ngayvip * $giabuff;
$exp = $giatien - $giagoc;
$cash = $datauser1['cash'];
if($cash >= $giatien){
$cashmoi = $cash - $giatien;
mysqli_query($ketnoi,"UPDATE `accounts` SET 
cheat = 'off', `cash` = '$cashmoi' WHERE `username` ='$username1'");
$code_oder = floor(microtime(true) * 1000);
$date = date("Y-m-d H:i:sa");
mysqli_query($ketnoi, "INSERT INTO `function` (`username`, `type`,`tinhnang`,`root`,`server`, `link`,`uid`, `comment`,`sophut`,`reaction`, `dayvip`, `goc`, `soluong`, `dachay`, `cashtru`,`rate`, `exp`, `codeodergoc`, `codeoder`, `respondapi`, `status`, `date`, `note`,`area`, `webdinhdanh`) 
VALUES ('$username1','$type','$madichvu','$service','$server2','$link','','$comment','$minutes','$reaction','$dayvip','','$quantity','','$giatien','$giabuff','$exp','$code_oder','','','pending','$date','','$area', '$domain')"); 
// thêm lịch sử dùng
mysqli_query($ketnoi, "INSERT INTO `history` (`username`, `type`, `coinfirst`, `coinsecond`,`coin`,`codeoder`, `date`, `note`, `webdinhdanh`)
VALUES ('$username1','$type','$cash','$cashmoi','$giatien','$code_oder','$date','$loaihinh', '$domain')"); 
// reactive
mysqli_query($ketnoi,"UPDATE `accounts` SET 
cheat = 'on' WHERE username='$username1'");
 if($area == 'dontay'){
 $datamainsys = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon`= 'dontay'"));
$padt = $datamainsys['token'];
$dataabs = explode("/",$padt);
$one = $dataabs[0];
$two = $dataabs[1];
$responsea = file_get_contents("https://api.telegram.org/bot$one/sendMessage?chat_id=$two&text=Đơn tay $type mới , vào xử lý nhé Admin !");    
}
if($comment !== 'no'){
$ghi = fopen( "../action/temp/$code_oder.txt", "w" );
            fwrite($ghi,$data['comments']);
            fclose($ghi);
}
 echo json_encode(array('order' => "$code_oder"));

 exit();
// cập nhật kích hoạt
}else{
echo json_encode(array('error' => "Balance not enough !"));     
exit();     
}
}    
}    


}else{
echo json_encode(array('error' => "Your account has been Baned !"));     
exit();     
}    
}else{
echo json_encode(array('error' => "Invalid Link"));     
exit();      
}
}else{
echo json_encode(array('error' => "Invalid service"));     
exit();     
}
}else{
echo json_encode(array('error' => "Invalid service"));     
exit();    
}
}elseif($action == 'status'){
if(!empty($data['orders'])){
$data1 = explode(",", htmlspecialchars($data['orders'])); 
$soluong = count($data1);
if($soluong < 201){
$hash = '';    
for($i = 0;$i < $soluong;$i++){
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `username` ='$username1' AND `webdinhdanh` ='$domain' AND `codeodergoc` = '$data1[$i]'"));
if($dem == 0){
$ketqua[$i] = array('error' => 'Incorrect order ID');
}else{
$dataorder = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `username` ='$username1' AND `webdinhdanh` ='$domain' AND `codeodergoc` = '$data1[$i]'")); 
if($dataorder['status'] == 'pending'){
$stt = 'Pending';    
}elseif($dataorder['status'] == 'inprogress'){
$stt = 'In progress';    
}elseif($dataorder['status'] == 'success'){
$stt = 'Completed';    
}elseif($dataorder['status'] == 'refund'){
$stt = 'Refunded';    
}elseif($dataorder['status'] == 'error'){
$stt = 'Canceled';    
} 
$conlai = $dataorder['soluong'] - $dataorder['dachay'];
$ketqua[$i] =  array('charge' => $dataorder['cashtru'],'start_count' => $dataorder['goc'],'status' => $stt,'remains' => $conlai); 
    }
}
echo json_encode(array_combine($data1, $ketqua));
}else{
echo json_encode(array('error' => "Maximum orders is 200 one time"));     
exit();
    }
}elseif(!empty($data['order'])){
$data1 = htmlspecialchars($data['order']); 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `username` ='$username1' AND `webdinhdanh` ='$domain' AND `codeodergoc` = '$data1'"));
if($dem == 0){
$ketqua = array('error' => 'Incorrect order ID');    
}else{
$dataorder = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `username` ='$username1' AND `webdinhdanh` ='$domain' AND `codeodergoc` = '$data1' LIMIT 1")); 
if($dataorder['status'] == 'pending'){
$stt = 'Pending';    
}elseif($dataorder['status'] == 'inprogess'){
$stt = 'In progress';    
}elseif($dataorder['status'] == 'success'){
$stt = 'Completed';    
}elseif($dataorder['status'] == 'refund'){
$stt = 'Canceled';    
}elseif($dataorder['status'] == 'error'){
$stt = 'Partial';    
} 
$conlai = $dataorder['soluong'] - $dataorder['dachay'];
$ketqua =  array('charge' => $dataorder['cashtru'],'start_count' => $dataorder['goc'],'status' => $stt,'remains' => $conlai); 

        }
echo json_encode($ketqua);          
    }
}elseif($action == 'services'){
$datadonhang1 = mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `webdinhdanh` = '$domain'");
$results = array();
while($datadonhang = mysqli_fetch_array($datadonhang1))
{
if($datadonhang['comment'] == 'yes'){
$type1 = 'Custom Comments';     
}else{
$type1 = 'Default';        
}   
$results[] = array(
    'service' => $datadonhang['id'], 
    'name' => $datadonhang['tendichvu'], 
    'type' => $type1, 
    'category' => $datadonhang['loaihinh'], 
    'rate' => $datadonhang[$giatri], 
    'min' => $datadonhang['min'],	
    'max' => $datadonhang['max']); 
		
}
echo json_encode($results);
 exit();
}elseif($action == 'floder'){
$datadonhang1 = mysqli_query($ketnoi, "SELECT * FROM `danhmuc` WHERE `webdinhdanh` = '$domain'");
$results = array();
while($datadonhang = mysqli_fetch_array($datadonhang1))
{
$results[] = array(
    'id' => $datadonhang['id'], 
    'sapxep' => $datadonhang['sapxep'], 
    'tendichvu' => $datadonhang['tendichvu'], 
    'icon' => $datadonhang['icon'], 
    'time' => $datadonhang['time']); 
}
echo json_encode($results);
 exit();
}elseif($action == 'flodercon'){
$datadonhang1 = mysqli_query($ketnoi, "SELECT * FROM `danhmuctinhnang` WHERE `webdinhdanh` = '$domain'");
$results = array();
while($datadonhang = mysqli_fetch_array($datadonhang1))
{
$results[] = array(
    'id' => $datadonhang['id'], 
    'danhmuc' => $datadonhang['danhmuc'], 
    'sapxep' => $datadonhang['sapxep'], 
    'tendichvu' => $datadonhang['tendichvu'], 
    'icon' => $datadonhang['icon'],
    'time' => $datadonhang['time']
    ); 
}
echo json_encode($results);
 exit();
}elseif($action == 'tinhnang'){
$datadonhang1 = mysqli_query($ketnoi, "SELECT * FROM `danhmuccon` WHERE `webdinhdanh` = '$domain'");
$results = array();
while($datadonhang = mysqli_fetch_array($datadonhang1))
{
$results[] = array(
    'id' => $datadonhang['id'], 
    'sapxep' => $datadonhang['sapxep'], 
    'danhmuctinhnang' => $datadonhang['danhmuctinhnang'], 
    'webnguon' => $datadonhang['webnguon'], 
    'action' => $datadonhang['action'],
    'tendichvucon' => $datadonhang['tendichvucon'],
    'time' => $datadonhang['time'],
    'type' => 'webchinh'
    ); 
}
echo json_encode($results);
 exit();
}elseif($action == 'server'){
$datadonhang1 = mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `webdinhdanh` = '$domain'");
$results = array();
while($datadonhang = mysqli_fetch_array($datadonhang1))
{
$results[] = array(
    'id' => $datadonhang['id'], 
    'loaihinh' => $datadonhang['loaihinh'], 
    'tinhnang' => $datadonhang['tinhnang'], 
    'madichvu' => $datadonhang['madichvu'], 
    'tendichvu' => $datadonhang['tendichvu'],
    'server' => $datadonhang['server'],
    'giagoc' => $datadonhang[$giatri],
    'min' => $datadonhang['min'],
    'max' => $datadonhang['max'],
    'exchange' => $datadonhang['exchange'],
    'reaction' => $datadonhang['reaction'],
    'comment' => $datadonhang['comment'],
    'minutes' => $datadonhang['minutes'],
    'dayvip' => $datadonhang['dayvip'],
    'mota' => $datadonhang['mota'],
    'note' => $datadonhang['note'],
    'status' => $datadonhang['status'],
    'type' => 'webchinh'
    ); 
}
echo json_encode($results);
 exit();
}else{
 echo json_encode(array('error' => "Invalid action"));      
 exit();    
}
}else{
 echo json_encode(array('error' => "Invalid API key "));      
 exit();
}
}
}
?>