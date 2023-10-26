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
		<!-- Main content -->
		<section class="content">
			<div class="row">
				  <div class="col-xl-6 col-12">  
				<?php
                 include('../pages/thongke.php');
                ?>
                <div class="col-xl-12 col-12">                
			<h4 class="card-title">Danh Sách Server</h4>
<div class="form-group">
<select class="form-select" aria-label="Default select example" id="chonsv" name="chonsv">
<?php                              
$respawn1a = mysqli_query($ketnoi,"SELECT * FROM `chietkhau` WHERE `webdinhdanh` = '$domain'");
if (mysqli_num_rows($respawn1a) == 0):
?><p>Không có server nào</p>
<?php else: while ($row1a = mysqli_fetch_array($respawn1a, MYSQLI_ASSOC)):?>
<option value="<?=$row1a['madichvu']?>">ID[<?=$row1a['id']?>] - [<?=$row1a['loaihinh']?>] - (Giá <?=$row1a[$giatri]?> VNĐ / 1 Seeding) - [<?=$row1a['tinhnang']?>]  - <?=$row1a['note']?></option>
<?php endwhile; endif; ?> 
</select>
</div>
<div class="form-group">
<div class="col-lg-12">
<center><button type="submit" name="submit" id="submit" class="btn btn-danger" onclick="submit();"><i class="fas fa-star-of-david"></i> MUA NGAY <i class="fas fa-star-of-david"></i></button></center>
</div>
</div>
</div>
                </div>

<div class="col-xl-6 col-12">
<div class="box">
<div class="box-header">    
<h4 class="box-title">Cấp Độ Ưu Đãi</h4>
	</div>
<div class="box-body">	
<div class="table-responsive dataview">
<table class="table datatable ">
<thead>
<tr>
<th>Số Thứ Tự</th>
<th>Nạp Kích Hoạt</th>
<th>Tên Gói</th>
<th>Ưu Đãi</th>
<th>Hành Động</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td><?=number_format($cap1)?> VNĐ</td>
<td>CTV PRO</td>
<td>Hưởng giá dịch vụ ưu đãi</td>
<td><?php if($ctv !== '1'){ ?><span class="badge badge-info" type="button" onclick="update1();">Nâng Cấp</span> <?php }else{ ?> <span class="badge badge-success">Đã Kích Hoạt</span><?php } ?></td>
</tr>
<tr>
<td>2</td>
<td><?=number_format($cap2)?> VNĐ</td>
<td>CTV VIP</td>
<td>Hưởng giá dịch vụ tốt + Support chat riêng</td>
<td><?php if($ctv !== '2'){ ?><span class="badge badge-info" type="button" onclick="update2();">Nâng Cấp</span><?php }else{ ?> <span class="badge badge-success">Đã Kích Hoạt</span><?php } ?></td>
</tr>
<tr>
<td>3</td>
<td><?=number_format($cap3)?> VNĐ</td>
<td>Đại Lý PRO</td>
<td>Hưởng giá dịch vụ siêu ưu đãi + Support chat riêng + Thêm nhiều dịch vụ free</td>
<td><?php if($ctv !== '3'){ ?><span class="badge badge-info" type="button"  onclick="update3();">Nâng Cấp</span><?php }else{ ?> <span class="badge badge-success">Đã Kích Hoạt</span><?php } ?></td>
</tr>
<tr>
<td>4</td>
<td><?=number_format($cap4)?> VNĐ</td>
<td>Đại Lý VIP</td>
<td>Hưởng giá dịch vụ siêu Tốt + Support chat riêng + Thêm nhiều dịch vụ free- Hỗ trợ mọi vấn đề về tool</td>
<td><?php if($ctv !== '4'){ ?><span class="badge badge-info" type="button"  onclick="update4();">Nâng Cấp</span><?php }else{ ?> <span class="badge badge-success">Đã Kích Hoạt</span><?php } ?></td>
</tr>
<tr>
<td>5</td>
<td><?=number_format($cap5)?> VNĐ</td>
<td>Nhà Phân Phối VIP</td>
<td>Hưởng giá dịch vụ tốt nhất thị trường + Support chat riêng + Thêm nhiều dịch vụ free- Hỗ trợ mọi vấn đề về tool + Hỗ trợ tạo website</td>
<td><?php if($ctv !== '5'){ ?><span class="badge badge-info" type="button"  onclick="update5();">Nâng Cấp</span><?php }else{ ?> <span class="badge badge-danger">Đã Kích Hoạt</span><?php } ?></td>
</tr>
</tbody>
</table>
</div>
</div>
</div> 
</div> 
	<div class="col-xl-12 col-12">						
							<div class="box">
								<div class="box-header">
									<h4 class="box-title">Thông Báo Hệ Thống</h4>
								</div>
								<div class="box-body">	
									<div class="nav-tabs-custom">
									    <?php
                      $query = mysqli_query($ketnoi,"SELECT * FROM `logs` WHERE `webdinhdanh` = '$domain' ORDER BY id DESC");
                      while($row = mysqli_fetch_array($query)){
                      ?>
										<div class="post">
					  <div class="user-block">
						<img class="img-bordered-sm rounded-circle" src="/images/adminnoti.png" alt="user image">
							<span class="username">
							  <a href="#">ADMIN</a>
							  <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
							</span>
						<span class="description"><?php echo $row['date'];?></span>
					  </div>
					  <!-- /.user-block -->
					  <div class="activitytimeline">
					      <h4><?php echo $row['tieudethongbao'];?></h4>
						  <p>
							<?php echo $row['noidung'];?>
						  </p>
						  <ul class="list-inline">
							<li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
							<li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
							</li>
							<li class="pull-right">
							  <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments</a></li>
						  </ul>
						  <form class="form-element">
							  <input class="form-control input-sm" type="text" placeholder="Type a comment">
						 </form>
					  </div>
					</div>
					<?php
                      }
                      ?>				</div>
								</div>
							</div>
						</div>
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

