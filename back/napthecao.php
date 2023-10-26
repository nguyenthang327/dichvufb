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
								<li class="breadcrumb-item" aria-current="page">Nạp Thẻ Cào</li>
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
			 <a style="float:right;" href="/lichsunapcard.html" class="btn btn-primary"><i class="fas fa-history"></i> Lịch sử nạp</a>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">	
			  <div class="form-group row">
						        <div class="col-sm-12">
						    			  <a  style="float:right;" href="/report.html" class="badge badge-danger"><i class="fas fa-times-circle"></i> Báo lỗi</a>
						    			  </div>
						    </div>
<h4  class="text-primary fs-20">Tỷ giá: 100K Card = <?=$ratecard?>K VNĐ</h4>
		    </div>
<div class="card-body">
<div class="row mb-n3">
<div class="col-xl-6">
<input class="form-control form-control-lg mb-3" type="number" name="SeriCard" id="SeriCard" placeholder="Seri" />
<input class="form-control form-control-lg mb-3" type="number" name="NumberCard" id="NumberCard" placeholder="Mã thẻ" />
</div>
<div class="col-xl-6">
<select class="form-select form-select-lg mb-3" id="NetworkCode" name="NetworkCode">
<option>Loại thẻ</option>
<option value="VIETTEL">Viettel</option>
<option value="VINAPHONE">Vinaphone</option>
<option value="MOBIFONE">Mobifone</option>
<option value="VIETNAMOBILE">Vietnamobile</option>
</select>
<select class="form-select form-select-lg mb-3" id="PricesExchange" name="PricesExchange">
<option>Mệnh giá</option>
<option value="10000">10,000</option>
<option value="20000">20,000</option>
<option value="30000">30,000</option>
<option value="50000">50,000</option>
<option value="100000">100,000</option>
<option value="200000">200,000</option>
<option value="300000">300,000</option>
<option value="500000">500,000</option>
<option value="1000000">1,000,000</option>
</select>
</div>

</div>
<br>
<div class="col-xl-12">
<center><button onclick="submit();" type="submit" name="submit" id="submit" class="btn btn-warning"><i class="fa fa-upload" aria-hidden="true"></i>Nạp thẻ ngay</button></center>
</div>
<br>
					  <div class="col-xl-12">
					  <div class="rounded p-15 h-100% bg-primary bg-temple-dark">
<center><h3>LƯU Ý CẦN ĐỌC ĐỂ TRÁNH MẤT TIỀN</h3> </center>  
<p>+ Sai mệnh giá sẽ mất thẻ, quý khách vui lòng chọn đúng nhé</p>
<p>+ Hệ thống nạp card hoạt động 24/7/365</p>
<p>+ Nếu gặp lỗi, quý khách vui lòng liên hệ <?=$hotline?></p>
<p>+ Sau khi nhập thẻ cào thành công, chỉ trong vài giây quý khách sẽ nhận được tiền</p>
<p>+ Spam thẻ giả sai 3 lần liên tiếp sẽ bị cấm tài khoản .</p>
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
	
	<!-- Page Content overlay -->
<script type="text/javascript">
function submit(){if(!$('#NetworkCode')['val']()){swal('ERROR','Bạn chưa chọn loại thẻ !','error')}
else {if(!$('#PricesExchange')['val']()){swal('ERROR','Bạn chưa chọn mệnh giá','error')}
else {if(!$('#SeriCard')['val']()){swal('ERROR','Bạn chưa nhập seri','error')}
else {if(!$('#NumberCard')['val']()){swal('ERROR','Bạn chưa nhập mã thẻ','error')}
else {
    $(document).ajaxStart(function () {
            $("#submit").attr("disabled", true);
        });      
    nap()}}}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning"></div>Đang xử lý');
$['post']('respawn/napthecao.html',{
    NetworkCode:$('#NetworkCode')['val'](),
    PricesExchange:$('#PricesExchange')['val'](),
    SeriCard:$('#SeriCard')['val'](),
    NumberCard:$('#NumberCard')['val']()},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('Tạo đơn khác')},'json')
    $(document).ajaxComplete(function() {
            $("#submit").attr("disabled", false);
        });     
}
</script>	
<?php
include('page/footer.php');
}
?>

