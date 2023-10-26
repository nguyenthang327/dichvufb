 <?php
require("../../system/connect.php");
if($ctv !== '3'){
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Nhưng mà tao địt con mẹ mày thành công chứ không có quyền edit đâu con !"));    
}else{
if (isset($_POST['title']) && isset($_POST['tukhoa']) && isset($_POST['mieuta']) && isset($_POST['namesite']) && isset($_POST['nangcap2']) && isset($_POST['nangcap1']) && isset($_POST['logo'])
&& isset($_POST['favicon']) && isset($_POST['logofull']) && isset($_POST['fbadmin']) && isset($_POST['nameadmin'])&& isset($_POST['hotline'])&& isset($_POST['nhanvienhotro'])&& isset($_POST['kenhthongbao'])&& isset($_POST['active'])) {
$tieude = mysqli_real_escape_string($ketnoi,addslashes($_POST['title']));
$tukhoa = mysqli_real_escape_string($ketnoi,addslashes($_POST['tukhoa']));
$mieuta = mysqli_real_escape_string($ketnoi,addslashes($_POST['mieuta']));
$namesite = mysqli_real_escape_string($ketnoi,addslashes($_POST['namesite']));
$nangcap2 = mysqli_real_escape_string($ketnoi,addslashes($_POST['nangcap2']));
$nangcap1 = mysqli_real_escape_string($ketnoi,addslashes($_POST['nangcap1']));
$logo = mysqli_real_escape_string($ketnoi,addslashes($_POST['logo']));
$favicon = mysqli_real_escape_string($ketnoi,addslashes($_POST['favicon']));
$logofull = mysqli_real_escape_string($ketnoi,addslashes($_POST['logofull']));
$fbadmin = mysqli_real_escape_string($ketnoi,addslashes($_POST['fbadmin']));
$nameadmin = mysqli_real_escape_string($ketnoi,addslashes($_POST['nameadmin']));
$hotline = mysqli_real_escape_string($ketnoi,addslashes($_POST['hotline']));
$nhanvienhotro = mysqli_real_escape_string($ketnoi,addslashes($_POST['nhanvienhotro']));
$kenhthongbao = mysqli_real_escape_string($ketnoi,addslashes($_POST['kenhthongbao']));
$active = mysqli_real_escape_string($ketnoi,addslashes($_POST['active']));
if($banquyen == "0983647058" && $ctv =='3' && $domain == $webkichhoat){
mysqli_query($ketnoi,"UPDATE `system` 
SET 
`title` = '".mysqli_real_escape_string($ketnoi,$tieude)."',
`tukhoa` = '".mysqli_real_escape_string($ketnoi,$tukhoa)."',
`phoneadmin` = '".mysqli_real_escape_string($ketnoi,$hotline)."',
`derc` = '".mysqli_real_escape_string($ketnoi,$mieuta)."',
`cap2` = '".mysqli_real_escape_string($ketnoi,$nangcap2)."',
`cap1` = '".mysqli_real_escape_string($ketnoi,$nangcap1)."',
`active` = '".mysqli_real_escape_string($ketnoi,$active)."',
`namesite` = '".mysqli_real_escape_string($ketnoi,$namesite)."',
`logo` = '".mysqli_real_escape_string($ketnoi,$logo)."',
`favicon` = '".mysqli_real_escape_string($ketnoi,$favicon)."',
`logofull` = '".mysqli_real_escape_string($ketnoi,$logofull)."',
`fbadmin` = '".mysqli_real_escape_string($ketnoi,$fbadmin)."',
`tenadmin` = '".mysqli_real_escape_string($ketnoi,$nameadmin)."',
`nhanvienhotro` = '".mysqli_real_escape_string($ketnoi,$nhanvienhotro)."',
`kenhthongbao` = '".mysqli_real_escape_string($ketnoi,$kenhthongbao)."'
WHERE `webdinhdanh` = '$domain'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Update cấu hình website thành công !"));
}else{
echo json_encode(array('status' => "error", 'title' => "Thất bại", 'msg' => "Bạn không có quyền thao tác, vui lòng Call : 0983647058 nếu bạn gặp vấn đề này !"));    
}
}elseif(isset($_POST['note']) && isset($_POST['tieudethongbao'])){
$note = addslashes($_POST['note']);
$tieudethongbao = htmlspecialchars($_POST['tieudethongbao']);
$now = date("Y-m-d H:i:sa");
if($banquyen == "0983647058" && $ctv =='3'  && $domain == $webkichhoat){
mysqli_query($ketnoi,"INSERT INTO `logs` SET 
`noidung` = '$note',
`tieudethongbao` = '$tieudethongbao',
`webdinhdanh` = '$domain',
`date` = '$now'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Đăng thông báo thành công !"));
}else{
echo json_encode(array('status' => "error", 'title' => "Thất bại", 'msg' => "Bạn không có quyền thao tác, vui lòng Call : 0983647058 nếu bạn gặp vấn đề này !"));
}
}elseif(isset($_POST['subgiare']) && isset($_POST['gsmm']) && isset($_POST['autofb'])) {
$subgiare = mysqli_real_escape_string($ketnoi,addslashes($_POST['subgiare']));
$gsmm = mysqli_real_escape_string($ketnoi,addslashes($_POST['gsmm']));
$autofb = mysqli_real_escape_string($ketnoi,addslashes($_POST['autofb']));
if($banquyen == "0983647058" && $ctv =='3'  && $domain == $webkichhoat  && $domain == $domainchinh){
mysqli_query($ketnoi,"UPDATE `token` SET `token` = '".mysqli_real_escape_string($ketnoi,$subgiare)."' WHERE `webnguon` = 'subgiare'");
mysqli_query($ketnoi,"UPDATE `token` SET `token` = '".mysqli_real_escape_string($ketnoi,$autofb)."' WHERE `webnguon` = 'autofb'");
mysqli_query($ketnoi,"UPDATE `token` SET `token` = '".mysqli_real_escape_string($ketnoi,$gsmm)."' WHERE `webnguon` = '5gsmm'");

echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Update cấu hình token thành công  !"));
}else{
echo json_encode(array('status' => "error", 'title' => "Thất bại", 'msg' => "Bạn không có quyền thao tác !"));    
}
}elseif(isset($_POST['name']) && isset($_POST['chuthe']) && isset($_POST['stk']) && isset($_POST['note1']) && isset($_POST['min']) && isset($_POST['link']) && isset($_POST['userbank']) && isset($_POST['mkbank'])&& isset($_POST['tokendoitac'])) {
$namea = mysqli_real_escape_string($ketnoi,addslashes($_POST['name']));
$chuthe = mysqli_real_escape_string($ketnoi,addslashes($_POST['chuthe']));
$stk = mysqli_real_escape_string($ketnoi,addslashes($_POST['stk']));
$notee = mysqli_real_escape_string($ketnoi,addslashes($_POST['note1']));
$minn = mysqli_real_escape_string($ketnoi,addslashes($_POST['min']));
$link = mysqli_real_escape_string($ketnoi,addslashes($_POST['link']));
$tokendoitac = mysqli_real_escape_string($ketnoi,addslashes($_POST['tokendoitac']));
$now = date("Y-m-d H:i:sa");
$mabank = mysqli_real_escape_string($ketnoi,addslashes($_POST['mabank']));
$userbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['userbank']));
$mkbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['mkbank']));
if($banquyen == "0983647058" && $ctv =='3'){
$dembank = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `banker` WHERE `userbank` ='$userbank' AND  `webdinhdanh` = '$domain' AND `stk` = '$stk'"));
if(empty($dembank)){
mysqli_query($ketnoi,"INSERT INTO `banker` SET 
`tenbank` = '$namea',
`chuthe` = '$chuthe',
`stk` = '$stk',
`noidung` = '$notee',
`toithieu` = '$minn',
`urlanh` = '$link',
`date` = '$now',
`webdinhdanh` = '$domain',
`mabank` = '$mabank',
`token` = '$tokendoitac',
`userbank` = '$userbank',
`mkbank` = '$mkbank'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm Banker thành công !"));
}else{
mysqli_query($ketnoi,"UPDATE `banker` SET 
`tenbank` = '$namea',
`chuthe` = '$chuthe',
`stk` = '$stk',
`noidung` = '$notee',
`toithieu` = '$minn',
`urlanh` = '$link',
`date` = '$now',
`userbank` = '$userbank',
`token` = '$tokendoitac',
`mkbank` = '$mkbank'
WHERE `webdinhdanh` = '$domain' AND `stk` = '$stk'");    
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Update Banker thành công !"));    
}
}else{
echo json_encode(array('status' => "error", 'title' => "Thất bại", 'msg' => "Bạn không có quyền thao tác, vui lòng Call : 0983647058 để mua bản quyền !"));    
}
}else{
echo json_encode(array('status' => "error", 'title' => "Thất bại", 'msg' => "Null !"));    
}
}
?>
