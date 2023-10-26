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
if(isset($_POST['checkid'])){
$checkid = addslashes($_POST['checkid']);
$dem =  mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$checkid)."' AND `webdinhdanh` = '$domain'"));
if($dem > 0){
$tanbien = "AND `username` = '$checkid'";
}else{
$tanbien = "AND `trans` = '$checkid'";    
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
            <h1 class="m-0"><i class="far fa-credit-card"></i> Lịch sử nạp thẻ cào</h1>
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
                                        <label for="disabledInput">Tìm Kiếm  Giao Dịch</label>
                                        <input type="text" class="form-control" id="checkid" name="checkid" placeholder="Nhập mã giao dịch, username cần tìm...">
                                    </div> <br>    
                                    <div class="form-group">
                                      <button type="submit" id="submit" id="submit" class="btn btn-success">  Tìm Kiếm</button>
                                      <button type="submit" class="btn btn-danger" onclick="location.href='/administrator/historybank.html'">Reset</button>
                                    </div>
                                    </form>
 </div> 
 
<div class="col-md-12"> 
              <div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Lịch sử nạp bằng thẻ cào</h3>
</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Username</th>
                                                    <th>Mã giao dịch</th>
                                                    <th>Loại thẻ</th>
                                                    <th>Mệnh giá</th>
                                                    <th>Thực nhận</th>
                                                    <th>Seri</th>
                                                    <th>Mã thẻ</th>
                                                    <th>Trạng thái</th>
                                                    
                                                    <th>Thời gian</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=150;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `historynapcard`  WHERE `webdinhdanh` = '$domain'  $tanbien"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `historynapcard`  WHERE `webdinhdanh` = '$domain'  $tanbien  order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td></tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['username'] ?></td>
                                                    <td><?php echo $row['trans'] ?></td>
                                                    <td><?php echo $row['type'] ?></td>
                                                    <td><?php echo $row['menhgia'] ?></td>
                                                    <td><?php echo $row['thucnhan'] ?></td>
                                                    <td><?php echo $row['seri'] ?></td>
                                                    <td><?php echo $row['mathe'] ?></td>
                                                    <td><?php 
                                                    if($row['status'] == 'success'){echo 'Thành Công';}elseif($row['status'] == 'error'){echo 'Thất Bại';}elseif($row['status'] == 'pending'){echo 'Chờ Duyệt';}
                                                     ?></td>
                                                    <td><?php echo $row['date'] ?></td>
                                                    
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
  
 <?php
include('page/footer.php');
}
?>

