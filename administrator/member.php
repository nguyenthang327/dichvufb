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
$id = addslashes($_POST['checkid']);
$dem  = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `username` ='".mysqli_real_escape_string($ketnoi,$id)."' AND `webdinhdanh` = '$domain'"));
if($dem == 1){
$tanbien  =  "AND `username` = '$id'";   
}else{
$tanbien  =  "AND `id` = '$id'";    
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
            <h1 class="m-0"><i class="fas fa-id-card"></i> Quản lý khách hàng</h1>
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
                                        <label for="disabledInput">Tìm Kiếm  Khách Hàng</label>
                                        <input type="text" class="form-control" id="checkid" name="checkid" placeholder="Nhập username,id tài khoản cần tìm...">
                                    </div> <br>    
                                    <div class="form-group">
                                      <button type="submit" id="submit" id="submit" class="btn btn-success">  Tìm Kiếm</button>
                                      <a class="btn btn-danger" href="/administrator/member.html">Reset</a>
                                    </div>
                                    </form>
 </div> 
 
<div class="col-md-12"> 
              <div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Quản lý khách hàng</h3>
</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>API</th>
                                                    <th>Số dư</th>
                                                    <th>Level</th>
                                                    <th>Thao tác</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                           <?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `accounts` WHERE `webdinhdanh` = '$domain' $tanbien"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `webdinhdanh` = '$domain' $tanbien  order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>
<tr><td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td></tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>    
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['username'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['api'] ?></td>
                                                    <td><?php echo number_format($row['cash'],'0','.','.'); ?> VNĐ</td>
                                                    <td><?php
                                                if($row['ctv'] == 0){
                                                echo 'Member';    
                                                }elseif($row['ctv'] == 1){
                                                echo 'CTV PRO';    
                                                }elseif($row['ctv'] == 2){
                                                echo 'CTV VIP';    
                                                }elseif($row['ctv'] == 3){
                                                echo 'ĐL PRO';    
                                                }elseif($row['ctv'] == 4){
                                                echo 'ĐL VIP';    
                                                }elseif($row['ctv'] == 5){
                                                echo 'NPP VIP';    
                                                }else{
                                                echo 'Không xác định';      
                                                }
                                                ?></td>
                                                    <td><a class="badge bg-info" href="/administrator/checkid.html?target=<?php echo $row['username'] ?>">Lịch Sử</a>&nbsp;<?php if($row['active'] == '1'){ echo'<a class="badge bg-danger" href="/administrator/member.html?action=block&target='.$row['username'].'">Block</a>';}else{ echo'<a class="badge bg-success" href="/administrator/member.html?action=unlock&target='.$row['username'].'">Unlock</a>';} ?>&nbsp;<a class="badge bg-success" href="/administrator/congtien.html?target=<?php echo $row['username'] ?>">Cộng tiền</a>&nbsp;<a class="badge bg-info" href="/administrator/member.html?action=level&target=<?php echo $row['username'] ?>">Nâng cấp</a>&nbsp;<a class="badge bg-danger" href="/administrator/member.html?action=leveldown&target=<?php echo $row['username'] ?>">Hạ cấp</a></td>
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
if(isset($_GET['action'])&&isset($_GET['target'])){
$action = addslashes($_GET['action']);
$target = addslashes($_GET['target']);
if($action == 'block'){
mysqli_query($ketnoi,"UPDATE accounts SET `active` = '0' WHERE `username`='$target' AND  `webdinhdanh` = '$domain'");
	die('<script type="text/javascript">swal("Thông báo","Cấm User thành công !","success"); setTimeout(function(){ location.href = "/administrator/member.html" },2000);</script>');
}elseif($action == 'unlock'){
mysqli_query($ketnoi,"UPDATE accounts SET `active` = '1' WHERE `username`='$target' AND  `webdinhdanh` = '$domain'");
	die('<script type="text/javascript">swal("Thông báo","Mở cấm User thành công !","success"); setTimeout(function(){ location.href = "/administrator/member.html" },2000);</script>');
}elseif($action == 'level'){
    $br = mysqli_fetch_array(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `webdinhdanh` = '$domain' AND `username`='$target'"));    
$levelhientai = $br['ctv'];
if($levelhientai < 5){
$levelhientai = $levelhientai + 1;   
mysqli_query($ketnoi,"UPDATE accounts SET `ctv` = '$levelhientai' WHERE `username`='$target' AND  `webdinhdanh` = '$domain'");
	die('<script type="text/javascript">swal("Thông báo","Nâng cấp thành công !","success"); setTimeout(function(){ location.href = "/administrator/member.html" },2000);</script>');
}else{
	die('<script type="text/javascript">swal("Thông báo","Đã đạt cấp độ tối đa !","error"); setTimeout(function(){ location.href = "/administrator/member.html" },2000);</script>');    
}
}elseif($action == 'leveldown'){
    $br = mysqli_fetch_array(mysqli_query($ketnoi,"SELECT * FROM `accounts` WHERE `webdinhdanh` = '$domain' AND `username`='$target'"));    
$levelhientai = $br['ctv'];
if($levelhientai == 0){
 	die('<script type="text/javascript">swal("Thông báo","Đã đạt cấp độ tối thiểu !","error"); setTimeout(function(){ location.href = "/administrator/member.html" },2000);</script>');   
}else{
$levelhientai = $levelhientai - 1;   
mysqli_query($ketnoi,"UPDATE accounts SET `ctv` = '$levelhientai' WHERE `username`='$target' AND  `webdinhdanh` = '$domain'");
	die('<script type="text/javascript">swal("Thông báo","Hạ cấp thành công !","success"); setTimeout(function(){ location.href = "/administrator/member.html" },2000);</script>');
 
}
}
    } 
include('page/footer.php');
}
?>

