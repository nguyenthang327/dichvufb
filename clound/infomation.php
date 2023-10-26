<?php
require_once('../system/config.php');
if(!isset($_SESSION['username'])){
header('location:/clients/login.html');
}else{
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
								<li class="breadcrumb-item" aria-current="page">Thông Tin Tài Khoản</li>
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
				<div class="col-lg-6 col-12">
					  <div class="box">
						<!-- /.box-header -->
						
							<div class="box-body">
								<h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i>Thông tin tài khoản</h4>
								<hr class="my-15">
								<div class="row">
								  <h5 class="card-title">Thông tin tài khoản</h5>
<div class="form-group row">
<label class="col-lg-3 col-form-label">Email tài khoản</label>
<div class="col-lg-12">
<input type="text" class="form-control" value="<?=$email?>" disabled />
</div>
</div>
<div class="form-group row">
<label class="col-lg-3 col-form-label">API Token </label>
<div class="col-lg-12">
<input type="text" class="form-control" value="<?=$api?>">
</div>
</div>
								</div>
							</div>
							<!-- /.box-body -->
						
					  </div>
					  <!-- /.box -->			
				</div>  

				<div class="col-lg-6 col-12">
					  <div class="box">
						<!-- /.box-header -->
						
							<div class="box-body">
								<h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Cập nhật mật khẩu</h4>
								<hr class="my-15">
								<div class="row">
								<div class="col-xl-6">
<h5 class="card-title">Mật khẩu</h5>
<div class="form-group row">
<label class="col-lg-6 col-form-label">Mật khẩu mới</label>
<div class="col-lg-12">
<input type="password" class="form-control" name="oldpass" id="oldpass">
</div>
</div>
<div class="form-group row">
<label class="col-lg-6 col-form-label">Nhập lại</label>
<div class="col-lg-12">
<input type="password" class="form-control"  name="newpass"  id="newpass">
</div>
</div>
</div>
								</div>
							</div>
							<!-- /.box-body -->
						
					  </div>
					  <!-- /.box -->			
				</div>
				
<div class="col-lg-12">
<span class="badge badge-info" type="button" onclick="copy('<?php echo $api ?>');"><i class="fas fa-copy"></i> Token</span>
<span class="badge badge-primary" type="button" onclick="update6();"><i class="fas fa-exchange-alt"></i> Token</span>
<span class="badge badge-danger" type="button" onclick="update7();">Cập Nhật Mật khẩu</span>
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
	     <a href="fb.com/thanh.lam.29.01" target="blank">
		<div id="chat-circle" class="waves-effect waves-circle btn btn-circle btn-lg btn-warning l-h-70">
            <div id="chat-overlay"></div>
           
            <span class="icon-Group-chat fs-30"><span class="path1"></span><span class="path2"></span></span>
		</div>
		</a>
	</div>
	<div id="trave"></div> 
	<script src="assets/js/jquery.js"></script>
<script type="text/javascript">
function copy(text) {
  document.body.insertAdjacentHTML("beforeend","<div id=\"copy\" contenteditable>"+text+"</div>")
  document.getElementById("copy").focus();
  document.execCommand("selectAll");
  document.execCommand("copy");
  document.getElementById("copy").remove();
swal("SUCCESS","Bạn đã sao chép API thành công","success");
  event.preventDefault();
}
</script>	

	<!-- Page Content overlay -->
<?php
include('../pages/footer.php');
}
?>

