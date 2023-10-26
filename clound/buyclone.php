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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
	      <div class="content-header">
<div class="d-flex align-items-center">
<div class="me-auto">
<div class="d-inline-block align-items-center">
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="/"><i class="mdi mdi-home-outline"></i>Trang Chủ</a></li>
<li class="breadcrumb-item" aria-current="page">Dịch Vụ Bán Clone - TOOL </li>
</ol>
</nav> 
</div> 
</div>
</div>
</div>
		<!-- Main content -->
		<section class="content">
			<div class="row">
			
  <!-- BEGIN: MÃ NGUỒN ĐƯỢC VIẾT BỞI RESPAWN DEVELOPER MUASITE.COM -->
<?php
$respawn = mysqli_query($ketnoi,"SELECT * FROM `product` WHERE `status` = 'active'");
if (mysqli_num_rows($respawn) == 0):
?>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>					    
<div class="col-xl-12 col-12">
<div class="box">
						<div class="box-body">
							<h4 class="box-title"><?=$row['tendanhmuc']?></h4>
							<h6> Đơn giá: 1 sản phẩm / giá tiền </h6>
							<div class="table-responsive">
								<table class="table b-1 border-<?=$row['giaodien']?>">
									<thead class="bg-<?=$row['giaodien']?>">
										<tr>
											<th class="text-center">THƯƠNG HIỆU</th>
											<th class="text-center">TÊN SẢN PHẨM</th>
											<th class="text-center">QUỐC GIA</th>
											<th class="text-center">CÒN LẠI</th>
											<th class="text-center">ĐÃ BÁN</th>
											<th class="text-center">GIÁ BÁN</th>
											<th class="text-center">CHỨC NĂNG</th>
										</tr>
									</thead>
									<tbody>
									    <?php
$danhmuc = $row['madanhmuc'];
$respawnv2 = mysqli_query($ketnoi,"SELECT * FROM `productcon` WHERE `status` = 'active' AND `madanhmuc` = '$danhmuc'");
if (mysqli_num_rows($respawnv2) == 0):
?>
<?php else: while ($rowv2 = mysqli_fetch_array($respawnv2, MYSQLI_ASSOC)):?>
										<tr>
											<td class="text-center"><img src="<?=$row['url']?>" width="50px"></td>
											<td class="text-center"><?=$rowv2['tensanpham']?><br><?=$rowv2['motangan']?></td>
											<td class="text-center"><img src="/brand/flags/<?=$rowv2['nation']?>.png" width="30px"></td>
											<td class="text-center text-success">
											    
                                                    <?php
                                                    $masanpham = $rowv2['masanpham'];
                                                    $demsp = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `sanpham` WHERE `status` = 'active' AND `masanpham` = '$masanpham'"));
                                                    echo $demsp;
                                                    ?>
                                                       
                                                    </td>
                                                    <td class="text-center text-danger">
                                                        
                                                    <?php
                                                    $demsp1 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `sanpham` WHERE `status` = 'pay' AND `masanpham` = '$masanpham'"));
                                                    echo $demsp1;
                                                    ?> 
                                                  
                                                    </td>
                                                    
											<td class="text-center"><?=number_format($rowv2['dongia'],'0','.','.')?> VNĐ</td>
											<td class="text-center"><?php
                                                            if($demsp > 0){
                                                            ?>
                                                            <a type="button" href="/clound/<?=$masanpham?>" class="btn btn-primary"><i class="fas fa-shopping-cart"></i>&nbsp;Mua ngay</a>
                                                            <?php
                                                            }else{
                                                            ?>
                                                            
                                                            <div class="flex items-center justify-center text-danger"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Hết hàng </div>
                                                            <?php
                                                            }
                                                            ?></tr>
						<?php  endwhile; endif; ?>   			
									</tbody>
								</table>
							</div>
							<div class="font-semibold text-gray-800 "> Dùng điện thoại <i class="fas fa-mobile-alt"></i>, hãy vuốt bảng từ phải qua trái <i class="fas fa-arrow-left"></i> để xem đầy đủ thông tin! </div>
						</div>
						
					</div> 	
</div>
<?php  endwhile; endif; ?>                                
                                <!-- END: KẾT THÚC MỘT CUỘC TÌNH -->
						
						
						
							
				
			
				
			</div>			
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
	<script src="assets/js/jquery.js"></script>
<script type="text/javascript">
function submit(){
var ref = $('#chonsv')['val']();
window.location.href='/services/'+ref;
}
</script>
	<!-- Page Content overlay -->
<?php
include('../pages/footer.php');
}
?>

