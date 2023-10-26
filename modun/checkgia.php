<?php
require('../system/config.php');
include('../system/function.php');
if(isset($_GET['number'])&& isset($_GET['loai'])){
if(isset($_SESSION['username'])){
$number = xss($_GET['number']);
$loai = xss($_GET['loai']);
$giamgia = 0;   
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `sanpham` WHERE `masanpham` ='$loai'"));
if($dem == 0){
$array = array("status" => "true", "money" => 'Sản phẩm này đã hết hàng');    
}else{
// đếm danh mục con
$dem1 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `productcon` WHERE `masanpham` ='$loai'"));
if($dem1 == 0){
$array = array("status" => "true", "money" => 'Danh mục sản phẩm này đã hết hạn'); 
}else{
$datadanhmuccon = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `productcon` WHERE `masanpham` ='$loai'"));
$dongia = $datadanhmuccon['dongia'];
$madanhmuc = $datadanhmuccon['madanhmuc'];
$dem2 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `product` WHERE `madanhmuc` ='$madanhmuc'"));
if($dem2 == 0){
$array = array("status" => "true", "money" => 'Danh mục này đã hết hạn'); 
}else{
$tinhtien = ceil($dongia * $number - ($dongia * $number * $giamgia/100));
$callback = number_format($tinhtien,'0','.','.');
$array = array("status" => "true", "money" => "$callback VNĐ");  
            }
        }
    }
    }else{
$array = array("status" => "true", "money" => 'Bạn chưa đăng nhập');         
    }
echo json_encode($array);     
}
?>