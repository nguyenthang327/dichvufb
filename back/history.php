<?php
include('system/connect.php');
if($active !== 'active'){
die (dev($active));
exit();
}elseif(!isset($_SESSION['username'])){
header('location:/login.html');
exit();
}else{
if(isset($_GET['type'])){
$id = mysqli_escape_string($ketnoi,$_GET['type']);
if($id == 1){
$nametarget = 'Like Rẻ';
$back = '/likesale.html';
$matinhnang = 'likesale';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';
}elseif($id == 2){
$nametarget = 'Like Nhanh';
$back = '/likespeed.html';
$matinhnang = 'likespeed';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';
}elseif($id == 3){
$nametarget = 'Like Tây';
$back = '/liketay.html';
$matinhnang = 'liketay';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 4){
$nametarget = 'Like Page Rẻ';
$back = '/likepage.html';
$matinhnang = 'likepagesale';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';}
elseif($id == 5){
$nametarget = 'Like Page Nhanh';
$back = '/likepagespeed.html';
$matinhnang = 'likepagespeed';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';}
elseif($id == 6){
$nametarget = 'Like Comment';
$back = '/likecomment.html';
$matinhnang = 'likecomment';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';}elseif($id == 7){
$nametarget = 'Member Group';
$back = '/membergroup.html';
$matinhnang = 'membergroup';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';
}elseif($id == 8){
$nametarget = 'Sub Rẻ';
$back = '/subsale.html';
$matinhnang = 'subsale';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 9){
$nametarget = 'Sub Nhanh';
$back = '/subspeed.html';
$matinhnang = 'subspeed';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 10){
$nametarget = 'Sub Vip';
$back = '/vipfollow.html';
$matinhnang = 'subvip';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 11){
$nametarget = 'Comment Rẻ';
$back = '/commentsale.html';
$matinhnang = 'commentsale';
$somat = 'no';
$comment = 'yes';
$dayvip = 'no';    
}elseif($id == 12){
$nametarget = 'Comment Nhanh';
$back = '/commentspeed.html';
$matinhnang = 'commentv2';
$somat = 'no';
$comment = 'yes';
$dayvip = 'no';    
}elseif($id == 13){
$nametarget = 'Share Rẻ';
$back = '/sharesale.html';
$matinhnang = 'shareprofile';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 14){
$nametarget = 'View Video';
$back = '/viewvideo.html';
$matinhnang = 'viewvideo';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 15){
$nametarget = 'View Story';
$back = '/viewstory.html';
$matinhnang = 'viewstory';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 16){
$nametarget = 'Mắt Live';
$back = '/matlivesale.html';
$matinhnang = 'matlive';
$somat = 'yes';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 17){
$nametarget = 'Vip Like';
$back = '/viplike.html';
$matinhnang = 'viplike';
$somat = 'no';
$comment = 'no';
$dayvip = 'yes';    
}elseif($id == 18){
$nametarget = 'Vip Comment';
$back = '/vipcomment.html';
$matinhnang = 'vipcomment';
$somat = 'no';
$comment = 'yes';
$dayvip = 'yes';    
}elseif($id == 19){
$nametarget = 'Vip Mắt Live';
$back = '/vipmatlive.html';
$matinhnang = 'vipmatlive';
$somat = 'yes';
$comment = 'no';
$dayvip = 'yes';    
}elseif($id == 20){
$nametarget = 'Like Instagram';
$back = '/likeinstagram.html';
$matinhnang = 'botlikeinstagram';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 21){
$nametarget = 'Sub Instagram';
$back = '/subinstagram.html';
$matinhnang = 'subinstagram';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 22){
$nametarget = 'Like Youtube';
$back = '/likeyoutube.html';
$matinhnang = 'likeyoutube';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 23){
$nametarget = 'Sub Youtube';
$back = '/subyoutube.html';
$matinhnang = 'subyoutubere';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 24){
$nametarget = 'View Youtube';
$back = '/viewyoutube.html';
$matinhnang = 'viewyoutube';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 25){
$nametarget = 'Like Tiktok';
$back = '/liketiktok.html';
$matinhnang = 'liketiktok';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 26){
$nametarget = 'Sub Tiktok';
$back = '/subtiktok.html';
$matinhnang = 'subtiktok';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 27){
$nametarget = 'View Tiktok';
$back = '/viewtiktok.html';
$matinhnang = 'viewtiktok';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 28){
$nametarget = 'Comment Tiktok';
$back = '/commenttiktok.html';
$matinhnang = 'commenttiktok';
$somat = 'no';
$comment = 'yes';
$dayvip = 'no';    
}elseif($id == 29){
$nametarget = 'Sub Twitter';
$back = '/subtwitter.html';
$matinhnang = 'subtwitter';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}elseif($id == 30){
$nametarget = 'Member Telegram';
$back = '/membertele.html';
$matinhnang = 'membertele';
$somat = 'no';
$comment = 'no';
$dayvip = 'no';    
}
}
if(isset($_POST['seach'])){
$seach = addslashes($_POST['seach']); 
$dem1 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `id` ='".mysqli_real_escape_string($ketnoi,$seach)."'"));
$dem2 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `codeoder` ='".mysqli_real_escape_string($ketnoi,$seach)."'"));
if($dem1 > 0){
$seachans = "AND `id` = '$seach'";    
}elseif($dem2 > 0){
$seachans = "AND `codeoder` = '$seach'";    
}else{
$seachans = "";      
}
}else{
$seachans = "";      
}    
include('system/thongke.php');    
include('page/header.php');
include('page/nav.php');
include('page/menu.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/"><i class="mdi mdi-home-outline"></i>Trang Chủ</a></li>
								<li class="breadcrumb-item" aria-current="page">Lịch Sử Dịch Vụ</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>	  

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			 <a style="float:right;" href="<?=$back?>" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw me-1"></i> THÊM ĐƠN</a>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					  <div class="row">
						<div class="col-xl-12">
						    <form method="POST" action="">
<div class="input-group">
										<input type="text" class="form-control" placeholder="seach" name="seach" id="seach" required="" aria-invalid="false"> 
										<button type="submit" class="btn btn-info btn-sm" type="button">Tìm kiếm</button> 
									</div>
</form>	
<div class="table-responsive">
<table class="table table-hover text-nowrap">
<thead>
<tr>
<th class="border-top-0 pt-0 pb-2">Focus</th>
<th class="border-top-0 pt-0 pb-2">ID</th>
<th class="border-top-0 pt-0 pb-2">Loại</th>
<th class="border-top-0 pt-0 pb-2">UID/LINK</th>
<th class="border-top-0 pt-0 pb-2">Mã giao dịch</th>
<th class="border-top-0 pt-0 pb-2">Số lượng</th>
<th class="border-top-0 pt-0 pb-2">Đã chạy</th>
<th class="border-top-0 pt-0 pb-2">Chi phí</th>
<?php
if($somat == 'yes'){
?>
<th class="border-top-0 pt-0 pb-2">Số phút</th>
<?php
}
?>
<?php
if($comment == 'yes'){
?>
<th class="border-top-0 pt-0 pb-2">Nội dung</th>
<?php
}
?>
<?php
if($dayvip == 'yes'){
?>
<th class="border-top-0 pt-0 pb-2">Số ngày VIP</th>
<?php
}
?>
<th class="border-top-0 pt-0 pb-2">Thời gian</th>
<th class="border-top-0 pt-0 pb-2">Trạng thái</th>
<th class="border-top-0 pt-0 pb-2">Action</th>
</tr>
</thead>
<tbody>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=10000;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `username` = '$username' AND `webdinhdanh` = '$domain' AND `matinhnang` = '$matinhnang' $seachans"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `username` = '$username' AND `webdinhdanh` = '$domain' AND `matinhnang` = '$matinhnang' $seachans  order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>    

 <tr>
<td>Bạn chưa có giao dịch nào !</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                               
                            </tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>       
<tr>
<td class="w-10px align-middle">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="product1">
<label class="form-check-label" for="product1"></label>
</div>
</td>
<td class="align-middle"><?=$row['id']?></td>
<td class="align-middle"><?=$row['type']?></td>
<td class="align-middle"><input type="text" value="<?=$row['link']?>" readonly=""></td>
<td class="align-middle"><?=$row['codeoder']?></td>
<td class="align-middle"><?=number_format($row['soluong'])?></td>
<td class="align-middle"><?=number_format($row['dachay'])?></td>
<td class="align-middle"><?=number_format($row['cashtru'])?> VNĐ</td>
<?php
if($somat == 'yes'){
?>
<td class="align-middle"><?=number_format($row['somat'])?></td>
<?php
}
?>
<?php
if($comment == 'yes'){
?>
<td class="align-middle"><input type="text" value="<?=$row['comment']?>" readonly=""></td>
<?php
}
?>
<?php
if($dayvip == 'yes'){
?>
<td class="align-middle"><?=number_format($row['dayvip'])?></td>
<?php
}
?>
<td class="align-middle"><?=$row['date']?></td>
<td class="align-middle"><?php if($row['status'] == 'active'){echo '<span class="badge border border-warning text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Đang chạy</span>';}
elseif($row['status'] == 'success'){echo '<span class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Hoàn thành</span>';}
elseif($row['status'] == 'report'){echo '<span class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Đơn sai</span>';}
elseif($row['status'] == 'cancel'){echo '<span class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Đơn sai</span>';}
elseif($row['status'] == 'pause'){echo '<span class="badge border border-primary text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Tạm dừng</span>';}
?></td>
<td class="align-middle"><form action="/report.html" method="POST"><button type="submit" class="badge border border-primary text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Khiếu nại</button></form></td>
</tr>
<?php $i++; endwhile; endif; ?>  
</tbody>
</table>
</div> 
<div class="d-md-flex align-items-center">
<div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
Hiện <?php $a = $i- 1; echo $a;?> kết quả từ trang <?=$total_pages?> có <?=$num_rec_per_page?> hàng
</div>
<ul class="pagination mb-0 justify-content-center">
<?
echo "<li class='page-item disabled'><a href='?page=1' class='page-link'>Trang đầu</a></li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item active'><a class='page-link'  href='?page=".$i."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' ?page=$total_pages'>Trang cuối</a></li>";
?>    
</ul>
</div>
</div>
					  </div>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
<?php
include('page/banquyen.php');
?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar">
	  
	<div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger" data-toggle="control-sidebar"><i class="ion ion-close text-white"></i></span> </div>  <!-- Create the tabs -->
    <ul class="nav nav-tabs control-sidebar-tabs">
      <li class="nav-item"><a href="#control-sidebar-home-tab" data-bs-toggle="tab" class="active"><i class="mdi mdi-message-text"></i></a></li>
      <li class="nav-item"><a href="#control-sidebar-settings-tab" data-bs-toggle="tab"><i class="mdi mdi-playlist-check"></i></a></li>
    </ul>

  </aside>
  <!-- /.control-sidebar -->
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->
	
	<!-- ./side demo panel -->
	<div class="sticky-toolbar">	    
	    <a href="/?mode=dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Dark Mode" class="waves-effect waves-dark btn btn-success btn-flat mb-5 btn-sm" target="_blank">
			<i class="fas fa-moon"></i>
		</a>
	    <a href="/?mode=light" data-bs-toggle="tooltip" data-bs-placement="left" title="Light Mode" class="waves-effect waves-light btn btn-danger btn-flat mb-5 btn-sm" target="_blank">
		<i class="fas fa-lightbulb"></i>
		</a>
	    <a id="chat-popup" href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Kênh Hỗ Trợ" class="waves-effect waves-light btn btn-warning btn-flat btn-sm">
			<span class="icon-Group-chat"><span class="path1"></span><span class="path2"></span></span>
		</a>
	</div>
	<!-- Sidebar -->
		
	<div id="chat-box-body">
	     <a href="<?=$kenhthongbao?>">
		<div id="chat-circle" class="waves-effect waves-circle btn btn-circle btn-lg btn-warning l-h-70">
            <div id="chat-overlay"></div>
           
            <span class="icon-Group-chat fs-30"><span class="path1"></span><span class="path2"></span></span>
		</div>
		</a>
	</div>
	
	<!-- Page Content overlay -->
	
<?php
if(isset($_POST['target']) && isset($_POST['reply'])){
if(empty($_POST['target']) ||empty($_POST['reply'])){
echo('<script type="text/javascript">swal("ERROR","Vui lòng không để trống bất cứ thông tin nào !","error");setTimeout(function(){ location.href = "/reply-admin.html?idcheck='.$idcheck.'" },3000);</script>');        
} else{  
$target = mysqli_real_escape_string($ketnoi,addslashes($_POST['target'])); // id phiên
$reply = htmlspecialchars($_POST['reply']);
$checkin1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `support` WHERE `id` ='".mysqli_real_escape_string($ketnoi,$target)."'")); 
$noidung = $checkin1['noidung'];
$reply2 = "<br><tr>$username:$reply </tr>";
$noidungupdate = "$noidung $reply2";
$ketnoi->query("UPDATE `support` SET `noidung` = '$noidungupdate',`status`='wait' WHERE `id` = '$target'");
echo('<script type="text/javascript">swal("SUCCESS","Đã phản hồi Admin thành công !","success");setTimeout(function(){ location.href = "/reply-admin.html?idcheck='.$idcheck.'" },3000);</script>');    
    }
}
include('page/footer.php');
}
?>

