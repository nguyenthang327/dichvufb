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
    <title>Đăng nhập | <?php echo $namesite ?></title>
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
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
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
<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/auth-bg/bg-1.jpg)">
	
	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
			
			<div class="col-12">
				<div class="row justify-content-center g-0">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded10 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">Đăng nhập</h2>
								<div id="trave"><p class="mb-0">Xin mời nhập đầy đủ thông tin đăng nhập.</p></div>
							</div>
							<div class="p-40">
								
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											<input type="text" name="username" id="username" class="form-control ps-15 bg-transparent" placeholder="Tài khoản">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
											<input name="password" id="password" type="password" class="form-control ps-15 bg-transparent" placeholder="Mật khẩu">
										</div>
									</div>
									  <div class="row">
										<div class="col-6">
										  <div class="checkbox">
											<input type="checkbox" id="basic_checkbox_1" >
											<label for="basic_checkbox_1">Ghi nhớ</label>
										  </div>
										</div>
										<!-- /.col -->
										<div class="col-6">
										 <div class="fog-pwd text-end">
											<a href="/clients/forgot.html" class="hover-warning"><i class="ion ion-locked"></i> Bạn quên mật khẩu?</a><br>
										  </div>
										</div>
										<!-- /.col -->
										<div class="col-12 text-center">
										  <button name="submit" id="submit" type="submit" button name="submit" id="submit" type="submit"  class="btn btn-danger mt-10">Đăng Nhập</button>
										</div>
										<!-- /.col -->
									  </div>
									
								<div class="text-center">
									<p class="mt-15 mb-0">Bạn chưa có tài khoản? <a href="/clients/register.html" class="text-warning ms-5">Đăng ký ngay</a></p>
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
			var password = $('#password').val();
				if (  username == '' || password == '') {
				$("#trave").html('<div class="alert"><span class="closebtn" onclick="spawn()">&times;</span><strong>Lỗi !</strong> Vui lòng điền đầy đủ thông tin đăng nhập .</div>');
					return false;
				}
				$('#submit').prop('disabled', true)
				$.post('../respawn/login.html', {
					username: username,
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