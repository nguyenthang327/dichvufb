<?php
require_once('../system/config.php');
if(!isset($_SESSION['username'])){
header('location:/clients/login.html');
exit();
}elseif(!isset($_GET['target'])){
header('location:/clients/login.html');
exit();
}else{
$magiaodich = xss($_GET['target']); 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `sanpham` WHERE `magiaodich` ='$magiaodich' AND `username` = '$username'"));
if($dem == 0){
header('location:/');
exit();
}else{
require_once('../system/thongke.php');    
require_once('../pages/header.php');;    
include('../pages/nav.php');
include('../pages/menu.php');    
$datadonhang = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM  `sanpham` WHERE `magiaodich` ='$magiaodich' AND `username` = '$username'"));
$masanpham = $datadonhang['masanpham'];  
$datadonhang1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM  `productcon` WHERE `masanpham` ='$masanpham'"));
$tensanpham = $datadonhang1['tensanpham'];
$madanhmuc = $datadonhang1['madanhmuc']; 
$dongia = $datadonhang1['dongia'];
$nation = $datadonhang1['nation'];
$datadonhang2 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM  `historybuyclone` WHERE `codeoder` ='$magiaodich' AND `username` = '$username'"));
$cashmua = $datadonhang2['cash'];  
$soluong = $datadonhang2['sl'];
$datebuy = $datadonhang2['date'];
$datadonhang3 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM  `product` WHERE `madanhmuc` ='$madanhmuc'"));
$url = $datadonhang3['url'];  
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
								<li class="breadcrumb-item" aria-current="page">LỊCH SỬ ĐƠN HÀNG <?=strtoupper($magiaodich)?></li>
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
<h4> Mã sản phẩm: #<?=$masanpham?></h4>
<h6>Số lượng: <span class="font-medium"><?=$soluong?></span> </div>
                                <div class="mt-1"><i>- Sản phẩm: <?=$tensanpham?> <br>- Ngày mua:<?=$datebuy?></i></div></h6>
</div>
</div>
<div class="card">
<div class="card-body">
    
<div class="row">
<div class="table-responsive ">
<table class="table">
<thead>
<tr>
<th>THÔNG TIN CLONE</th>
<th>THƯƠNG HIỆU</th>
<th>QUỐC GIA</th>
<th>ACTION</th>
</tr>
</thead>
<tbody>
 <?php
                                        $respawn = mysqli_query($ketnoi,"SELECT * FROM `sanpham` WHERE `username` = '$username' AND `magiaodich` = '$magiaodich' AND `status` ='pay'  order by id desc");
while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):
?>   
<tr>
<td><?=$row['info']?></td>
<td><img src="<?=$url?>" width="50px"></td>
<td><img src="/brand/flags/<?=$nation?>.png" width="50px"></td>
<td><a class="btn btn-success" id="respawn" onclick="copy('<?=$row['info']?>')"> <i class="fas fa-copy"></i> Sao Chép</a>
<a class="btn btn-danger " href="/clound/error.html"><i class="fas fa-exclamation-triangle"></i> Báo Lỗi </a>
</td>
</tr>
<?php endwhile;?>  
</tbody>
</table>
</div>
</div>
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
    function copy(text) {
  document.body.insertAdjacentHTML("beforeend","<div id=\"copy\" contenteditable>"+text+"</div>")
  document.getElementById("copy").focus();
  document.execCommand("selectAll");
  document.execCommand("copy");
  document.getElementById("copy").remove();
      	swal("","Đã copy thành công !","success");
  event.preventDefault();
}
</script>
	<!-- Page Content overlay -->
<?php
include('../pages/footer.php');
}
?>

