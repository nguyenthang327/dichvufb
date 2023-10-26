<?php
require('../system/config.php');
$date = date("Y-m-d H-i-s");
if(!isset($_SESSION['username'])){
echo json_encode(array('status' => "error", 'title' => "Thất bại", 'msg' => "Vui lòng đăng nhập lại bằng cách F5 để tiếp tục !"));      
exit();
}else{
if($admin !== 'yes'){
echo json_encode(array('status' => "error", 'title' => "Thất bại", 'msg' => "Bạn không có quyền Admin, vui lòng không phá hoại website (bạn tuổi lồn, địt mẹ bạn) !"));  
exit();
}else{
if (isset($_POST['title']) && isset($_POST['mota']) && isset($_POST['tukhoa']) && isset($_POST['logo']) && isset($_POST['favicon']) && isset($_POST['phone']) && isset($_POST['brand']) && isset($_POST['name']) && isset($_POST['fbadmin']) && isset($_POST['zalo']) && isset($_POST['cap1'])&& isset($_POST['cap2'])&& isset($_POST['cap3'])&& isset($_POST['cap4'])&& isset($_POST['cap5'])&& isset($_POST['token'])&& isset($_POST['active']) && isset($_POST['chat'])) {
$tieude = mysqli_real_escape_string($ketnoi,addslashes($_POST['title']));
$tukhoa = mysqli_real_escape_string($ketnoi,addslashes($_POST['tukhoa']));
$mieuta = mysqli_real_escape_string($ketnoi,addslashes($_POST['mota']));
$logo = mysqli_real_escape_string($ketnoi,addslashes($_POST['logo']));
$favicon = mysqli_real_escape_string($ketnoi,addslashes($_POST['favicon']));
$phone = mysqli_real_escape_string($ketnoi,addslashes($_POST['phone']));
$brand = mysqli_real_escape_string($ketnoi,addslashes($_POST['brand']));
$name = mysqli_real_escape_string($ketnoi,addslashes($_POST['name']));
$fbadmin = mysqli_real_escape_string($ketnoi,addslashes($_POST['fbadmin']));
$zalo = mysqli_real_escape_string($ketnoi,addslashes($_POST['zalo']));
$cap1 = mysqli_real_escape_string($ketnoi,addslashes($_POST['cap1']));
$cap2 = mysqli_real_escape_string($ketnoi,addslashes($_POST['cap2']));
$cap3 = mysqli_real_escape_string($ketnoi,addslashes($_POST['cap3']));
$cap4 = mysqli_real_escape_string($ketnoi,addslashes($_POST['cap4']));
$cap5 = mysqli_real_escape_string($ketnoi,addslashes($_POST['cap5'])); 
$token = mysqli_real_escape_string($ketnoi,addslashes($_POST['token'])); 
$active = mysqli_real_escape_string($ketnoi,addslashes($_POST['active']));  
$chat = $_POST['chat'];
mysqli_query($ketnoi,"UPDATE `system` 
SET 
`title` = '".mysqli_real_escape_string($ketnoi,$tieude)."',
`tukhoa` = '".mysqli_real_escape_string($ketnoi,$tukhoa)."',
`phoneadmin` = '".mysqli_real_escape_string($ketnoi,$phone)."',
`derc` = '".mysqli_real_escape_string($ketnoi,$mieuta)."',
`cap1` = '".mysqli_real_escape_string($ketnoi,$cap1)."',
`cap2` = '".mysqli_real_escape_string($ketnoi,$cap2)."',
`cap3` = '".mysqli_real_escape_string($ketnoi,$cap3)."',
`cap4` = '".mysqli_real_escape_string($ketnoi,$cap4)."',
`cap5` = '".mysqli_real_escape_string($ketnoi,$cap5)."',
`token` = '".mysqli_real_escape_string($ketnoi,$token)."',
`active` = '".mysqli_real_escape_string($ketnoi,$active)."',
`namesite` = '".mysqli_real_escape_string($ketnoi,$brand)."',
`logo` = '".mysqli_real_escape_string($ketnoi,$logo)."',
`favicon` = '".mysqli_real_escape_string($ketnoi,$favicon)."',
`fbadmin` = '".mysqli_real_escape_string($ketnoi,$fbadmin)."',
`tenadmin` = '".mysqli_real_escape_string($ketnoi,$name)."',
`script` = '".mysqli_real_escape_string($ketnoi,$chat)."',
`kenhthongbao` = '".mysqli_real_escape_string($ketnoi,$zalo)."'
WHERE `webdinhdanh` = '$domain'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Update cài đặt cấu hình website thành công."));
exit();
        }
if (isset($_POST['name']) && isset($_POST['chuthe']) && isset($_POST['stk']) && isset($_POST['link']) && isset($_POST['note1']) && isset($_POST['mabank']) && isset($_POST['min']) && isset($_POST['userbank']) && isset($_POST['tokendoitac']) && isset($_POST['mkbank']) && isset($_POST['idbank'])  && isset($_POST['tygia'])) {
$name = mysqli_real_escape_string($ketnoi,addslashes($_POST['name']));
$chuthe = mysqli_real_escape_string($ketnoi,addslashes($_POST['chuthe']));
$stk = mysqli_real_escape_string($ketnoi,addslashes($_POST['stk']));
$link = mysqli_real_escape_string($ketnoi,addslashes($_POST['link']));
$note1 = mysqli_real_escape_string($ketnoi,addslashes($_POST['note1']));
$mabank = mysqli_real_escape_string($ketnoi,addslashes($_POST['mabank']));
$min = mysqli_real_escape_string($ketnoi,addslashes($_POST['min']));
$userbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['userbank']));
$tokendoitac = mysqli_real_escape_string($ketnoi,addslashes($_POST['tokendoitac'])); 
$tygia = mysqli_real_escape_string($ketnoi,addslashes($_POST['tygia'])); 
$mkbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['mkbank']));
if(empty($_POST['idbank'])){
mysqli_query($ketnoi,"INSERT INTO `banker` SET 
`tenbank` = '$name',
`chuthe` = '$chuthe',
`stk` = '$stk',
`noidung` = '$note1',
`toithieu` = '$min',
`tygia` = '$tygia',
`urlanh` = '$link',
`webdinhdanh` = '$domain',
`mabank` = '$mabank',
`token` = '$tokendoitac',
`userbank` = '$userbank',
`mkbank` = '$mkbank'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm Bank - Ví điện tử thành công !"));
exit();
            }else{
$idbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['idbank']));   
$dembank = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `banker` WHERE `id` = '$idbank' AND `webdinhdanh` = '$domain'"));
if($dembank == 1){

mysqli_query($ketnoi,"UPDATE `banker` SET 
`tenbank` = '$name',
`chuthe` = '$chuthe',
`stk` = '$stk',
`noidung` = '$note1',
`toithieu` = '$min',
`tygia` = '$tygia',
`urlanh` = '$link',
`webdinhdanh` = '$domain',
`mabank` = '$mabank',
`token` = '$tokendoitac',
`userbank` = '$userbank',
`mkbank` = '$mkbank'
WHERE `webdinhdanh` = '$domain' AND `id` = '$idbank'");    
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Cập nhật Bank - Ví điện tử thành công !"));    
    
}else{
mysqli_query($ketnoi,"INSERT INTO `banker` SET 
`tenbank` = '$name',
`chuthe` = '$chuthe',
`stk` = '$stk',
`noidung` = '$note1',
`toithieu` = '$min',
`tygia` = '$tygia',
`urlanh` = '$link',
`webdinhdanh` = '$domain',
`mabank` = '$mabank',
`token` = '$tokendoitac',
`userbank` = '$userbank',
`mkbank` = '$mkbank'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm Bank - Ví điện tử thành công !"));
exit();
            }
            }
        }
        
