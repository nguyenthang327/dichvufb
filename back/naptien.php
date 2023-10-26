<?php
include('system/connect.php');
if($active !== 'active'){
die (dev($active));
exit();
}elseif(!isset($_SESSION['username'])){
header('location:/login.html');
exit();
}else{
include('system/thongke.php');    
include('page/header.php');
include('page/nav.php');
include('page/menu.php');
?>
<style>
  respawn {
    padding: 1px;  
  }
  </style>
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
								<li class="breadcrumb-item" aria-current="page">Nạp Bằng ATM - Ví Điện Tử</li>
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
			 <a style="float:right;" href="/lichsunapbank.html" class="btn btn-primary"><i class="fas fa-history"></i> Lịch sử nạp</a>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">	
			  <div class="form-group row">
						        <div class="col-sm-12">
						    			  <a  style="float:right;" href="/report.html" class="badge badge-danger"><i class="fas fa-times-circle"></i> Báo lỗi</a>
						    			  </div>
						    </div>
<h4  class="text-primary fs-20">Tỷ giá: 100K Bank = 100K VNĐ</h4>
		    </div>
<div class="card-body">
<div class="row mb-n3">
    <div class="row">
        
<?php
 $respawnbank = mysqli_query($ketnoi,"SELECT * FROM `banker` WHERE `webdinhdanh` = '$domain' order by id");
if (mysqli_num_rows($respawnbank) == 0):
?>
<p>Admin chưa thêm Ngân Hàng nào nhận tiền !</p>
<?php else: while ($rowbanker = mysqli_fetch_array($respawnbank, MYSQLI_ASSOC)):?> 
		  <div class="col-lg-4 col-12">
			  	<div class="box bg-img" style="background-image: url(<?=$rowbanker['urlanh']?>);background-position: right top; background-size: 30% auto;">
					<div class="box-body">
						<a href="#" class="box-title fw-400 text-muted hover-primary fs-18"><?=$rowbanker['tenbank']?></a>
						<div class="fw-bold text-success mt-10 mb-10">CTK : <?php echo $rowbanker['chuthe'] ?></div>
						<div class="fw-bold text-success mt-10 mb-10">STK: <code><?php echo $rowbanker['stk'] ?></code> <button id="respawn" class="badge bg-success" onclick="copy('<?php echo $rowbanker['stk'] ?>')"> Copy STK</button></div>
						<div class="fw-bold text-success mt-10 mb-10">Nội dung: <code><?php echo $rowbanker['noidung'] ?><?php echo $idacc ?></code> <button id="respawn" class="badge bg-success" onclick="copy('<?php echo $rowbanker['noidung'] ?><?php echo $idacc ?>')"> Copy nội dung</button></div>
						<div class="fw-bold text-success mt-10 mb-10">Số tiền tối thiểu : <?php echo number_format($rowbanker['toithieu']); ?> VNĐ</div>
					</div>
				</div>
			  </div>
<?php endwhile; endif; ?>
</div>
</div>
<br>
					  <div class="col-xl-12">
					  <div class="rounded p-15 h-100% bg-primary bg-temple-dark">
<center><h3>LƯU Ý CẦN ĐỌC ĐỂ TRÁNH MẤT TIỀN</h3> </center>  
<p>+ Nạp sai nội dung bạn chỉ nhận được 70% số tiền nạp</p>
<p>+ Nạp dưới tối thiểu bạn sẽ không nhận được tiền</p>
<p>+ Nếu gặp lỗi, quý khách vui lòng liên hệ <?=$hotline?></p>
<p>+ Sau khi chuyển tiền, chỉ trong vài giây quý khách sẽ nhận được tiền</p>
<p>+ Hệ thống có thể bị chậm trong việc cộng tiền cho quý khách .</p>
</div>
<br>
<div class="alert alert-light" role="alert">
<center><respawn></respawn></center>
</div>
</div>
</div>
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
<script type="text/javascript">
function copy(text) {
  document.body.insertAdjacentHTML("beforeend","<div id=\"copy\" contenteditable>"+text+"</div>")
  document.getElementById("copy").focus();
  document.execCommand("selectAll");
  document.execCommand("copy");
  document.getElementById("copy").remove();
  $( "respawn" ).text( "Đã copy thành công !").show().fadeOut( 10000 );
  event.preventDefault();
}
</script>	
	<!-- Page Content overlay -->
<?php
include('page/footer.php');
}
?>

