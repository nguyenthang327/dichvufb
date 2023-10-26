<?php
require_once('../system/config.php');
if(!isset($_SESSION['username'])){
header('location:/login');
exit();
}elseif(!isset($_GET['target'])){
header('location:/login');
exit();
}else{
$sanphammua = xss($_GET['target']); 
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `sanpham` WHERE `masanpham` ='$sanphammua' AND `status` = 'active'"));
if($dem == 0){
header('location:/');
exit();
}else{
// đếm danh mục con
$dem1 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `productcon` WHERE `masanpham` ='$sanphammua' AND `status` = 'active'"));
if($dem1 == 0){
header('location:/');
exit();
}else{
$datadanhmuccon = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `productcon` WHERE `masanpham` ='$sanphammua' AND `status` = 'active'"));
$madanhmuc = $datadanhmuccon['madanhmuc'];
$motangan = $datadanhmuccon['motangan'];
$tensanpham = $datadanhmuccon['tensanpham'];
$dongia = $datadanhmuccon['dongia'];
$dongia2 = number_format($dongia,'0','.','.');
$nation = $datadanhmuccon['nation'];
$dem2 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `product` WHERE `madanhmuc` ='$madanhmuc'  AND `status` = 'active'"));
if($dem2 == 0){
header('location:/');
exit();
}else{
$datadanhmuc = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `product` WHERE `madanhmuc` ='$madanhmuc'"));
$tendanhmuc = $datadanhmuc['tendanhmuc'];    
$url = $datadanhmuc['url'];    
$date = date("Y-m-d H:i:sa"); 
            }
        }
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
  <script type="text/javascript">
        function checkpoint() {
            var number = $("#number").val();
            $.ajax({
                url: "/modun/checkgia.php",
                type: "GET",
                dataType: "text",
                data: {
                    number: $("#number").val(),
                    loai: '<?=$sanphammua?>',
                },
                success: function(result) {
                    var result = JSON.parse(result);
                    if (result["status"] == "true") {
                        $("#total").html(result["money"]);
                    } else {
                        $("#total").html(result["money"]);
                    }
                },
            });
        }
</script>
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
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i>ĐƠN HÀNG</a></li>
								<li class="breadcrumb-item" aria-current="page"> Mã sản phẩm #<?=$sanphammua?></li>
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
<div class="table-responsive ">
<table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">THÔNG TIN ĐƠN HÀNG</th>
                                            <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap"><center>THƯƠNG HIỆU</center></th>
                                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">ĐƠN GIÁ</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border-b dark:border-darkmode-400">
                                                <div class="font-medium whitespace-nowrap respawnshadow"><?=$tensanpham?></div>
                                                <div class="text-slate-500 text-sm mt-0.5 whitespace-nowrap"><?=$motangan?></div>
                                            </td>
                                            <td class="text-right border-b dark:border-darkmode-400 w-32"><center><img src="<?=$url?>" width="50px"></center></td>                                            
                                            <td class="text-right border-b dark:border-darkmode-400 w-32"><?=number_format($dongia,'0','.','.')?> VNĐ / Sản phẩm</td>
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            
                                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap"><center>SỐ LƯỢNG MUA</center></th>
                                            <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap"><center>THANH TOÁN</center></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-right border-b dark:border-darkmode-400 w-32"><center><input type="number" name="number" id="number" class="form-control" value="1" onchange="checkpoint()"> </center></td>                                        
                                            <td class="text-left border-b dark:border-darkmode-400 w-32"><center><h3> <div id="total"><?=number_format($dongia,'0','.','.')?> VNĐ</div></h3></center></td>
                                            <td></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
			  <!-- /.row -->
			</div>
	<div class="col-lg-12 col-sm-12 col-12">
<div class="form-group">
 <button onclick="respawndev();" type="submit" name="submit" id="submit" class="btn btn-primary btn-block"><i class="fas fa-shopping-cart"></i> Xác nhận đơn hàng</button>
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
function respawndev(){
    if(!$('#number')['val']()){swal('','Vui lòng nhập số lượng muốn mua !','error')}
else {
    $(document).ajaxStart(function () {
            $("#submit").attr("disabled", true);
        });    
    nap()}}
function nap(){$('#submit')['html']('Loading <img src="/dist/images/ajax-loader.gif">');
$['post']('/client/buy.php',{
    number:$('#number')['val'](),
    giftcode:$('#giftcode')['val'](),
    type: '<?=$sanphammua?>'
},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
if(_0xb982x3['status'] == 'success'){
setTimeout(function(){location.href="/clound/history-clone.html", 3000} );    
}
    $('#submit')['html']('Mua thêm')},'json')    
    $(document).ajaxComplete(function() {
            $("#submit").attr("disabled", false);
        });    
}
</script> 

	<!-- Page Content overlay -->
<?php
include('../pages/footer.php');
}
?>

