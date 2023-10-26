<?php
require_once('../system/config.php');
if(!isset($_SESSION['username'])){
header('location:/clients/login.html');
}else{
if(isset($_GET['target'])){
$target = htmlspecialchars($_GET['target']);
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `support` WHERE `username`='$username' AND `webdinhdanh` ='$domain' AND `id` = '$target'"));
if($dem > 0){
$datadon = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `support` WHERE `username`='$username' AND `webdinhdanh` ='$domain' AND `id` = '$target'"));
$noidung = $datadon['noidung'];
}else{
header('/clound/error.html');
exit(); 
    
}
}else{
header('/clound/error.html');
exit();    
}
require_once('../system/thongke.php');    
require_once('../pages/header.php');;    
include('../pages/nav.php');
include('../pages/menu.php');

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
								<li class="breadcrumb-item" aria-current="page">Chi tiết hỗ trợ</li>
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
<h4>Chi tiết hỗ trợ</h4>
<h6>(Báo lỗi - Khiếu nại - Yêu cầu hoàn tiền - Hỗ trợ)</h6>
</div>
</div>
<div class="card">
<div class="card-body">
<div class="row">
<div class="card"    
<div class="col-lg-12 col-sm-12 col-12">
<div class="form-group">
<p><?=$noidung?></p>
</div>
</div>
</div>
<div class="col-lg-12 col-sm-12 col-12">
<div class="form-group">
<label>Phản hồi</label>
<input type="hidden" id="respond" name="respond" value="<?=$target?>">
<textarea class="form-control" id="noidung"  name="noidung" rows="5" placeholder="Tôi đã nhận được, cảm ơn admin !"></textarea>
</div>
</div>
</div>
</div>
<div class="col-lg-12">
<center><button type="submit" name="submit" id="submit"  class="btn btn-primary btn-block" onclick="submit();">Phản hồi</button></center>
</div>

<div class="page-header">
<div class="page-title">
<h4>Lịch sử yêu cầu</h4>
<h6>(Lịch sử yêu cầu hỗ trợ)</h6>
</div>
</div>
<div class="card">
<div class="card-body">
<div class="row">
<div class="table-responsive ">
<table class="table">
<thead>
<tr>
<th>Mã đơn</th>
<th>Cấp độ</th>
<th>Thời gian</th>
<th>Trạng thái</th>
<th>Hành động</th>
</tr>
</thead>
<tbody>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };

$num_rec_per_page=50;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `support` WHERE `webdinhdanh` = '$domain' AND `username` ='$username'"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `support` WHERE `webdinhdanh` = '$domain' AND `username` ='$username' order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Bạn chưa có lịch sử nào</td></tr>
<?php else: while ($rowhis = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>     
<tr>
<td><?=$rowhis['codeoder']?></td>
<td><?=$rowhis['level']?></td>
<td><?=$rowhis['date']?></td>
<td><span class="badge badge-info"><font color="white"><?=$rowhis['status']?></font></span></td>
<td><a class="badge badge-success" href="/clound/respond.html?target=<?=$rowhis['id']?>"><font color="white">Phản hồi</font></a>
<a class="badge badge-danger" href="/clound/error.html?del=<?=$rowhis['id']?>"><font color="white">Xóa</font></a>
</td>
</tr>
<?php endwhile; endif; ?> 
</tbody>
</table>
</div>
</div>
<center><ul class="pagination">
<?php
echo "<li class='page-item'><a class='page-link' href='?page=1'>".'Trang đầu'."</a> </li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item'><a class='page-link' href='?page=".$i."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' href='?page=$total_pages'>".'Trang cuối'."</a></li>";

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
<script type="text/javascript">
function submit(){
$('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý, vui lòng không tắt trình duyệt');
$("#submit").attr("disabled", true);
$['post']('../action/error.php',{
    respond:$('#respond')['val'](),
    noidung:$('#noidung')['val']()},
     function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('Gửi thành công !')},'json')       
    $(document).ajaxComplete(function() {
            $("#submit").attr("disabled", false);
            location.href = "/clound/respond.html?target=<?=$target?>";
        });    
    
}
</script>	

	<!-- Page Content overlay -->
<?php
include('../pages/footer.php');
}
?>

