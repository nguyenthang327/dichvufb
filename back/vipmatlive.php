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
<script type="text/javascript">
        function checkpoint() {
            var goivip = $("#goivip").val();
            var tgdtm = $("#tgdtm").val();
            var time = $("#time").val();
            var sll = $("#sll").val();
            var server = $('.form-check-input1:checked').val()
            $.ajax({
                url: "/modun/checkgia.php",
                type: "GET",
                dataType: "text",
                data: {
                    number: $("#sll").val(),
                    tgdtm: $("#tgdtm").val(),
                    time: $("#time").val(),
                    goivip: $("#goivip").val(),
                    type: "vipmatlive",
                    server:$('.form-check-input:checked').val(),
                },
                success: function(result) {
                    var result = JSON.parse(result);
                    if (result["status"] == "true") {
                        $("#total_money").val(result["name"]);
                    } else {
                        $("#total_money").val(result["name"]);
                    }
                },
            });
        }
</script>
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
								<li class="breadcrumb-item" aria-current="page">Vip Mắt Live</li>
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
			 <a style="float:right;" href="/history.html?type=19" class="btn btn-primary"><i class="fas fa-history"></i> Lịch sử đơn hàng</a>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					  <div class="row">
						<div class="col-xl-12">
						    <div class="form-group row">
						        <div class="col-sm-12">
						    			  <a  style="float:right;" href="/report.html" class="badge badge-danger"><i class="fas fa-times-circle"></i> Báo lỗi</a>
						    			  </div>
						    </div>			  
<div class="form-group row">
                          <label for="idpost" class="col-sm-3 col-form-label">UID trang cá nhân</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="idpost"  name="idpost" placeholder="Nhập ID trang cá nhân cần tăng">
                          </div>
                        </div>
                        <br>
<div class="form-group row">
                          <label for="server" class="col-sm-3 col-form-label">Chọn Server</label>
                          <div class="col-sm-9">
<?php                              
$respawn = mysqli_query($ketnoi,"SELECT * FROM `chietkhau` WHERE `madichvu` = 'vipmatlive' AND `webdinhdanh` = '$domain'");
if (mysqli_num_rows($respawn) == 0):
?><p>Không có server khả dụng</p>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>
                            <div class="form-check">
  <input class="form-check-input" type="radio" name="server" id="<?=$row['server']?>" value="<?=$row['server']?>" onchange="checkpoint()">
  <label class="form-check-label" for="<?=$row['server']?>">
  <?=$row['note']?> <div class="badge bg-primary"><?=$row[$order]?> Coin / 1 Mắt</div>
  </label>
</div>
     <?php endwhile; endif; ?>                                                 
                    </div>
                </div>
                    <br>
                        <br>    
                     <div class="form-group row">
                         <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Chọn gói Vip:</label>
                         <div class="col-sm-9">
                         <select class="form-select mb-3" id="goivip" name="goivip" onchange="checkpoint()">
                             <option value="50">50</option>
                             <option value="100">100</option>
                             <option value="150">150</option>
                             <option value="200">200</option>
                             <option value="250">250</option>
                             <option value="300">300</option>
                             <option value="350">350</option>
                             <option value="400">400</option>
                             <option value="450">450</option>
                             <option value="500">500</option>
                             <option value="550">550</option>
                             <option value="600">600</option>
                             <option value="650">650</option>
                             <option value="700">700</option>
                             <option value="750">750</option>
                             <option value="800">800</option>
                             <option value="850">850</option>
                             <option value="900">900</option>
                             <option value="950">950</option>
                             <option value="1000">1000</option>
                             </select>
                         </div> 
                         </div> <br> 
                                              <div class="form-group row">
                         <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Thời gian duy trì mắt:</label>
                         <div class="col-sm-9">
                     <select class="form-select mb-3" id="tgdtm" name="tgdtm"  onchange="checkpoint()">
                         <option value="30">30 phút</option>
                         <option value="45">45 phút</option>
                         <option value="60">60 phút</option>
                         <option value="90">90 phút</option>
                         <option value="120">120 phút</option>
                         <option value="150">150 phút</option>
                         <option value="180">180 phút</option>
                         <option value="210">210 phút</option>
                         <option value="240">240 phút</option>
                         </select>
                         </div> 
                         </div> <br>
                        <div class="form-group row">
                          <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Thời gian sử dụng:</label>
                          <div class="col-sm-9">
                            <select class="form-select mb-3" id="time" name="time"  onchange="checkpoint()">
                                <option value="7">7 ngày</option
                                ><option value="10">10 ngày</option
                                ><option value="15">15 ngày</option
                                ><option value="30">30 ngày</option
                                ></select>
                          </div>
                        </div><br>
                        <div class="form-group row">
                          <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Số lần live tối đa trong thời gian sử dụng:</label>
                          <div class="col-sm-9">
                            <select class="form-select mb-3" id="sll" name="sll"  onchange="checkpoint()">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option><option value="66">66</option><option value="67">67</option><option value="68">68</option><option value="69">69</option><option value="70">70</option><option value="71">71</option><option value="72">72</option><option value="73">73</option><option value="74">74</option><option value="75">75</option><option value="76">76</option><option value="77">77</option><option value="78">78</option><option value="79">79</option><option value="80">80</option><option value="81">81</option><option value="82">82</option><option value="83">83</option><option value="84">84</option><option value="85">85</option><option value="86">86</option><option value="87">87</option><option value="88">88</option><option value="89">89</option><option value="90">90</option><option value="91">91</option><option value="92">92</option><option value="93">93</option><option value="94">94</option><option value="95">95</option><option value="96">96</option><option value="97">97</option><option value="98">98</option><option value="99">99</option><option value="100">100</option></select>
                          </div>
                        </div><br>
                        <div class="form-group row">
                          <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Giới Hạn Live Trong 1 Ngày:</label>
                          <div class="col-sm-9">
                            <select class="form-select mb-3" id="ghltmn" name="ghltmn"  onchange="checkpoint()"><option value="1">1 Live / 1 Ngày</option><option value="2">2 Live / 1 Ngày</option><option value="3">3 Live / 1 Ngày</option><option value="4">4 Live / 1 Ngày</option><option value="5">5 Live / 1 Ngày</option><option value="6">6 Live / 1 Ngày</option><option value="7">7 Live / 1 Ngày</option><option value="8">8 Live / 1 Ngày</option><option value="9">9 Live / 1 Ngày</option><option value="10">10 Live / 1 Ngày</option></select>
                          </div>
                        </div><br>
                        <div class="form-group row">
                          <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Ghi chú đơn</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" id="note" name="note" rows="3" placeholder="Nhập ghi chú">Không</textarea>
                          </div>
                        </div><br>
                        <div class="form-group row">
                          <label for="total_money" class="col-sm-3 col-form-label">Thanh Toán</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="total_money" placeholder="0 VNĐ" disabled="" id="total_money" />
                          </div>
                        </div> <br>                       
