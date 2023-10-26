<?php
include('system/connect.php');
if($active !== 'active'){
die (dev($active));
exit();
}elseif(!isset($_SESSION['username'])){
header('location:/login.html');
exit();
}else{
if(isset($_GET['seach'])){
$seach = addslashes($_GET['seach']); 
$dem1 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `historynaptien` WHERE `id` ='".mysqli_real_escape_string($ketnoi,$seach)."'"));
$dem2 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `historynaptien` WHERE `seri` ='".mysqli_real_escape_string($ketnoi,$seach)."'"));
$dem3 = mysqli_num_rows(mysqli_query($ketnoi,"SELECT * FROM `historynaptien` WHERE `code` ='".mysqli_real_escape_string($ketnoi,$seach)."'"));
if($dem1 > 0){
$seachans = "AND `id` = '$seach'";    
}elseif($dem2 > 0){
$seachans = "AND `seri` = '$seach'";    
}elseif($dem3 > 0){
$seachans = "AND `code` = '$seach'";    
}else{
$seachans = "";      
}
}else{
$seachans = "";      
}    
include('system/thongke.php');    
include('page/header.php');
include('page/nav.php');
include('page/menu.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="/"><i class="mdi mdi-home-outline"></i>Trang Chủ</a></li>
								<li class="breadcrumb-item" aria-current="page">Lịch Sử Nạp Card</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>	  

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			 <a style="float:right;" href="/report.html" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw me-1"></i> HỖ TRỢ</a>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					  <div class="row">
						<div class="col-xl-12">
					    
<div class="card">
<ul class="nav nav-tabs nav-tabs-v2 px-4">
<li class="nav-item me-3"><a href="#allTab" class="nav-link active px-2" data-bs-toggle="tab">Tất cả</a></li>
<li class="nav-item me-3"><a href="#Viettel" class="nav-link px-2" data-bs-toggle="tab">Viettel</a></li>
<li class="nav-item me-3"><a href="#Vinaphone" class="nav-link px-2" data-bs-toggle="tab">Vinaphone</a></li>
<li class="nav-item me-3"><a href="#Mobifone" class="nav-link px-2" data-bs-toggle="tab">Mobifone</a></li>
<li class="nav-item me-3"><a href="#Vietnamobile" class="nav-link px-2" data-bs-toggle="tab">Vietnamobile</a></li></ul>
<div class="tab-content p-4">
<div class="tab-pane fade show active" id="allTab">
<form method="GET" action="">
<div class="input-group">
										<input type="text" class="form-control" placeholder="seach" name="seach" id="seach" required="" aria-invalid="false"> 
										<button type="submit" class="btn btn-info btn-sm" type="button">Tìm kiếm</button> 
									</div>
</form>	

<div class="table-responsive">
<table class="table table-hover text-nowrap">
<thead>
<tr>
<th class="border-top-0 pt-0 pb-2">Focus</th>
<th class="border-top-0 pt-0 pb-2">ID</th>
<th class="border-top-0 pt-0 pb-2">Loại thẻ</th>
<th class="border-top-0 pt-0 pb-2">Seri</th>
<th class="border-top-0 pt-0 pb-2">Mã thẻ</th>
<th class="border-top-0 pt-0 pb-2">Mệnh giá</th>
<th class="border-top-0 pt-0 pb-2">Thực nhận</th>
<th class="border-top-0 pt-0 pb-2">Thời gian nạp</th>
<th class="border-top-0 pt-0 pb-2">Trạng thái</th>
<th class="border-top-0 pt-0 pb-2">Action</th>
</tr>
</thead>
<tbody>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `historynaptien` WHERE `username` = '$username' AND `webdinhdanh` = '$domain' AND `matinhnang` = 'card' $seachans"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `historynaptien` WHERE `username` = '$username' AND `webdinhdanh` = '$domain' AND `matinhnang` = 'card' $seachans  order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>    

 <tr>
<td>Bạn chưa có giao dịch nào !</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                               
                            </tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>       
<tr>
<td class="w-10px align-middle">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="product1">
<label class="form-check-label" for="product1"></label>
</div>
</td>
<td class="align-middle"><?=$row['id']?></td>
<td class="align-middle"><?=$row['type']?></td>
<td class="align-middle"><?=$row['seri']?></td>
<td class="align-middle"><?=$row['code']?></td>
<td class="align-middle"><?=number_format($row['sotien'])?> VNĐ</td>
<td class="align-middle"><?=number_format($row['thucnhan'])?> VNĐ</td>
<td class="align-middle"><?=$row['date']?></td>
<td class="align-middle"><?php if($row['status'] == 'choduyet'){echo '<span class="badge border border-warning text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Chờ xử lý</span>';}
elseif($row['status'] == 'thanhcong'){echo '<span class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thành công</span>';}
elseif($row['status'] == 'thatbai'){echo '<span class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thất bại</span>';}
?></td>
<td class="align-middle"><form action="/report.html" method="POST"><button type="submit" class="badge border border-primary text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Khiếu nại</button></form></td>
</tr>
<?php $i++; endwhile; endif; ?>  
</tbody>
</table>
</div>
<div class="d-md-flex align-items-center">
<div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
Hiện <?php $a = $i- 1; echo $a;?> kết quả từ trang <?=$total_pages?> có <?=$num_rec_per_page?> hàng
</div>
<ul class="pagination mb-0 justify-content-center">
<?
echo "<li class='page-item disabled'><a href='?page=1' class='page-link'>Trang đầu</a></li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item active'><a class='page-link'  href='?page=".$i."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' ?page=$total_pages'>Trang cuối</a></li>";
?>    
</ul>
</div>
</div>

<div class="tab-pane fade show" id="Viettel">
<form method="GET" action="">
<div class="input-group">
										<input type="text" class="form-control" placeholder="seach" name="seach" id="seach" required="" aria-invalid="false"> 
										<button type="submit" class="btn btn-info btn-sm" type="button">Tìm kiếm</button> 
									</div>
</form>	

<div class="table-responsive">
<table class="table table-hover text-nowrap">
<thead>
<tr>
<th class="border-top-0 pt-0 pb-2">Focus</th>
<th class="border-top-0 pt-0 pb-2">ID</th>
<th class="border-top-0 pt-0 pb-2">Loại thẻ</th>
<th class="border-top-0 pt-0 pb-2">Seri</th>
<th class="border-top-0 pt-0 pb-2">Mã thẻ</th>
<th class="border-top-0 pt-0 pb-2">Mệnh giá</th>
<th class="border-top-0 pt-0 pb-2">Thực nhận</th>
<th class="border-top-0 pt-0 pb-2">Thời gian nạp</th>
<th class="border-top-0 pt-0 pb-2">Trạng thái</th>
<th class="border-top-0 pt-0 pb-2">Action</th>
</tr>
</thead>
<tbody>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `historynaptien` WHERE `username` = '$username' AND `type` = 'Viettel' AND `webdinhdanh` = '$domain' AND `matinhnang` = 'card' $seachans"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `historynaptien` WHERE `username` = '$username' AND `type` = 'Viettel' AND `webdinhdanh` = '$domain' AND `matinhnang` = 'card' $seachans  order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>    

 <tr>
<td>Bạn chưa có giao dịch nào !</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                               
                            </tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>       
<tr>
<td class="w-10px align-middle">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="product1">
<label class="form-check-label" for="product1"></label>
</div>
</td>
<td class="align-middle"><?=$row['id']?></td>
<td class="align-middle"><?=$row['type']?></td>
<td class="align-middle"><?=$row['seri']?></td>
<td class="align-middle"><?=$row['code']?></td>
<td class="align-middle"><?=number_format($row['sotien'])?> VNĐ</td>
<td class="align-middle"><?=number_format($row['thucnhan'])?> VNĐ</td>
<td class="align-middle"><?=$row['date']?></td>
<td class="align-middle"><?php if($row['status'] == 'choduyet'){echo '<span class="badge border border-warning text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Chờ xử lý</span>';}
elseif($row['status'] == 'thanhcong'){echo '<span class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thành công</span>';}
elseif($row['status'] == 'thatbai'){echo '<span class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thất bại</span>';}
?></td>
<td class="align-middle"><form action="/report.html" method="POST"><button type="submit" class="badge border border-primary text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Khiếu nại</button></form></td>
</tr>
<?php $i++; endwhile; endif; ?>  
</tbody>
</table>
</div>
<div class="d-md-flex align-items-center">
<div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
Hiện <?php $a = $i- 1; echo $a;?> kết quả từ trang <?=$total_pages?> có <?=$num_rec_per_page?> hàng
</div>
<ul class="pagination mb-0 justify-content-center">
<?
echo "<li class='page-item disabled'><a href='?page=1' class='page-link'>Trang đầu</a></li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item active'><a class='page-link'  href='?page=".$i."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' ?page=$total_pages'>Trang cuối</a></li>";
?>    
</ul>
</div>
</div>

<div class="tab-pane fade show" id="Vinaphone">
<form method="GET" action="">
<div class="input-group">
										<input type="text" class="form-control" placeholder="seach" name="seach" id="seach" required="" aria-invalid="false"> 
										<button type="submit" class="btn btn-info btn-sm" type="button">Tìm kiếm</button> 
									</div>
</form>	

<div class="table-responsive">
<table class="table table-hover text-nowrap">
<thead>
<tr>
<th class="border-top-0 pt-0 pb-2">Focus</th>
<th class="border-top-0 pt-0 pb-2">ID</th>
<th class="border-top-0 pt-0 pb-2">Loại thẻ</th>
<th class="border-top-0 pt-0 pb-2">Seri</th>
<th class="border-top-0 pt-0 pb-2">Mã thẻ</th>
<th class="border-top-0 pt-0 pb-2">Mệnh giá</th>
<th class="border-top-0 pt-0 pb-2">Thực nhận</th>
<th class="border-top-0 pt-0 pb-2">Thời gian nạp</th>
<th class="border-top-0 pt-0 pb-2">Trạng thái</th>
<th class="border-top-0 pt-0 pb-2">Action</th>
</tr>
</thead>
<tbody>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `historynaptien` WHERE `username` = '$username' AND `type` = 'Vinaphone' AND `webdinhdanh` = '$domain' AND `matinhnang` = 'card' $seachans"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `historynaptien` WHERE `username` = '$username' AND `type` = 'Vinaphone' AND `webdinhdanh` = '$domain' AND `matinhnang` = 'card' $seachans  order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>    

 <tr>
<td>Bạn chưa có giao dịch nào !</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                               
                            </tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>       
<tr>
<td class="w-10px align-middle">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="product1">
<label class="form-check-label" for="product1"></label>
</div>
</td>
<td class="align-middle"><?=$row['id']?></td>
<td class="align-middle"><?=$row['type']?></td>
<td class="align-middle"><?=$row['seri']?></td>
<td class="align-middle"><?=$row['code']?></td>
<td class="align-middle"><?=number_format($row['sotien'])?> VNĐ</td>
<td class="align-middle"><?=number_format($row['thucnhan'])?> VNĐ</td>
<td class="align-middle"><?=$row['date']?></td>
<td class="align-middle"><?php if($row['status'] == 'choduyet'){echo '<span class="badge border border-warning text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Chờ xử lý</span>';}
elseif($row['status'] == 'thanhcong'){echo '<span class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thành công</span>';}
elseif($row['status'] == 'thatbai'){echo '<span class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thất bại</span>';}
?></td>
<td class="align-middle"><form action="/report.html" method="POST"><button type="submit" class="badge border border-primary text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Khiếu nại</button></form></td>
</tr>
<?php $i++; endwhile; endif; ?>  
</tbody>
</table>
</div>
<div class="d-md-flex align-items-center">
<div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
Hiện <?php $a = $i- 1; echo $a;?> kết quả từ trang <?=$total_pages?> có <?=$num_rec_per_page?> hàng
</div>
<ul class="pagination mb-0 justify-content-center">
<?
echo "<li class='page-item disabled'><a href='?page=1' class='page-link'>Trang đầu</a></li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item active'><a class='page-link'  href='?page=".$i."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' ?page=$total_pages'>Trang cuối</a></li>";
?>    
</ul>
</div>
</div>

<div class="tab-pane fade show" id="Mobifone">
<form method="GET" action="">
<div class="input-group">
										<input type="text" class="form-control" placeholder="seach" name="seach" id="seach" required="" aria-invalid="false"> 
										<button type="submit" class="btn btn-info btn-sm" type="button">Tìm kiếm</button> 
									</div>
</form>	

<div class="table-responsive">
<table class="table table-hover text-nowrap">
<thead>
<tr>
<th class="border-top-0 pt-0 pb-2">Focus</th>
<th class="border-top-0 pt-0 pb-2">ID</th>
<th class="border-top-0 pt-0 pb-2">Loại thẻ</th>
<th class="border-top-0 pt-0 pb-2">Seri</th>
<th class="border-top-0 pt-0 pb-2">Mã thẻ</th>
<th class="border-top-0 pt-0 pb-2">Mệnh giá</th>
<th class="border-top-0 pt-0 pb-2">Thực nhận</th>
<th class="border-top-0 pt-0 pb-2">Thời gian nạp</th>
<th class="border-top-0 pt-0 pb-2">Trạng thái</th>
<th class="border-top-0 pt-0 pb-2">Action</th>
</tr>
</thead>
<tbody>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `historynaptien` WHERE `username` = '$username' AND `type` = 'Mobifone' AND `webdinhdanh` = '$domain' AND `matinhnang` = 'card' $seachans"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `historynaptien` WHERE `username` = '$username' AND `type` = 'Mobifone' AND `webdinhdanh` = '$domain' AND `matinhnang` = 'card' $seachans  order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>    

 <tr>
<td>Bạn chưa có giao dịch nào !</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                               
                            </tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>       
<tr>
<td class="w-10px align-middle">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="product1">
<label class="form-check-label" for="product1"></label>
</div>
</td>
<td class="align-middle"><?=$row['id']?></td>
<td class="align-middle"><?=$row['type']?></td>
<td class="align-middle"><?=$row['seri']?></td>
<td class="align-middle"><?=$row['code']?></td>
<td class="align-middle"><?=number_format($row['sotien'])?> VNĐ</td>
<td class="align-middle"><?=number_format($row['thucnhan'])?> VNĐ</td>
<td class="align-middle"><?=$row['date']?></td>
<td class="align-middle"><?php if($row['status'] == 'choduyet'){echo '<span class="badge border border-warning text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Chờ xử lý</span>';}
elseif($row['status'] == 'thanhcong'){echo '<span class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thành công</span>';}
elseif($row['status'] == 'thatbai'){echo '<span class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thất bại</span>';}
?></td>
<td class="align-middle"><form action="/report.html" method="POST"><button type="submit" class="badge border border-primary text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Khiếu nại</button></form></td>
</tr>
<?php $i++; endwhile; endif; ?>  
</tbody>
</table>
</div>
<div class="d-md-flex align-items-center">
<div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
Hiện <?php $a = $i- 1; echo $a;?> kết quả từ trang <?=$total_pages?> có <?=$num_rec_per_page?> hàng
</div>
<ul class="pagination mb-0 justify-content-center">
<?
echo "<li class='page-item disabled'><a href='?page=1' class='page-link'>Trang đầu</a></li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item active'><a class='page-link'  href='?page=".$i."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' ?page=$total_pages'>Trang cuối</a></li>";
?>    
</ul>
</div>
</div>

<div class="tab-pane fade show" id="Vinaphone">
<form method="GET" action="">
<div class="input-group">
										<input type="text" class="form-control" placeholder="seach" name="seach" id="seach" required="" aria-invalid="false"> 
										<button type="submit" class="btn btn-info btn-sm" type="button">Tìm kiếm</button> 
									</div>
</form>	

<div class="table-responsive">
<table class="table table-hover text-nowrap">
<thead>
<tr>
<th class="border-top-0 pt-0 pb-2">Focus</th>
<th class="border-top-0 pt-0 pb-2">ID</th>
<th class="border-top-0 pt-0 pb-2">Loại thẻ</th>
<th class="border-top-0 pt-0 pb-2">Seri</th>
<th class="border-top-0 pt-0 pb-2">Mã thẻ</th>
<th class="border-top-0 pt-0 pb-2">Mệnh giá</th>
<th class="border-top-0 pt-0 pb-2">Thực nhận</th>
<th class="border-top-0 pt-0 pb-2">Thời gian nạp</th>
<th class="border-top-0 pt-0 pb-2">Trạng thái</th>
<th class="border-top-0 pt-0 pb-2">Action</th>
</tr>
</thead>
<tbody>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `historynaptien` WHERE `username` = '$username' AND `type` = 'Vinaphone' AND `webdinhdanh` = '$domain' AND `matinhnang` = 'card' $seachans"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `historynaptien` WHERE `username` = '$username' AND `type` = 'Vinaphone' AND `webdinhdanh` = '$domain' AND `matinhnang` = 'card' $seachans  order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>    

 <tr>
<td>Bạn chưa có giao dịch nào !</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                               
                            </tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>       
<tr>
<td class="w-10px align-middle">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="product1">
<label class="form-check-label" for="product1"></label>
</div>
</td>
<td class="align-middle"><?=$row['id']?></td>
<td class="align-middle"><?=$row['type']?></td>
<td class="align-middle"><?=$row['seri']?></td>
<td class="align-middle"><?=$row['code']?></td>
<td class="align-middle"><?=number_format($row['sotien'])?> VNĐ</td>
<td class="align-middle"><?=number_format($row['thucnhan'])?> VNĐ</td>
<td class="align-middle"><?=$row['date']?></td>
<td class="align-middle"><?php if($row['status'] == 'choduyet'){echo '<span class="badge border border-warning text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Chờ xử lý</span>';}
elseif($row['status'] == 'thanhcong'){echo '<span class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thành công</span>';}
elseif($row['status'] == 'thatbai'){echo '<span class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thất bại</span>';}
?></td>
<td class="align-middle"><form action="/report.html" method="POST"><button type="submit" class="badge border border-primary text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Khiếu nại</button></form></td>
</tr>
<?php $i++; endwhile; endif; ?>  
</tbody>
</table>
</div>
<div class="d-md-flex align-items-center">
<div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
Hiện <?php $a = $i- 1; echo $a;?> kết quả từ trang <?=$total_pages?> có <?=$num_rec_per_page?> hàng
</div>
<ul class="pagination mb-0 justify-content-center">
<?
echo "<li class='page-item disabled'><a href='?page=1' class='page-link'>Trang đầu</a></li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item active'><a class='page-link'  href='?page=".$i."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' ?page=$total_pages'>Trang cuối</a></li>";
?>    
</ul>
</div>
</div><div class="tab-pane fade show" id="Vietnamobile">
<form method="GET" action="">
<div class="input-group">
										<input type="text" class="form-control" placeholder="seach" name="seach" id="seach" required="" aria-invalid="false"> 
										<button type="submit" class="btn btn-info btn-sm" type="button">Tìm kiếm</button> 
									</div>
</form>	

<div class="table-responsive">
<table class="table table-hover text-nowrap">
<thead>
<tr>
<th class="border-top-0 pt-0 pb-2">Focus</th>
<th class="border-top-0 pt-0 pb-2">ID</th>
<th class="border-top-0 pt-0 pb-2">Loại thẻ</th>
<th class="border-top-0 pt-0 pb-2">Seri</th>
<th class="border-top-0 pt-0 pb-2">Mã thẻ</th>
<th class="border-top-0 pt-0 pb-2">Mệnh giá</th>
<th class="border-top-0 pt-0 pb-2">Thực nhận</th>
<th class="border-top-0 pt-0 pb-2">Thời gian nạp</th>
<th class="border-top-0 pt-0 pb-2">Trạng thái</th>
<th class="border-top-0 pt-0 pb-2">Action</th>
</tr>
</thead>
<tbody>
<?php
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$i=1;
$num_rec_per_page=100;
$start_from = ($page-1) * $num_rec_per_page;
$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `historynaptien` WHERE `username` = '$username' AND `type` = 'Vietnamobile' AND `webdinhdanh` = '$domain' AND `matinhnang` = 'card' $seachans"));
$total_pages = ceil($total_records / $num_rec_per_page);                                            
$respawn = mysqli_query($ketnoi,"SELECT * FROM `historynaptien` WHERE `username` = '$username' AND `type` = 'Vietnamobile' AND `webdinhdanh` = '$domain' AND `matinhnang` = 'card' $seachans  order by id desc LIMIT $start_from, $num_rec_per_page ");
if (mysqli_num_rows($respawn) == 0):
?>    

 <tr>
<td>Bạn chưa có giao dịch nào !</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                               
                            </tr>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>       
<tr>
<td class="w-10px align-middle">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="product1">
<label class="form-check-label" for="product1"></label>
</div>
</td>
<td class="align-middle"><?=$row['id']?></td>
<td class="align-middle"><?=$row['type']?></td>
<td class="align-middle"><?=$row['seri']?></td>
<td class="align-middle"><?=$row['code']?></td>
<td class="align-middle"><?=number_format($row['sotien'])?> VNĐ</td>
<td class="align-middle"><?=number_format($row['thucnhan'])?> VNĐ</td>
<td class="align-middle"><?=$row['date']?></td>
<td class="align-middle"><?php if($row['status'] == 'choduyet'){echo '<span class="badge border border-warning text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Chờ xử lý</span>';}
elseif($row['status'] == 'thanhcong'){echo '<span class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thành công</span>';}
elseif($row['status'] == 'thatbai'){echo '<span class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Thất bại</span>';}
?></td>
<td class="align-middle"><form action="/report.html" method="POST"><button type="submit" class="badge border border-primary text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle fs-9px fa-fw me-5px"></i> Khiếu nại</button></form></td>
</tr>
<?php $i++; endwhile; endif; ?>  
</tbody>
</table>
</div>
<div class="d-md-flex align-items-center">
<div class="me-md-auto text-md-left text-center mb-2 mb-md-0">
Hiện <?php $a = $i- 1; echo $a;?> kết quả từ trang <?=$total_pages?> có <?=$num_rec_per_page?> hàng
</div>
<ul class="pagination mb-0 justify-content-center">
<?
echo "<li class='page-item disabled'><a href='?page=1' class='page-link'>Trang đầu</a></li>"; 
for ($i=1; $i<=$total_pages; $i++) {
echo "<li class='page-item active'><a class='page-link'  href='?page=".$i."'>".$i."</a></li>";
};
echo "<li class='page-item'><a class='page-link' ?page=$total_pages'>Trang cuối</a></li>";
?>    
</ul>
</div>
</div>
</div>
<div class="card-arrow">
<div class="card-arrow-top-left"></div>
<div class="card-arrow-top-right"></div>
<div class="card-arrow-bottom-left"></div>
<div class="card-arrow-bottom-right"></div>
</div>
</div>

</div>
					  </div>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
<?php
include('page/banquyen.php');
?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar">
	  
	<div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger" data-toggle="control-sidebar"><i class="ion ion-close text-white"></i></span> </div>  <!-- Create the tabs -->
    <ul class="nav nav-tabs control-sidebar-tabs">
      <li class="nav-item"><a href="#control-sidebar-home-tab" data-bs-toggle="tab" class="active"><i class="mdi mdi-message-text"></i></a></li>
      <li class="nav-item"><a href="#control-sidebar-settings-tab" data-bs-toggle="tab"><i class="mdi mdi-playlist-check"></i></a></li>
    </ul>

  </aside>
  <!-- /.control-sidebar -->
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->
	
	<!-- ./side demo panel -->
	<div class="sticky-toolbar">	    
	    <a href="/?mode=dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Dark Mode" class="waves-effect waves-dark btn btn-success btn-flat mb-5 btn-sm" target="_blank">
			<i class="fas fa-moon"></i>
		</a>
	    <a href="/?mode=light" data-bs-toggle="tooltip" data-bs-placement="left" title="Light Mode" class="waves-effect waves-light btn btn-danger btn-flat mb-5 btn-sm" target="_blank">
		<i class="fas fa-lightbulb"></i>
		</a>
	    <a id="chat-popup" href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Kênh Hỗ Trợ" class="waves-effect waves-light btn btn-warning btn-flat btn-sm">
			<span class="icon-Group-chat"><span class="path1"></span><span class="path2"></span></span>
		</a>
	</div>
	<!-- Sidebar -->
		
	<div id="chat-box-body">
	     <a href="<?=$kenhthongbao?>">
		<div id="chat-circle" class="waves-effect waves-circle btn btn-circle btn-lg btn-warning l-h-70">
            <div id="chat-overlay"></div>
           
            <span class="icon-Group-chat fs-30"><span class="path1"></span><span class="path2"></span></span>
		</div>
		</a>
	</div>
	
	<!-- Page Content overlay -->
	
<?php
include('page/footer.php');
}
?>

