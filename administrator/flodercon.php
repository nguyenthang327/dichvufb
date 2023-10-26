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
mysqli_query($ketnoi,"DELETE  FROM `danhmuctinhnang` WHERE `id`='$target' AND `webdinhdanh` = '$domain'");
mysqli_query($ketnoi,"DELETE  FROM `danhmuccon` WHERE `danhmuctinhnang`='$target' AND `webdinhdanh` = '$domain'");
	die('<script type="text/javascript">swal("Thông báo","Xóa thành công !","success"); setTimeout(function(){ location.href = "/administrator/flodercon.html" },2000);</script>');
}elseif($action == 'edit'){
$databak = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuctinhnang` WHERE `id` ='$target' AND `webdinhdanh` = '$domain'"));  
$danhmuc = $databak['danhmuc']; 
$sapxep = $databak['sapxep']; 
$tendichvu = $databak['tendichvu']; 
$icon = $databak['icon']; 
$idbank = $databak['id'];
}else{
$danhmuc = '';     
$sapxep = ''; 
$tendichvu = ''; 
$icon = ''; 
$idbank = '';
}
    }else{
$danhmuc = '';         
$sapxep = ''; 
$tendichvu = ''; 
$icon = ''; 
$idbank = '';
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
            <h1 class="m-0"><i class="far fa-folder-open"></i> Quản Lý Danh Mục Con</h1>
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
<h3 class="card-title"> Quản Lý Danh Mục Con</h3>
</div>


<div>
<div class="card-body">
    <div class="form-group">
                                        <label for="disabledInput">Chọn Danh Mục</label>
<select class="form-control" aria-label="Default select example" id="danhmuca" name="danhmuca">                                        
<?php                              
$respawn1a = mysqli_query($ketnoi,"SELECT * FROM `danhmuc` WHERE `webdinhdanh` = '$domain'");
if (mysqli_num_rows($respawn1a) == 0):
?><p>Không có danh mục nào !</p>
<?php else: while ($row1a = mysqli_fetch_array($respawn1a, MYSQLI_ASSOC)):?>
<option value="<?=$row1a['id']?>" <?php if($danhmuc == $row1a['id']){echo 'selected="selected"';} ?>><?=$row1a['tendichvu']?></option>
<?php endwhile; endif; ?> 
</select>
                                    </div>
<div class="form-group">
 <input type="hidden" id="idbanka" name="idbanka" value="<?=$idbank?>">    
                                        <label for="disabledInput">Tên Danh mục con</label>
                                        <input type="text" class="form-control" id="danhmuccon" name="danhmuccon" placeholder="Ví dụ: Like Facebook" value="<?=$tendichvu?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Sắp Xếp (1-99)</label>
                                        <input  type="number" class="form-control" id="sapxep" name="sapxep" placeholder="1" value="<?=$sapxep?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Icon hoặc mã nhúng bộ ảnh</label>
                                        <input  type="text" class="form-control" id="icon1" name="icon1" placeholder='<i class="fab fa-facebook-square"></i> hoặc <img src="link ảnh" width="Kích cỡ px">' value='<?=$icon?>'>
                                    </div>
                                    <p><i>- Thư viện icon Font fontawesome V5 vip siêu cấp vô địch: <a href="https://fontawesome.com/v5/search" target="blank">https://fontawesome.com/v5/search</a></i></p>

</div>

<div class="card-footer">
<center><button onclick="submit();" type="submit" id="submit" id="submit" class="btn btn-primary btn-lg"><i class="fas fa-cogs"></i> Cấu hình</button>
<button onclick="location.href='/administrator/flodercon.html'" type="submit" id="submit" id="submit" class="btn btn-danger btn-lg"> Reload</button>
</center>
</div>
</div>
</div> 
 </div> 
 
<div class="col-md-12"> 
              <div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Danh mục con đã thêm</h3>
</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                                                    <th>Sắp xếp</th>
                                                    <th>Danh Mục</th>
                                                    <th>Tên danh mục con</th>
                                                    <th>Icon</th>
                                                    <th>Ngày thêm</th>
                                                    <th>Thao tác</th>
                        </tr>
                      </thead>
                                                                  <tbody>
                                            <?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `danhmuctinhnang` WHERE `webdinhdanh` = '$domain'"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `danhmuctinhnang` WHERE `webdinhdanh` = '$domain' LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td></tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['sapxep'] ?></td>
                                                    <td><?php 
                                                    $dataad = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuc` WHERE `id`='".$row['danhmuc']."' AND `webdinhdanh` ='$domain'"));
                                                    echo $dataad['tendichvu']; 
                                                    
                                                    ?></td>
                                                    <td><?php echo $row['tendichvu'] ?></td>
                                                    <td><?php echo $row['icon'] ?></td>
                                                    <td><?php echo $row['time'] ?></td>
                                                    <td><a class="btn btn-success" href="/administrator/flodercon.html?action=edit&target=<?php echo $row['id'] ?>">Edit</a> 
                                                    
                                                    <a onclick="return confirm('Hành động nguy hiểm - Hành động này có thể gây nguy hại đến tính năng trên website , xác nhận xóa nhấn OK, chưa chắc nhấn Hủy')" href="/administrator/flodercon.html?action=del&target=<?php echo $row['id'] ?>" class="btn btn-danger">Xóa</a>
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
function submit(){if(!$('#danhmuca')['val']()){swal('ERROR','Tên danh mục là gì ?','error')}
else {if(!$('#danhmuccon')['val']()){swal('ERROR','Tên danh mục con là gì ?','error')}
else {if(!$('#sapxep')['val']()){swal('ERROR','Vui lòng sắp xếp danh mục con','error')}
else {if(!$('#icon1')['val']()){swal('ERROR','Hãy tặng cho tôi 1 icon xinh đẹp !','error')}
else {nap()}}}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
$['post']('../action/admin.php',{
    danhmuca:$('#danhmuca')['val'](),
    danhmuccon:$('#danhmuccon')['val'](),
    sapxep:$('#sapxep')['val'](),
    icon1:$('#icon1')['val'](),
    idbanka:$('#idbanka')['val']()},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('<i class="fas fa-cogs"></i> Cấu hình thêm')},'json')}
</script>           
 <?php
include('page/footer.php');
}
?>