if (isset($_POST['danhmuc']) && isset($_POST['sapxep']) && isset($_POST['icon'])  && isset($_POST['idbank'])) {
$danhmuc = mysqli_real_escape_string($ketnoi,addslashes($_POST['danhmuc']));
$sapxep = mysqli_real_escape_string($ketnoi,addslashes($_POST['sapxep']));
$idbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['idbank']));
$icon = mysqli_real_escape_string($ketnoi,$_POST['icon']);

if(empty($_POST['idbank'])){
mysqli_query($ketnoi,"INSERT INTO `danhmuc` SET 
`sapxep` = '$sapxep',
`tendichvu` = '$danhmuc',
`icon` = '$icon',
`webdinhdanh` = '$domain',
`time` = '$date'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm danh mục thành công  !"));
exit();
            }else{
$idbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['idbank']));   
$dembank = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `danhmuc` WHERE `id` = '$idbank' AND `webdinhdanh` = '$domain'"));
if($dembank == 1){

mysqli_query($ketnoi,"UPDATE `danhmuc` SET 
`sapxep` = '$sapxep',
`tendichvu` = '$danhmuc',
`icon` = '$icon'
WHERE `webdinhdanh` = '$domain' AND `id` = '$idbank'");    
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Cập nhật danh mục thành công !"));    
    
}else{
mysqli_query($ketnoi,"INSERT INTO `danhmuc` SET 
`sapxep` = '$sapxep',
`tendichvu` = '$danhmuc',
`icon` = '$icon',
`webdinhdanh` = '$domain',
`time` = '$date'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm danh mục thành công !"));
exit();
            }
            }
        }        
 if (isset($_POST['danhmuca']) && isset($_POST['danhmuccon']) && isset($_POST['motangan'])  && isset($_POST['masanpham']) && isset($_POST['nation']) && isset($_POST['dongia'])) {
$danhmuc = mysqli_real_escape_string($ketnoi,addslashes($_POST['danhmuca']));
$danhmuccon = mysqli_real_escape_string($ketnoi,addslashes($_POST['danhmuccon']));
$motangan = mysqli_real_escape_string($ketnoi,addslashes($_POST['motangan']));
$masanpham = mysqli_real_escape_string($ketnoi,addslashes($_POST['masanpham']));
$nation = mysqli_real_escape_string($ketnoi,$_POST['nation']);
$dongia = mysqli_real_escape_string($ketnoi,$_POST['dongia']);
if(empty($_POST['idbanka'])){
mysqli_query($ketnoi,"INSERT INTO `productcon` SET 
`tensanpham` = '$danhmuccon',
`motangan` = '$motangan',
`madanhmuc` = '$danhmuc',
`masanpham` = '$masanpham',
`webdinhdanh` = '$domain',
`nation` = '$nation',
`status` = 'active',
`dongia` = '$dongia'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm sản phẩm thành công  !"));
exit();
            }else{
$idbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['idbanka']));   
$dembank = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `productcon` WHERE `id` = '$idbank'"));
if($dembank == 1){

mysqli_query($ketnoi,"UPDATE `productcon` SET 
`tensanpham` = '$danhmuccon',
`motangan` = '$motangan',
`madanhmuc` = '$danhmuc',
`masanpham` = '$masanpham',
`nation` = '$nation',
`webdinhdanh` = '$domain',
`status` = 'active',
`dongia` = '$dongia'
WHERE  `id` = '$idbank'");    
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Cập nhật sản phẩm thành công !"));    
    
}else{
mysqli_query($ketnoi,"INSERT INTO `productcon` SET 
`tensanpham` = '$danhmuccon',
`motangan` = '$motangan',
`madanhmuc` = '$danhmuc',
`masanpham` = '$masanpham',
`webdinhdanh` = '$domain',
`status` = 'active',
`nation` = '$nation',
`dongia` = '$dongia'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm sản phẩm thành công !"));
exit();
                }
            }
        }          
if (isset($_POST['danhmuc']) && isset($_POST['madanhmuc']) && isset($_POST['icon'])  && isset($_POST['idbank']) && isset($_POST['danhmucclone'])) {
$danhmuc = mysqli_real_escape_string($ketnoi,addslashes($_POST['danhmuc']));
$sapxep = mysqli_real_escape_string($ketnoi,addslashes($_POST['madanhmuc']));
$idbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['idbank']));
$danhmucclone = mysqli_real_escape_string($ketnoi,addslashes($_POST['danhmucclone']));
$icon = mysqli_real_escape_string($ketnoi,$_POST['icon']);

