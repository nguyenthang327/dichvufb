<?php
include('system/connect.php');
if($active !== 'active'){
die (dev($active));
exit();
}elseif(!isset($_SESSION['username'])){
header('location:/login.html');
exit();
}else{
if(isset($_GET['idcheck'])){
$idcheck = addslashes($_GET['idcheck']);
$dem  = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `support` WHERE `id` ='".mysqli_real_escape_string($ketnoi,$idcheck)."'"));
if($dem == 0){
header('location:/');
exit();    
}else{
$checkin = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `support` WHERE `id` ='".mysqli_real_escape_string($ketnoi,$idcheck)."'")); 
$userkhieunai = $checkin['username'];
$loaihinh = $checkin['loaihinh'];
$codeoder = $checkin['codeoder'];
$cashoder = $checkin['cash'];
$noidung = $checkin['noidung'];
$status = $checkin['status'];
$level = $checkin['level'];
$urlanh = $checkin['urlanh'];
$date = $checkin['date'];
}
}else{
header('location:/');
exit();     
}    
include('system/thongke.php');    
include('page/header.php');
include('page/nav.php');
include('page/menu.php');
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
								<li class="breadcrumb-item" aria-current="page">Phản Hồi Admin</li>
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
<div class="row" id="basic-table">
<div class="card">
    <br>
    <center><h1>THÔNG TIN PHIÊN HỖ TRỢ: <?= $idcheck ?></h1></center>

                                    <div class="form-group">
                                    <p>Username gửi khiếu nại : <?= $userkhieunai ?>  
                                    -   Loại GD : <?= $loaihinh ?>
                                    -   Mã GD : <?= $codeoder ?>
                                    -   Cấp độ : <?= $level ?></p>
                                     <p>Trạng thái : <?= $status ?>
                                    -   Ngày gửi : <?= $date ?></p>
                                    <p><img src="../<?= $urlanh ?>" width="50px"><br><br> <a href="../<?= $urlanh ?>" class="btn btn-success" target="_blank">Xem Full</a> <a href="/report.html" class="btn btn-danger" target="_blank">Back</a></p>
                                    </div>

<!-- table head dark --><form method="POST">
                                    <div class="table-responsive">
                                        <br>
                                        <center><h3>TRAO ĐỔI VỚI ADMIN TRỰC TUYẾN</h3></center>
                                        <table class="table mb-0">
                                            <thead class="thead-dark">
                                                <tr>
                                                <?= $noidung ?>    
                                                </tr>
                                            </thead>
                                        <div class="form-group">
                                        <input type="hidden" name="target" id="target" value="<?php echo $idcheck?>">
                                    </div>    
                                           <div class="form-group">
                                        <label for="disabledInput"><i>Viết tin nhắn</i></label>
                                       <textarea class="form-control" id="reply" name="reply" rows="4" placeholder="Nội dung cung cấp" style="margin-top: 0px; margin-bottom: 0px; height: 204px;"></textarea>
                                    </div><br>
                                    <div class="form-group">
                                      <center>  <button onclick="submit();" type="submit" id="submit" id="submit" class="btn btn-success">Trả Lời</button></center>
                                    </div>
                                        </table>
                                    </div><br><br><br>

</form>  
                                        
                                      
                <!-- Table head options end -->
</div>                        
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
if(isset($_POST['target']) && isset($_POST['reply'])){
if(empty($_POST['target']) ||empty($_POST['reply'])){
echo('<script type="text/javascript">swal("ERROR","Vui lòng không để trống bất cứ thông tin nào !","error");setTimeout(function(){ location.href = "/reply-admin.html?idcheck='.$idcheck.'" },3000);</script>');        
} else{  
$target = mysqli_real_escape_string($ketnoi,addslashes($_POST['target'])); // id phiên
$reply = htmlspecialchars($_POST['reply']);
$checkin1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `support` WHERE `id` ='".mysqli_real_escape_string($ketnoi,$target)."'")); 
$noidung = $checkin1['noidung'];
$reply2 = "<br><tr>$username:$reply </tr>";
$noidungupdate = "$noidung $reply2";
$ketnoi->query("UPDATE `support` SET `noidung` = '$noidungupdate',`status`='wait' WHERE `id` = '$target'");
echo('<script type="text/javascript">swal("SUCCESS","Đã phản hồi Admin thành công !","success");setTimeout(function(){ location.href = "/reply-admin.html?idcheck='.$idcheck.'" },3000);</script>');    
    }
}
include('page/footer.php');
}
?>

