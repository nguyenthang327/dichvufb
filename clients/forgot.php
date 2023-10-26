<?php
require_once('../system/config.php');
if(isset($_SESSION['username'])){
header('location:/clound/home.html');
}else{
?> 
<html lang="vi">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quên mật khẩu | <?php echo $namesite ?></title>
    <meta name="keywords" content="<?php echo $tukhoa ?>" />
	<meta name="author" content="<?php echo $namesite ?>" />
	<meta name="robots" content="<?php echo $namesite ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo $mota ?>" />
	<meta property="og:title" content="<?php echo $tieude?>" />
	<meta property="og:description" content="<?php echo $mota ?>" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:image" content="../assets/img/home-banner.jpg" />
    <link rel="shortcut icon" type="image/x-icon" href="<?=$favicon?>">
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="../css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/skin_color.css">	

</head>
<style>
.goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
body {
    top: 0px !important; 
    }
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
}

.alert.success {background-color: #04AA6D;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>	
<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/auth-bg/bg-2.jpg)">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center g-0">
					<div class="col-lg-5 col-md-5 col-12">
							<div class="bg-white rounded10 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">Khôi phục mật khẩu</h2>
								
								   <div id="trave" >
								       <p class="mb-0">Nhập đầy đủ thông tin và nhấn khôi phục</p>	
	</div> 
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
											<input name="email" id="email" type="email" class="form-control ps-15 bg-transparent" placeholder="Email đăng ký">
										</div>
									</div>
								
									  <div class="row">
										<!-- /.col -->
										<div class="col-12 text-center">
										  <button name="submit" id="submit" type="submit" class="btn btn-info margin-top-10">Khôi phục</button>
										</div>
										<!-- /.col -->
									  </div>
											
								<div class="text-center">
									<p class="mt-15 mb-0">Bạn đã có mật khẩu?<a href="/clients/login.html" class="text-danger ms-5"> Đăng nhập ngay</a></p>
									<p class="mt-15 mb-0">Chưa có tài khoản?<a href="/clients/register.html" class="text-danger ms-5"> Đăng ký ngay</a></p>
								</div>
							</div>
						</div>			
						<div class="text-center">
						  <p class="mt-20 text-white">- Nhiều lựa chọn ngôn ngữ hơn -</p>
						  <p class="gap-items-2 mb-20">
							  <div id="google_translate_element"></div>
</center>
							</p>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Vendor JS -->
	<script src="../js/vendors.min.js"></script>
	<script src="../js/pages/chat-popup.js"></script>
    <script src="../assets/icons/feather-icons/feather.min.js"></script>
    <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'vi'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  
<script type="text/javascript">
function spawn(){
$("#trave").html('');    
}
         $('#submit').click(function(){
			var username = $('#username').val();
			var email = $('#email').val();
				if ( username == '' || email == '') {
					$("#trave").html('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong> Vui lòng điền đầy đủ thông tin khôi phục .</div>');
					return false;
				}
				$('#submit').prop('disabled', true)
				$.post('../respawn/forgot.html', {
					username: username,
					email: email
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