if(empty($_POST['idbank'])){
mysqli_query($ketnoi,"INSERT INTO `product` SET 
`madanhmuc` = '$sapxep',
`tendanhmuc` = '$danhmuc',
`giaodien` = '$danhmucclone',
`url` = '$icon',
`status` = 'active'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm danh mục clone thành công  !"));
exit();
            }else{
$idbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['idbank']));   
$dembank = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `product` WHERE `id` = '$idbank'"));
if($dembank == 1){

mysqli_query($ketnoi,"UPDATE `product` SET 
`madanhmuc` = '$sapxep',
`tendanhmuc` = '$danhmuc',
`giaodien` = '$danhmucclone',
`url` = '$icon'
WHERE  `id` = '$idbank'");    
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Cập nhật danh mục clone thành công !"));    
    
}else{
mysqli_query($ketnoi,"INSERT INTO `product` SET 
`madanhmuc` = '$sapxep',
`tendanhmuc` = '$danhmuc',
`giaodien` = '$danhmucclone',
`url` = '$icon',
`status` = 'active'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm danh mục clone thành công !"));
exit();
                }
            }
        }    
 if (isset($_POST['danhmuca']) && isset($_POST['danhmuccon']) && isset($_POST['sapxep'])  && isset($_POST['idbanka']) && isset($_POST['icon1'])) {
$danhmuc = mysqli_real_escape_string($ketnoi,addslashes($_POST['danhmuca']));
$danhmuccon = mysqli_real_escape_string($ketnoi,addslashes($_POST['danhmuccon']));
$sapxep = mysqli_real_escape_string($ketnoi,addslashes($_POST['sapxep']));
$idbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['idbanka']));
$icon = mysqli_real_escape_string($ketnoi,$_POST['icon1']);

