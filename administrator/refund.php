<?php
include('../system/config.php');
if(!isset($_SESSION['username'])){
header('location:/');  
exit();
}elseif($admin !== 'yes'){
header('location:/');  
exit();
}else{
if(isset($_GET['type'])&&isset($_GET['id'])){
$action = addslashes($_GET['type']);
$target = addslashes($_GET['id']);
if($action == 'refund'){
$databak = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `id` ='$target' AND `webdinhdanh` = '$domain'"));   
$type = $databak['type'];
$nguoinap = $databak['username'];
$rate = $databak['rate']; 
$dachay = $databak['dachay'];
$sl = $databak['soluong'];
$cashtru = $databak['cashtru'];
$status = $databak['status'];
$codeodergoc = $databak['codeodergoc'];
$loaidon = $databak['area'];
if($loaidon == 'dontay'){
$location = '/administrator/dontay.html';    
}else{
$location = '/administrator/all.html';    
}
if($status == 'refund'){
header('location:'.$location.'');
exit();    
}
}else{
header('location:/administrator/all.html');
exit();
}
    }else{
header('location:/administrator/all.html');
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
            <h1 class="m-0"><i class="fas fa-shopping-bag"></i> Tính năng hoàn tiền đơn</h1>
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
<h3 class="card-title">Hoàn tiền cho đơn hàng #<?=$codeodergoc?> </h3>
</div>


<div>
<form action="" method="POST">    
<div class="card-body">
<div class="form-group">
                                        <label for="disabledInput">Nhập tiền hoàn</label>
                                        <input type="text" class="form-control" id="tienhoan" name="tienhoan" placeholder="Ví dụ: 100" value="<?=$cashtru?>">
                                    </div>
                                   <p><i>- Khách hàng: <?=$nguoinap?></i></p>
                                    <p><i>- Loại đơn: <?=$type?></i></p>
                                    <p><i>- Giá buff: <?=$rate?>  - Số lượng: <?=$sl?> </i></p>
                                    <p><i>- Đã chạy: <?=$dachay?></i></p>
                                    <p><i>- Tiền trừ: <?=number_format($cashtru)?> VNĐ</i></p>
                                    <p><i>- Trạng thái: <?=$status?></i></p>
                                    <p><i>- Mã giao dịch: <?=$codeodergoc?></i></p>
                                  

</div>

<div class="card-footer">
<center><button  type="submit" id="submit" id="submit" class="btn btn-primary btn-lg"><i class="fas fa-cogs"></i> Thực hiện</button>
</form>
</center>
</div>
</div>
</div> 
 </div> 
 
 
 </div> 
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
    
  </div>
  <!-- /.content-wrapper -->
  
          
 <?php
 if(isset($_POST['tienhoan'])){
$tienhoan = mysqli_escape_string($ketnoi,addslashes($_POST['tienhoan']));
if(empty($tienhoan)){
	die('<script type="text/javascript">swal("Thông báo","Bạn vui lòng nhập số tiền đúng định dạng hoặc không phải là 0","error");</script>');    
}else{
$datauser1 = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `accounts` WHERE `username` ='$nguoinap' AND `webdinhdanh` = '$domain'"));
$casha = $datauser1['cash'];
$cheata = $datauser1['cheat'];
if($cheata == 'on'){
$cashmoi = $casha + $tienhoan;
$type1 = 'Hoàn Tiền Đơn '.$codeodergoc.'';
$date = date("Y-m-d H:i:sa");
$code_oder = floor(microtime(true) * 1000);
mysqli_query($ketnoi, "INSERT INTO history (`username`, `type`, `coinfirst`, `coinsecond`, `coin`, `codeoder`, `date`, `note`, `webdinhdanh`)
VALUES ('$nguoinap','Hoàn Tiền','$casha','$cashmoi','$tienhoan','$code_oder','$date','$type1','$domain')"); 
// trừ tiền
$ketnoi->query("UPDATE accounts SET `cash` = '$cashmoi' WHERE `username` = '$nguoinap'  AND `webdinhdanh` = '$domain'");
mysqli_query($ketnoi,"UPDATE `function` SET `status` ='refund' WHERE `id` = '$target'");
$hienthi = number_format($tienhoan,'0','.','.');
	die('<script type="text/javascript">swal("Thông báo","Bạn đã hoàn tiền '.$hienthi.' VNĐ cho username : '.$nguoinap.'  !","success"); setTimeout(function(){ location.href = "'.$location.'" },2000);</script>');
    }else{
	die('<script type="text/javascript">swal("Thông báo","Tài khoản này đang thao tác tính năng, không thể cộng tiền vui lòng xử lý lại sau vài giây !" },2000);</script>');        
    }
} 
} 
include('page/footer.php');
}
?>

