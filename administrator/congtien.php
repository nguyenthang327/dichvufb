<?php
include('../system/config.php');
if(!isset($_SESSION['username'])){
header('location:/');  
exit();
}elseif($admin !== 'yes'){
header('location:/');  
exit();
}else{
if(isset($_GET['target'])){
$id = addslashes($_GET['target']);
$dem  = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$id)."' AND `webdinhdanh` = '$domain'"));
if($dem == 1){
$usercheck  =  $id;   
}else{
header('location:/administrator/member.html');
exit();    
    }
}else{
header('location:/administrator/member.html');
exit();        
    }      
include('../system/thongke.php');
include('page/header.php');
include('page/menu.php');
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
            <h1 class="m-0"><i class="fas fa-history"></i> Cộng tiền cho khách hàng: <?=$usercheck?></h1>
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
                                        <label for="disabledInput">Nhập số tiền cần cộng (trừ)</label>
                                        <input type="number" class="form-control" id="checkid" name="checkid" placeholder="10000">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Ghi chú</label>
                                        <input type="text" class="form-control" id="ghi" name="ghi" value="Admin cộng tiền cho bạn">
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" id="submit" id="submit" class="btn btn-success">  Thực hiện</button>
                                      <a class="btn btn-danger" href="/administrator/member.html">Back</a>
                                    </div>
                                    <p><i>- Cộng tiền thì gõ như bình thường ví dụ : 100000 (tương ứng cộng 100.000 VNĐ)</p>
                                    <p>- Trừ tiền thì thêm dấu trừ đằng trước ví dụ : -100000 (tương ứng trừ 100.000 VNĐ)</i></p>
                                    </form>
 </div>
<div class="col-md-12"> 
              <div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Lịch sử cộng tiền khách hàng <?=$usercheck?></h3>
</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Loại hình</th>
                                                    <th>Trước giao dịch</th>
                                                    <th>Sau giao dịch</th>
                                                    <th>Số tiền</th>
                                                    <th>Mã giao dịch</th>
                                                    <th>Thời gian</th>
                                                    <th>Chi tiết</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                           <?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=50;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `history` WHERE `username` = '$usercheck' AND `type`='Cộng Tiền'"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `history` WHERE `username` = '$usercheck' AND `type`='Cộng Tiền' order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>    
<tr><td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td></tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['type'] ?></td>
                                                    <td><?php echo number_format($row['coinfirst'],'0','.','.'); ?> VNĐ</td>
                                                    <td><?php echo number_format($row['coinsecond'],'0','.','.'); ?> VNĐ</td>
                                                    <td><?php echo number_format($row['coin'],'0','.','.'); ?> VNĐ</td>
                                                    <td><?php echo $row['codeoder'] ?></td>
                                                    <td><?php echo $row['date'] ?></td>
                                                    <td><textarea class="form-control" readonly="" rows="1"><?php echo $row['note'] ?></textarea></td>
                                                </tr>
<?php $i++; endwhile; endif; ?>                                                
                                            </tbody>
                                            
                    </table>
                  </div>
                </div>
              </div>
<center><ul class="pagination">
<?php
echo "<li class='page-item'><a class='page-link' href='?page=1&target=".$usercheck."'>".'Trang đầu'."</a> </li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item'><a class='page-link' href='?page=".$i."&target=".$usercheck."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' href='?page=$total_pages&target=".$usercheck."'>".'Trang cuối'."</a></li>";
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
if(isset($_POST['checkid']) && isset($_POST['ghi'])){
$checkid = mysqli_escape_string($ketnoi,addslashes($_POST['checkid']));
$ghi = mysqli_escape_string($ketnoi,addslashes($_POST['ghi']));
if(empty($checkid)){
	die('<script type="text/javascript">swal("Thông báo","Bạn vui lòng nhập số tiền đúng định dạng hoặc không phải là 0","error");</script>');    
}else{
$datauser1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `accounts` WHERE `username` ='$usercheck' AND `webdinhdanh` = '$domain'"));
$casha = $datauser1['cash'];
$cheata = $datauser1['cheat'];
if($cheata == 'on'){
$cashmoi = $casha + $checkid;
$type1 = 'Cộng Tiền';
$date = date("Y-m-d H:i:sa");
$code_oder = floor(microtime(true) * 1000);
mysqli_query($ketnoi, "INSERT INTO history (`username`, `type`, `coinfirst`, `coinsecond`, `coin`, `codeoder`, `date`, `note`, `webdinhdanh`)
VALUES ('$usercheck','$type1','$casha','$cashmoi','$checkid','$code_oder','$date','$ghi','$domain')"); 
// trừ tiền
$ketnoi->query("UPDATE accounts SET `cash` = '$cashmoi' WHERE `username` = '$usercheck'  AND `webdinhdanh` = '$domain'");
$hienthi = number_format($checkid,'0','.','.');
	die('<script type="text/javascript">swal("Thông báo","Bạn đã cộng '.$hienthi.' VNĐ cho username : '.$usercheck.'  !","success"); setTimeout(function(){ location.href = "/administrator/congtien.html?target='.$usercheck.'" },2000);</script>');
    }else{
	die('<script type="text/javascript">swal("Thông báo","Tài khoản này đang thao tác tính năng, không thể cộng tiền vui lòng xử lý lại sau vài giây !" },2000);</script>');        
    }
} 
}
include('page/footer.php');
}
?>

