<?php
require('config.php');
if(isset($_GET['status']) && isset($_GET['request_id']) && isset($_GET['declared_value'])&& isset($_GET['value'])&& isset($_GET['amount'])&& isset($_GET['code'])&& isset($_GET['serial'])&& isset($_GET['telco'])&& isset($_GET['trans_id'])&& isset($_GET['callback_sign'])) {
$status =  $_GET['status'];//1,2,3,4,99,100
$request_id =  $_GET['request_id'];
$declared_value =  $_GET['declared_value'];
$value =  $_GET['value']; // Mệnh giá thực
$amount =  $_GET['amount'];
$code =  $_GET['code'];
$serial =  $_GET['serial'];
$telco =  $_GET['telco']; 
$trans_id =  $_GET['trans_id']; // Đã có ở bước gửi thẻ
$callback_sign =  $_GET['callback_sign'];			
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `historynapcard` WHERE `trans` ='".mysqli_real_escape_string($ketnoi,$trans_id)."' AND  `seri` ='".mysqli_real_escape_string($ketnoi,$serial)."'"));
if($dem == 0){
echo json_encode(array('status' => "error", 'title' => "fail", 'msg' => "Không có mã trans_id nào tương ứng trên hệ thống "));    
        }else{
$datanguoinap = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `historynapcard` WHERE `trans` ='".mysqli_real_escape_string($ketnoi,$trans_id)."' AND  `seri` ='".mysqli_real_escape_string($ketnoi,$serial)."'"));
$usernap = $datanguoinap['username'];  
$thucnhan = $datanguoinap['thucnhan'];
$statusthe = $datanguoinap['status'];
$domainnap = $datanguoinap['webdinhdanh'];

if($statusthe == 'pending'){
$datauser = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `accounts` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$usernap)."'"));  
$cash = $datauser['cash'];
if($status == 1){
if($value == $declared_value){    
$note ='Nạp thẻ cào thành công mệnh giá '.$declared_value.' ';
$cashmoi = $cash + $thucnhan;
mysqli_query($ketnoi, "INSERT INTO history (`username`, `type`, `coinfirst`, `coinsecond`, `coin`, `date`,`webdinhdanh`, `note`)
VALUES ('$usernap','Card','$cash','$cashmoi','$thucnhan','$date','$domainnap','$note')"); 
// Update cash
$ketnoi->query("UPDATE accounts SET `cash` = '$cashmoi' WHERE `username` = '$usernap' AND `webdinhdanh` = '$domainnap'");
// update history card
$ketnoi->query("UPDATE historynapcard SET `status` = 'success' WHERE `trans` ='".mysqli_real_escape_string($ketnoi,$trans_id)."' AND  `seri` ='".mysqli_real_escape_string($ketnoi,$serial)."'");
echo json_encode(array('status' => "success", 'title' => "true", 'msg' => "successfully"));    
    
}else{
$ketnoi->query("UPDATE historynapcard SET `status` = 'error' WHERE `trans` ='".mysqli_real_escape_string($ketnoi,$trans_id)."' AND  `seri` ='".mysqli_real_escape_string($ketnoi,$serial)."'");
echo json_encode(array('status' => "error", 'title' => "fail", 'msg' => "Từ chối thẻ  "));        
    }    
}elseif($status == 2){
$ketnoi->query("UPDATE historynapcard SET `status` = 'error' WHERE `trans` ='".mysqli_real_escape_string($ketnoi,$trans_id)."' AND  `seri` ='".mysqli_real_escape_string($ketnoi,$serial)."'");
echo json_encode(array('status' => "error", 'title' => "fail", 'msg' => "Từ chối thẻ  "));        
    }elseif($status == 3){
$ketnoi->query("UPDATE historynapcard SET `status` = 'error' WHERE `trans` ='".mysqli_real_escape_string($ketnoi,$trans_id)."' AND  `seri` ='".mysqli_real_escape_string($ketnoi,$serial)."'");
echo json_encode(array('status' => "error", 'title' => "fail", 'msg' => "Từ chối thẻ  "));        
    }elseif($status == 4){
$ketnoi->query("UPDATE historynapcard SET `status` = 'baotri' WHERE `trans` ='".mysqli_real_escape_string($ketnoi,$trans_id)."' AND  `seri` ='".mysqli_real_escape_string($ketnoi,$serial)."'");
echo json_encode(array('status' => "error", 'title' => "fail", 'msg' => "Từ chối thẻ  "));        
    }elseif($status == 100){
$ketnoi->query("UPDATE historynapcard SET `status` = 'baotri' WHERE `trans` ='".mysqli_real_escape_string($ketnoi,$trans_id)."' AND  `seri` ='".mysqli_real_escape_string($ketnoi,$serial)."'");
echo json_encode(array('status' => "error", 'title' => "fail", 'msg' => "Từ chối thẻ  "));         
    }elseif($status == 99){
#do nothing
echo json_encode(array('status' => "error", 'title' => "fail", 'msg' => "Chưa có kết quả"));         
    }
            }else{
echo json_encode(array('status' => "error", 'title' => "fail", 'msg' => "Thẻ này đã có kết quả vui lòng không spam callback "));                 
            }
        }
    }else{
echo json_encode(array('status' => "error", 'title' => "fail", 'msg' => "Chưa nhận được callback"));          
    }