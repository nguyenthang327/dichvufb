<?php
require_once('../system/config.php');
if(!isset($_SESSION['username'])){
header('location:/clients/login.html');
}else{
require_once('../system/thongke.php');    
require_once('../pages/header.php');;    
include('../pages/nav.php');
include('../pages/menu.php');
//require_once('../pages/thongke.php'); 
if(isset($_GET['date']) && isset($_GET['code']) && isset($_GET['type'])&& isset($_GET['tinhnang'])){
$date = $_GET['date']; 
$type = xss($_GET['type']);
$code = xss($_GET['code']);
$tinhnang = xss($_GET['tinhnang']);
if(!empty($date)){
$a = " AND `date` > '$date 00:00:00' AND `date` < '$date 23:59:59'";    
}else{
$a ='';    
}
if(!empty($code)){
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `username` ='$username' AND `codeodergoc` = '$code' AND `webdinhdanh` = '$domain'"));
if($dem > 0){
$b = "AND `codeodergoc` = '$code'";  
}else{
$b = "AND `link` = '$code'";    
}
}else{
$b ='';    
}
if($tinhnang == 'all'){
$cat ='';
}else{
$cat ="AND `tinhnang` = '$tinhnang'";   
}
if($type == 'all'){
$c = '';  
}else{
$c = "AND `status` = '$type'";   
}
}else{
$a ='';
$b ='';
$c ='';
$cat = '';
} 
?>
<style>
.goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
body {
    top: 0px !important; 
    }
</style>
<style>
  respawn {
    padding: 1px;  
  }
  </style>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <br>
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/"><i class="mdi mdi-home-outline"></i>Trang Chủ</a></li>
								<li class="breadcrumb-item" aria-current="page">Lịch sử đơn hàng</li>
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
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
    <div class="page-header">
<div class="page-title">
<h4>Lịch sử đơn</h4>
<h6>(Lịch sử đơn hàng)</h6>
</div>
</div>
<div class="card">
<div class="card-body">
<form method="GET">  
<div class="row">
 <div class="col-lg-12 col-sm-12 col-12">
                                        <label for="disabledInput">Chọn tính năng</label>
                                        <select class="form-control" aria-label="Default select example" id="tinhnang" name="tinhnang">                                        
<option value="all">Tất cả tính năng</option>
<?php                              
$respawn1a = mysqli_query($ketnoi,"SELECT * FROM `danhmuccon` WHERE `webdinhdanh` = '$domain'");
if (mysqli_num_rows($respawn1a) == 0):
?>
<?php else: while ($row1a = mysqli_fetch_array($respawn1a, MYSQLI_ASSOC)):?>
<option value="<?=$row1a['id']?>">[ID: <?=$row1a['id']?>]<?=$row1a['tendichvucon']?> </option>
<?php endwhile; endif; ?> 
</select> 
                                    </div>   
<br><br><br>                                  
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Đơn Hàng</label>
<div class="row">
<div class="col-lg-10 col-sm-10 col-10">
<select class="form-select" name="type" id="type">
<option value="all">Tất cả</option>
<option value="success">Hoàn Thành</option>
<option value="inprogess">Đang Chạy</option>
<option value="pending">Chờ Xử Lý</option>
<option value="error">Lỗi</option>
<option value="refund">Hoàn Tiền</option>
<option value="partial">Tạm ngưng</option>
</select>
</div>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Thời Gian</label>
<div class="input-groupicon">
<input name ="date" id="date" type="date" placeholder="DD-MM-YYYY" class="form-control">
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Mã Đơn Hoặc Link</label>
<input type="text" id="code" name="code"  class="form-control">
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Hành động</label> <br>   
<button class="btn btn-success" type="submit">Tìm kiếm</button>
<a href="/clound/history-ordes.html" class="btn btn-danger">Reset</a>
</div>
</div>
</div>
</form>
<div class="row">
<div class="table-responsive ">
<table class="table">
<thead>
<tr>
<th>Mã đơn</th>
<th>Nội dung</th>
<th>Chi phí và tiến trình</th>
<th></th>
</tr>
</thead>
<tbody>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };

