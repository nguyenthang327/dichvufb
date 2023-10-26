<?php
include('system/connect.php');
include('system/functionautofb.php');
if($active !== 'active'){
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
								<li class="breadcrumb-item" aria-current="page">Check UID</li>
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
				<div class="col">
					  <div class="row">
						<div class="col-xl-12">
						    <div class="form-group row">
						        <div class="col-sm-12">
 <form class="forms-sample" method="post">
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Link cần Check</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="idpost"  name="idpost" placeholder="Nhập Link Cần Check">
                          </div>
                        </div><br>
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Chọn Loại Check</label>
                          <div class="col-sm-9">
                            <select class="form-control" id="type"  name="type">
                            <option value="1">UID Bài Viết Facebook</option>
                            <option value="2">UID Trang Cá Nhân / Fanpage</option>
                            </select>    
                          </div>
                        </div><br>      
                        <div class="form-group row">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Kết Quả:</label>
                          <div class="col-sm-9">
<?php
if(isset($_POST['idpost']) &&isset($_POST['type'])){
if(empty($_POST['idpost']) ||empty($_POST['type'])){
echo '<b style="color:red">Vui lòng điền link cần check và chọn loại check !</b>';    
}else{
$respawn = addslashes($_POST['idpost']);
$respawn1 = addslashes($_POST['type']);
$tokendichvu = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webnguon` ='autofb'"));
$token = $tokendichvu['token']; 
if($respawn1 == 2){
$path = '/api/checklinkfb/check/';  
$referer = 'https://autofb.pro/tool/Buffsub'; 
$url = 'https://autofb.pro/api/checklinkfb/check/';    
$data = '{"id_user":13128,"link":"'.$respawn.'"}';
$checkin = oder($url,$token,$path,$referer,$data);
$obj = json_decode($checkin);
$status = $obj-> status;
if($status == 200){
$id = $obj-> id;
echo '<b style="color:green">'.$id.'</b>';  
    }else{
echo '<b style="color:red">Lấy UID thất bại, xin hãy thử lại 2-3 lần !</b>';        
    }
    
        }elseif($respawn1 == 1){
if(strlen(strstr($respawn, 'posts')) > 0) {            
$respawn = explode("/", $respawn);
$id =  $respawn['5'];
echo '<b style="color:green">'.$id.'</b>';  
}elseif(strlen(strstr($respawn, 'story_fbid=')) > 0) {            
$respawn = explode("story_fbid=", $respawn);
$id1 =  $respawn['1'];
$respawn = explode("&", $id1);
$id1 =  $respawn['0'];
echo '<b style="color:green">'.$id1.'</b>'; 
    
}
        }
    }
}
?>  
                          </div>
                        </div><br>                           
                        <div class="form-group row">
<button type="submit" class="btn btn-primary" id="submit" name="submit"> Check Ngay</button>
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
<script type="text/javascript">
function submit(){if(!$('#idpost')['val']()){swal('ERROR','Bạn chưa nhập UID cần tăng sub','error')}
else {if(!$('.form-check-input:checked')['val']()){swal('ERROR','Bạn chưa chọn server buff','error')}
else {if(!$('#amount')['val']()){swal('ERROR','Bạn chưa nhập số lượng','error')}
else {if(!$('#note')['val']()){swal('ERROR','Bạn chưa ghi chú cho đơn','error')}
else {
    $(document).ajaxStart(function () {
            $("#submit").attr("disabled", true);
        });    
    nap()}}}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
$['post']('respawn/subsale.html',{
    idpost:$('#idpost')['val'](),
    server:$('.form-check-input:checked')['val'](),
    amount:$('#amount')['val'](),
    note:$('#note')['val']()},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('Tạo đơn khác')},'json')    
    $(document).ajaxComplete(function() {
            $("#submit").attr("disabled", false);
        });    
}
</script> 	
<?php
include('page/footer.php');
}
?>

