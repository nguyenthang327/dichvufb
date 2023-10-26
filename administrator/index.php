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
            <h1 class="m-0"><i class="fas fa-cogs"></i> Trang Quản Trị</h1>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4><?=$tongthanhvien?></h4>

                <p>Thành Viên</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/administrator/member.html" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h4><?=number_format($soduthanhvien)?> VNĐ</h4>

                <p>Số Dư Thành Viên</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4><?=number_format($tongnapa)?> VNĐ</h4>

                <p>Tổng Nạp</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h4><?=number_format($tongdung1)?> VNĐ</h4>

                <p>Tổng Dùng</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4><?=number_format($tongdon1)?> Đơn</h4>

                <p>Tổng Đơn Hàng</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h4><?=number_format($tongdon1a)?> Đơn</h4>

                <p>Đơn Đã Xử Lý</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4><?=number_format($tongdon1b)?> Đơn</h4>

                <p>Đơn Chưa Xử Lý</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h4><?=number_format($refund)?> Đơn</h4>

                <p>Đơn Hoàn Tiền</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4><?=number_format($tiendon)?> VNĐ</h4>

                <p>Tổng Tiền Đơn</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h4><?=number_format($tiendon1)?> VNĐ</h4>

                <p>Tiền Đơn Lỗi</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4><?=number_format($tiendon2)?> VNĐ</h4>

                <p>Tiền Hoàn Đơn</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h4><?=number_format($tiendon3)?> VNĐ</h4>

                <p>Tổng Lợi Nhuận DVMXH</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4><?=$tongthanhvienmoi?></h4>

                <p>Thành Viên Mới</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h4><?=number_format($tongnapamoi)?> VNĐ</h4>

                <p>Nạp Trong Ngày</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4><?=number_format($tongdung1moi)?> VNĐ</h4>

                <p>Dùng Trong Ngày</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h4><?=number_format($expmoi)?> VNĐ</h4>

                <p>Lợi Nhuận Hôm Nay</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
  <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4><?=$donclone?></h4>

                <p>Tổng Đơn Mua Clone</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h4><?=$clonecon?> / <?=$clonedaban?></h4>

                <p>Số Clone Còn/ Đã Bán</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4><?=number_format($tienngayclone)?> VNĐ</h4>

                <p>Tiền Bán Clone Trong Ngày</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h4><?=number_format($tienbanclone)?> VNĐ</h4>

                <p>Tổng Lợi Nhuận Bán Clone</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>        
        <!-- /.row -->
 <div class="row">
<div class="col-md-12">

<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Cài Đặt Website</h3>
</div>


<div>
<div class="card-body">
<div class="form-group">
<label for="exampleInputEmail1">Tiêu đề Website</label>
<input type="text" name="title" id="title" class="form-control" id="exampleInputEmail1" placeholder="<?=$tieude?>" value="<?=$tieude?>">
</div>
<div class="form-group">
<label for="exampleInputEmail1">Mô Tả Website</label>
<textarea class="form-control" id="mota" name="mota" rows="3" placeholder=""><?=$mota?></textarea>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Từ Khóa Website</label>
<textarea class="form-control" id="tukhoa" name="tukhoa" rows="3" placeholder=""><?=$tukhoa?></textarea>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Link Logo (154x42 px)</label>
<input type="text"  name="logo" id="logo" class="form-control" id="exampleInputEmail1" placeholder="<?=$logo?>"  value="<?=$logo?>">
</div>

<div class="form-group">
<label for="exampleInputEmail1">Favicon (42x42 px)</label>
<input type="text"  name="favicon" id="favicon" class="form-control" id="exampleInputEmail1" placeholder="<?=$favicon?>"  value="<?=$favicon?>">
</div>

<div class="form-group">
<label for="exampleInputEmail1">Hotline</label>
<input type="text"  name="phone" id="phone" class="form-control" id="exampleInputEmail1" placeholder="<?=$hotline?>"  value="<?=$hotline?>">
</div>

<div class="form-group">
<label for="exampleInputEmail1">Tên Website</label>
<input type="text"  name="brand" id="brand" class="form-control" id="exampleInputEmail1" placeholder="<?=$namesite?>"  value="<?=$namesite?>">
</div>


<div class="form-group">
<label for="exampleInputEmail1">Tên Admin</label>
<input type="text"  name="name" id="name" class="form-control" id="exampleInputEmail1" placeholder="<?=$nameadmin?>"  value="<?=$nameadmin?>">
</div>
<div class="form-group">
<label for="exampleInputEmail1">Link Facebook Admin</label>
<input type="text"  name="fbadmin" id="fbadmin" class="form-control" id="exampleInputEmail1" placeholder="<?=$fbadmin?>"  value="<?=$fbadmin?>">
</div>

<div class="form-group">
<label for="exampleInputEmail1">Link Kênh Hỗ Trợ</label>
<input type="text"  name="zalo" id="zalo" class="form-control" id="exampleInputEmail1" placeholder="<?=$kenhthongbao?>"  value="<?=$kenhthongbao?>">
</div>