if(empty($_POST['idbanka'])){
mysqli_query($ketnoi,"INSERT INTO `danhmuctinhnang` SET 
`sapxep` = '$sapxep',
`danhmuc` = '$danhmuc',
`tendichvu` = '$danhmuccon',
`icon` = '$icon',
`webdinhdanh` = '$domain',
`time` = '$date'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm danh mục con thành công  !"));
exit();
            }else{
$idbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['idbanka']));   
$dembank = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `danhmuctinhnang` WHERE `id` = '$idbank' AND `webdinhdanh` = '$domain'"));
if($dembank == 1){

mysqli_query($ketnoi,"UPDATE `danhmuctinhnang` SET 
`sapxep` = '$sapxep',
`danhmuc` = '$danhmuc',
`tendichvu` = '$danhmuccon',
`icon` = '$icon'
WHERE `webdinhdanh` = '$domain' AND `id` = '$idbank'");    
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Cập nhật danh mục con thành công $sapxep!"));    
    
}else{
mysqli_query($ketnoi,"INSERT INTO `danhmuctinhnang` SET 
`sapxep` = '$sapxep',
`danhmuc` = '$danhmuc',
`tendichvu` = '$danhmuccon',
`icon` = '$icon',
`webdinhdanh` = '$domain',
`time` = '$date'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm danh mục con thành công !"));
exit();
            }
            }
        }   

 if (isset($_POST['danhmucb']) && isset($_POST['tentinhnang']) && isset($_POST['sapxep'])  && isset($_POST['webnguon']) && isset($_POST['trangthai'])&& isset($_POST['idbanka'])) {
$danhmuccon = mysqli_real_escape_string($ketnoi,addslashes($_POST['danhmucb']));
$tentinhnang = mysqli_real_escape_string($ketnoi,addslashes($_POST['tentinhnang']));
$sapxep = mysqli_real_escape_string($ketnoi,addslashes($_POST['sapxep']));
$webnguon = mysqli_real_escape_string($ketnoi,addslashes($_POST['webnguon']));
$trangthai = mysqli_real_escape_string($ketnoi,addslashes($_POST['trangthai']));
$idbank = mysqli_real_escape_string($ketnoi,$_POST['idbanka']);

$respawn1a = mysqli_fetch_array(mysqli_query($ketnoi,"SELECT * FROM `token` WHERE `webdinhdanh` = '$domain' AND `webnguon` = '$webnguon'"));
$type = $respawn1a['type'];

if(empty($_POST['idbanka'])){
mysqli_query($ketnoi,"INSERT INTO `danhmuccon` SET 
`sapxep` = '$sapxep',
`danhmuctinhnang` = '$danhmuccon',
`webnguon` = '$webnguon',
`action` = '$trangthai',
`tendichvucon` = '$tentinhnang',
`webdinhdanh` = '$domain',
`type` = '$type',
`time` = '$date'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm tính năng thành công  !"));
exit();
            }else{
$idbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['idbanka']));   
$dembank = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `danhmuccon` WHERE `id` = '$idbank' AND `webdinhdanh` = '$domain'"));
if($dembank == 1){

mysqli_query($ketnoi,"UPDATE `danhmuccon` SET 
`sapxep` = '$sapxep',
`danhmuctinhnang` = '$danhmuccon',
`webnguon` = '$webnguon',
`action` = '$trangthai',
`tendichvucon` = '$tentinhnang',
`webdinhdanh` = '$domain',
`type` = '$type'
WHERE `webdinhdanh` = '$domain' AND `id` = '$idbank'");    
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Cập nhật tính năng thành công !"));    
    
}else{
mysqli_query($ketnoi,"INSERT INTO `danhmuccon` SET 
`sapxep` = '$sapxep',
`danhmuctinhnang` = '$danhmuccon',
`webnguon` = '$webnguon',
`action` = '$trangthai',
`tendichvucon` = '$tentinhnang',
`webdinhdanh` = '$domain',
`type` = '$type',
`time` = '$date'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm tính năng thành công  !"));
exit();
            }
            }
        } 
if (isset($_POST['sanpham']) && isset($_POST['acc']) && isset($_POST['type']) && isset($_SESSION['username'])) {
$sanpham = mysqli_real_escape_string($ketnoi,addslashes($_POST['sanpham']));
$acc = $_POST['acc'];
$type = mysqli_real_escape_string($ketnoi,addslashes($_POST['type']));
if($type == 'add' && $admin == 'yes'){
$data = explode("\n",$acc);
$soluong = count($data);
for($i = 0;$i < $soluong;$i++){
$data1 = $data[$i];
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `sanpham` WHERE `masanpham` = '$sanpham' AND `info` = '$data1'"));
if($dem == 0){
mysqli_query($ketnoi,"INSERT INTO `sanpham` SET 
`info` = '$data1',
`masanpham` = '$sanpham',
`status` = 'active',
`webdinhdanh` = '$domain',
`date` = '$date'");
}
            
}
 echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Bạn đã thêm $soluong sản phẩm thành công  !"));
exit(); 
 }else{
 echo json_encode(array('status' => "error", 'title' => "Thất bại", 'msg' => "Bạn cần đăng nhập quyền admin  !"));
exit();    
 }
        } 
 if (isset($_POST['brand']) && isset($_POST['tinhnang']) && isset($_POST['tenserver']) && isset($_POST['severgoc'])  && isset($_POST['giagoc']) && isset($_POST['giacap0'])&& isset($_POST['giacap1'])&& isset($_POST['giacap2'])&& isset($_POST['giacap3'])&& isset($_POST['giacap4'])&& isset($_POST['giacap5'])&& isset($_POST['min'])&& isset($_POST['max'])&& isset($_POST['reaction'])&& isset($_POST['comment'])&& isset($_POST['minutes'])&& isset($_POST['dayvip'])&& isset($_POST['summernote'])&& isset($_POST['motangan'])&& isset($_POST['status'])&& isset($_POST['idbankc'])&& isset($_POST['exchange'])&& isset($_POST['loaidonb'])) {
$brand = mysqli_real_escape_string($ketnoi,addslashes($_POST['brand']));
$tinhnang = mysqli_real_escape_string($ketnoi,addslashes($_POST['tinhnang']));
$tenserver = mysqli_real_escape_string($ketnoi,addslashes($_POST['tenserver']));
$servergoc = mysqli_real_escape_string($ketnoi,addslashes($_POST['severgoc']));
$giagoc = mysqli_real_escape_string($ketnoi,addslashes($_POST['giagoc']));
$giacap0 = mysqli_real_escape_string($ketnoi,addslashes($_POST['giacap0']));
$giacap1 = mysqli_real_escape_string($ketnoi,addslashes($_POST['giacap1']));
$giacap2 = mysqli_real_escape_string($ketnoi,addslashes($_POST['giacap2']));
$giacap3 = mysqli_real_escape_string($ketnoi,addslashes($_POST['giacap3']));
$giacap4 = mysqli_real_escape_string($ketnoi,addslashes($_POST['giacap4']));
$giacap5 = mysqli_real_escape_string($ketnoi,addslashes($_POST['giacap5']));
$min = mysqli_real_escape_string($ketnoi,addslashes($_POST['min']));
$max = mysqli_real_escape_string($ketnoi,addslashes($_POST['max']));
$exchange = mysqli_real_escape_string($ketnoi,addslashes($_POST['exchange']));
$reaction = mysqli_real_escape_string($ketnoi,addslashes($_POST['reaction']));
$comment = mysqli_real_escape_string($ketnoi,addslashes($_POST['comment']));
$minutes = mysqli_real_escape_string($ketnoi,addslashes($_POST['minutes']));
$dayvip = mysqli_real_escape_string($ketnoi,addslashes($_POST['dayvip']));
$loaidonb = mysqli_real_escape_string($ketnoi,addslashes($_POST['loaidonb']));
$mota = mysqli_real_escape_string($ketnoi,$_POST['summernote']);
$motangan = htmlspecialchars($_POST['motangan']);
$status = mysqli_real_escape_string($ketnoi,addslashes($_POST['status']));
$idbankc = mysqli_real_escape_string($ketnoi,$_POST['idbankc']);

$respawn1a = mysqli_fetch_array(mysqli_query($ketnoi,"SELECT * FROM `danhmuccon` WHERE `webdinhdanh` = '$domain' AND `id` = '$tinhnang'"));
$type = $respawn1a['type'];
if($loaidonb =='goc' || $loaidonb == $respawn1a['webnguon']){
if($type == 'smm'){
$type = $respawn1a['webnguon'];    
}    
}else{
if($loaidonb !=='goc'){
$type =   $loaidonb;  
}   
}    
$tendichvucon = $respawn1a['tendichvucon'];


if(empty($_POST['idbankc'])){
mysqli_query($ketnoi,"INSERT INTO `chietkhau` SET 
`loaihinh` = '$brand',
`tinhnang` = '$tendichvucon',
`madichvu` = '$tinhnang',
`tendichvu` = '$tenserver',
`server` = '$servergoc',
`giagoc` = '$giagoc',
`cap0` = '$giacap0',
`cap1` = '$giacap1',
`cap2` = '$giacap2',
`cap3` = '$giacap3',
`cap4` = '$giacap4',
`cap5` = '$giacap5',
`min` = '$min',
`max` = '$max',
`exchange` = '$exchange',
`reaction` = '$reaction',
`comment` = '$comment',
`minutes` = '$minutes',
`dayvip` = '$dayvip',
`mota` = '$mota',
`note` = '$motangan',
`status` = '$status',
`type` = '$type',
`webdinhdanh` = '$domain'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm server thành công  !"));
exit();
            }else{
$idbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['idbankc']));   
$dembank = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `danhmuccon` WHERE `id` = '$tinhnang' AND `webdinhdanh` = '$domain'"));
if($dembank == 1){

mysqli_query($ketnoi,"UPDATE `chietkhau` SET 
`loaihinh` = '$brand',
`tinhnang` = '$tendichvucon',
`madichvu` = '$tinhnang',
`tendichvu` = '$tenserver',
`server` = '$servergoc',
`giagoc` = '$giagoc',
`cap0` = '$giacap0',
`cap1` = '$giacap1',
`cap2` = '$giacap2',
`cap3` = '$giacap3',
`cap4` = '$giacap4',
`cap5` = '$giacap5',
`min` = '$min',
`max` = '$max',
`exchange` = '$exchange',
`reaction` = '$reaction',
`comment` = '$comment',
`minutes` = '$minutes',
`dayvip` = '$dayvip',
`mota` = '$mota',
`note` = '$motangan',
`status` = '$status',
`type` = '$type'
WHERE `webdinhdanh` = '$domain' AND `id` = '$idbank'");    
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Cập nhật server thành công !"));    
    
}else{
mysqli_query($ketnoi,"INSERT INTO `chietkhau` SET 
`loaihinh` = '$brand',
`tinhnang` = '$tendichvucon',
`madichvu` = '$tinhnang',
`tendichvu` = '$tenserver',
`server` = '$servergoc',
`giagoc` = '$giagoc',
`cap0` = '$giacap0',
`cap1` = '$giacap1',
`cap2` = '$giacap2',
`cap3` = '$giacap3',
`cap4` = '$giacap4',
`cap5` = '$giacap5',
`min` = '$min',
`max` = '$max',
`exchange` = '$exchange',
`reaction` = '$reaction',
`comment` = '$comment',
`minutes` = '$minutes',
`dayvip` = '$dayvip',
`mota` = '$mota',
`note` = '$motangan',
`status` = '$status',
`type` = '$type',
`webdinhdanh` = '$domain'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm server thành công  !"));
exit();
            }
            }
        } 
 

if (isset($_POST['idbankd']) && isset($_POST['webnguon']) && isset($_POST['schoice'])  && isset($_POST['token'])) {
$idbankd = mysqli_real_escape_string($ketnoi,addslashes($_POST['idbankd']));
$webnguon = mysqli_real_escape_string($ketnoi,addslashes($_POST['webnguon']));
$schoice = mysqli_real_escape_string($ketnoi,addslashes($_POST['schoice']));
$token = mysqli_real_escape_string($ketnoi,$_POST['token']);

if(empty($_POST['idbankd'])){
mysqli_query($ketnoi,"INSERT INTO `token` SET 
`token` = '$token',
`webnguon` = '$webnguon',
`status` = 'active',
`webdinhdanh` = '$domain',
`type` = '$schoice'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm token thành công  !"));
exit();
            }else{
$idbank = mysqli_real_escape_string($ketnoi,addslashes($_POST['idbankd']));   
$dembank = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `token` WHERE `id` = '$idbank' AND `webdinhdanh` = '$domain'"));
if($dembank == 1){

mysqli_query($ketnoi,"UPDATE `token` SET 
`token` = '$token',
`webnguon` = '$webnguon',
`status` = 'active',
`webdinhdanh` = '$domain',
`type` = '$schoice'
WHERE `webdinhdanh` = '$domain' AND `id` = '$idbank'");    
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Cập nhật danh mục thành công !"));    
    
}else{
mysqli_query($ketnoi,"INSERT INTO `token` SET 
`token` = '$token',
`webnguon` = '$webnguon',
`status` = 'active',
`webdinhdanh` = '$domain',
`type` = '$schoice'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm token thành công  !"));
exit();
            }
            }
        } 

if (isset($_POST['websmm']) && isset($_POST['link'])) {
$websmm = mysqli_real_escape_string($ketnoi,addslashes($_POST['websmm']));
$link = mysqli_real_escape_string($ketnoi,addslashes($_POST['link']));

$dembank = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `apitoken` WHERE `webnguon` = '$websmm'"));
if($dembank == 1){

mysqli_query($ketnoi,"UPDATE `apitoken` SET 
`function` = '$link'
WHERE `webnguon` = '$websmm'");    
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Cập nhật link thành công !"));    
    
}else{
mysqli_query($ketnoi,"INSERT INTO `apitoken` SET 
`function` = '$link',
`webnguon` = '$websmm',
`status` = 'active'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm link thành công  !"));
exit();
            }
            
        } 
if (isset($_POST['idthongbao']) && isset($_POST['tieude']) && isset($_POST['summernote'])) {
$idthongbao = mysqli_real_escape_string($ketnoi,addslashes($_POST['idthongbao']));
$tieude = mysqli_real_escape_string($ketnoi,addslashes($_POST['tieude']));
$summernote = mysqli_real_escape_string($ketnoi,$_POST['summernote']);
if(empty($_POST['idthongbao'])){

mysqli_query($ketnoi,"INSERT INTO `logs` SET 
`tieudethongbao` = '$tieude',
`noidung` = '$summernote',
`webdinhdanh` = '$domain',
`date` = '$date'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm thông báo thành công  !"));
exit();
                
}else{
$dembank = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `logs` WHERE `webdinhdanh` = '$domain' AND `id` = '$idthongbao'"));
if($dembank == 1){
mysqli_query($ketnoi,"UPDATE `logs` SET 
`tieudethongbao` = '$tieude',
`noidung` = '$summernote'
WHERE `webdinhdanh` = '$domain'  AND `id` = '$idthongbao'");    
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Cập nhật thông báo thành công !"));    
    
}else{
mysqli_query($ketnoi,"INSERT INTO `logs` SET 
`tieudethongbao` = '$tieude',
`noidung` = '$summernote',
`webdinhdanh` = '$domain',
`date` = '$date'");
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Thêm thông báo thành công  !"));
exit();
            }
            
        } 

}









 
        
        if (isset($_POST['tygia']) && isset($_POST['partnerid']) && isset($_POST['partnerkey'])) {
$tygia = mysqli_real_escape_string($ketnoi,addslashes($_POST['tygia']));
$partnerid = mysqli_real_escape_string($ketnoi,addslashes($_POST['partnerid']));
$partnerkey = mysqli_real_escape_string($ketnoi,addslashes($_POST['partnerkey']));


mysqli_query($ketnoi,"UPDATE `system` SET 
`ratecard` = '$tygia',
`partnerid` = '$partnerid',
`partnerkey` = '$partnerkey'
WHERE `webdinhdanh` = '$domain'");    
echo json_encode(array('status' => "success", 'title' => "Thành công", 'msg' => "Cập nhật cấu hình thẻ cào thành công !"));    
    

        }        
    }
}
?>