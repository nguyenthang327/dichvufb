<?php
error_reporting(0);
require('../system/config.php');
$sl1 = '';$sl2 = '';$sl3 = '';$sl4 = '';$sl5 = '';$sl6 = '';$sl7 = '';$sl8 = '';$sl9 = '';$sl10 = '';$sl11 = '';
$dayvip1 = '';$dayvip2 = '';$dayvip3 = '';$dayvip4 = '';$dayvip5 = '';$dayvip6 = '';$dayvip7 = '';$dayvip8 = '';$dayvip9 = '';$dayvip10 = '';$dayvip11 = '';
if(!isset($_SESSION['username'])){
$array = array("status" => "false", "min" => '0', "max" => '0', "comment" => '', "reaction" => '', "minutes" => '', "dayvip" => '', "infomation" => 'Bạn chưa đăng nhập');     
}else{
if(isset($_GET['number']) && isset($_GET['server'])){
if(isset($_GET['minutes1'])){
$tiengio =  $_GET['minutes1']; 
if($tiengio == 30){
$sl1 = 'selected="selected"';
}elseif($tiengio == 45){
$sl2 = 'selected="selected"';
}elseif($tiengio == 60){
$sl3 = 'selected="selected"';
}elseif($tiengio == 90){
$sl4 = 'selected="selected"';
}elseif($tiengio == 120){
$sl5 = 'selected="selected"';
}elseif($tiengio == 150){
$sl6 = 'selected="selected"';
}elseif($tiengio == 180){
$sl7 = 'selected="selected"';
}elseif($tiengio == 210){
$sl8 = 'selected="selected"';
}elseif($tiengio == 240){
$sl9 = 'selected="selected"';
}elseif($tiengio == 270){
$sl10 = 'selected="selected"';
}elseif($tiengio == 300){
$sl11 = 'selected="selected"';
}
}else{
$tiengio = 1; 
}  
if(isset($_GET['dayvip1'])){
$dayvip =  $_GET['dayvip1']; 
if($dayvip == 7){
$tienthang = $dayvip/30;    
$dayvip1 = 'selected="selected"';
}elseif($dayvip == 15){
$tienthang = $dayvip/30;    
$dayvip2 = 'selected="selected"';
}elseif($dayvip == 30){
$tienthang = $dayvip/30;    
$dayvip3 = 'selected="selected"';
}elseif($dayvip == 60){
$tienthang = $dayvip/30;    
$dayvip4 = 'selected="selected"';
}elseif($dayvip == 90){
$tienthang = $dayvip/30;    
$dayvip5 = 'selected="selected"';
}elseif($dayvip == 120){
$tienthang = $dayvip/30;    
$dayvip6 = 'selected="selected"';
}elseif($dayvip == 150){
$tienthang = $dayvip/30;    
$dayvip7 = 'selected="selected"';
}elseif($dayvip == 180){
$tienthang = $dayvip/30;    
$dayvip8 = 'selected="selected"';
}
}else{
$dayvip = 1; 
$tienthang = $dayvip;
}
if(isset($_GET['dayvip1']) && isset($_GET['minutes1'])){
$tienthang = 1 * 10;     // 5 lượt live mỗi ngày và 10 lần live trong quá trình dùng
}
$soluong = xss($_GET['number']);    
$server = xss($_GET['server']);
$datasv = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `id`='$server' AND `webdinhdanh` ='$domain'"));
$min = $datasv['min'];
$max = $datasv['max'];
$reaction = $datasv['reaction'];
if($reaction == 'yes'){
$reaction1 = '<div class="col-lg-12">
<div class="form-group">
<label>Chọn cảm xúc</label>
<select class="form-control custom-select" id="reaction1" name="reaction1">
<option>Vui lòng chọn cảm xúc</option>
<option value="like">Like</option>
<option value="haha">Haha</option>
<option value="wow">Wow</option>
<option value="care">Quan tâm</option>
<option value="love">Yêu</option>
<option value="sad">Buồn</option>
<option value="angry">Tức giận</option>
</select>
</div>
</div>';    
}else{$reaction1 = '';}
$comment = $datasv['comment'];
if($comment == 'yes'){
$comment1 = '<div class="col-lg-12">
<div class="form-group">
<label>Comment</label>
<textarea class="form-control" name="comment1" id="comment1" placeholder="Vui lòng nhập nội dung bình luận, mỗi dòng 1 bình luận"></textarea>
</div>
</div>';    
}else{$comment1 = '';}
$minutes = $datasv['minutes'];
if($minutes == 'yes'){

$minutes1 = '<div class="col-lg-12">
<div class="form-group">
<label>Số phút</label>
<select class="form-control custom-select" id="minutes1" name="minutes1" onchange="checkpoint()">
<option value="">Chọn số phút</option>
<option value="30" '.$sl1.'>30 phút</option>
<option value="45" '.$sl2.'>45 phút</option>
<option value="60" '.$sl3.'>60 phút</option>
<option value="90" '.$sl4.'>90 phút</option>
<option value="120" '.$sl5.'>120 phút</option>
<option value="150" '.$sl6.'>150 phút</option>
<option value="180" '.$sl7.'>180 phút</option>
<option value="210" '.$sl8.'>210 phút</option>
<option value="240" '.$sl9.'>240 phút</option>
<option value="270" '.$sl10.'>270 phút</option>
<option value="300" '.$sl11.'>300 phút</option>
</select>
</div>
</div>';    
}else{$minutes1 = '';}
$dayvip1a = $datasv['dayvip'];
if($dayvip1a == 'yes'){
$dayvip1 = '<div class="col-lg-12">
<div class="form-group">
<label>Ngày Vip</label>
<select class="form-control custom-select" id="dayvip1" name="dayvip1" onchange="checkpoint()">
<option>Ngày Vip</option>
 <option value="7" '.$dayvip1.'>7</option>
                         <option value="15" '.$dayvip2.'>15</option>
                         <option value="30" '.$dayvip3.'>30</option>
                         <option value="60" '.$dayvip4.'>60</option>
                         <option value="90" '.$dayvip5.'>90</option>
                         <option value="120" '.$dayvip6.'>120</option>
                         <option value="150" '.$dayvip7.'>150</option>
                         <option value="180" '.$dayvip8.'>180</option>
</select>
</div>
</div>';    
}else{$dayvip1 = '';}
$mota = $datasv['mota'];
$datauserbuff = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `id`='$server' AND `webdinhdanh` ='$domain'"));
$giabuff = $datauserbuff[$giatri];
$giatien = $soluong * $tiengio * $tienthang * $giabuff;
$total = number_format($giatien);
$array = array("status" => "true", "min" => "$min", "max" => "$max", "comment" => "$comment1", "reaction" => "$reaction1", "minutes" => "$minutes1", "dayvip" => "$dayvip1", "infomation" => "$mota", "total" => "$total VNĐ");   
    }else{
$array = array("status" => "false", "min" => '0', "max" => '0', "comment" => '', "reaction" => '', "minutes" => '', "dayvip" => '', "infomation" => 'Vui lòng chọn máy chủ và nhập số lượng', "total" => "0 VNĐ");           
    }    
}
echo json_encode($array);
?>