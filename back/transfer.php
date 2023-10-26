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
								<li class="breadcrumb-item" aria-current="page">Chuyển Tiền</li>
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
			 <a style="float:right;" href="/lichsuchuyen.html" class="btn btn-primary"><i class="fas fa-history"></i> Lịch sử chuyển</a>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">	
			  <div class="form-group row">
						        <div class="col-sm-12">
						    			  <a  style="float:right;" href="/report.html" class="badge badge-danger"><i class="fas fa-times-circle"></i> Báo lỗi</a>
						    			  </div>
						    </div>
						    
<h4 class="text-primary fs-20">Tỷ giá: 100K VNĐ = 98K VNĐ</h4>
		    </div>
<div class="card-body">
<div class="row mb-n3">
<div class="col-xl-6">
<input class="form-control form-control-lg mb-3" type="text" name="usernhan" id="usernhan" placeholder="Tài khoản người nhận" />
<input class="form-control form-control-lg mb-3" type="number" name="sotien" id="sotien" placeholder="Số tiền" />
</div>
<div class="col-xl-6">
<select class="form-select form-select-lg mb-3" id="change" name="change">
<option>Chọn phương thức</option>
<option value="nguoinhan">Người nhận chịu phí</option>
<option value="nguoichuyen">Người chuyển chịu phí</option>
</select>
<input class="form-control form-control-lg mb-3" type="password" name="password" id="password" placeholder="Mật khẩu" />
</div>

</div>
<br>
<div class="col-xl-12">
<center><button onclick="submit();" type="submit" name="submit" id="submit" class="btn btn-warning"><i class="fa fa-upload" aria-hidden="true"></i>Chuyển Khoản</button></center>
</div>
<br>
<div class="col-xl-12">
					  <div class="rounded p-15 h-100% bg-primary bg-temple-dark">
<center><h3>LƯU Ý CẦN ĐỌC ĐỂ TRÁNH MẤT TIỀN</h3> </center>  
<p>+ Chi phí chuyển tiền 2% / Số tiền</p>
<p>+ Không thể tự chuyển tiền cho chính mình</p>
<p>+ Nếu gặp lỗi, quý khách vui lòng liên hệ <?=$hotline?></p>
<p>+ Sau khi chuyển thành công, người nhận sẽ lập tức nhận được tiền</p>
<p>+ Phát hiện lừa đảo, thử debug, cố tình nhập sai định dạng để tiêm Injection,Bug sẽ bị cấm tài khoản .</p>
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
function submit(){if(!$('#usernhan')['val']()){swal('ERROR','Bạn chưa nhập người nhận tiền !','error')}
else {if(!$('#sotien')['val']()){swal('ERROR','Bạn chưa nhập số tiền !','error')}
else {if(!$('#change')['val']()){swal('ERROR','Bạn chưa chọn phương thức !','error')}
else {if(!$('#password')['val']()){swal('ERROR','Bạn chưa nhập mật khẩu','error')}
else {
    $(document).ajaxStart(function () {
            $("#submit").attr("disabled", true);
        });      
    nap()}}}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning"></div>Đang xử lý');
$['post']('respawn/transfer.html',{
    usernhan:$('#usernhan')['val'](),
    change:$('#change')['val'](),
    password:$('#password')['val'](),
    sotien:$('#sotien')['val']()},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('Tạo đơn khác')},'json')
    $(document).ajaxComplete(function() {
            $("#submit").attr("disabled", false);
        });     
}
</script>	
	<!-- Page Content overlay -->
<?php
include('page/footer.php');
}
?>

