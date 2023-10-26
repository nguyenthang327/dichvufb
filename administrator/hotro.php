<?php
include('../system/config.php');
if(!isset($_SESSION['username'])){
header('location:/');  
exit();
}elseif($admin !== 'yes'){
header('location:/');  
exit();
}else{
include('../system/thongke.php');
include('page/header.php');
include('page/menu.php');
if(isset($_GET['action'])&&isset($_GET['target'])){
$action = addslashes($_GET['action']);
$target = addslashes($_GET['target']);
if($action == 'del'){
mysqli_query($ketnoi,"DELETE FROM `support` WHERE `id`='$target' AND `webdinhdanh` = '$domain'");
	die('<script type="text/javascript">swal("Thông báo","Xóa thành công !","success"); setTimeout(function(){ location.href = "/administrator/hotro.html" },2000);</script>');
    
}elseif($action == 'edit'){
$databak = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `support` WHERE `id`='$target' AND `webdinhdanh` = '$domain'"));  
$noidung = $databak['noidung']; 
$idthongbao  = $databak['id']; 
$callback = "?action=edit&target=$idthongbao";
}
}else{
 $noidung = '';   
    $id = '';
    $callback='';
}
?>

    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-life-ring"></i> Hỗ trợ khách hàng</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Panel Admin Ver 3.2.0</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
 <div class="row">
<div class="col-md-12">
<div class="card card-primary">
<div class="card-header">
<h3 class="card-title"> Hỗ trợ khách hàng</h3>
</div>


<div>
<div class="card-body">

                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="idchat" name="idchat" value="<?=$idthongbao?>">
                                        <p><?=$noidung?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Nội dung trả lời</label>
                                     <textarea id="summernote" name="summernote" style="min-height: 500px;">
                                 
                                     </textarea>
                                    </div>

<div class="card-footer">
<center><button onclick="submit();" type="submit" id="submit" id="submit" class="btn btn-primary btn-lg"><i class="fas fa-cogs"></i> Phản hồi</button>
</center>
</div>
</div>
</div> 
 </div> 
 
<div class="col-md-12"> 
              <div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Các yêu cầu hỗ trợ</h3>
</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Mã đơn</th>
<th>Cấp độ</th>
<th>Thời gian</th>
<th>Trạng thái</th>
<th>Hành động</th>
                        </tr>
                      </thead>
                                                                  <tbody>
                                            <?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `support` WHERE `webdinhdanh` ='$domain' ORDER by id DESC"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `support`  WHERE `webdinhdanh` ='$domain'  ORDER by id DESC LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td></tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
                                                <tr>
                                                      <td><?=$row['id']?></td>
<td><?=$row['codeoder']?></td>
<td><?=$row['level']?></td>
<td><?=$row['date']?></td>
<td><span class="badge bg-danger"><font color="white"><?=$row['status']?></font></span></td>
                                                    <td>
                                                    <a class="btn btn-success" href="/administrator/hotro.html?action=edit&target=<?php echo $row['id'] ?>">Phản hồi</a> 
                                                    <a onclick="return confirm('Xác nhận xóa nhấn OK, chưa chắc nhấn Hủy')" href="/administrator/hotro.html?action=del&target=<?php echo $row['id'] ?>" class="btn btn-danger">Xóa</a>
                                                    </td>
                                                </tr>
<?php $i++; endwhile; endif; ?>                                                
                                            </tbody>
                    </table>
                  </div>
                </div>
              </div>
<center><ul class="pagination">
<?
echo "<li class='page-item'><a class='page-link' href='?page=1'>".'Trang đầu'."</a> </li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item'><a class='page-link' href='?page=".$i."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' href='?page=$total_pages'>".'Trang cuối'."</a></li>";
?>
</ul></center>              
 </div>  
 
 </div> 
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
  
 <script type="text/javascript">
function submit(){if(!$('#idchat')['val']()){swal('ERROR','Vui lòng chọn yêu cầu hỗ trợ','error')}
else {if(!$('#summernote')['val']()){swal('ERROR','Vui lòng nhập nội dung','error')}
else {nap()}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
$['post']('../action/error.php',{
    idchat:$('#idchat')['val'](),
    summernote:$('#summernote')['val']()},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('<i class="fas fa-cogs"></i> Phản hồi thêm')},'json')
    $(document).ajaxComplete(function() {
            location.href = "/administrator/hotro.html<?=$callback?>";
        }); 
}
</script>           
 <?php
include('page/footer.php');
}
?>