<div class="form-group">
<label for="exampleInputEmail1">Token Active</label>
<input type="text"  name="token" id="token" class="form-control" id="exampleInputEmail1" placeholder="<?=$tokenweb?>"  value="<?=$tokenweb?>">
</div>
<div class="row">
<div class="form-group col-md-3">
      <label for="cap1">CTV PRO</label>
      <input type="text" class="form-control" id="cap1" placeholder="cap1" value="<?=$cap1?>">
    </div> 
    <div class="form-group col-md-3">
      <label for="cap2">CTV VIP</label>
      <input type="text" class="form-control" id="cap2" placeholder="cap2" value="<?=$cap2?>">
    </div>
    <div class="form-group col-md-2">
      <label for="cap3">Đại Lý PRO	</label>
      <input type="text" class="form-control" id="cap3" placeholder="cap3" value="<?=$cap3?>">
    </div>
    <div class="form-group col-md-2">
      <label for="cap4">Đại Lý VIP</label>
      <input type="text" class="form-control" id="cap4" placeholder="cap4" value="<?=$cap4?>">
    </div>
    <div class="form-group col-md-2">
      <label for="cap5">Nhà Phân Phối VIP</label>
      <input type="text" class="form-control" id="cap5" placeholder="cap5" value="<?=$cap5?>">
    </div>
</div>    
<div class="form-group">
<label for="exampleInputEmail1">Extension Chat (Hỗ trợ trực tuyến - Mã nhúng box chat - Fanpage Facebook)</label>
<textarea class="form-control" id="chat" name="chat" rows="5" placeholder=""><?=$script?></textarea>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Trạng Thái Website (Kích hoạt lại bằng cách liên hệ Website mẹ)</label>
 <select class="form-control" id="active" name="active">
<option value="active" <?php if($active == 'active'){echo 'slected="slected"';} ?>>Kích hoạt</option>
<option value="disabled" <?php if($active !== 'active'){echo 'slected="slected"';} ?>>Bảo trì</option>
</select>
</div>

</div>

<div class="card-footer">
<center><button onclick="submit();" type="submit" id="submit" id="submit" class="btn btn-primary btn-lg"><i class="fas fa-cogs"></i> Cập Nhật Hệ Thống</button></center>
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
 <script type="text/javascript">
function submit(){if(!$('#title')['val']()){swal('ERROR','Tiêu đề không được bỏ trống !','error')}
else {if(!$('#mota')['val']()){swal('ERROR','Mô tả không được bỏ trống !','error')}
else {if(!$('#tukhoa')['val']()){swal('ERROR','Từ khóa không được bỏ trống !','error')}
else {if(!$('#logo')['val']()){swal('ERROR','Link Logo không được bỏ trống !','error')}
else {if(!$('#favicon')['val']()){swal('ERROR','Link Favicon không được bỏ trống !','error')}
else {if(!$('#phone')['val']()){swal('ERROR','SĐT Admin  không được bỏ trống !','error')}
else {if(!$('#brand')['val']()){swal('ERROR','Tên Website không được bỏ trống !','error')}
else {if(!$('#name')['val']()){swal('ERROR','Tên Admin không được bỏ trống !','error')}
else {if(!$('#fbadmin')['val']()){swal('ERROR','Facebook Admin  không được bỏ trống','error')}
else {if(!$('#zalo')['val']()){swal('ERROR','Link hỗ trợ không được bỏ trống','error')}
else {if(!$('#token')['val']()){swal('ERROR','Token website không được bỏ trống','error')}
else {if(!$('#cap1')['val']()){swal('ERROR','Xem lại hạn mức Nhà Phân Phối 1','error')}
else {if(!$('#cap2')['val']()){swal('ERROR','Xem lại hạn mức Nhà Phân Phối 2','error')}
else {if(!$('#cap3')['val']()){swal('ERROR','Xem lại hạn mức Đại Lý 1','error')}
else {if(!$('#cap4')['val']()){swal('ERROR','Xem lại hạn mức Đại Lý 2','error')}
else {if(!$('#cap5')['val']()){swal('ERROR','Xem lại hạn mức Đại Lý 3','error')}
else {if(!$('#active')['val']()){swal('ERROR','Website cần kích hoạt hoặc bảo trì !','error')}
else {nap()}}}}}}}}}}}}}}}}}}
function nap(){$('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
$['post']('../action/admin.php',{
    title:$('#title')['val'](),
    mota:$('#mota')['val'](),
    tukhoa:$('#tukhoa')['val'](),
    logo:$('#logo')['val'](),
    favicon:$('#favicon')['val'](),
    phone:$('#phone')['val'](),
    brand:$('#brand')['val'](),
    name:$('#name')['val'](),
    fbadmin:$('#fbadmin')['val'](),
    zalo:$('#zalo')['val'](),
    cap1:$('#cap1')['val'](),
    cap2:$('#cap2')['val'](),
    cap3:$('#cap3')['val'](),
    cap4:$('#cap4')['val'](),
    cap5:$('#cap5')['val'](),
    token:$('#token')['val'](),
    chat:$('#chat')['val'](),
    active:$('#active')['val']()},
    function(_0xb982x3){swal(_0xb982x3['title'],_0xb982x3['msg'],_0xb982x3['status']);
    $('#submit')['html']('<i class="fas fa-cogs"></i> Đổi lại')},'json')}
</script>           
 <?php
include('page/footer.php');
}
?>