</div>
<div class="col-xl-12">
<center><button onclick="submit();" type="submit" name="submit" id="submit" class="btn btn-warning"><i class="fa fa-upload" aria-hidden="true"></i> Tạo Đơn</button></center>
</div>
					  </div>
					  <br>
					  <div class="col-xl-12">
					  <div class="rounded p-15 h-100% bg-primary bg-temple-dark">
<center><h3>LƯU Ý CẦN ĐỌC ĐỂ TRÁNH MẤT TIỀN</h3> </center>  
<p>+ Hệ thống chạy bằng UID trang cá nhân</p>
<p>+ Nhập sai định dạng UID, không bật Like cho tất cả sẽ không được hoàn tiền</p>
<p>+ Nếu gặp lỗi, quý khách vui lòng liên hệ hỗ  trợ trực tuyến</p>
<p>+ Like nhảy sau khoảng 1-5p sau khi mua</p>
<p>+ Không cài 1 id nhiều đơn, đơn cũ lên xong rồi mới cài thêm</p>
<p>+ Không mua đơn nhiều site 1 lúc, tụt hay thiếu không hỗ trợ</p>
<p>+ Một vài bài share chứa link có thể sẽ lỗi không lên Like</p>
<p>+ Một trang cá nhân chỉ được mua 1 đơn cùng lúc, đơn cũ chưa xong mà mua thêm sẽ lỗi .</p>
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
function submit(){if(!$('#idpost')['val']()){swal('ERROR','Bạn chưa nhập UID cần tăng Vip','error')}
else {if(!$('.form-check-input:checked')['val']()){swal('ERROR','Bạn chưa chọn Server Buff','error')}
else {if(!$('#goivip')['val']()){swal('ERROR','Bạn chưa chọn gói Vip','error')}
else {if(!$('#tgdtm')['val']()){swal('ERROR','Bạn chưa chọn thời gian duy trì','error')}
else {if(!$('#time')['val']()){swal('ERROR','Bạn chưa chọn thời gian sử dụng','error')}
else {if(!$('#ghltmn')['val']()){swal('ERROR','Bạn chưa chọn giới hạn live trong ngày','error')}
else {if(!$('#sll')['val']()){swal('ERROR','Bạn chưa chọn số lần live tối đa trong thời gian sử dụng','error')}
else {if(!$('#note')['val']()){swal('ERROR','Bạn chưa ghi chú cho đơn','error')}
else {
    $(document).ajaxStart(function () {
            $("#submit").attr("disabled", true);
        });    
    nap()}}}}}}}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
$['post']('respawn/vipmatlive.html',{
    idpost:$('#idpost')['val'](),
    server:$('.form-check-input:checked')['val'](),
    goivip:$('#goivip')['val'](),
    tgdtm:$('#tgdtm')['val'](),
    time:$('#time')['val'](),
    ghltmn:$('#ghltmn')['val'](),
    sll:$('#sll')['val'](),
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

