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
<script type="text/javascript">
        function checkpoint() {
            var service_type = $("#service_type").val();
            $.ajax({
                url: "/modun/checkin.php",
                type: "GET",
                dataType: "text",
                data: {
                    service_type: $("#service_type").val()
                },
                success: function(result) {
                    var result = JSON.parse(result);
                    if (result["status"] == "true") {
                        $("#info").html(result["info"]);
                    } else {
                       $("#info").html(result["info"]);
                    }
                },
            });
        }
</script>
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
<td>https://<?=$domain?>/api/v2</td>
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
  <button class="tablinks">Add</button>
  <button class="tablinks">Status</button>
  <button class="tablinks">Multistatus</button>  
  <button class="tablinks">Balance</button>   
  <button class="tablinks">PHP Code</button>    
</div>
 
<div id="Services" class="tabcontent">
    <h3>Dịch Vụ</h3>

        <table class="table mb-0">
<tbody>
<tr>
<td>Parameters</td> 
<td>Description</td>
</tr>    
<tr>
<td>key</td> 
<td>API Key</td>
</tr>
<tr>
<td>action</td>
<td>services</td>
</tr>
</tbody>
</table>
    <p>
        Example response
        <pre class="language-html">[
    {
        "service": 1,
        "name": "Youtube views",
        "type": "Default",
        "category": "Youtube",
        "rate": "2.5",
        "min": "200",
        "max": "10000"
    },
    {
        "service": 2,
        "name": "Facebook comments",
        "type": "Custom Comments",
        "category": "Facebook",
        "rate": "4",
        "min": "10",
        "max": "1500"
    }
]
</pre>
    </p>
</div>
 
<div id="Add" class="tabcontent">
    <h3>Thêm Oder</h3>
 <select class="form-control input-sm" id="service_type"  onchange="checkpoint()">
                                                  <option value="0">Default</option>
                                                  <!---option value="10">Package</option--->
                                                  <option value="2">Custom Comments</option>
                                                  <option value="9">Mentions</option>
                                                  <option value="15">Comment Likes</option>
                                                  <option value="100">Subscriptions</option>
                                            </select>  
                                            <br>

<div name="info" id="info">
<table class="table mb-0">
<tbody>
<tr>
<td>Parameters</td> 
<td>Description</td>
</tr>    
<tr>
<td>key</td> 
<td>API Key</td>
</tr>
<tr>
<td>action</td>
<td>add</td>
</tr>
<tr>
<td>service</td>
<td>Service ID</td>
</tr>
<tr>
<td>link</td>
<td>Link</td>
</tr>
<tr>
<td>quantity</td>
<td>Needed quantity</td>
</tr> <tr>
<td>reaction (optional)</td>
<td>like,haha,wow,care,love,sad,angry (default like)</td>
</tr> 
<tr>
<td>minutes (optional)</td>
<td>30,45,60,90,120,150,180,210,240,270,300 (default 30)</td>
</tr>
<tr>
<td>dayvip (optional)</td>
<td>7,15,30,60,90,120,150,180 (default 30)</td>
</tr>
</tbody>
</table>    
</div>
    <p>
        Example response
        <pre class="language-html">{
    "order": 99999
}
</pre>
    </p>
</div>
 
<div id="Status" class="tabcontent">
    <h3>Trạng thái đơn</h3>
  <table class="table mb-0">
<tbody>
<tr>
<td>Parameters</td> 
<td>Description</td>
</tr>    
<tr>
<td>key</td> 
<td>API Key</td>
</tr>
<tr>
<td>action</td>
<td>status</td>
</tr>
<tr>
<td>order</td>
<td>Order ID</td>
</tr>
</tbody>
</table>
    <p>
        Example response
        <pre class="language-html">{
    "charge": "2.5",
    "start_count": "168",
    "status": "Completed",
    "remains": "-2"
}
</pre>
Status: Pending, Processing, In progress, Completed, Partial, Canceled
    </p>
</div>
<div id="Multistatus" class="tabcontent">
    <h3>Nhiều trạng thái đơn</h3>
    <table class="table mb-0">
<tbody>
<tr>
<td>Parameters</td> 
<td>Description</td>
</tr>    
<tr>
<td>key</td> 
<td>API Key</td>
</tr>
<tr>
<td>action</td>
<td>status</td>
</tr>
<tr>
<td>orders</td>
<td>Order IDs separated by comma (E.g: 123,456,789)</td>
</tr>
</tbody>
</table>
    <p>
        Example response
        <pre class="language-html">{
    "123": {
        "charge": "0.27819",
        "start_count": "3572",
        "status": "Partial",
        "remains": "157"
    },
    "456": {
        "error": "Incorrect order ID"
    },
    "789": {
        "charge": "1.44219",
        "start_count": "234",
        "status": "In progress",
        "remains": "10"
    }
}
</pre>
Status: Pending, Processing, In progress, Completed, Partial, Canceled
    </p>
</div>
<div id="Balance" class="tabcontent">
    <h3>Số dư</h3>
    <table class="table mb-0">
<tbody>
<tr>
<td>Parameters</td> 
<td>Description</td>
</tr>    
<tr>
<td>key</td> 
<td>API Key</td>
</tr>
<tr>
<td>action</td>
<td>balance</td>
</tr>

</tbody>
</table>
    <p>
        Example response
        <pre class="language-html">{
    "balance": "68.6868",
    "currency": "VND"
}
</pre>
    </p>
</div>
<div id="PHP Code" class="tabcontent">
    <h3>Code mẫu</h3>
    <p>
       <a href="code.txt" class="btn btn-primary"><i class="fas fa-code" aria-hidden="true"></i> Example PHP Code</a>
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

