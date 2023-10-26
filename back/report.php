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
								<li class="breadcrumb-item" aria-current="page">Báo Cáo Lỗi</li>
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
			 <a style="float:right;" href="/history-report.html" class="btn btn-primary"><i class="fas fa-history"></i> Lịch sử khiếu nại</a>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					  <div class="row">
						<div class="col-xl-12">
			  
<div class="alert alert-success" role="alert">
                   Gửi yêu cầu hỗ trợ phản ánh sai sót trong quá trình gửi đơn hàng, thời gian xử lý 1 - 5 phút  hoặc có thể lâu hơn .<br> Nếu bạn chờ đợi quá lâu mà không được phản hồi, bạn có thể  liên hệ admin để tiến hành phản ánh qua Fanpage hoặc hotline.<br>
Theo dõi phiếu hỗ trợ và sau khi hỗ trợ thành công, phiếu hỗ trợ sẽ bị xóa .
                  </div>
<form  class="col-12" action="/report.html" method="post" enctype="multipart/form-data"> 
<div class="card-body">
<div class="row mb-n3">
<div class="col-xl-6">
<input type="text" class="form-control form-control-lg mb-3" id="magiaodich" name="magiaodich" placeholder="Mã giao dịch">
<input type="number" class="form-control form-control-lg mb-3" id="cash" name="cash" placeholder="Số tiền phát sinh giao dịch gặp lỗi">
</div>
<div class="col-xl-6">
<select class="form-select form-select-lg mb-3" id="loaihotro" name="loaihotro">
<option>Chọn Loại hỗ trợ</option>
                                            <option value="banking">Nạp tiền</option>
                                            <option value="card">Nạp card</option>
                                            <option value="donhang">Xử lý đơn hàng</option>
                                            <option value="khac">Vấn đề khác</option>
</select>
<select class="form-select form-select-lg mb-3" id="level" name="level">
<option>Chọn Level</option>
<option value="normal">Thông thường</option>
                                            <option value="special">Khẩn cấp</option>
</select>
</div>
<div class="col-xl-12">
<div class="form-group">
<label for="cash">Nội Dung Bạn Muốn Cung Cấp Cho Admin</label>
<textarea class="form-control" id="note" name="note" rows="5" placeholder="Ví dụ : Xin chào Admin ! Tôi có một giao dịch bị lỗi, tôi đã chuyển tiền vào lúc XX/YY/ZZZZ nhưng không nhận được tiền trong tài khoản"></textarea>
</div>
</div>
<br>
<div class="form-group">
                                        <label for="photo">Đính Kèm Ảnh</label>
                                        <input type="file" name="photo" id="fileSelect">
                                    </div>
