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
mysqli_query($ketnoi,"DELETE FROM `token` WHERE `id`='$target' AND `webdinhdanh` = '$domain'");
	die('<script type="text/javascript">swal("Thông báo","Xóa thành công !","success"); setTimeout(function(){ location.href = "/administrator/token.html" },2000);</script>');
}elseif($action == 'edit'){
$databak = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `id` ='$target' AND `webdinhdanh` = '$domain'"));  
$idbank = $databak['id']; 
$webnguon = $databak['webnguon']; 
$reaction = $databak['type']; 
$token = $databak['token'];
}else{
$idbank = ''; 
$webnguon = ''; 
$reaction = ''; 
$token = ''; 
}
    }else{
$idbank = ''; 
$webnguon = ''; 
$reaction = ''; 
$token = '';  
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
            <h1 class="m-0"><i class="fas fa-link"></i> Quản Lý Token đối tác</h1>
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
<h3 class="card-title"> Quản Lý Token đối tác</h3>
</div>


<div>
<div class="card-body">
    <div class="form-group">
                                        <label for="disabledInput">Mã web nguồn (Viết liền không dấu)</label>
<input type="text" class="form-control" id="webnguon" name="webnguon" placeholder="Ví dụ: subgiare,5gsmm,baostar,..." value="<?=$webnguon?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="disabledInput">Định dạng</label>
                                     <select class="form-control" aria-label="Default select example" id="schoice" name="schoice">                                         <option value="normal" <?php if($reaction == 'normal'){echo 'selected="selected"';} ?>>Server Việt Nam</option>
                                                    <option value="smm" <?php if($reaction == 'smm'){echo 'selected="selected"';} ?>>Server SMM</option>
                                                    <option value="dontay" <?php if($reaction == 'dontay'){echo 'selected="selected"';} ?>>Đơn Tay (Chỉ thêm 1 lần )</option>
</select> 
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Token - API (Đơn tay sử dụng Telegram định dạng: Token/idchat)</label>
                                     <input  type="text" class="form-control" id="token" name="token" placeholder="" value= "<?=$token?>"> 
                                     <input  type="hidden" class="form-control" id="idbankd" name="idbankd" value="<?=$idbank?>"> 
                                    </div>

<div class="card-footer">
<center><button onclick="submit();" type="submit" id="submit" id="submit" class="btn btn-primary btn-lg"><i class="fas fa-cogs"></i> Cấu hình</button>
<button onclick="location.href='/administrator/token.html'" type="submit" id="submit" id="submit" class="btn btn-danger btn-lg"> Reload</button>
</center>
</div>
</div>
</div> 
 </div> 
 
<div class="col-md-12"> 
              <div class="card card-primary">
<div class="card-header">
<h3 class="card-title">API - Token đã thêm</h3>
</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                                                    <th>Type</th>
                                                    <th>Token</th>
                                                    <th>Web nguồn (Định danh)</th>
                                                    <th>Trạng Thái</th>
                                                    <th>Thao tác</th>
                        </tr>
                      </thead>
                                                                  <tbody>
                                            <?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `token` WHERE `webdinhdanh` = '$domain'"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `token` WHERE `webdinhdanh` = '$domain' LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td></tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['type'] ?></td>
                                                    <td>
                                                    <textarea class="form-control" readonly="" rows="2"><?php echo $row['token'] ?></textarea>
                                                    </td>
                                                    <td><?php echo $row['webnguon'] ?></td>
                                                    <td><?php echo $row['status'] ?></td>
                                                    <td><a class="btn btn-success" href="/administrator/token.html?action=edit&target=<?php echo $row['id'] ?>">Edit</a> 
                                                    
                                                    <a onclick="return confirm('Hành động nguy hiểm - Hành động này có thể gây nguy hại đến tính năng trên website , xác nhận xóa nhấn OK, chưa chắc nhấn Hủy')" href="/administrator/token.html?action=del&target=<?php echo $row['id'] ?>" class="btn btn-danger">Xóa</a>
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
function submit(){if(!$('#webnguon')['val']()){swal('ERROR','Vui lòng nhập mã Web nguồn','error')}
else {if(!$('#schoice')['val']()){swal('ERROR','Vui lòng chọn định dạng','error')}
else {if(!$('#token')['val']()){swal('ERROR','Hãy nhập Token','error')}
else {nap()}}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
$['post']('../action/admin.php',{
    idbankd:$('#idbankd')['val'](),
    webnguon:$('#webnguon')['val'](),
    schoice:$('#schoice')['val'](),
    token:$('#token')['val']()},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('<i class="fas fa-cogs"></i> Cấu hình thêm')},'json')}
</script>           
 <?php
include('page/footer.php');
}
?>

