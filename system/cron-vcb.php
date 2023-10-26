<?php
    require_once("config.php"); // Database
    require_once("checkin.php"); // Function 
if(isset($_GET['domain'])){
$domain = trim($_GET['domain']);
}	
        $respawnbank = mysqli_fetch_array(mysqli_query($ketnoi,"SELECT * FROM `banker` WHERE `webdinhdanh` = '$domain' AND `mabank` = 'vcb'"));
        $noidungvalue = strtolower($respawnbank['noidung']);
        $sotaikhoan = $respawnbank['stk'];
        $password = $respawnbank['mkbank'];
        $token = $respawnbank['token'];
        $toithieu = $respawnbank['toithieu'] - 1;
        $date =  date("Y-m-d H:i:sa"); 
        $result = json_decode(curl_get("https://api.web2m.com/historyapivcb/$password/$sotaikhoan/$token"), true);
        $data = [];
        $data = $result['data']['ChiTietGiaoDich'];
        $soluong =  count($data);  
        if($soluong > 0){
        for ($j = 0; $j < $soluong; $j++) {
        $magd =  $data[$j]['SoThamChieu']; 
        $amount =  $data[$j]['SoTienGhiCo']; 
        $loaigd =  $data[$j]['CD'];
        $amount =  str_replace(",", "", $amount);
        $noidung =  $data[$j]['MoTa']; 
        $noidung = strtolower($noidung); 
        if($amount > $toithieu){
        $usercheck1var = explode("$noidungvalue",$noidung); 
        $usercheck1 = strtolower($usercheck1var['1']);
        $usercheck2 =  explode(" ", $usercheck1); // bỏ khoảng trống
        $usercheck3 = $usercheck2['0'];
        $usercheck2 =  explode(".", $usercheck3); // bỏ dấu .
        $usercheck3 = $usercheck2['0'];
        $usercheck2 =  explode("-", $usercheck3); // bỏ dấu -
        $usercheck3 = $usercheck2['0'];
        // ID 
        $dem1 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `id` ='".mysqli_real_escape_string($ketnoi,$usercheck3)."' AND `webdinhdanh` = '$domain'")); // Check xem tài khoản có tồn tại ko
        if($dem1 == 1){
        $datauser1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `accounts` WHERE `id` ='$usercheck3'   AND `webdinhdanh` = '$domain'"));
        $cashto = $datauser1['cash'];  
        $create = $datauser1['cheat'];
        $usercheck3b = $datauser1['username'];     
        $dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `historynaptien` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$usercheck3b)."' AND `magd` ='$magd' AND `type` = 'naptien'"));
        $demtaba = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `historynaptien` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$usercheck3b)."' AND `noidung` = '$noidung'")); // Check xem mã GD đã có chưa
        if($dem == 0 && $demtaba == 0 && $loaigd == '+' && $create == 'on'){
        $cashmoi = $cashto + $amount;
        $type = "Vietcombank";
        $statusne ="success";
        // Lịch sử Nạp Tiền
          mysqli_query($ketnoi,"INSERT INTO `historynaptien` SET 
        `username` = '".mysqli_real_escape_string($ketnoi,$usercheck3b)."',
        `noidung` = '$noidung',
        `type` = '".mysqli_real_escape_string($ketnoi,$type)."',
        `sotien` = '$amount',
        `magd` = '$magd',
        `status` = '$statusne',
        `webdinhdanh` = '$domain',
        `date` = '$date'"); 
        // Cộng Tiền

        $ketnoi->query("UPDATE `accounts` SET `cash` = '$cashmoi' WHERE `username` = '$usercheck3b'");
        $note ='Chuyển tiền Vietcombank hệ thống tự động cộng số dư cho user của bạn';
        // Thống kê
        mysqli_query($ketnoi, "INSERT INTO `history` (`username`,`type`,`coinfirst`,`coinsecond`,`coin`,`codeoder`,`date`,`webdinhdanh`,`note`)VALUES 
          ('$usercheck3b','$type','$cashto','$cashmoi','$amount','$magd','$date','$domain','$noidung')");
        echo 'OK DA CONG TIEN';
                }else{
                echo 'Đã cộng tiền rồi hoặc là giao dịch chuyển tiền đi !';            
                }
                }else{
        echo "Không có đơn mới : $noidung <br>";    
        }
        }else{
                echo "Tối thiểu : $amount <br>";            
                }
            }
        }elseif($soluong == 0){
        echo 'Null'; 
        }else{
        echo 'Error';    
        }  
echo $soluong;