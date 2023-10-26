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
mysqli_query($ketnoi,"DELETE FROM `sanpham` WHERE `id`='$target'");
	die('<script type="text/javascript">swal("Thông báo","Xóa thành công !","success"); setTimeout(function(){ location.href = "/administrator/sanpham.html" },2000);</script>');
}
    }
if(isset($_POST['checkid'])){
$id = addslashes($_POST['checkid']);
$dem  = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `sanpham` WHERE `masanpham` ='".mysqli_real_escape_string($ketnoi,$id)."'"));
if($dem > 0){
$tanbien  =  "WHERE `masanpham` = '$id'";   
}else{
$tanbien  =  "WHERE `id` = '$id'";    
}
}else{
$tanbien = "";   
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
            <h1 class="m-0"><i class="fas fa-folder"></i> Upload Clone</h1>
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
<h3 class="card-title"> Upload Clone</h3>
</div>


<div>
<div class="card-body">
 <div class="form-group">
                                        <label for="disabledInput">Chọn Sản Phẩm</label>
<select class="form-control" aria-label="Default select example" id="sanpham" name="sanpham">                                        
<?php                              
$respawn1a = mysqli_query($ketnoi,"SELECT * FROM `productcon`");
if (mysqli_num_rows($respawn1a) == 0):
?><p>Không có sản phẩm nào !</p>
<?php else: while ($row1a = mysqli_fetch_array($respawn1a, MYSQLI_ASSOC)):
$law = $row1a['madanhmuc'];    
$madanhmuc = mysqli_fetch_array(mysqli_query($ketnoi,"SELECT * FROM `product` WHERE `madanhmuc` = '$law'"));
?>
<option value="<?=$row1a['masanpham']?>"><?=$madanhmuc['tendanhmuc']?> - Quốc Gia: <?=$row1a['nation']?> - <?=$row1a['tensanpham']?> - <?=$row1a['motangan']?></option>
<?php endwhile; endif; ?> 
</select>
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">LIST SẢN PHẨM (Mỗi dòng một acc)</label>
                                        <textarea id="acc" name="acc" rows="4" cols="50" placeholder="MỖI DÒNG 1 ACC" class="form-control"></textarea>
                                    </div>
                                    
                        

</div>

<div class="card-footer">
<center><button onclick="submit();" type="submit" id="submit" id="submit" class="btn btn-primary btn-lg"><i class="fas fa-cogs"></i> UPLOAD</button>
<button onclick="location.href='/administrator/sanpham.html'" type="submit" id="submit" id="submit" class="btn btn-danger btn-lg"> Reload</button>
</center>
</div>
</div>
</div> 
 </div> 
 <div class="col-md-12">
<form action="" method="POST">
                                    <div class="form-group">
                                        <label for="disabledInput">Lọc Sản Phẩm Đã Thêm</label>
                                        <select class="form-control" aria-label="Default select example" id="checkid" name="checkid">                                        
<?php                              
$respawn1a = mysqli_query($ketnoi,"SELECT * FROM `productcon`");
if (mysqli_num_rows($respawn1a) == 0):
?><p>Không có sản phẩm nào !</p>
<?php else: while ($row1a = mysqli_fetch_array($respawn1a, MYSQLI_ASSOC)):
$law = $row1a['madanhmuc'];    
$madanhmuc = mysqli_fetch_array(mysqli_query($ketnoi,"SELECT * FROM `product` WHERE `madanhmuc` = '$law'"));
?>
<option value="<?=$row1a['masanpham']?>"><?=$madanhmuc['tendanhmuc']?> - Quốc Gia: <?=$row1a['nation']?> - <?=$row1a['tensanpham']?> - <?=$row1a['motangan']?></option>
<?php endwhile; endif; ?> 
</select>
                                    </div> <br>    
                                    <div class="form-group">
                                      <button type="submit" id="submit" id="submit" class="btn btn-success">  Tìm Kiếm</button>
                                      <a class="btn btn-danger" href="/administrator/sanpham.html">Reset</a>
                                    </div>
                                    </form>
 </div> 
<div class="col-md-12"> 
              <div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Sản Phẩm Đã Thêm</h3>
</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                                                    <th>Sản Phẩm</th>
                                                    <th>Người Mua</th>
                                                    <th>Info</th>
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
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `sanpham` $tanbien"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `sanpham` $tanbien LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td></tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php 
                                                    $law1 = $row['masanpham'];    
$madanhmuca = mysqli_fetch_array(mysqli_query($ketnoi,"SELECT * FROM `productcon` WHERE `masanpham` = '$law1'"));
                                                    
                                                    echo $madanhmuca['tensanpham'] ?></td>
                                                    <td><?php echo $row['username'] ?></td>
                                                    <td><?php echo $row['info'] ?></td>
                                                    <td><?php echo $row['status'] ?></td>
                                                    <td>
                                                    <a onclick="return confirm('Hành động nguy hiểm - Hành động này có thể gây nguy hại đến tính năng trên website , xác nhận xóa nhấn OK, chưa chắc nhấn Hủy')" href="/administrator/sanpham.html?action=del&target=<?php echo $row['id'] ?>" class="btn btn-danger">Xóa</a>
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
function submit(){if(!$('#sanpham')['val']()){swal('ERROR','Vui lòng chọn sản phẩm !','error')}
else {if(!$('#acc')['val']()){swal('ERROR','Vui lòng nhập acc','error')}
else {nap()}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
$['post']('../action/admin.php',{
    sanpham:$('#sanpham')['val'](),
    acc:$('#acc')['val'](),
    type: 'add'},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('<i class="fas fa-cogs"></i> Thêm Acc')},'json')}
</script>           
 <?php
include('page/footer.php');
}
?>

