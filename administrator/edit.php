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
if($action == 'fix'){
$databak = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `function` WHERE `id` ='$target' AND `webdinhdanh` = '$domain'"));   
$type = $databak['type'];
$nguoinap = $databak['username'];
$goc = $databak['goc'];
$rate = $databak['rate']; 
$dachay = $databak['dachay'];
$sl = $databak['soluong'];
$cashtru = $databak['cashtru'];
$status = $databak['status'];
$codeodergoc = $databak['codeodergoc'];
$loaidon = $databak['area'];
$note = $databak['note'];
$link = $databak['link'];
$uid = $databak['uid'];
if($loaidon == 'dontay'){
$location = '/administrator/dontay.html';    
}else{
$location = '/administrator/all.html';    
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
            <h1 class="m-0"><i class="fas fa-shopping-bag"></i> Tính năng sửa đơn hàng</h1>
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
<h3 class="card-title">Sửa đơn hàng #<?=$codeodergoc?> </h3>
</div>


<div>
<form action="" method="POST">    
<div class="card-body">
                                    <div class="form-group">
                                        <label for="disabledInput">Link Buff</label>
                                        <input type="text" class="form-control" id="link" name="link"  value="<?=$link?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">UID</label>
                                        <input type="uid" class="form-control" id="uid" name="uid"  value="<?=$uid?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Gốc</label>
                                        <input type="number" class="form-control" id="goc" name="goc"  value="<?=$goc?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Đã chạy</label>
                                        <input type="number" class="form-control" id="dachay" name="dachay"  value="<?=$dachay?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Trạng thái</label>
                                        <select class="form-control" aria-label="Default select example" id="trangthai" name="trangthai">               
                                        <option value="pending" <?php if($status == 'pending'){echo 'selected="selected"';}?>>Đang chờ</option>
                                        <option value="inprogess" <?php if($status == 'inprogess'){echo 'selected="selected"';}?>>Đang chạy</option>
                                        <option value="success" <?php if($status == 'success'){echo 'selected="selected"';}?>>Hoàn thành</option>
                                        <option value="error" <?php if($status == 'error'){echo 'selected="selected"';}?>>Lỗi</option>
                                        <option value="refund" <?php if($status == 'refund'){echo 'selected="selected"';}?>>Hoàn tiền</option>
                                    </select> 
                                    </div>
                                    <div class="form-group">
                                        <label for="disabledInput">Ghi chú</label>
                                        <textarea class="form-control" rows="3" id="ghichu" name="ghichu"><?=$note?></textarea>
                                    </div>
                                   
                                    <p><i>- Loại đơn: <?=$type?> của khách hàng: <?=$nguoinap?></i></p>
                                    <p><i>- Giá buff: <?=$rate?>  - Số lượng: <?=$sl?> </i></p>
                                    <p><i>- Đã chạy: <?=$dachay?></i></p>
                                    <p><i>- Tiền trừ: <?=number_format($cashtru)?> VNĐ</i></p>
                                    <p><i>- Trạng thái: <?=$status?></i></p>
                                    <p><i>- Mã giao dịch: <?=$codeodergoc?></i></p>
                                    <p><i>- Ghi chú: <?=$note?></i></p>
                                  

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
 if(isset($_POST['link']) && isset($_POST['uid']) && isset($_POST['dachay']) && isset($_POST['trangthai']) && isset($_POST['ghichu']) && isset($_POST['goc'])){
$link = mysqli_escape_string($ketnoi,addslashes($_POST['link']));
$uid = mysqli_escape_string($ketnoi,addslashes($_POST['uid']));
$dachay = mysqli_escape_string($ketnoi,addslashes($_POST['dachay']));
$trangthai = mysqli_escape_string($ketnoi,addslashes($_POST['trangthai']));
$ghichu = mysqli_escape_string($ketnoi,addslashes($_POST['ghichu']));
$goc = mysqli_escape_string($ketnoi,addslashes($_POST['goc']));
mysqli_query($ketnoi,"UPDATE `function` SET 
`link` ='$link',
`uid` ='$uid',
`dachay` ='$dachay',
`status` ='$trangthai',
`goc` ='$goc',
`note` ='$ghichu'
WHERE `id` = '$target'");
	die('<script type="text/javascript">swal("Thông báo","Bạn đã cập nhật đơn hàng thành công  !","success"); setTimeout(function(){ location.href = "'.$location.'" },2000);</script>');
    
} 
include('page/footer.php');
}
?>

