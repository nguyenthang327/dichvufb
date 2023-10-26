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
if(isset($_GET['type'])&&isset($_GET['id'])){
$type = addslashes($_GET['type']); 
$id = addslashes($_GET['id']);
if($type =='finish'){
$datadon = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `id` ='".mysqli_real_escape_string($ketnoi,$id)."'  AND `webdinhdanh` = '$domain'")); 
$soluong = $datadon['soluong'];  
mysqli_query($ketnoi,"UPDATE `function` SET `dachay`='$soluong',`status` ='success' WHERE `id` = '$id'");
	die('<script type="text/javascript">swal("Thông báo","Đã set trạng thái đơn hoàn thành thành công !","success"); setTimeout(function(){ location.href = "/administrator/all.html" },2000);</script>');
}elseif($type =='refund'){
$datadon = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `id` ='".mysqli_real_escape_string($ketnoi,$id)."'  AND `webdinhdanh` = '$domain'")); 
$usernamechay = $datadon['username']; 
$codeodergoc = $datadon['codeodergoc']; 
$cashtru = $datadon['cashtru']; 
$status = $datadon['status'];
$datacash = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `accounts` WHERE `username`='$usernamechay' AND `webdinhdanh` ='$domain'"));
$casha = $datacash['cash'];
$trangthai = $datacash['cheat'];

if($trangthai == 'on' && $status !== 'refund'){
$date = date("Y-m-d H:i:sa"); 
$code_oder = floor(microtime(true) * 1000);
mysqli_query($ketnoi,"UPDATE `function` SET `status` ='refund' WHERE `id` = '$id'");
$cashmoi = $casha + $cashtru;
mysqli_query($ketnoi,"UPDATE `accounts` SET `cash` ='$cashmoi' WHERE `username` = '$usernamechay' AND `webdinhdanh` ='$domain' ");
mysqli_query($ketnoi,"INSERT INTO `history` SET 
`username` = '".mysqli_real_escape_string($ketnoi,$usernamechay)."',
`type` = 'Hoàn Tiền',
`coinfirst` = '".mysqli_real_escape_string($ketnoi,$casha)."',
`coinsecond` = '".mysqli_real_escape_string($ketnoi,$cashmoi)."',
`coin` = '".mysqli_real_escape_string($ketnoi,$cashtru)."',
`codeoder` = '$code_oder',
`date` = '$date',
`webdinhdanh` = '$domain',
`note` = 'Hoàn Tiền đơn $codeodergoc'");
	die('<script type="text/javascript">swal("Thông báo","Đã hoàn Full đơn hàng !","success"); setTimeout(function(){ location.href = "/administrator/all.html" },2000);</script>');
}else{
	die('<script type="text/javascript">swal("Thông báo","Tài khoản buff đơn hàng này đang thao tác trên tính năng, vui lòng thử lại sau vài giây hoặc đơn đã hoàn tiền không thể hoàn thêm !","error"); setTimeout(function(){ location.href = "/administrator/all.html" },2000);</script>');    
}
}elseif($type =='run'){
mysqli_query($ketnoi,"UPDATE `function` SET `status` ='pending' WHERE `id` = '$id'");
	die('<script type="text/javascript">swal("Thông báo","Đã set trạng thái đơn chờ xử lý thành công !","success"); setTimeout(function(){ location.href = "/administrator/all.html" },2000);</script>');
}
}

if(isset($_POST['checkid']) &&  isset($_POST['tinhnang'])){
$checkid = addslashes($_POST['checkid']);
$dem  = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$checkid)."' AND `webdinhdanh` = '$domain'"));
$dem1  = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `link` ='".mysqli_real_escape_string($ketnoi,$checkid)."' AND `webdinhdanh` = '$domain'"));
$dem2  = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `codeodergoc` ='".mysqli_real_escape_string($ketnoi,$checkid)."' AND `webdinhdanh` = '$domain'"));
if($_POST['tinhnang'] == 'all'){
$valuea = '';    
}else{
$tinhangal2 = htmlspecialchars($_POST['tinhnang']);    
$valuea = "AND `tinhnang` = '$tinhangal2'";    
}
if($dem > 0){
$tanbien = "AND `username` = '$checkid' $valuea";    
}elseif($dem1 > 0){
$tanbien = "AND `link` = '$checkid' $valuea";    
}elseif($dem2 > 0){
$tanbien = "AND `codeodergoc` = '$checkid' $valuea";    
}else{
$tanbien = "$valuea";      
}
}else{
$tanbien = "";   
}
if(isset($_GET['status'])){
$stt = addslashes($_GET['status']);    
$tanbien2 = "AND `status` = '$stt'";    
}else{
 $tanbien2 = "";   
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
            <h1 class="m-0"><i class="fas fa-shopping-bag"></i> Quản lý đơn hàng</h1>
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
<form action="" method="POST">
                                    <div class="form-group">
                                        <label for="disabledInput">Tìm Kiếm  đơn hàng</label>
                                        <input type="text" class="form-control" id="checkid" name="checkid" placeholder="Nhập username,Link hoặc mã giao dịch...">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Lọc theo tính năng</label>
                                        <select class="form-control" aria-label="Default select example" id="tinhnang" name="tinhnang">                                        
<option value="all">Tất cả tính năng</option>
<?php                              
$respawn1a = mysqli_query($ketnoi,"SELECT * FROM `danhmuccon` WHERE `webdinhdanh` = '$domain' AND `type` !='dontay'");
if (mysqli_num_rows($respawn1a) == 0):
?>
<?php else: while ($row1a = mysqli_fetch_array($respawn1a, MYSQLI_ASSOC)):?>
<option value="<?=$row1a['id']?>">[ID: <?=$row1a['id']?>]<?=$row1a['tendichvucon']?> - (<?php if($row1a['type'] == 'normal'){echo 'Đấu nối server Việt Nam';}if($row1a['type'] == 'smm'){echo 'Đấu nối SMM Panel';}if($row1a['type'] == 'dontay'){echo 'Đơn tay';}?>) </option>
<?php endwhile; endif; ?> 
</select> 
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" id="submit" id="submit" class="btn btn-success">  Tìm Kiếm</button>
                                      <a class="btn btn-danger" href="/administrator/all.html">Reset</a>
                                      <div class="float-right">
                                      <a class="btn btn-success" href="/administrator/all.html?status=success" role="button">Success (<?=$a?>)</a>
                                      <a class="btn btn-danger" href="/administrator/all.html?status=error" role="button">Error (<?=$b?>)</a>
                                      <a class="btn btn-info" href="/administrator/all.html?status=pending" role="button">Pending (<?=$c?>)</a>
                                      <a class="btn btn-secondary" href="/administrator/all.html?status=inprogess" role="button">In Progress (<?=$d?>)</a>
                                      <a class="btn btn-primary" href="/administrator/all.html?status=refund" role="button">Refund (<?=$e?>)</a>
                                      <a class="btn btn-danger" href="/administrator/all.html?status=partial" role="button">Partial (<?=$f?>)</a>
                                      </div>
                                    </div>
                                    </form>
                                    
 </div> 
 
<div class="col-md-12"> 
              <div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Quản lý đơn hàng</h3>
</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Khách Hàng</th>
                                                    <th>Đơn Hàng</th>
                                                    <th>Thông Tin Đơn</th>
                                                    <th>Comment</th>
                                                    <th>Phút</th>
                                                    <th>Vip</th>
                                                    <th>Tiến trình</th>
                                                    <th>Phản hồi</th>
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
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `area` !='dontay' $tanbien $tanbien2"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `function` WHERE `webdinhdanh` = '$domain' AND `area` !='dontay' $tanbien $tanbien2 order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td></tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['username'] ?></td>
                                                    <td>Loại đơn: <?php echo $row['type'] ?></br>
                                                    Server: <?php echo $row['root'] ?></br>
                                                    Server Gốc: <?php echo $row['server'] ?></br>
                                                    Loại đơn: <?php echo $row['area'] ?><br>
                                                    Giá:  <?php echo $row['rate'] ?><br>
                                                    Thời gian:  <?php echo $row['date'] ?>
                                                    </td>
                                                    <td>Link: <textarea class="form-control" readonly="" rows="1"><?php echo $row['link'] ?></textarea></br>
                                                    UID: <textarea class="form-control" readonly="" rows="1"><?php echo $row['uid'] ?></textarea></br>
                                                    Mã đơn: <?php echo $row['codeodergoc'] ?></br>
                                                    Mã đơn gốc: <?php echo $row['codeoder'] ?></br>
                                                    </td>
                                                    <td><textarea class="form-control" readonly="" rows="5" style="width:500px"><?php 
                                                    if($row['comment'] !== 'no' && file_exists("../action/temp/".$row['codeodergoc'].".txt")){
                                                        $filename = "../action/temp/".$row['codeodergoc'].".txt";
                                                   $fp = fopen($filename, "r");//mở file ở chế độ đọc
                                                    $contents = fread($fp, filesize($filename));//đọc file 
                                                    echo htmlspecialchars($contents);
                                                    fclose($fp);
                                                    }else{
                                                    
                                                    echo $row['comment'];
                                                    }
                                                    
                                                    ?></textarea></td>
                                                    <td><?php echo $row['sophut'] ?></td>
                                                    <td><?php echo $row['dayvip'] ?></td>
                                                    <td>Số lượng: <?php echo $row['soluong'] ?></br>
                                                    Gốc: <?php echo $row['goc'] ?></br>
                                                    Đã chạy: <?php echo $row['dachay'] ?></br>
                                                    Chi phí: <?php echo number_format($row['cashtru'])?> VNĐ </br>
                                                    EXP: <?php echo number_format($row['exp'])?> VNĐ
                                                    </td>
                                                    <td><textarea class="form-control" readonly="" rows="5"><?php echo $row['respondapi'] ?></textarea></td>
                                                    
                                                    <td><?php if($row['status'] == 'pending'){?><span class="badge bg-info">Pending</span> <?php }elseif($row['status'] == 'success'){?><span class="badge bg-success">Success</span> <?php }elseif($row['status'] == 'refund'){?><span class="badge bg-primary">Refund</span> <?php }elseif($row['status'] == 'error'){?><span class="badge bg-danger">Error</span> <?php }elseif($row['status'] == 'pause'){?><span class="badge bg-info">Pause</span> <?php }elseif($row['status'] == 'inprogess'){?><span class="badge bg-secondary">In Progress</span> <?php }elseif($row['status'] == 'partial'){?><span class="badge bg-danger">Partial</span> <?php } ?></td>
                                                    <td><a class="badge bg-info" href="/administrator/all.html?type=finish&id=<?php echo $row['id'] ?>">Hoàn thành</a> 
                                                    <?php if($row['status'] !== 'refund'){
                                                    ?>    
                                                    <a class="badge bg-danger" href="/administrator/refund.html?type=refund&id=<?php echo $row['id'] ?>">Hoàn tiền</a> 
                                                    
                                                    <a onclick="return confirm('Hành động nguy hiểm - Hành động này sẽ hoàn toàn bộ tiền của đơn này cho người buff , xác nhận nhấn OK, chưa chắc nhấn Hủy')" href="/administrator/all.html?type=refund&id=<?php echo $row['id'] ?>" class="badge bg-danger">Hoàn full</a>
                                                    <?php }
                                                    ?>
                                                    <a  onclick="return confirm('Hành động nguy hiểm - Hành động này sẽ tiến hành gửi lại đơn trên hệ thống , xác nhận nhấn OK, chưa chắc nhấn Hủy')" href="/administrator/all.html?type=run&id=<?php echo $row['id'] ?>" class="badge bg-primary">Chạy lại</a>
                                                    
                                                    <a class="badge bg-success" href="/administrator/edit.html?type=fix&id=<?php echo $row['id'] ?>">Sửa đơn</a></td>
                                                </tr>
<?php $i++; endwhile; endif; ?>                                                
                                            </tbody>
                                            
                    </table>
                  </div>
                </div>
              </div>
<center><ul class="pagination">
<?php
if(!isset($_GET['status'])){
echo "<li class='page-item'><a class='page-link' href='?page=1'>".'Trang đầu'."</a> </li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item'><a class='page-link' href='?page=".$i."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' href='?page=$total_pages'>".'Trang cuối'."</a></li>";
}else{

echo "<li class='page-item'><a class='page-link' href='?page=1&status=".$stt."'>".'Trang đầu'."</a> </li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item'><a class='page-link' href='?page=".$i."&status=".$stt."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' href='?page=$total_pages&status=".$stt."'>".'Trang cuối'."</a></li>";
    
}
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
  
 <?php
include('page/footer.php');
}
?>

