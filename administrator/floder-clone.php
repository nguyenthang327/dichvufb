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
mysqli_query($ketnoi,"DELETE FROM `product` WHERE `id`='$target'");
	die('<script type="text/javascript">swal("Thông báo","Xóa thành công !","success"); setTimeout(function(){ location.href = "/administrator/floder-clone.html" },2000);</script>');
}elseif($action == 'edit'){
$databak = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `product` WHERE `id` ='$target'"));   
$madanhmuc = $databak['madanhmuc']; 
$tendichvu = $databak['tendanhmuc']; 
$icon = $databak['url']; 
$idbank = $databak['id'];
$mau = $databak['giaodien'];
}else{
$madanhmuc = ''; 
$tendichvu = ''; 
$icon = ''; 
$idbank = '';
$mau = $databak['giaodien'];
}
    }else{
$madanhmuc = ''; 
$tendichvu = ''; 
$icon = ''; 
$idbank = '';
$mau = $databak['giaodien'];
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
            <h1 class="m-0"><i class="fas fa-folder"></i> Quản Lý Danh Mục Tính Năng</h1>
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
<h3 class="card-title"> Quản Lý Danh Mục Tính Năng</h3>
</div>


<div>
<div class="card-body">
<div class="form-group">
 <input type="hidden" id="idbank" name="idbank" value="<?=$idbank?>">    
                                        <label for="disabledInput">Tên Danh mục</label>
                                        <input type="text" class="form-control" id="danhmuc" name="danhmuc" placeholder="Ví dụ: Facebook" value="<?=$tendichvu?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Mã Danh Mục</label>
                                        <input  type="text" class="form-control" id="madanhmuc" name="madanhmuc" placeholder='1' value='<?=$madanhmuc?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Màu Sắc</label>
                                        <select class="form-control" aria-label="Default select example" id="danhmucclone" name="danhmucclone">  
                            <option value="success" <?php if($mau == 'success'){echo 'selected="selected"';} ?>>Màu Xanh Lá Cây</option>
                            <option value="danger" <?php if($mau == 'danger'){echo 'selected="selected"';} ?>>Màu Đỏ</option>
                            <option value="dark" <?php if($mau == 'dark'){echo 'selected="selected"';} ?>>Màu Đen</option>
                            <option value="primary" <?php if($mau == 'primary'){echo 'selected="selected"';} ?>>Màu Xanh Đậm</option>
                            <option value="info" <?php if($mau == 'info'){echo 'selected="selected"';} ?>>Màu Xanh Dương</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Bộ icon</label>
                                        <input  type="text" class="form-control" id="icon" name="icon" placeholder='/brand/facebook/facebook.png' value='<?=$icon?>'>
                                    </div>
                        

</div>

<div class="card-footer">
<center><button onclick="submit();" type="submit" id="submit" id="submit" class="btn btn-primary btn-lg"><i class="fas fa-cogs"></i> Cấu hình</button>
<button onclick="location.href='/administrator/floder-clone.html'" type="submit" id="submit" id="submit" class="btn btn-danger btn-lg"> Reload</button>
</center>
</div>
</div>
</div> 
 </div> 
 
<div class="col-md-12"> 
              <div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Danh mục đã thêm</h3>
</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                                                    <th>Tên danh mục</th>
                                                    <th>Icon</th>
                                                    <th>Hiển Thị</th>
                                                    <th>Mã danh mục</th>
                                                    <th>Thao tác</th>
                        </tr>
                      </thead>
                                                                  <tbody>
                                            <?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `product`"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `product` LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td></tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['tendanhmuc'] ?></td>
                                                    <td><?php echo $row['url'] ?></td>
                                                    <td><img src="<?php echo $row['url'] ?>" width="50px"></td>
                                                    <td><?php echo $row['madanhmuc'] ?></td>
                                                    <td><a class="btn btn-success" href="/administrator/floder-clone.html?action=edit&target=<?php echo $row['id'] ?>">Edit</a> 
                                                    
                                                    <a onclick="return confirm('Hành động nguy hiểm - Hành động này có thể gây nguy hại đến tính năng trên website , xác nhận xóa nhấn OK, chưa chắc nhấn Hủy')" href="/administrator/floder-clone.html?action=del&target=<?php echo $row['id'] ?>" class="btn btn-danger">Xóa</a>
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
function submit(){if(!$('#danhmuc')['val']()){swal('ERROR','Tên danh mục là gì ?','error')}
else {if(!$('#madanhmuc')['val']()){swal('ERROR','Mã danh mục là gì ?','error')}
else {if(!$('#icon')['val']()){swal('ERROR','Hãy tặng cho tôi 1 icon xinh đẹp !','error')}
else {nap()}}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
$['post']('../action/admin.php',{
    danhmuc:$('#danhmuc')['val'](),
    madanhmuc:$('#madanhmuc')['val'](),
    danhmucclone:$('#danhmucclone')['val'](),
    icon:$('#icon')['val'](),
    idbank:$('#idbank')['val']()},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('<i class="fas fa-cogs"></i> Cấu hình thêm')},'json')}
</script>           
 <?php
include('page/footer.php');
}
?>

