<?php
include('system/connect.php');
if(empty($demdomain)){
header('location:/active.html');
exit();    
}elseif($active !== 'active'){
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
if($ctv == '0'){
$order = 'ckmem';
}elseif($ctv == '2'){
$order = 'ckc2';
}elseif($ctv == '1'){
$order = 'ckc1';
}else{
$order = 'ckc1';
}
?>

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
								<li class="breadcrumb-item" aria-current="page">Lịch Sử Báo Cáo Lỗi</li>
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
			 <a style="float:right;" href="/report.html" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw me-1"></i> HỖ TRỢ</a>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					  <div class="row">
						<div class="col-xl-12">
<form method="POST" action="">
<div class="input-group">
										<input type="text" class="form-control" placeholder="seach" name="seach" id="seach" required="" aria-invalid="false"> 
										<button type="submit" class="btn btn-info btn-sm" type="button">Tìm kiếm</button> 
									</div>
</form>						    
<div class="table-responsive">
<table class="table table-hover text-nowrap">
<thead>
<tr>
    <th>ID</th>
                                                    <th class="border-top-0 pt-0 pb-2">THỜI GIAN</th>
                                                    <th class="border-top-0 pt-0 pb-2">IMAGES</th>
                                                    <th class="border-top-0 pt-0 pb-2">ĐƠN HÀNG</th>
                                                    <th class="border-top-0 pt-0 pb-2">MÃ ĐƠN</th>
                                                    <th class="border-top-0 pt-0 pb-2">SỐ TIỀN PHÁT SINH</th>
                                                    <th class="border-top-0 pt-0 pb-2">LEVEL</th>
                                                    <th class="border-top-0 pt-0 pb-2">STATUS</th>
                                                    <th class="border-top-0 pt-0 pb-2">ACTION</th>
</tr>
</thead>
<tbody>
<?php                              
$respawn = mysqli_query($ketnoi,"SELECT * FROM `support` WHERE `username` = '".$_SESSION['username']."' AND `webdinhdanh` = '$domain' order by id desc ");
if (mysqli_num_rows($respawn) == 0):
?>    

 <tr>
<td>Bạn chưa có giao dịch nào !</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                               
                            </tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>                             
                            <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['date'] ?></td>
                                                    <td><img src="<?php echo $row['urlanh'] ?>" width="70px"></td>
                                                    <td><?php 
                                                    if($row['loaihinh'] == 'banking'){ echo 'Banking';}elseif($row['card'] == 'banking'){ echo 'Nạp Card';}else{echo 'Đơn Hàng';    
                                                    }
                                                   ?></td>
                                                    <td><font color =red><?php echo $row['codeoder'] ?></font></td>
                                                    <td><?php echo number_format($row['cash'],'0','.','.'); ?> VNĐ</td>
                                                    <td><?php echo $row['level'] ?></td>
                                                    <td><?php if($row['status'] =='wait'){echo 'Chờ xử lý';}else{
                                                    echo 'Đã phản hồi';} ?></td>
                                                    <td><a class="btn btn-success" href="/reply-admin.html?idcheck=<?php echo $row['id'] ?>">Phản Hồi</a></td>
                                                </tr>
<?php endwhile; endif; ?>   
</tbody>
</table>
</div>                 
</div>
					  </div>

				</div>
				<!-- /.col -->
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
	
<?php
include('page/footer.php');
}
?>

