<?php
require_once('../system/config.php');
if (!isset($_SESSION['username'])) {
	header('location:/clients/login.html');
} else {
	require_once('../system/thongke.php');
	require_once('../pages/header.php');;
	include('../pages/nav.php');
	include('../pages/menu.php');
	if (isset($_GET['date']) && isset($_GET['code'])) {
		$date = $_GET['date'];
		$code = xss($_GET['code']);
		if (!empty($date)) {
			$a = " AND `date` > '$date 00:00:00' AND `date` < '$date 23:59:59'";
		} else {
			$a = '';
		}
		if (!empty($code)) {
			$b = "AND `codeoder` = '$code'";
		} else {
			$b = '';
		}
	} else {
		$a = '';
		$b = '';
	}
?>
	<style>
		.goog-te-banner-frame.skiptranslate {
			display: none !important;
		}

		body {
			top: 0px !important;
		}
	</style>
	<style>
		respawn {
			padding: 1px;
		}
	</style>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<br>
		<div class="container-full">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="d-flex align-items-center">
					<div class="me-auto">
						<div class="d-inline-block align-items-center">
							<nav>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="mdi mdi-home-outline"></i>Trang Chủ</a></li>
									<li class="breadcrumb-item" aria-current="page">Ngân hàng/ Ví điện tử</li>
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
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="table-responsive ">
								<table class="table">
									<thead>
										<tr>
											<th>Brand</th>
											<th>Ngân hàng/ Ví điện tử</th>
											<th>Tối thiểu</th>
											<th>Số tài khoản</th>
											<th>Chủ tài khoản</th>
											<th>Nội dung</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$respawn = mysqli_query($ketnoi, "SELECT * FROM `banker` WHERE `webdinhdanh` = '$domain' order by id desc");
										if (mysqli_num_rows($respawn) == 0) :
										?>
											<tr>
												<td valign="top" colspan="100%">Admin chưa thêm ngân hàng nhận tiền</td>
											</tr>
											<?php else : while ($rowhis = mysqli_fetch_array($respawn, MYSQLI_ASSOC)) : ?>
												<tr>
													<td><img src="<?= $rowhis['urlanh'] ?>" width="50px"></td>
													<td><?= $rowhis['tenbank'] ?></td>
													<td><?= number_format($rowhis['toithieu']) ?> VNĐ</td>
													<td><?= $rowhis['stk'] ?> <span class="badge badge-success" type="button" onclick="copy('<?= $rowhis['stk'] ?>');"><i class="fas fa-copy"></i></span></td>
													<td><?= $rowhis['chuthe'] ?></td>
													<td><?= $rowhis['noidung'] ?><?= $idacc ?> <span class="badge badge-success" type="button" onclick="copy('<?= $rowhis['noidung'] ?><?= $idacc ?>');"><i class="fas fa-copy"></i></span></td>
													<td>
													</td>
												</tr>
										<?php endwhile;
										endif; ?>
									</tbody>
								</table>
							</div>


							<div><img src="https://img.vietqr.io/image/mbbank-001010588888-compact2.jpg?amount=50000&addInfo=dvfb24h <?= $idacc ?>&accountName=LE%XUAN%CHUNG" alt="Girl in a jacket" width="540" height="640"></div>
							<!---<div><a href="https://img.vietqr.io/image/mbbank-205102622-compact2.jpg?amount=50000&addInfo=dvfb24h <?= $idacc ?>&accountName=LE%20THI%20THU"class="primary-btn">MÃ QR TẠI ĐÂY</a></div> --->

							<div class="page-header">
								<div class="page-title">
									<h4>Lịch sử nạp tiền</h4>
									<h6>(Hệ thống tự động cộng tiền sau 1 phút)</h6>
								</div>
							</div>
							<form method="GET">
								<div class="row">
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="form-group">
											<label>Thời Gian</label>
											<div class="input-groupicon">
												<input name="date" id="date" type="date" placeholder="DD-MM-YYYY" class="form-control">
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="form-group">
											<label>Mã Đơn</label>
											<input type="text" id="code" name="code" class="form-control">
										</div>
									</div>
									<div class="col-lg-3 col-sm-6 col-12">
										<div class="form-group">
											<label>Hành động</label>
											<button class="btn btn-success" type="submit">Tìm kiếm</button>
											<a href="/clound/bank.html" class="btn btn-danger">Reset</a>
										</div>
									</div>
								</div>
							</form>
							<div class="row">
								<div class="table-responsive ">
									<table class="table">
										<thead>
											<tr>
												<th>Loại bank</th>
												<th>Mã giao dịch</th>
												<th>Số tiền</th>
												<th>Thực nhận</th>
												<th>Thời gian nạp</th>
												<th>Trạng thái</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php
											if (isset($_GET["page"])) {
												$page  = $_GET["page"];
											} else {
												$page = 1;
											};

											$num_rec_per_page = 50;
											$start_from = ($page - 1) * $num_rec_per_page;
											$total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `historynaptien` WHERE `webdinhdanh` = '$domain' AND `username` ='$username' $a $b"));
											$total_pages = ceil($total_records / $num_rec_per_page);
											$respawn = mysqli_query($ketnoi, "SELECT * FROM `historynaptien` WHERE `webdinhdanh` = '$domain' AND `username` ='$username' $a $b order by id desc LIMIT $start_from, $num_rec_per_page ");
											if (mysqli_num_rows($respawn) == 0) :
											?>
												<tr>
													<td valign="top" colspan="100%">Bạn chưa có lịch sử nào</td>
												</tr>
												<?php else : while ($rowhis = mysqli_fetch_array($respawn, MYSQLI_ASSOC)) : ?>
													<tr>
														<td><?= $rowhis['type'] ?></td>
														<td><?= $rowhis['magd'] ?></td>
														<td><?= number_format($rowhis['sotien']) ?> VNĐ</td>
														<td><?= number_format($rowhis['sotien']) ?> VNĐ</td>
														<td><?= $rowhis['date'] ?></td>
														<td><span class="badge badge-success"><?= $rowhis['status'] ?></span></td>
														<td>
														</td>
													</tr>
											<?php endwhile;
											endif; ?>
										</tbody>
									</table>
								</div>
							</div>
							<center>
								<ul class="pagination">
									<?
									echo "<li class='page-item'><a class='page-link' href='?page=1'>" . 'Trang đầu' . "</a> </li>";
									for ($i = 1; $i <= $total_pages; $i++) {
										echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
									};
									echo "<li class='page-item'><a class='page-link' href='?page=$total_pages'>" . 'Trang cuối' . "</a></li>";
									?>
								</ul>
							</center>
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
	include('../pages/banquyen.php');
	?>
	<!-- Control Sidebar -->
	<aside class="control-sidebar">

		<div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger" data-toggle="control-sidebar"><i class="ion ion-close text-white"></i></span> </div> <!-- Create the tabs -->
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
		<a href="/?mode=dark" data-bs-toggle="tooltip" data-bs-placement="left" title="Dark Mode" class="waves-effect waves-dark btn btn-success btn-flat mb-5 btn-sm">
			<i class="fas fa-moon"></i>
		</a>
		<a href="/?mode=light" data-bs-toggle="tooltip" data-bs-placement="left" title="Light Mode" class="waves-effect waves-light btn btn-danger btn-flat mb-5 btn-sm">
			<i class="fas fa-lightbulb"></i>
		</a>
		<a id="chat-popup" href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Kênh Hỗ Trợ" class="waves-effect waves-light btn btn-warning btn-flat btn-sm">
			<span class="icon-Group-chat"><span class="path1"></span><span class="path2"></span></span>
		</a>
	</div>
	<!-- Sidebar -->

	<div id="chat-box-body">
		<a href="<?= $kenhthongbao ?>" target="blank">
			<div id="chat-circle" class="waves-effect waves-circle btn btn-circle btn-lg btn-warning l-h-70">
				<div id="chat-overlay"></div>

				<span class="icon-Group-chat fs-30"><span class="path1"></span><span class="path2"></span></span>
			</div>
		</a>
	</div>
	<div id="trave"></div>
	<script type="text/javascript">
		function copy(text) {
			document.body.insertAdjacentHTML("beforeend", "<div id=\"copy\" contenteditable>" + text + "</div>")
			document.getElementById("copy").focus();
			document.execCommand("selectAll");
			document.execCommand("copy");
			document.getElementById("copy").remove();
			swal("SUCCESS", "Bạn đã sao chép thành công", "success");
			event.preventDefault();
		}
	</script>
	<!-- Page Content overlay -->
<?php
	include('../pages/footer.php');
}
?>