$num_rec_per_page=50;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `username` ='$username' $a $b $c $cat"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `username` ='$username' $a $b $c $cat order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Bạn chưa có lịch sử nào</td></tr>
<?php else: while ($rowhis = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>     
<tr>
<td>Mã Đơn:<?=$rowhis['codeodergoc']?><br>
<b>Tình trạng:<?php if($rowhis['status'] == 'pending'){?><span class="badge badge-info">Pending</span> <?php }elseif($rowhis['status'] == 'success'){?><span class="badge badge-success">Hoàn thành</span> <?php }elseif($rowhis['status'] == 'refund'){?><span class="badge badge-danger">Refund</span> <?php }elseif($rowhis['status'] == 'error'){?><span class="badge badge-danger">Lỗi</span> <?php }elseif($rowhis['status'] == 'pause'){?><span class="badge badge-info">Pause</span> <?php }elseif($rowhis['status'] == 'inprogess'){?><span class="badge badge-info">Đang chạy</span> <?php }elseif($rowhis['status'] == 'partial'){?><span class="badge badge-info">Partial</span> <?php } ?></b><br>
<?=$rowhis['date']?>
</td>
<td><b class="card-title mb-0">ID[<?=$rowhis['tinhnang']?>] | Máy chủ [<?=$rowhis['root']?>] |  <?=$rowhis['type']?> </b><br>

<textarea class="form-control"><?=$rowhis['link']?></textarea>
<br>
<a class="badge badge-success" href="/services/<?=$rowhis['tinhnang']?>"><font color="white">Đặt đơn lại</font></a>&nbsp;<a class="badge badge-danger" href="/clound/error.html?target=<?=$rowhis['codeodergoc']?>&action=error"><font color="white">Báo lỗi</font></a>&nbsp;<a class="badge badge-info" href="/clound/error.html?target=<?=$rowhis['codeodergoc']?>&action=refill"><font color="white">Bảo hành</font></a>&nbsp;<a class="badge badge-danger" href="/clound/error.html?target=<?=$rowhis['codeodergoc']?>&action=cancel"><font color="white">Hủy đơn</font></a>
</td>
<td>Chi phí:<?=number_format($rowhis['cashtru'])?> VNĐ<br>
Số lượng: <?=$rowhis['soluong']?><br>
Gốc: <?=$rowhis['goc']?><br>
Còn lại: <?php
if($rowhis['soluong'] - $rowhis['dachay'] >=0){
$conlai =  $rowhis['soluong'] - $rowhis['dachay'];   
echo $conlai;    
}else{
echo 0;    
}
?> 
</td>
</tr>
<?php endwhile; endif; ?> 
</tbody>
</table>
</div>
</div>
<center><ul class="pagination">
<?php
if(!isset($_GET['date']) || !isset($_GET['code']) || !isset($_GET['type'])|| !isset($_GET['tinhnang'])){
echo "<li class='page-item'><a class='page-link' href='?page=1'>".'Trang đầu'."</a> </li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item'><a class='page-link' href='?page=".$i."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' href='?page=$total_pages'>".'Trang cuối'."</a></li>";
}else{
echo "<li class='page-item'><a class='page-link' href='?page=1&type=".$_GET['type']."&date=".$_GET['date']."&code=".$_GET['code']."&tinhnang=".$_GET['tinhnang']."'>".'Trang đầu'."</a> </li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item'><a class='page-link' href='?page=".$i."&type=".$_GET['type']."&date=".$_GET['date']."&code=".$_GET['code']."&tinhnang=".$_GET['tinhnang']."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' href='?page=$total_pages&type=".$_GET['type']."&date=".$_GET['date']."&code=".$_GET['code']."&tinhnang=".$_GET['tinhnang']."'>".'Trang cuối'."</a></li>";    
}
?>
</ul></center>
</div>
</div>
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
include('../pages/banquyen.php');
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
	    <a href="/?mode=dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Dark Mode" class="waves-effect waves-dark btn btn-success btn-flat mb-5 btn-sm">
			<i class="fas fa-moon"></i>
		</a>
	    <a href="/?mode=light" data-bs-toggle="tooltip" data-bs-placement="left" title="Light Mode" class="waves-effect waves-light btn btn-danger btn-flat mb-5 btn-sm">
		<i class="fas fa-lightbulb"></i>
		</a>
	    <a id="chat-popup" href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Kênh Hỗ Trợ" class="waves-effect waves-light btn btn-warning btn-flat btn-sm">
			<span class="icon-Group-chat"><span class="path1"></span><span class="path2"></span></span>
		</a>
	</div>
	<!-- Sidebar -->
		
	<div id="chat-box-body">
	     <a href="<?=$kenhthongbao?>" target="blank">
		<div id="chat-circle" class="waves-effect waves-circle btn btn-circle btn-lg btn-warning l-h-70">
            <div id="chat-overlay"></div>
           
            <span class="icon-Group-chat fs-30"><span class="path1"></span><span class="path2"></span></span>
		</div>
		</a>
	</div>
	<div id="trave"></div> 


	<!-- Page Content overlay -->
<?php
include('../pages/footer.php');
}
?>

