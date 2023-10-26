<?php
include('system/connect.php');
if(empty($demdomain)){
header('location:/active.html');
exit();    
}elseif($active !== 'active'){
die (dev($active));
exit();
}elseif(isset($_SESSION['username'])){
header('location:/');
exit();
}else{
?>
<!-- RESPAWN DEVELOPER - NẾU BẠN MUỐN SỞ HỮU 1 WEBSITE TƯƠNG TỰ, LIÊN HỆ : 0983647058 -->
<!-- RESPAWN DEVELOPER - IF YOU WANT TO HAVE A WEBSITE SIMILAR, CONTACT : 0983647058 -->
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký | <?php echo $namesite ?></title>
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

<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/auth-bg/bg-2.jpg)">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">
			
			<div class="col-12">
				<div class="row justify-content-center g-0">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded10 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">Đăng ký</h2>
								<p class="mb-0">Nhập đầy đủ thông tin và nhấn đăng ký</p>							
							</div>
							<div class="p-40">
								
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											<input name="username" id="username" type="text" class="form-control ps-15 bg-transparent" placeholder="Tài khoản">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
											<input name="email" id="email" type="email" class="form-control ps-15 bg-transparent" placeholder="Email">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
											<input name="password" id="password" type="password" class="form-control ps-15 bg-transparent" placeholder="Mật khẩu">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
											<input name="repassword" id="repassword" type="password" class="form-control ps-15 bg-transparent" placeholder="Nhập lại mật khẩu">
										</div>
									</div>
									  <div class="row">
										<div class="col-12">
										  <div class="checkbox">
											<input type="checkbox" id="basic_checkbox_1" checked>
											<label for="basic_checkbox_1">Tôi hoàn toàn đồng ý với <a href="#" class="text-warning"><b>quy định và điều khoản dịch vụ</b></a></label>
										  </div>
										</div>
										<!-- /.col -->
										<div class="col-12 text-center">
										  <button name="submit" id="submit" type="submit" class="btn btn-info margin-top-10">Đăng Ký</button>
										</div>
										<!-- /.col -->
									  </div>
											
								<div class="text-center">
									<p class="mt-15 mb-0">Bạn đã có tài khoản?<a href="/login.html" class="text-danger ms-5"> Đăng nhập ngay</a></p>
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
			var username = $('#username').val();
			var password = $('#password').val();
			var repassword = $('#repassword').val();
			var email = $('#email').val();
				if ( username == '' || password == '' || repassword == '' || email == '') {
					swal("ERROR","Vui lòng điền đầy đủ thông tin đăng ký !","error");
					return false;
				}
				$('#submit').prop('disabled', true)
				$.post('respawn/register.html', {
			    	repassword: repassword,
					username: username,
					email: email,
					password: password
				}, function(data, status) {
					$("#trave").html(data);
					$('#submit').prop('disabled', false);
				});
			});
</script>	
	
</body>
<!-- RESPAWN DEVELOPER - NẾU BẠN MUỐN SỞ HỮU 1 WEBSITE TƯƠNG TỰ, LIÊN HỆ : 0983647058 -->
<!-- RESPAWN DEVELOPER - IF YOU WANT TO HAVE A WEBSITE SIMILAR, CONTACT : 0983647058 -->
</html>
<?php
}
?>
