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
            <h1 class="m-0"><i class="fas fa-id-card"></i> Kiểm tra tài khoản</h1>
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
<h3 class="card-title">Lịch sử khách hàng <?=$usercheck?></h3>
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
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `history` WHERE `username` = '$usercheck'"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `history` WHERE `username` = '$usercheck' order by id desc LIMIT $start_from, $num_rec_per_page ");
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
include('page/footer.php');
}
?>

