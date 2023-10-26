<?php
include('system/connect.php');
if(!empty($demdomain)){
header('location:/');
exit();    
}elseif(isset($_SESSION['username'])){
header('location:/logout.html');
exit();
}else{
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Active | Kích hoạt Website Con</title>
    <meta name="keywords" content="<?php echo $tukhoasite ?>" />
	<meta name="author" content="<?php echo $namesite ?>" />
	<meta name="robots" content="<?php echo $namesite ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $mieutasite ?>" />
	<meta property="og:title" content="<?php echo $titlenentang ?>" />
	<meta property="og:description" content="<?php echo $mieutasite ?>" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:image" content="assets/img/home-banner.jpg" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/skin_color.css">	

</head>
	
<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/auth-bg/bg-1.jpg)">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center g-0">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded10 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">Kích Hoạt Website Con</h2>
								<p class="mb-0">Vui lòng nhập Token kích hoạt !</p>							
							</div>
							<div class="p-40">
								
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											<input type="text" name="token" id="token" class="form-control ps-15 bg-transparent" placeholder="Token trên Website chính">
										</div>
									</div>
									  <div class="row">
										<!-- /.col -->
										<div class="col-6">
										 <div class="fog-pwd text-end">
											<a href="https://<?=$domainchinh?>/information.html" class="hover-warning"><i class="ion ion-locked"></i> Bạn không biết vị trí lấy Token?</a><br>
										  </div>
										</div>
										<!-- /.col -->
										<div class="col-12 text-center">
										  <button name="submit" id="submit" type="submit" button name="submit" id="submit" type="submit"  class="btn btn-danger mt-10">Kích Hoạt</button>
										</div>
										<!-- /.col -->
									  </div>
									
							</div>						
						</div>
						<div class="text-center">
						  <p class="mt-20 text-white">- Đối tác -</p>
						  <p class="gap-items-2 mb-20">
							  <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
							  <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
							  <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i class="fa fa-instagram"></i></a>
							</p>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Vendor JS -->
	<script src="js/vendors.min.js"></script>
	<script src="js/pages/chat-popup.js"></script>
    <script src="../assets/icons/feather-icons/feather.min.js"></script>
     <div id="trave" style="display: none;">
	</div> 
<script type="text/javascript">
  $('#submit').click(function(){
var token = $('#token').val();
                    if ( token == '') {
					swal("ERROR","Vui lòng điền đầy đủ thông tin token !","error");
					return false;
				}
				$('#submit').prop('disabled', true)
				$.post('respawn/active.html', {
					token: token
				}, function(data, status) {
					$("#trave").html(data);
					$('#submit').prop('disabled', false);
				});
			});
</script>
</body>
</html>
<?php
}
?>