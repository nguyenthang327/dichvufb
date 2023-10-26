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
mysqli_query($ketnoi,"DELETE FROM `danhmuccon` WHERE `id`='$target' AND `webdinhdanh` = '$domain'");
mysqli_query($ketnoi,"DELETE FROM `chietkhau` WHERE `madichvu`='$target' AND `webdinhdanh` = '$domain'");
	die('<script type="text/javascript">swal("Thông báo","Xóa thành công !","success"); setTimeout(function(){ location.href = "/administrator/function.html" },2000);</script>');
}elseif($action == 'edit'){
$databak = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuccon` WHERE `id` ='$target' AND `webdinhdanh` = '$domain'"));  
$danhmuctinhnang = $databak['danhmuctinhnang']; 
$sapxep = $databak['sapxep']; 
$webnguon = $databak['webnguon']; 
$action = $databak['action']; 
$tendichvucon = $databak['tendichvucon']; 
$idbank = $databak['id'];
}else{
$danhmuctinhnang = ''; 
$sapxep = ''; 
$webnguon = ''; 
$action = ''; 
$tendichvucon = ''; 
$idbank = '';
}
    }else{
$danhmuctinhnang = ''; 
$sapxep = ''; 
$webnguon = ''; 
$action = ''; 
$tendichvucon = ''; 
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
            <h1 class="m-0"><i class="fas fa-wrench"></i> Quản Lý Tính Năng</h1>
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
<h3 class="card-title"> Quản Lý Tính Năng</h3>
</div>


<div>
<div class="card-body">
    <div class="form-group">
                                        <label for="disabledInput">Chọn Danh Mục Con</label>
<select class="form-control" aria-label="Default select example" id="danhmucb" name="danhmucb">                                        
<?php                              
$respawn1a = mysqli_query($ketnoi,"SELECT * FROM `danhmuctinhnang` WHERE `webdinhdanh` = '$domain'");
if (mysqli_num_rows($respawn1a) == 0):
?><p>Không có danh mục con nào !</p>
<?php else: while ($row1a = mysqli_fetch_array($respawn1a, MYSQLI_ASSOC)):?>
<option value="<?=$row1a['id']?>" <?php if($danhmuctinhnang == $row1a['id']){echo 'selected="selected"';} ?>>[ID: <?=$row1a['id']?>]<?=$row1a['tendichvu']?> (
<?php
$madanhmuc = $row1a['danhmuc'];
$databak1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuc` WHERE `id` ='$madanhmuc' AND `webdinhdanh` = '$domain'"));  
$danhmuc = $databak1['tendichvu']; 
echo $danhmuc;
?>
)</option>
<?php endwhile; endif; ?> 
</select>
                                    </div>
<div class="form-group">
 <input type="hidden" id="idbanka" name="idbanka" value="<?=$idbank?>">    
                                        <label for="disabledInput">Tên Tính Năng</label>
                                        <input type="text" class="form-control" id="tentinhnang" name="tentinhnang" placeholder="Ví dụ: Like Facebook Rẻ" value="<?=$tendichvucon?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Sắp Xếp (1-99)</label>
                                        <input  type="number" class="form-control" id="sapxep" name="sapxep" placeholder="1" value="<?=$sapxep?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Web nguồn</label>
                                     <select class="form-control" aria-label="Default select example" id="webnguon" name="webnguon">                                        
<?php                              
$respawn1a = mysqli_query($ketnoi,"SELECT * FROM `token` WHERE `webdinhdanh` = '$domain'");
if (mysqli_num_rows($respawn1a) == 0):
?><p>Không có web nguồn nào !</p>
<?php else: while ($row1a = mysqli_fetch_array($respawn1a, MYSQLI_ASSOC)):?>
<option value="<?=$row1a['webnguon']?>" <?php if($webnguon == $row1a['webnguon']){echo 'selected="selected"';} ?>><?=$row1a['webnguon']?> - (<?php if($row1a['type'] == 'normal'){echo 'Đấu nối sever Việt Nam';}if($row1a['type'] == 'smm'){echo 'Đấu nối SMM Panel';}if($row1a['type'] == 'dontay'){echo 'Đơn tay';}?>) </option>
<?php endwhile; endif; ?> 
</select>   
                                    </div>
 <div class="form-group">
                                        <label for="disabledInput">Trạng thái</label>
                                     <select class="form-control" aria-label="Default select example" id="trangthai" name="trangthai">                                        
