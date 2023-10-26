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
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Tài khoản đăng nhập</label>
									  <input type="text" class="form-control"  placeholder="<?=$username?>" disabled="">
									</div>
								  </div>
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Email</label>
									  <input type="text" class="form-control"  placeholder="<?=$mail?>" disabled="">
									</div>
								  </div>
								</div>
								<div class="row">
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">API Token <br><button id="respawn" class="badge bg-success" onclick="copy('<?php echo $api ?>')"><respawn></respawn> Copy Token</button></label>
									  <input type="text" class="form-control" placeholder="<?php echo $api ?>" value="<?php echo $api ?>">
									</div>
								  </div>
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Cấp độ <form method="GET"><button  type="submit" name="active" value="<?php if($ctv == 0){echo 'true2';}elseif($ctv == 2){echo 'true1';}else{echo 'respawn';} ?>" class="badge bg-danger">Nâng Cấp</button></form></label>
									  <input type="text" class="form-control" placeholder="<?php if($ctv == 0){
                                                echo 'Member';    
                                                }elseif($ctv == 1){
                                                echo 'Đại Lý';    
                                                }elseif($ctv == 2){
                                                echo 'Cộng Tác Viên';    
                                                }elseif($ctv == 3){
                                                echo 'Admin';    
                                                }else{
                                                echo 'Không xác định';      
                                                } ?>" disabled="">
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
								<div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Tài khoản đăng nhập</label>
									  <input type="text" class="form-control"  placeholder="<?=$username?>" disabled="">
									</div>
								  </div>    
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Mật khẩu cũ</label>
									  <input type="password" class="form-control" id="oldpass" name="oldpass" placeholder="***">
									</div>
								  </div>
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Mật khẩu mới</label>
									  <input type="password" class="form-control" id="newpass" name="newpass" placeholder="***">
									</div>
								  </div>
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Nhập lại mật khẩu mới</label>
									  <input type="password" class="form-control" id="renewpass" name="renewpass" placeholder="***">
									</div>
								  </div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer text-end">
								<a href="/information.html" type="button" class="btn btn-warning me-1">
								  <i class="ti-trash"></i> Cancel
								</a>
								<button type="submit" id="submit" class="btn btn-primary">
								  <i class="ti-save-alt"></i> Cập Nhật
								</button>
							</div>  
						
					  </div>
					  <!-- /.box -->			
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
<script type="text/javascript">
function copy(text) {
  document.body.insertAdjacentHTML("beforeend","<div id=\"copy\" contenteditable>"+text+"</div>")
  document.getElementById("copy").focus();
  document.execCommand("selectAll");
  document.execCommand("copy");
  document.getElementById("copy").remove();
  $( "respawn" ).text( "Đã" ).show().fadeOut( 1000 );
  event.preventDefault();
}
</script>
 <div id="trave" style="display: none;">
	</div> 
<script type="text/javascript">
  $('#submit').click(function(){
			var oldpass = $('#oldpass').val();
			var newpass = $('#newpass').val();
			var renewpass = $('#renewpass').val();
				if (  oldpass == '' || newpass == ''|| renewpass == '') {
					swal("ERROR","Vui lòng nhập đầy đủ thông tin để đổi mật khẩu !","error");
					return false;
				}
				$('#submit').prop('disabled', true)
				$.post('respawn/changepass.html', {
					oldpass: oldpass,
					newpass: newpass,
					renewpass: renewpass
				}, function(data, status) {
					$("#trave").html(data);
					$('#submit').prop('disabled', false);
				});
			});
</script>	
<?php
if(isset($_GET['active'])){
$action = htmlspecialchars($_GET['active']);
if($ctv == 3){
echo('<script type="text/javascript">swal("ERROR","Nâng cấp lên làm Developer luôn đi bạn :)","error");setTimeout(function(){ location.href = "/information.html" },3000);</script>');        
    }elseif($action == 'true1'){
if($ctv == 1){
echo('<script type="text/javascript">swal("ERROR","Bạn đã là đại lý !","error");setTimeout(function(){ location.href = "/information.html" },3000);</script>');     
}elseif($sumcash < $nangcap1){
$cashthieu = $nangcap1 - $sumcash;
$cashthongbao = number_format($cashthieu,'0','.','.');
echo('<script type="text/javascript">swal("ERROR","Bạn chưa đủ điều kiện để lên làm đại lý (bạn cần nạp : '.$cashthongbao.' Coin) !","error");setTimeout(function(){ location.href = "/information.html" },3000);</script>');
}else{
$ketnoi->query("UPDATE accounts SET `ctv` = '1' WHERE `username` ='$username'");  
echo('<script type="text/javascript">swal("SUCCESS","Bạn đã được thăng cấp làm đại lý và tận hưởng ưu đãi chiết khấu của dịch vụ !","success");setTimeout(function(){ location.href = "/information.html" },3000);</script>');     
    }
}elseif($action == 'true2'){
if($ctv == 1){
echo('<script type="text/javascript">swal("ERROR","Bạn đã là đại lý !","error");setTimeout(function(){ location.href = "/information.html" },3000);</script>');     
}elseif($sumcash < $nangcap2){
$cashthieu = $nangcap2 - $sumcash;
$cashthongbao = number_format($cashthieu,'0','.','.');
echo('<script type="text/javascript">swal("ERROR","Bạn chưa đủ điều kiện để lên làm cộng tác viên (bạn cần nạp : '.$cashthongbao.' Coin) !","error");setTimeout(function(){ location.href = "/information.html" },3000);</script>');
}else{
$ketnoi->query("UPDATE accounts SET `ctv` = '2' WHERE `username` ='$username'");  
echo('<script type="text/javascript">swal("SUCCESS","Bạn đã được thăng cấp làm cộng tác viên và tận hưởng ưu đãi chiết khấu của dịch vụ !","success");setTimeout(function(){ location.href = "/information.html" },3000);</script>');
            
}        
    }else{
echo('<script type="text/javascript">swal("ERROR","Không có thao tác này !","error");setTimeout(function(){ location.href = "/information.html" },3000);</script>');    
        }
}
include('page/footer.php');
}
?>

