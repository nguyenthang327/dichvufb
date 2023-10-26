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
mysqli_query($ketnoi,"DELETE FROM `chietkhau` WHERE `id`='$target' AND `webdinhdanh` = '$domain'");
	die('<script type="text/javascript">swal("Thông báo","Xóa thành công !","success"); setTimeout(function(){ location.href = "/administrator/server.html" },2000);</script>');
}elseif($action == 'edit'){
$databak = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `id` ='$target' AND `webdinhdanh` = '$domain'"));  
$brand = $databak['loaihinh']; 
$tinhnang = $databak['madichvu']; 
$tenserver = $databak['tendichvu']; 
$giagoc = $databak['giagoc'];
$server = $databak['server']; 
$cap0 = $databak['cap0']; 
$cap1 = $databak['cap1']; 
$cap2 = $databak['cap2']; 
$cap3 = $databak['cap3']; 
$cap4 = $databak['cap4']; 
$cap5 = $databak['cap5']; 
$min = $databak['min']; 
$max = $databak['max']; 
$reaction = $databak['reaction']; 
$comment = $databak['comment']; 
$minutes = $databak['minutes']; 
$dayvip = $databak['dayvip']; 
$mota = $databak['mota']; 
$note = $databak['note']; 
$status = $databak['status']; 
$idbank = $databak['id'];
$exchange = $databak['exchange'];
$kieu = $databak['type'];
$datawwebchinh =  mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `danhmuccon` WHERE `webdinhdanh` = '$domain' AND  `id` = '$tinhnang'"));  
$concatsa  = $datawwebchinh['id'];
}else{
$brand = ''; 
$tinhnang = ''; 
$tenserver = ''; 
$giagoc = ''; 
$server = ''; 
$cap0 = ''; 
$cap1 = ''; 
$cap2 = ''; 
$cap3 = ''; 
$cap4 = ''; 
$cap5 = ''; 
$min = ''; 
$max = ''; 
$reaction = ''; 
$comment = ''; 
$minutes = ''; 
$dayvip = ''; 
$mota = ''; 
$note = ''; 
$status = ''; 
$idbank = ''; 
$exchange = '';
$kieu = '';
}
    }else{
$brand = ''; 
$tinhnang = ''; 
$tenserver = ''; 
$giagoc = ''; 
$server = ''; 
$cap0 = ''; 
$cap1 = ''; 
$cap2 = ''; 
$cap3 = ''; 
$cap4 = ''; 
$cap5 = ''; 
$min = ''; 
$max = ''; 
$reaction = ''; 
$comment = ''; 
$minutes = ''; 
$dayvip = ''; 
$mota = ''; 
$note = ''; 
$status = ''; 
$idbank = '';
$exchange = '';
$kieu = '';
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
            <h1 class="m-0"><i class="fas fa-server"></i> Quản Lý Server</h1>
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
<h3 class="card-title"> Quản Lý Server</h3>
</div>


<div>
<div class="card-body">
    <div class="form-group">
                                        <label for="disabledInput">Brand</label>
<input type="text" class="form-control" id="brand" name="brand" placeholder="Ví dụ: Facebook" value="<?=$brand?>">
                                    </div>
<div class="form-group">
 <input type="hidden" id="idbankc" name="idbankc" value="<?=$idbank?>">    
                                        <label for="disabledInput">Chọn Tính Năng</label>
                                       <select class="form-control" aria-label="Default select example" id="tinhnang" name="tinhnang">                                        
<?php  
if(isset($kieu) && $kieu == 'normal'){
$bai = "AND `id` = '$concatsa'";    
}else{
$bai = '';    
}
$respawn1a = mysqli_query($ketnoi,"SELECT * FROM `danhmuccon` WHERE `webdinhdanh` = '$domain' $bai");
if (mysqli_num_rows($respawn1a) == 0):
?><p>Không có tính năng nào !</p>
<?php else: while ($row1a = mysqli_fetch_array($respawn1a, MYSQLI_ASSOC)):?>
<option value="<?=$row1a['id']?>" <?php if($tinhnang == $row1a['id']){echo 'selected="selected"';} ?>>[ID: <?=$row1a['id']?>]<?=$row1a['tendichvucon']?> - (<?php if($row1a['type'] == 'normal'){echo 'Đấu nối server Việt Nam';}if($row1a['type'] == 'smm'){echo 'Đấu nối SMM Panel';}if($row1a['type'] == 'dontay'){echo 'Đơn tay';}?>) </option>
<?php endwhile; endif; ?> 
</select>    
                                    </div>
                                <div class="row">    
                                    <div class="col-md-6">
                                        <label for="disabledInput">Tên Server</label>
                                     <input  type="text" class="form-control" id="tenserver" name="tenserver" placeholder="Ví dụ: Like Rẻ Nhất" value="<?=$tenserver?>"> 
                                    </div>
                                    <div class="col-md-6">
                                        <label for="disabledInput">Loại đơn</label>
                                       <select class="form-control" aria-label="Default select example" id="loaidonb" name="loaidonb">                                      <option value="goc">Theo tính năng</option>  
<?php   
if($kieu == ''){
$respawn1a = mysqli_query($ketnoi,"SELECT * FROM `token` WHERE `webdinhdanh` = '$domain' AND `type` !='normal'");
if (mysqli_num_rows($respawn1a) == 0):
?>
<?php else: while ($row1aa = mysqli_fetch_array($respawn1a, MYSQLI_ASSOC)):?>
<option value="<?=$row1aa['webnguon']?>" <?php if($kieu == $row1aa['webnguon']){echo 'selected="selected"';} ?>><?=$row1aa['webnguon']?> - (<?php if($row1aa['type'] == 'normal'){echo 'Đấu nối sever Việt Nam';}if($row1aa['type'] == 'smm'){echo 'Đấu nối SMM Panel';}if($row1aa['type'] == 'dontay'){echo 'Đơn tay';}?>) </option>
<?php endwhile; endif; }?> 
</select>    
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Server Gốc</label>
                                     <input  type="text" class="form-control" id="severgoc" name="severgoc" placeholder="Ví dụ: sever1" value="<?=$server?>"> 
                                    </div>
<div class="row">
<div class="form-group col-md-2">
      <label for="cap1">Giá gốc</label>
      <input type="text" class="form-control" id="giagoc" placeholder="Giá gốc để tính lãi" value="<?=$giagoc?>">
    </div>     
    <div class="form-group col-md-2">
      <label for="cap1">Member</label>
      <input type="text" class="form-control" id="giacap0" placeholder="Giá Member" value="<?=$cap0?>">
    </div>
<div class="form-group col-md-2">
      <label for="cap1">Cấp 1</label>
      <input type="text" class="form-control" id="giacap1" placeholder="Giá cấp 1" value="<?=$cap1?>">
    </div> 
    <div class="form-group col-md-2">
      <label for="cap2">Cấp 2</label>
      <input type="text" class="form-control" id="giacap2" placeholder="Giá cấp 2" value="<?=$cap2?>">
    </div>
    <div class="form-group col-md-2">
      <label for="cap3">Cấp 3</label>
      <input type="text" class="form-control" id="giacap3" placeholder="Giá cấp 3" value="<?=$cap3?>">
    </div>
    <div class="form-group col-md-2">
      <label for="cap4">Cấp 4</label>
      <input type="text" class="form-control" id="giacap4" placeholder="Giá cấp 4" value="<?=$cap4?>">
    </div>
    <div class="form-group col-md-2">
      <label for="cap5">Cấp 5</label>
      <input type="text" class="form-control" id="giacap5" placeholder="Giá cấp 5" value="<?=$cap5?>">
    </div>
</div> 
<div class="row">
<div class="form-group col-md-4">
      <label for="cap1">Tối Thiểu</label>
      <input type="text" class="form-control" id="min" name="min" placeholder="50" value="<?=$min?>">
    </div>     
<div class="form-group col-md-4">
      <label for="cap1">Tối Đa</label>
      <input type="text" class="form-control" id="max" max="max" placeholder="10000" value="<?=$max?>">
    </div> 
    <div class="form-group col-md-4">
      <label for="exchange">Giới Hạn/Ngày</label>
      <input type="text" class="form-control" id="exchange" max="exchange" placeholder="10000" value="<?=$exchange?>">
    </div> 
</div> 
<div class="row">
 <div class="form-group col-md-3">
                                        <label for="disabledInput">Tùy chọn Reaction</label>
                                     <select class="form-control" aria-label="Default select example" id="reaction" name="reaction">                                         <option value="yes" <?php if($reaction == 'yes'){echo 'selected="selected"';} ?>>Bật</option>
                                                    <option value="no" <?php if($reaction == 'no'){echo 'selected="selected"';} ?>>Tắt</option>
</select> 
                                    </div>
<div class="form-group col-md-3">
                                        <label for="disabledInput">Tùy chọn Comment</label>
                                   <select class="form-control" aria-label="Default select example" id="comment" name="comment">                                         <option value="yes" <?php if($comment == 'yes'){echo 'selected="selected"';} ?>>Bật</option>
                                                    <option value="no" <?php if($comment == 'no'){echo 'selected="selected"';} ?>>Tắt</option>
</select> 
                                    </div>
<div class="form-group col-md-3">
                                        <label for="disabledInput">Tùy chọn Minutes</label>
                                     <select class="form-control" aria-label="Default select example" id="minutes" name="minutes">                                         <option value="yes" <?php if($minutes == 'yes'){echo 'selected="selected"';} ?>>Bật</option>
                                                    <option value="no" <?php if($minutes == 'no'){echo 'selected="selected"';} ?>>Tắt</option>
</select> 
                                    </div>
<div class="form-group col-md-3">
                                        <label for="disabledInput">Tùy chọn Ngày Vip</label>
                                     <select class="form-control" aria-label="Default select example" id="dayvip" name="dayvip">                                         <option value="yes" <?php if($dayvip == 'yes'){echo 'selected="selected"';} ?>>Bật</option>
                                                    <option value="no" <?php if($dayvip == 'no'){echo 'selected="selected"';} ?>>Tắt</option>
</select> 
                                    </div>
</div>                                     
<div class="form-group">
                                        <label for="disabledInput">Mô tả tính năng</label>
                                     <textarea id="summernote" name="summernote">
                <?=$mota?>
              </textarea>
                                    </div> 
<div class="form-group">
                                        <label for="disabledInput">Mô tả ngắn</label>
                                    <input type="text" class="form-control" id="motangan" placeholder="Ví dụ: Like Rẻ tốc độ 50 Like / Ngày không bảo hành" value="<?=$note?>">
                                    </div> 
<div class="form-group">
                                        <label for="disabledInput">Trạng Thái</label>
                                    <select class="form-control" aria-label="Default select example" id="status" name="status">                                         <option value="on" <?php if($status == 'on'){echo 'selected="selected"';} ?>>Bật</option>
                                                    <option value="off" <?php if($status == 'off'){echo 'selected="selected"';} ?>>Tắt</option>
</select> 
                                    </div>                                     

<div class="card-footer">
<center><button onclick="submit();" type="submit" id="submit" id="submit" class="btn btn-primary btn-lg"><i class="fas fa-cogs"></i> Cấu hình</button>
<button onclick="location.href='/administrator/server.html'" type="submit" id="submit" id="submit" class="btn btn-danger btn-lg"> Reload</button>
</center>
</div>
</div>
</div> 
 </div> 
 
<div class="col-md-12"> 
              <div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Server đã thêm</h3>
</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                                                    <th>Loại hình</th>
                                                    <th>Dịch vụ</th>
                                                    <th>Server</th>
                                                    <th>Giá tiền</th>
                                                    <th>Tùy chọn</th>
                                                    <th>Note</th>
                                                    <th>Trạng thái</th>
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
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `chietkhau` WHERE `webdinhdanh` = '$domain'"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `chietkhau` WHERE `webdinhdanh` = '$domain' LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td></tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td>Brand: <?php echo $row['loaihinh'] ?><br>
                                                    Tính năng: <?php echo $row['tinhnang'] ?><br>
                                                    Tên Server: <?php echo $row['tendichvu'] ?><br>
                                                    </td>
                                                    <td><?php echo $row['tendichvu'] ?></td>
                                                    <td>Server hiển thị: <?php echo $row['id'] ?><br>
                                                    Server gốc: <?php echo $row['server'] ?><br>
                                                    Tối thiểu: <?php echo $row['min'] ?>, Tối đa: <?php echo $row['max'] ?><br>
                                                    Giới hạn đơn / Ngày: <?php echo $row['exchange'] ?>
                                                    </td>
                                                    <td>
                                                        Gốc: <?php echo $row['giagoc'] ?> VNĐ,
                                                        Member: <?php echo $row['cap0'] ?> VNĐ,
                                                        Giá cấp 1: <?php echo $row['cap1'] ?> VNĐ<br>
                                                        Giá cấp 2: <?php echo $row['cap2'] ?> VNĐ,
                                                         Giá cấp 3: <?php echo $row['cap3'] ?> VNĐ,
                                                          <br>Giá cấp 4: <?php echo $row['cap4'] ?> VNĐ,
                                                           Giá cấp 5: <?php echo $row['cap5'] ?> VNĐ
                                                    <td>Reaction: <?php echo $row['reaction'] ?>, 
                                                    Comment: <?php echo $row['comment'] ?><br>
                                                    Minutes: <?php echo $row['minutes'] ?>, 
                                                    Vip: <?php echo $row['dayvip'] ?></td>
                                                    
                                                    <td><textarea class="form-control" readonly="" rows="3"><?php echo $row['note'] ?></textarea></td>
                                                    <td><?php echo $row['status'] ?></td>
                                                    <td><?php echo $row['type'] ?></td>
                                                    <td><a class="btn btn-success" href="/administrator/server.html?action=edit&target=<?php echo $row['id'] ?>">Edit</a> 
                                                    
                                                    <a onclick="return confirm('Hành động nguy hiểm - Hành động này có thể gây nguy hại đến tính năng trên website , xác nhận xóa nhấn OK, chưa chắc nhấn Hủy')" href="/administrator/server.html?action=del&target=<?php echo $row['id'] ?>" class="btn btn-danger">Xóa</a>
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
function submit(){if(!$('#brand')['val']()){swal('ERROR','Vui lòng nhập thương hiệu','error')}
else {if(!$('#tinhnang')['val']()){swal('ERROR','Vui lòng chọn tính năng','error')}
else {if(!$('#tenserver')['val']()){swal('ERROR','Hãy nhập tên server','error')}
else {if(!$('#severgoc')['val']()){swal('ERROR','Hãy nhập server gốc !','error')}
else {if(!$('#giagoc')['val']()){swal('ERROR','Giá gốc là ?','error')}
else {if(!$('#giacap1')['val']()){swal('ERROR','Giá cấp 1 là ?','error')}
else {if(!$('#giacap2')['val']()){swal('ERROR','Giá cấp 2 là ?','error')}
else {if(!$('#giacap0')['val']()){swal('ERROR','Giá member là ?','error')}
else {if(!$('#giacap3')['val']()){swal('ERROR','Giá cấp 3 là ?','error')}
else {if(!$('#giacap4')['val']()){swal('ERROR','Giá cấp 4 là ?','error')}
else {if(!$('#giacap5')['val']()){swal('ERROR','Giá cấp 5 là ?','error')}
else {if(!$('#min')['val']()){swal('ERROR','Tối thiểu là ?','error')}
else {if(!$('#max')['val']()){swal('ERROR','Tối đa là ?','error')}
else {if(!$('#reaction')['val']()){swal('ERROR','reaction là ?','error')}
else {if(!$('#comment')['val']()){swal('ERROR','Comment là ?','error')}
else {if(!$('#minutes')['val']()){swal('ERROR','Số phút là ?','error')}
else {if(!$('#dayvip')['val']()){swal('ERROR','Có Vip không ?','error')}
else {if(!$('#summernote')['val']()){swal('ERROR','Mô tả là ?','error')}
else {if(!$('#motangan')['val']()){swal('ERROR','Mô tả ngắn là ?','error')}
else {if(!$('#status')['val']()){swal('ERROR','Trạng thái là ?','error')}
else {if(!$('#exchange')['val']()){swal('ERROR','Giới hạn là ?','error')}
else {nap()}}}}}}}}}}}}}}}}}}}}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
$['post']('../action/admin.php',{
    brand:$('#brand')['val'](),
    tinhnang:$('#tinhnang')['val'](),
    severgoc:$('#severgoc')['val'](),
    tenserver:$('#tenserver')['val'](),
    giagoc:$('#giagoc')['val'](),
    giacap0:$('#giacap0')['val'](),
    giacap1:$('#giacap1')['val'](),
    giacap2:$('#giacap2')['val'](),
    loaidonb:$('#loaidonb')['val'](),
    giacap3:$('#giacap3')['val'](),
    giacap4:$('#giacap4')['val'](),
    giacap5:$('#giacap5')['val'](),    
    exchange:$('#exchange')['val'](),
    min:$('#min')['val'](),
    max:$('#max')['val'](),
    max:$('#max')['val'](),
    reaction:$('#reaction')['val'](),
    comment:$('#comment')['val'](),
    minutes:$('#minutes')['val'](),
    dayvip:$('#dayvip')['val'](),
    summernote:$('#summernote')['val'](),
    motangan:$('#motangan')['val'](),
    status:$('#status')['val'](),
    idbankc:$('#idbankc')['val']()},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('<i class="fas fa-cogs"></i> Cấu hình thêm')},'json')}
</script>           
 <?php
include('page/footer.php');
}
?>