<option value="on" <?php if($action == $row1a['action']){echo 'selected="selected"';} ?>>Bật</option>
<option value="off" <?php if($action == $row1a['action']){echo 'selected="selected"';} ?>>Tắt</option>
</select>   
                                    </div>
</div>

<div class="card-footer">
<center><button onclick="submit();" type="submit" id="submit" id="submit" class="btn btn-primary btn-lg"><i class="fas fa-cogs"></i> Cấu hình</button>
<button onclick="location.href='/administrator/function.html'" type="submit" id="submit" id="submit" class="btn btn-danger btn-lg"> Reload</button>
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
                                                    <th>Danh Mục Con</th>
                                                    <th>Tên Tính Năng</th>
                                                    <th>Nguồn gốc</th>
                                                    <th>Trạng Thái</th>
                                                    <th>Ngày Thêm</th>
                                                    <th>Định Dạng</th>
                                                    <th>Thao tác</th>
                        </tr>
                      </thead>
                                                                  <tbody>
                                            <?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `danhmuccon` WHERE `webdinhdanh` = '$domain'"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `danhmuccon` WHERE `webdinhdanh` = '$domain' LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td></tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['sapxep'] ?></td>
                                                    <td><?php 
                                                    $dataad = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuctinhnang` WHERE `id`='".$row['danhmuctinhnang']."' AND `webdinhdanh` ='$domain'"));
                                                    echo $dataad['tendichvu']; 
                                                    
                                                    ?></td>
                                                    <td><?php echo $row['tendichvucon'] ?></td>
                                                    <td><?php echo $row['webnguon'] ?></td>
                                                    <td><?php echo $row['action'] ?></td>
                                                    <td><?php echo $row['time'] ?></td>
                                                    <td><?php echo $row['type'] ?></td>
                                                    <td><a class="btn btn-success" href="/administrator/function.html?action=edit&target=<?php echo $row['id'] ?>">Edit</a> 
                                                    
                                                    <a onclick="return confirm('Hành động nguy hiểm - Hành động này có thể gây nguy hại đến tính năng trên website , xác nhận xóa nhấn OK, chưa chắc nhấn Hủy')" href="/administrator/function.html?action=del&target=<?php echo $row['id'] ?>" class="btn btn-danger">Xóa</a>
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
function submit(){if(!$('#danhmucb')['val']()){swal('ERROR','Tên danh mục con là gì ?','error')}
else {if(!$('#tentinhnang')['val']()){swal('ERROR','Tên tính năng là gì ?','error')}
else {if(!$('#sapxep')['val']()){swal('ERROR','Vui lòng sắp xếp danh mục con','error')}
else {if(!$('#webnguon')['val']()){swal('ERROR','Hãy chọn web nguồn cho dịch vụ !','error')}
else {if(!$('#trangthai')['val']()){swal('ERROR','Hãy chọn trạng thái !','error')}
else {nap()}}}}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
$['post']('../action/admin.php',{
    danhmucb:$('#danhmucb')['val'](),
    tentinhnang:$('#tentinhnang')['val'](),
    sapxep:$('#sapxep')['val'](),
    webnguon:$('#webnguon')['val'](),
    trangthai:$('#trangthai')['val'](),
    idbanka:$('#idbanka')['val']()},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('<i class="fas fa-cogs"></i> Cấu hình thêm')},'json')}
</script>           
 <?php
include('page/footer.php');
}
?>