</div>
<br>
<div class="col-xl-12">
<center><button onclick="submit();" type="submit" name="submit" id="submit" class="btn btn-warning"><i class="fa fa-upload" aria-hidden="true"></i> Gửi Yêu Cầu</button></center>
</div>
</div>
</form>                  
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
if(isset($_POST['magiaodich']) && isset($_POST['level']) && isset($_POST['cash']) && isset($_POST['note']) && isset($_POST['loaihotro']) && isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
$magiaodich = mysqli_real_escape_string($ketnoi,addslashes($_POST['magiaodich']));
$level = mysqli_real_escape_string($ketnoi,addslashes($_POST['level']));
$casha4 = mysqli_real_escape_string($ketnoi,addslashes($_POST['cash']));
$loaihotro = mysqli_real_escape_string($ketnoi,addslashes($_POST['loaihotro']));
$note = htmlspecialchars(addslashes($_POST['note']));
$hinhanh = $_FILES["photo"];

$date = date("Y-m-d H:i:sa");
$dem = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `support` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$username)."' AND `codeoder` = '$magiaodich'"));
// Kiểm tra level có hợp lệ không
if($level == 'normal'){
$typesupport = 'Thường';    
}elseif($level == 'special'){
$typesupport = 'Khẩn Cấp';    
}else{
echo('<script type="text/javascript">swal("ERROR","Loại support không hợp lệ, bạn định làm con cặt gì vậy ?","error"); setTimeout(function(){ location.href = "/report.html" },5000);</script>');  
exit();
}
// Kiểm tra số tiền có hợp lệ không
if($casha4 < 1){
echo('<script type="text/javascript">swal("ERROR","Dường như bạn đã không đọc yêu cầu của chúng tôi lúc chuyển tiền, số tiền tối thiểu mà hệ thống xử lý là 1 VNĐ","error");setTimeout(function(){ location.href = "/report.html" },3000);</script>');
exit();  
// Kiểm tra loại hỗ trợ

}
if($loaihotro == 'banking'){
$typebanking = 'banking';
}elseif($loaihotro == 'card'){
$typebanking = 'card';
}elseif($loaihotro == 'donhang'){
$typebanking = 'donhang';
}elseif($loaihotro == 'khac'){
$typebanking = 'khac';
}else{
echo('<script type="text/javascript">swal("ERROR","Loại hỗ trợ không hợp lệ, bạn định làm con cặt gì vậy ?","error"); setTimeout(function(){ location.href = "/report.html" },5000);</script>');  
exit();  
}
// Kiểm tra mã giao dịch có trống không
if(empty($magiaodich)){
echo('<script type="text/javascript">swal("ERROR","Vui lòng nhập mã giao dịch !","error"); setTimeout(function(){ location.href = "/report.html" },2000);</script>');   
exit();
}
// Kiểm tra đơn này đã có trên hệ thống chưa
if($dem > 0){
echo('<script type="text/javascript">swal("ERROR","Bạn đã từng gửi yêu cầu hỗ trợ có chứa mã đơn hàng này rồi, xin hãy kiểm tra ở lịch sử gửi yêu cầu hỗ trợ","error");setTimeout(function(){ location.href = "/report.html" },3000);</script>');
exit(); 
// Nhập hình ảnh
}
if(empty($hinhanh)){
echo('<script type="text/javascript">swal("ERROR","Hãy thêm hình ảnh chụp bill chuyển tiền để dịch vụ có thể hỗ trợ bạn","error");setTimeout(function(){ location.href = "/report.html" },3000);</script>');
exit();    
// Phiên đăng nhập
}
if(empty($note)){
echo('<script type="text/javascript">swal("ERROR","Hãy thêm mô tả chi tiết vấn đề bạn đang gặp phải để chúng tôi xử lý !","error");setTimeout(function(){ location.href = "/report.html" },3000);</script>');
exit();    
// Phiên đăng nhập
}
if(!$username){
die('<script type="text/javascript" setTimeout(function(){ location.href = "/" },0);</script>');  
exit();     
}else{
$magiaodich = str_replace(" - ", "", $magiaodich);   
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["photo"]["name"];
		        $filetype = $_FILES["photo"]["type"];
		        $filesize = $_FILES["photo"]["size"];
		        $ext = pathinfo($filename, PATHINFO_EXTENSION);
		        $maxsize = 5 * 1024 * 1024;
		        if(!array_key_exists($ext, $allowed)){
echo('<script type="text/javascript">swal("ERROR"," Vui lòng chọn đúng định dạng file (PNG, JPEG, JPG, GIF)","error");setTimeout(function(){ location.href = "/report.html" },3000);</script>');
exit(); 		            
		        }elseif($filesize > $maxsize){
echo('<script type="text/javascript">swal("ERROR"," Ảnh upload tối đa 5MB bạn nhé","error");setTimeout(function(){ location.href = "/report.html" },3000);</script>');
exit(); 		            
		        }elseif(in_array($filetype, $allowed)){
if(file_exists("upload/" . $_FILES["photo"]["name"])){
$namemol = substr($filename,strrpos($filename,'.') + 1); 
$namecjo = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,10); 
$_FILES["photo"]["name"] = "$namecjo.$namemol";
move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $_FILES["photo"]["name"]); 
$url = 'upload/'.$_FILES["photo"]["name"].'';
$note = "<tr>$username: $note</tr>";
mysqli_query($ketnoi, "INSERT INTO `support` (`username`, `type`, `loaihinh`, `codeoder`, `cash`, `noidung`, `status`, `level`, `urlanh`,`webdinhdanh`, `date`) 
VALUES ('$username','$typebanking','$loaihotro','$magiaodich','$casha4','$note','wait','$typesupport','$url','$domain','$date')"); 
echo('<script type="text/javascript">swal("SUCCESS","Yêu cầu hỗ trợ, khiếu nại thành công, hãy kiểm tra kết quả ở lịch sử và trao đổi thêm với Admin !","success");setTimeout(function(){ location.href = "/report.html" },3000);</script>');    
    }else{
move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $_FILES["photo"]["name"]); 
$url = 'upload/'.$_FILES["photo"]["name"].'';
$note = "<tr>$username: $note</tr>";
mysqli_query($ketnoi, "INSERT INTO `support` (`username`, `type`, `loaihinh`, `codeoder`, `cash`, `noidung`, `status`, `level`, `urlanh`,`webdinhdanh`, `date`) 
VALUES ('$username','$typebanking','$loaihotro','$magiaodich','$casha4','$note','wait','$typesupport','$url','$domain','$date')"); 
echo('<script type="text/javascript">swal("SUCCESS","Yêu cầu hỗ trợ, khiếu nại thành công, hãy kiểm tra kết quả ở lịch sử và trao đổi thêm với Admin !","success");setTimeout(function(){ location.href = "/report.html" },3000);</script>');    
            }
        }
    }
}
include('page/footer.php');
}
?>

