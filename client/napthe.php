 <?php
    require("../system/config.php");
    require("../system/checkin.php");
    if (isset($_POST['NetworkCode']) && isset($_POST['PricesExchange']) && isset($_POST['SeriCard']) && isset($_POST['NumberCard'])) {
        $loaithe = mysqli_real_escape_string($ketnoi, addslashes($_POST['NetworkCode']));
        $menhgia = mysqli_real_escape_string($ketnoi, addslashes($_POST['PricesExchange']));
        $mathe = mysqli_real_escape_string($ketnoi, addslashes($_POST['NumberCard']));
        $seri = mysqli_real_escape_string($ketnoi, addslashes($_POST['SeriCard']));
        if (!isset($_SESSION['username'])) {
            die('<script type="text/javascript">swal("ERROR","Vui lòng  đăng nhập !","error");</script>');
            exit();
        }
        if ($menhgia == '10000') {
            $menhgiareal = 10000;
        } elseif ($menhgia == '20000') {
            $menhgiareal = 20000;
        } elseif ($menhgia == '30000') {
            $menhgiareal = 30000;
        } elseif ($menhgia == '50000') {
            $menhgiareal = 50000;
        } elseif ($menhgia == '100000') {
            $menhgiareal = 100000;
        } elseif ($menhgia == '200000') {
            $menhgiareal = 200000;
        } elseif ($menhgia == '300000') {
            $menhgiareal = 300000;
        } elseif ($menhgia == '500000') {
            $menhgiareal = 500000;
        } elseif ($menhgia == '1000000') {
            $menhgiareal = 1000000;
        } else {
            die('<script type="text/javascript">swal("ERROR","Mệnh giá bạn chọn không hợp lệ","error");</script>');
            exit();
        }
        if ($loaithe == 'VIETTEL') {
            $type = 'Viettel';
            $cardtype = 1;
        } elseif ($loaithe == 'MOBIFONE') {
            $type = 'Mobifone';
            $cardtype = 2;
        } elseif ($loaithe == 'VINAPHONE') {
            $type = 'Vinaphone';
            $cardtype = 3;
        } elseif ($loaithe == 'VIETNAMOBILE') {
            $type = 'Vietnamobile';
            $cardtype = 16;
        } else {
            die('<script type="text/javascript">swal("ERROR","Loại thẻ cào không hợp lệ","error");</script>');
        }
        $chietkhau = ($menhgiareal / 100) * (100 - $ratecard); // chiết khấu card tùy ý :))
        $thucnhan = ($menhgiareal - $chietkhau);
        $date = date("Y-m-d H:i:sa");
        $request_id = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        $command = 'charging';
        //$partnerid
        //$partnerkey
        $sig = md5($partnerkey . $mathe . $seri);
        $uri = "http://trumthe.vn/chargingws/v2?telco=$loaithe&code=$mathe&serial=$seri&amount=$menhgiareal&request_id=$request_id&partner_id=$partnerid&sign=$sig&command=$command";

        $result = curl_get($uri);
        $obj = json_decode($result);
        $status = $obj->status; // status gửi
        if ($status == 99) {
            $trans = $obj->trans_id; // mã đối soát       
            // tạo ra một yêu cầu nạp  ở domain phụ       
            mysqli_query($ketnoi, "INSERT INTO `historynapcard` (`username`, `type`, `menhgia`, `thucnhan`, `seri`, `mathe`, `trans`, `status`,`webdinhdanh`, `date`) 
VALUES ('$username','$type','$menhgiareal','$thucnhan','$seri','$mathe','$trans','pending','$domain','$date')");
            die('<script type="text/javascript">swal("SUCCESS","Yêu cầu nạp thẻ đã được ghi nhận, xin vui lòng kiểm tra kết quả ở lịch sử nạp !","success"); setTimeout(function(){ location.href = "/clound/card.html" },2000);</script>');
            exit();
        } else {
            $msg = $obj->msg;
            die('<script type="text/javascript">swal("ERROR","Yêu cầu nạp thẻ đã bị từ chối, xin vui lòng kiểm tra thông tin nhập vào hoặc lỗi chưa xác định trên hệ thống ERR:' . $status . ' !","error");</script>');
        }
    } else {
        die('<script type="text/javascript">swal("ERROR","Không có tính năng này !","error");</script>');
    }

    ?>
