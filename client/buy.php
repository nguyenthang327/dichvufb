<?php
require("../system/config.php");
if (isset($_POST['number'])  && isset($_POST['type'])) {
if(isset($_SESSION['username']) && $cheat == 'on'){    
$number = xss($_POST['number']);
$type = xss($_POST['type']);
$giftcode = '';    // chức năng này đã bị đóng
$giamgia = 0; 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `sanpham` WHERE `masanpham` ='$type'  AND `status` = 'active'"));
if($dem < $number){
echo json_encode(array('status' => "error", 'title' => "", 'msg' => "Số lượng trong kho chỉ còn $dem sản phẩm"));
exit();   
}else{
// đếm danh mục con
$dem1 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `productcon` WHERE `masanpham` ='$type'  AND `status` = 'active'"));
if($dem1 == 0){
echo json_encode(array('status' => "error", 'title' => "", 'msg' => "Sản phẩm này đã hết hạn hoặc tạm ngưng bán vui lòng liên hệ Admin"));
exit();  
}else{
$datadanhmuccon = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `productcon` WHERE `masanpham` ='$type'  AND `status` = 'active'"));
$madanhmuc = $datadanhmuccon['madanhmuc'];
$motangan = $datadanhmuccon['motangan'];
$tensanpham = $datadanhmuccon['tensanpham'];
$dongia = $datadanhmuccon['dongia'];
$dongia2 = number_format($dongia,'0','.','.');
$nation = $datadanhmuccon['nation'];
$dem2 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `product` WHERE `madanhmuc` ='$madanhmuc'  AND `status` = 'active'"));
if($dem2 == 0){
echo json_encode(array('status' => "error", 'title' => "", 'msg' => "Sản phẩm này đã hết hạn hoặc tạm ngưng bán vui lòng liên hệ Admin"));
exit(); 
}else{
$datadanhmuc = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `product` WHERE `madanhmuc` ='$madanhmuc'"));
$tendanhmuc = $datadanhmuc['tendanhmuc'];    
$date = date("Y-m-d H:i:sa"); 
$m = date("m"); 
$canmua = $number * $dongia - ($dongia * $number * $giamgia/100);
$callback = number_format($canmua,'0','.','.');
if($number < 1){
echo json_encode(array('status' => "error", 'title' => "", 'msg' => "Mua tối thiểu 1 sản phẩm "));
exit();     
}elseif($cash < $canmua){
echo json_encode(array('status' => "error", 'title' => "", 'msg' => "Bạn không đủ tiền để thực hiện đơn hàng này, bạn cần có : $callback VNĐ để thực hiện lệnh mua  !"));
exit();     
}else{
mysqli_query($ketnoi, "UPDATE `accounts` SET `cheat` = 'off' WHERE `username` = '$username'");    
$cashmoi = $cash - $canmua;   
$note = "Mua $number Clone $tendanhmuc";
// Tạo mã đơn hàng ngẫu nhiên
$code_oder = floor(microtime(true) * 1000);
// Lấy data sản phẩm còn trong kho
$datadonhang = mysqli_query($ketnoi, "SELECT * FROM `sanpham` WHERE `masanpham` ='$type' AND `status` ='active' AND  `username` ='' LIMIT $number");
while($respawndeveloper = mysqli_fetch_array($datadonhang))
{
$idmua = $respawndeveloper['id'];
mysqli_query($ketnoi, "UPDATE `sanpham` SET 
`magiaodich` ='$code_oder',
`username` ='$username',
`datemua` ='$date',
`status` ='pay'
WHERE `id` = '$idmua'");
}

// Ghi lại lịch sử giao dịch
mysqli_query($ketnoi, "INSERT INTO `history` (`username`, `type`, `coinfirst`, `coinsecond`,`coin`,`codeoder`, `date`, `note`, `webdinhdanh`)
VALUES ('$username','$tendanhmuc','$cash','$cashmoi','$canmua','$code_oder','$date','Buy Clone', '$domain')"); 

// Ghi lại lịch sử mua
mysqli_query($ketnoi, "INSERT INTO `historybuyclone` (`username`, `tensanpham`, `codeoder`, `giftcode`, `sl`, `cash`,`webdinhdanh`, `date`)
VALUES ('$username','$tensanpham','$code_oder','$giftcode','$number','$canmua','$domain','$date')"); 

// Trừ tiền
mysqli_query($ketnoi, "UPDATE `accounts` SET `cash` = '$cashmoi',`cheat` = 'on' WHERE `username` = '$username'");

echo json_encode(array('status' => "success", 'title' => "", 'msg' => "Bạn đã mua thành công, hãy kiểm tra ở lịch sử mua !"));
exit(); 
}
            }
        }
    }
}else{
echo json_encode(array('status' => "error", 'title' => "", 'msg' => "Vui lòng tải lại trang để sử dụng tính năng !"));
exit();     
}
}else{
echo "liên hệ mua bản quyền website xin vui lòng liên hệ hotline: 0983647058, cảm ơn bạn đã quan tâm !";    
}
?>