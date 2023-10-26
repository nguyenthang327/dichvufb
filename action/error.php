<?php
require('../system/config.php');
if ($_POST && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_SESSION['username'])){
if(isset($_POST['madon']) && isset($_POST['level']) && isset($_POST['noidung']) && isset($_POST['loaidon'])){
$madon = xss($_POST['madon']);   
$level = xss($_POST['level']);
$noidung = xss(addslashes($_POST['noidung']));
$loaidon = xss($_POST['loaidon']);
if(empty($madon) || empty($level) ||empty($noidung) ||empty($loaidon)){
   echo json_encode(array('status' => "danger", 'title' => "Lỗi", 'msg' => "Vui lòng nhập đầy đủ thông tin"));
 exit();     
}else{
$date = date("Y-m-d H:i:sa");
// ghi lại lịch sử 
mysqli_query($ketnoi, "INSERT INTO `support` (`username`, `type`, `codeoder`, `noidung`, `status`, `level`,`webdinhdanh`,`date`) 
VALUES ('$username','$loaidon','$madon','$username: ".mysqli_real_escape_string($ketnoi,$noidung)."','pending','$level','$domain','$date')"); 
   echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thành công, bạn đã yêu cầu hỗ trợ thành công, xin vui lòng kiểm tra ở lịch sử !"));
 exit();  
    
}    
        }
if(isset($_POST['respond'])&& isset($_POST['noidung'])){
$respond = xss($_POST['respond']);   
$noidung = xss(addslashes($_POST['noidung']));
if(empty($respond) || empty($noidung)){
   echo json_encode(array('status' => "danger", 'title' => "Lỗi", 'msg' => "Vui lòng nhập đầy đủ thông tin"));
 exit();     
}else{
$date = date("Y-m-d H:i:sa");
$datauserbuff = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `support` WHERE `username` ='$username' AND `id` = '$respond' AND `webdinhdanh` = '$domain'"));
$gocnjoi = $datauserbuff['noidung'];
$new = "$gocnjoi <br>$username: $noidung";
mysqli_query($ketnoi,"UPDATE `support` SET 
noidung = '".mysqli_real_escape_string($ketnoi,$new)."',`status`='pending' WHERE `username` ='$username' AND `id` = '$respond' AND `webdinhdanh` = '$domain'");
   echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Đã phản hồi !"));
 exit();  
    
}    
        }        
 if(isset($_POST['idchat'])&& isset($_POST['summernote']) && $admin == 'yes'){
$respond = xss($_POST['idchat']);   
$noidung = $_POST['summernote'];
if(empty($respond) || empty($noidung)){
   echo json_encode(array('status' => "danger", 'title' => "Lỗi", 'msg' => "Vui lòng nhập đầy đủ thông tin"));
 exit();     
}else{
$date = date("Y-m-d H:i:sa");
$datauserbuff = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `support` WHERE  `id` = '$respond' AND `webdinhdanh` = '$domain'"));
$gocnjoi = $datauserbuff['noidung'];
$new = "$gocnjoi <br><font color='red'>ADMIN</font>: $noidung";
mysqli_query($ketnoi,"UPDATE `support` SET 
noidung = '".mysqli_real_escape_string($ketnoi,$new)."',`status`='reply' WHERE  `id` = '$respond' AND `webdinhdanh` = '$domain'");
   echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Đã phản hồi !"));
 exit();  
    
}    
        }          
        
        
        
    }
?>