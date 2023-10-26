<?php
require_once('../system/config.php');
if(!isset($_SESSION['username'])){
header('location:/clients/login.html');
}else{
require_once('../system/thongke.php');    
require_once('../pages/header.php');;    
include('../pages/nav.php');
include('../pages/menu.php');
$target = xss($_GET['act']);
$dataatc = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuccon` WHERE `id`='$target' AND `webdinhdanh` ='$domain'"));
?>
<style>
.goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
body {
    top: 0px !important; 
    }
</style>
<script type="text/javascript">
        function checkpoint() {
            var amount = $("#amount").val();
            var server = $("#server").val();
            var minutes1 = $("#minutes1").val();
            var dayvip1 = $("#dayvip1").val();
            $.ajax({
                url: "/modun/index.php",
                type: "GET",
                dataType: "text",
                data: {
                    number: $("#amount").val(),
                    server: $("#server").val(),
                    minutes1: $("#minutes1").val(),
                    dayvip1: $("#dayvip1").val(),
                },
                success: function(result) {
                    var result = JSON.parse(result);
                    if (result["status"] == "true") {
                        $("#min").val(result["min"]);
                        $("#max").val(result["max"]);
                        $("#infomation").html(result["infomation"]);
                        $("#comment").html(result["comment"]);
                        $("#reaction").html(result["reaction"]);
                        $("#minutes").html(result["minutes"]);
                        $("#dayvip").html(result["dayvip"]);
                        $("#total").html(result["total"]);
                    } else {
                        $("#min").val(result["min"]);
                        $("#max").val(result["max"]);
                        $("#infomation").html(result["infomation"]);
                        $("#comment").html(result["comment"]);
                        $("#reaction").html(result["reaction"]);
                        $("#minutes").html(result["minutes"]);
                        $("#dayvip").html(result["dayvip"]);     
                        $("#total").html(result["total"]);
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
								<li class="breadcrumb-item"><a href="/"><i class="mdi mdi-home-outline"></i>Trang Chủ</a></li>
								<li class="breadcrumb-item" aria-current="page">Dịch Vụ Tăng Tương Tác <?=$dataatc['tendichvucon']?></li>
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
<h1><?=$dataatc['tendichvucon']?></h1>
<h6>(Dịch Vụ Tăng Tương Tác <?=$dataatc['tendichvucon']?>)</h6>
</div>

</div>
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-lg-6 col-sm-6 col-12">
<div class="form-group">
<label>Link cần tăng ( khuyến khích sử dụng ID tránh lỗi )</label>
<input  class="form-control" type="link" name="link" id="link">
</div>
</div>
<div class="col-lg-6 col-sm-6 col-12">
<div class="form-group">
<label>Chọn máy chủ</label>
<select class="form-control custom-select" id="server" name="server" onchange="checkpoint()">
<option>Vui lòng chọn máy chủ</option>    
<?php                              
$respawn = mysqli_query($ketnoi,"SELECT * FROM `chietkhau` WHERE `madichvu` = '$target' AND `webdinhdanh` = '$domain'");
if (mysqli_num_rows($respawn) == 0):
?>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
<option value="<?=$row['id']?>">(Máy chủ <?=$row['id']?>) - (<?=$row[$giatri]?> VNĐ/ 1 Seeding) - <?=$row['note']?> (<?php if($row['status'] !== 'on'){echo 'Bảo trì';}else{echo 'Hoạt động';} ?>)</option>
<?php endwhile; endif; ?> 
</select>
</div>
</div>
<div class="col-lg-6 col-sm-6 col-12">
<div class="form-group">
<label>Số lượng</label>
<input class="form-control" type="number" id="amount" name="amount" value="50" onchange="checkpoint()">
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Số lượng tối thiểu</label>
<input type="text" class="form-control" value="0" name="min" id="min" disabled/>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Số lượng tối đa</label>
<input type="text" class="form-control" value="0" name="max"  id="max" disabled/>
</div>
</div>
<div class="col-lg-12 col-sm-12 col-12">
<div class="form-group">
<label>Tổng chi phí:</label>
<h1><div name="total"  id="total"></div></h1>
</div>
</div>
<div name="reaction" id="reaction"></div>
<div name="minutes" id="minutes"></div>
<div name="dayvip" id="dayvip"></div>
<div name="comment" id="comment"></div>
<div class="col-md-12 col-sm-12">
<div class="ribbon-wrapper card">
<div class="card-body">
<div class="ribbon ribbon-success">Thông tin máy chủ</div>
<div id="infomation" name="infomation"></div>
</div>
</div>
</div>    
</div>




<div class="col-lg-12">
<button type="submit" name="submit" id="submit"  class="btn btn-primary btn-block" onclick="submit();">Xác nhận đơn hàng</button>
<a href="/services/<?=$target?>" class="btn btn-danger">Clear</a>
<a href="/clound/history-ordes.html" class="btn btn-info"><i class="fas fa-history"></i> &nbsp;Lịch sử đơn hàng</a>
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
	    <a id="chat-popup" href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Support Facebook" class="waves-effect waves-light btn btn-warning btn-flat btn-sm">
			<img src="https://cdn3.iconfinder.com/data/icons/free-social-icons/67/facebook_circle_color-512.png" width="300px">
		</a>
	    <a href="https://zalo.me/0932352365" data-bs-toggle="tooltip" data-bs-placement="left" title="Support Zalo" class="waves-effect waves-teal btn btn-success btn-flat mb-5 btn-sm">
			<img src="https://giaiphapzalo.com/wp-content/uploads/2021/10/zalosvg.svg" width="300px">
		</a>
		<a href="https://web.telegram.org/k/#@HotroDichvufb24h"data-bs-toggle="tooltip" data-bs-placement="left" title="Support Telegram" class="waves-effect waves-light btn btn-danger btn-flat mb-5 btn-sm" >
			<img src="https://cdn3.iconfinder.com/data/icons/social-media-chamfered-corner/154/telegram-512.png" width="300px">
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
$['post']('../action/order.php',{
    link:$('#link')['val'](),
    server:$('#server')['val'](),
    amount:$('#amount')['val'](),
    reaction:$('#reaction1')['val'](),
    minutes:$('#minutes1')['val'](),
    dayvip:$('#dayvip1')['val'](),
    comment:$('#comment1')['val']()},
   function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('Tạo đơn thành công')},'json')    
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

