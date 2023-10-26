<?php
    require_once("config.php"); // Database
    require_once("checkin.php"); // Function 
	if(isset($_GET['domain'])){
$domain = trim($_GET['domain']);
}
            $respawnbank = mysqli_fetch_array(mysqli_query($ketnoi,"SELECT * FROM `banker` WHERE `webdinhdanh` = '$domain' AND `mabank` = 'momo'"));
        $noidungvalue = strtolower($respawnbank['noidung']);
        $token = $respawnbank['token'];
        $toithieu = $respawnbank['toithieu'] - 1;
        $date =  date("Y-m-d H:i:sa");  
        $result = json_decode(curl_get("https://api.web2m.com/historyapimomo/$token"), true);
      
        $data = [];
        $data = $result['momoMsg']['tranList'];
        $soluong =  count($data);
        if($soluong > 0){
        for ($j = 0; $j < $soluong; $j++) {
            $magd =  $data[$j]['tranId']; 
            $nguoichuyen =  $data[$j]['partnerName'];
            $desc =  $data[$j]['desc']; 
            $noidung1 = $data[$j]['comment'];
            $amount =  $data[$j]['amount']; 
            $status =  $data[$j]['status'];
            $io =  $data[$j]['io'];
            $noidung = strtolower(str_replace("\n", "", $noidung1));
            $timbill = strpos($noidung, $noidungvalue); 
            if($timbill !== false && $io == '1'){
            $usercheck1var = explode("$noidungvalue", $noidung); 
            $usercheck1 = strtolower($usercheck1var['1']);
            $dem1 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `id` ='".mysqli_real_escape_string($ketnoi,$usercheck1)."'  AND `webdinhdanh` = '$domain'")); // Check xem tài khoản có tồn tại ko
            if($dem1 == 1){
        $datauser1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `accounts` WHERE `id` ='$usercheck1'"));
        $cashto = $datauser1['cash'];
        $create = $datauser1['cheat'];
        $usercheck1b = $datauser1['username'];
        $dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `historynaptien` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$usercheck1b)."' AND `magd` ='$magd'")); // Check xem mã GD đã có chưa

        if($dem1 == 1 && $dem < 1 && $amount > $toithieu  && $create == 'on'){
        $cashmoi = $cashto + $amount;
        $type = "Momo";
        $statusne ="success";
        
         mysqli_query($ketnoi,"INSERT INTO `historynaptien` SET 
        `username` = '".mysqli_real_escape_string($ketnoi,$usercheck1b)."',
        `noidung` = '$noidung1',
        `type` = '".mysqli_real_escape_string($ketnoi,$type)."',
        `sotien` = '$amount',
        `magd` = '$magd',
        `status` = '$statusne',
        `webdinhdanh` = '$domain',
        `date` = '$date'"); 
        // Cộng Tiền

        $ketnoi->query("UPDATE `accounts` SET `cash` = '$cashmoi' WHERE `username` = '$usercheck1b'");
        // Thống kê
           mysqli_query($ketnoi, "INSERT INTO `history` (`username`,`type`,`coinfirst`,`coinsecond`,`coin`,`codeoder`,`date`,`webdinhdanh`,`note`) VALUES 
          ('$usercheck1b','$type','$cashto','$cashmoi','$amount','$magd','$date','$domain','$noidung')");  
        echo "Đã cộng tiền cho : $magd <br>";
                }else{
        echo "Mã giao dịch đã cộng : $magd<br>";            
                }
                }else{
        echo "Không có đơn mới : $usercheck1<br>";   
        }
            }else{
         echo "Sai nội dung<br>";       
            }
        }
        }elseif($soluong == 0){
        echo "Không có giao dịch hoặc cấu hình sai, data: $data !<br>";
        }else{
        echo 'Lỗi code';    
        }
?>        