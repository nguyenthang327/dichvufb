<?php
require("../system/config.php");
require("../system/checkin.php");
if (isset($_POST['tiendo'])) {
    if (!isset($_SESSION['username'])) {
        die('<script type="text/javascript">swal("ERROR","Vui lòng  đăng nhập !","error");</script>');
        exit();
    }

    $tiendo = $_POST['tiendo'];
    $tigia = 24000;
    $tienviet = $tiendo * 24000;
    $date = date("Y-m-d H:i:sa");

    mysqli_query($ketnoi, "INSERT INTO `historynappaypal` (`username`, `tiendo`, `tigia`, `tienviet`, `status`,`webdinhdanh`, `date`) 
VALUES ('$username','$tiendo','$tigia','$tienviet', 'success','$domain','$date')");
    $historyOld = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM  `history`  WHERE `username` = '".mysqli_real_escape_string($ketnoi,$username)."' ORDER BY id DESC LIMIT 1"));

    $coinfirst = 0;
    if(isset($historyOld["coinsecond"])){
        $coinfirst = $historyOld["coinsecond"];
    }
    $coinsecond = $coinfirst + $tienviet;
    $code_oder = floor(microtime(true) * 1000);
    // ghi lại lịch sử cộng tiền
    mysqli_query($ketnoi, "INSERT INTO `history` (`username`, `type`, `coinfirst`, `coinsecond`, `coin`, `codeoder`, `date`,`webdinhdanh`,`note`) 
    VALUES ('$username','Cộng Tiền','$coinfirst','$coinsecond','$tienviet','$code_oder','$date','$domain','Nạp tiền từ paypal')"); 
    die('<script type="text/javascript">swal("SUCCESS","Nạp thẻ thành công!","success"); setTimeout(function(){ location.href = "/clound/paypal.html" },2000);</script>');
    exit();
} else {
    die('<script type="text/javascript">swal("ERROR","Không có tính năng này !","error");</script>');
}
