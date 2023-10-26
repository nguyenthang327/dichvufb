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
mysqli_query($ketnoi,"DELETE  FROM `productcon` WHERE `id`='$target'");
	die('<script type="text/javascript">swal("Thông báo","Xóa thành công !","success"); setTimeout(function(){ location.href = "/administrator/floder-con-clone.html" },2000);</script>');
}elseif($action == 'edit'){
$databak = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `productcon` WHERE `id` ='$target'"));  
$danhmuc = $databak['madanhmuc']; 
$tensanpham = $databak['tensanpham']; 
$motangan = $databak['motangan']; 
$masanpham = $databak['masanpham']; 
$nation = $databak['nation']; 
$dongia = $databak['dongia']; 
$idbank = $databak['id']; 

}else{
$danhmuc = '';     
$tensanpham = ''; 
$motangan = ''; 
$masanpham = ''; 
$nation = ''; 
$dongia = ''; 
 
$idbank = '';
}
    }else{
$danhmuc = '';         
$tensanpham = ''; 
$motangan = ''; 
$masanpham = ''; 
$nation = ''; 
$dongia = ''; 

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
            <h1 class="m-0"><i class="far fa-folder-open"></i> Quản Lý Sản Phẩm</h1>
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
<h3 class="card-title"> Quản Lý Sản Phẩm</h3>
</div>


<div>
<div class="card-body">
    <div class="form-group">
                                        <label for="disabledInput">Chọn Danh Mục</label>
<select class="form-control" aria-label="Default select example" id="danhmuca" name="danhmuca">                                        
<?php                              
$respawn1a = mysqli_query($ketnoi,"SELECT * FROM `product`");
if (mysqli_num_rows($respawn1a) == 0):
?><p>Không có danh mục nào !</p>
<?php else: while ($row1a = mysqli_fetch_array($respawn1a, MYSQLI_ASSOC)):?>
<option value="<?=$row1a['madanhmuc']?>" <?php if($danhmuc == $row1a['madanhmuc']){echo 'selected="selected"';} ?>><?=$row1a['tendanhmuc']?></option>
<?php endwhile; endif; ?> 
</select>
                                    </div>
<div class="form-group">
 <input type="hidden" id="idbanka" name="idbanka" value="<?=$idbank?>">    
                                        <label for="disabledInput">Tên Sản Phẩm</label>
                                        <input type="text" class="form-control" id="danhmuccon" name="danhmuccon" placeholder="Ví dụ: Via clone kèm 2FA" value="<?=$tensanpham?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Mô Tả Ngắn</label>
                                        <input  type="text" class="form-control" id="motangan" name="motangan" placeholder="UID | PASS | 2FA | COOKIE | TOKEN | USERAGENT" value="<?=$motangan?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Mã Sản Phẩm</label>
                                        <input  type="number" class="form-control" id="masanpham" name="masanpham" placeholder="1" value="<?=$masanpham?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Quốc Gia</label>
                                        <input  type="text" class="form-control" id="nation" name="nation" placeholder='vn' value='<?=$nation?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Đơn giá / 1 Sản Phẩm</label>
                                        <input  type="number" class="form-control" id="dongia" name="dongia" placeholder='1000' value='<?=$dongia?>'>
                                    </div>
                                   

</div>

<div class="card-footer">
<center><button onclick="submit();" type="submit" id="submit" id="submit" class="btn btn-primary btn-lg"><i class="fas fa-cogs"></i> Cấu hình</button>
<button onclick="location.href='/administrator/floder-con-clone.html'" type="submit" id="submit" id="submit" class="btn btn-danger btn-lg"> Reload</button>
</center>
</div>
 <p><center><img src="../dist/img/68747470733a2f2f7261772e6769746875622e636f6d2f6a6f69656c6563686f6e672f69736f2d636f756e7472792d666c6167732d7376672d636f6c6c656374696f6e2f6d61737465722f6578616d706c65732f69736f2d636f756e7472792d666c616773.png"></center></p>
</div>
</div> 
 </div> 
 
<div class="col-md-12"> 
              <div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Sản Phẩm đã thêm</h3>
</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                                                    <th>Tên Sản Phẩm</th>
                                                    <th>Mô Tả Ngắn</th>
                                                    <th>Danh Mục</th>
                                                    <th>Mã Sản Phẩm</th>
                                                    <th>Quốc Gia</th>
                                                    <th>Đơn Giá</th>
                                                    <th>Thao tác</th>
                        </tr>
                      </thead>
                                                                  <tbody>
                                            <?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `productcon`"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `productcon` LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td></tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['tensanpham'] ?></td>
                                                     <td><?php echo $row['motangan'] ?></td>
                                                    <td><?php 
                                                    $dataad = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `product` WHERE `madanhmuc`='".$row['madanhmuc']."'"));
                                                    echo $dataad['tendanhmuc']; 
                                                    
                                                    ?></td>
                                                    <td><?php echo $row['masanpham'] ?></td>
                                                    <td><?php echo $row['nation'] ?></td>
                                                    <td><?php echo number_format($row['dongia'],'0','.','.') ?> VNĐ</td>
                                                    <td><a class="btn btn-success" href="/administrator/floder-con-clone.html?action=edit&target=<?php echo $row['id'] ?>">Edit</a> 
                                                    
                                                    <a onclick="return confirm('Hành động nguy hiểm - Hành động này có thể gây nguy hại đến tính năng trên website , xác nhận xóa nhấn OK, chưa chắc nhấn Hủy')" href="/administrator/floder-con-clone.html?action=del&target=<?php echo $row['id'] ?>" class="btn btn-danger">Xóa</a>
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
function submit(){if(!$('#danhmuccon')['val']()){swal('ERROR','Tên sản phẩm là gì ?','error')}
else {if(!$('#danhmuca')['val']()){swal('ERROR','Danh Mục là gì ?','error')}
else {if(!$('#motangan')['val']()){swal('ERROR','Mô Tả Sản Phẩm là gì ?','error')}
else {if(!$('#masanpham')['val']()){swal('ERROR','Mã Sản Phẩm là gì','error')}
else {if(!$('#nation')['val']()){swal('ERROR','Chọn Quốc Gia !','error')}
else {if(!$('#dongia')['val']()){swal('ERROR','Đơn Giá !','error')}
else {nap()}}}}}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
$['post']('../action/admin.php',{
    danhmuca:$('#danhmuca')['val'](),
    danhmuccon:$('#danhmuccon')['val'](),
    motangan:$('#motangan')['val'](),
    masanpham:$('#masanpham')['val'](),
    nation:$('#nation')['val'](),
    dongia:$('#dongia')['val'](),
    idbanka:$('#idbanka')['val']()},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('<i class="fas fa-cogs"></i> Cấu hình thêm')},'json')}
</script>           
 <?php
include('page/footer.php');
}
?>

