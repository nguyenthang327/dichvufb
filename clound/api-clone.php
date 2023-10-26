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
div.container {
    width: 60%;  
    margin: auto;  
}
/* định dạng thẻ div chưa các button tab */
div.tab {
    overflow: hidden; 
    border: 1px solid #ccc; 
    background-color: #f1f1f1; 
}
 
/* định dạng các button tab */
div.tab button {
    background-color: inherit; 
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}
 
/* đổi màu khi một button tab được hover */
div.tab button:hover {
    background-color: #ddd;
}
 
/* đổi màu nền cho tab đang được hiển thị nội dung */
div.tab button.active {
    background-color: #ccc;
}
 
/* định dạng nội dung hiển thị */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}    
</style>
  
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
								<li class="breadcrumb-item" aria-current="page">(Chuẩn SMM Panel - Hệ thống dễ đấu code mẫu rõ ràng được hỗ trợ bởi Respawn Developer)</li>
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
<h4>API</h4>
<h6>(Kết nối API)</h6>
</div>
</div>
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<div class="table-responsive">
<table class="table mb-0">
<tbody>
<tr>
<td>API URL</td> 
<td><a href="https://<?=$domain?>/api/v9">https://<?=$domain?>/api/v9</a></td>
</tr>
<tr>
<td>API Key</td>
<td> <span onclick="location.href='/clound/infomation.html'" class="badge badge-success">Lấy ở đây</span></td>
</tr>
<tr>
<td>HTTP Method</td>
<td>POST</td>
</tr>
<tr>
<td>Content-Type</td>
<td>application/x-www-form-urlencoded</td>
</tr>
<tr>
<td>Response</td>
<td>JSON</td>
</tr>
</tbody>
</table>

</div>

</div>
<div class="tab">
  <button class="tablinks active">Services</button>
  <button class="tablinks">Buy</button>
  <button class="tablinks">PHP Code</button>    
</div>
 
<div id="Services" class="tabcontent">
    <h3>Dịch Vụ</h3>

        <table class="table mb-0">
<tbody>
<tr>
<td>token</td> 
<td>API Key của bạn</td>
</tr>    
<tr>
<td>type</td> 
<td>Điền vào: clone</td>
</tr>
</tbody>
</table>
    <p>
        Example response
        <pre class="language-html">
            {"status":200,"data":[{"nation":"vn","name":"Gmail very 1 th\u00e1ng bao
tr\u00e2u","amount":"1000","codesp":"1","conlai":76},{"nation":"vn","name":"Via clone k\u00e8m
2FA","amount":"1000","codesp":"2","conlai":70},{"nation":"vn","name":"Hotmail very 1 th\u00e1ng si\u00eau
tr\u00e2u","amount":"1000","codesp":"3","conlai":80},{"nation":"vn","name":"Acc 1 tri\u1ec7u xu
traodoisub","amount":"10000","codesp":"4","conlai":81},{"nation":"vn","name":"Acc 1 tri\u1ec7u xu
tuongtaccheo","amount":"10000","codesp":"5","conlai":80},{"nation":"vn","name":"Via radom li\u00ean minh huy\u1ec1n
tho\u1ea1i","amount":"1000","codesp":"6","conlai":82},{"nation":"vn","name":"Via radom
freefire","amount":"1000","codesp":"7","conlai":79},{"nation":"vn","name":"Via radom li\u00ean qu\u00e2n
mobile","amount":"1000","codesp":"8","conlai":81},{"nation":"vn","name":"Gmail very 6 th\u00e1ng bao
tr\u00e2u","amount":"1000","codesp":"9","conlai":73},{"nation":"vn","name":"Via Valorant
R\u1ebb","amount":"5000","codesp":"10","conlai":91}]}
</pre>
    </p>
</div>
 
<div id="Buy" class="tabcontent">
    <h3>Mua Clone</h3>

<div name="info" id="info">
<table class="table mb-0">
<tbody>
<td>token</td> 
<td>API Key của bạn</td>
</tr>    
<tr>
<td>type</td> 
<td>Điền vào: buyclone</td>
</tr>
<tr>
<td>masanpham</td>
<td>Mã sản phẩm</td>
</tr>
<tr>
<td>soluong</td>
<td>Số lượng</td>
</tr>

</tbody>
</table>    
</div>
    <p>
        Example response
        <pre class="language-html">{"status":200,"name":"Gmail very 1 th\u00e1ng bao
tr\u00e2u","magiaodich":"ORDER_JhEius3RX5n6WlGzrcM2mSg8e","amount":2000,"data":[{"info":"DEMO 7"},{"info":"DEMO 8"}]}
</pre>
    </p>
</div>

<div id="PHP Code" class="tabcontent">
    <h3>Code mẫu</h3>
    <p>
       <a href="code-clone.txt" class="btn btn-primary"><i class="fas fa-code" aria-hidden="true"></i> Example PHP Code</a>
    </p>
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
    var buttons = document.getElementsByClassName('tablinks');
    var contents = document.getElementsByClassName('tabcontent');
    function showContent(id){
        for (var i = 0; i < contents.length; i++) {
            contents[i].style.display = 'none';
        }
        var content = document.getElementById(id);
        content.style.display = 'block';
    }
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function(){
            var id = this.textContent;
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].classList.remove("active");
            }
            this.className += " active";
            showContent(id);
        });
    }
    showContent('Services');
</script>	

	<!-- Page Content overlay -->
<?php
include('../pages/footer.php');
}
?>

