<?php
require('../system/config.php');
$data = json_decode(file_get_contents('php://input'), true);
if(empty($data)){
 echo json_encode(array('staus' => "404",'message' => "Request không hợp lệ"));   
 exit();
}else{
$key = htmlspecialchars($data['token']);
$data1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `accounts` WHERE `api`='$key' AND `cheat` ='on'"));
if(!empty($data1)){
$type = htmlspecialchars($data['type']);
if($type == 'clone'){
$datadonhang = mysqli_query($ketnoi, "SELECT * FROM `productcon` WHERE `status` ='active'");
while($row = mysqli_fetch_array($datadonhang))
{
$conlai = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `sanpham` WHERE `masanpham` = '".$row['masanpham']."' AND `status` = 'active'"));     
$results[] = 
    array(
    'nation' => $row['nation'], 
    'name' => $row['tensanpham'], 
    'amount' => $row['dongia'], 
    'codesp' => $row['masanpham'],
    'conlai' => $conlai
    );  

}
echo json_encode(array("status" => 200,"data" =>$results));
}elseif($type == 'document'){

$datadonhang = mysqli_query($ketnoi, "SELECT * FROM `document` WHERE `status` ='active'");
while($row = mysqli_fetch_array($datadonhang))
{
$results[] = 
    array(
    'name' => $row['tensanpham'], 
    'codesp' => $row['matailieu'], 
    'amount' => $row['dongia']
    );  

}
echo json_encode(array("status" => 200,"data" =>$results));
    
}elseif($type == 'buyclone'){
 $masanpham = htmlspecialchars($data['masanpham']);
 $number = htmlspecialchars($data['soluong']);
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `sanpham` WHERE `masanpham` ='$masanpham'  AND `status` = 'active'"));
 if($number < 1){
 echo json_encode(array('staus' => "404",'message' => "Số lượng không hợp lệ"));   
 exit();       
 }elseif($number > $dem){
 echo json_encode(array('staus' => "404",'message' => "Số lượng mua nhiều hơn sản phẩm có trong kho "));   
 exit();       
 }else{
$date = date("Y-m-d H:i:sa");   
$m = date("m"); 
$datauseraa = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `accounts` WHERE `api` ='$key'  AND `cheat` ='on'"));
$casha = $datauseraa['cash']; 
$usernamea = $datauseraa['username']; 
mysqli_query($ketnoi, "UPDATE `accounts` SET `cheat` = 'off' WHERE `username` = '$usernamea'");  
$datadanhmuccon = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `productcon` WHERE `masanpham` ='$masanpham'  AND `status` = 'active'"));
$dongia = $datadanhmuccon['dongia'];  
$tensanpham = $datadanhmuccon['tensanpham'];
$madanhmuc = $datadanhmuccon['madanhmuc'];
$datadanhmuc = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `product` WHERE `madanhmuc` ='$madanhmuc'"));
$tendanhmuc = $datadanhmuc['tendanhmuc'];  
$canmua = $number * $dongia;
if($casha > $canmua){
$code_oder = floor(microtime(true) * 1000);
$cashmoi = $casha - $canmua;   
$note = "Mua $number Clone $tendanhmuc";
$datadonhang = mysqli_query($ketnoi, "SELECT * FROM `sanpham` WHERE `masanpham` ='$masanpham' AND `status` ='active' AND  `username` ='' LIMIT $number");
while($respawndeveloper = mysqli_fetch_array($datadonhang))
{
$idmua = $respawndeveloper['id'];
mysqli_query($ketnoi, "UPDATE `sanpham` SET 
`magiaodich` ='$code_oder',
`username` ='$usernamea',
`datemua` ='$date',
`status` ='pay'
WHERE `id` = '$idmua'");
$results[] = 
    array(
    'info' => $respawndeveloper['info']
    ); 
}

// Ghi lại lịch sử giao dịch
mysqli_query($ketnoi, "INSERT INTO `history` (`username`, `type`, `coinfirst`, `coinsecond`,`coin`,`codeoder`, `date`, `note`, `webdinhdanh`)
VALUES ('$usernamea','$tendanhmuc','$casha','$cashmoi','$canmua','$code_oder','$date','Buy Clone', '$domain')"); 
// Ghi lại lịch sử mua
mysqli_query($ketnoi, "INSERT INTO `historybuyclone` (`username`, `tensanpham`, `codeoder`, `giftcode`, `sl`, `cash`, `date`)
VALUES ('$usernamea','$tensanpham','$code_oder','','$number','$canmua','$date')"); 

// Trừ tiền
mysqli_query($ketnoi, "UPDATE `accounts` SET `cash` = '$cashmoi',`cheat` = 'on' WHERE `username` = '$usernamea'");

echo json_encode(array("status" => 200,"name" =>$tensanpham,"magiaodich" =>$code_oder,"amount" =>$canmua,"data" =>$results));
}else{
 echo json_encode(array('staus' => "404",'message' => "Bạn không đủ tiền"));   
 exit();     
}
 }
}else{
 echo json_encode(array('staus' => "404",'message' => "Định dạng type không hợp lệ"));   
 exit();    
}
}else{
 echo json_encode(array('staus' => "404",'message' => "API không tồn tại trên hệ thống"));   
 exit();      
}
}
?>
