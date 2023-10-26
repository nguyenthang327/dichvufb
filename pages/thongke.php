<div class="row">
	<div class="col-xl-3 col-md-6 col-6">
		<div class="box">
			<div class="box-body text-center">
				<div class="bg-primary-light rounded10 p-20 mx-auto w-100 h-100">
					<img src="../images/respawn/wallet.png" class="" alt="" />
				</div>
				<p class="text-fade mt-15 mb-5">SỐ DƯ (VNĐ)</p>
				<h4 class="mt-0"><?= number_format($cash) ?></h4>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 col-6">
		<div class="box">
			<div class="box-body text-center">
				<div class="bg-danger-light rounded10 p-20 mx-auto w-100 h-100">
					<img src="../images/respawn/wallet.png" class="" alt="" />
				</div>
				<p class="text-fade mt-15 mb-5">TỔNG NẠP (VNĐ)</p>
				<h4 class="mt-0"><?= number_format($tongnap) ?></h4>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 col-6">
		<div class="box">
			<div class="box-body text-center">
				<div class="bg-warning-light rounded10 p-20 mx-auto w-100 h-100">
					<img src="../images/respawn/running.png" class="" alt="" />
				</div>
				<p class="text-fade mt-15 mb-5">ĐƠN ĐANG CHẠY</p>
				<h4 class="mt-0"><?= number_format($tongdondangchay) ?></h4>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 col-6">
		<div class="box">
			<div class="box-body text-center">
				<div class="bg-info-light rounded10 p-20 mx-auto w-100 h-100">
					<img src="../images/respawn/finish.png" class="" alt="" />
				</div>
				<p class="text-fade mt-15 mb-5">ĐƠN HOÀN THÀNH</p>
				<h4 class="mt-0"><?= number_format($tongdonthanhcong) ?></h4>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-3 col-md-6 col-6">
		<div class="box">
			<div class="box-body text-center">
				<div class="bg-primary-light rounded10 p-20 mx-auto w-100 h-100">
					<img src="../images/respawn/purchase.png" class="" alt="" />
				</div>
				<p class="text-fade mt-15 mb-5">TỔNG DÙNG (VNĐ)</p>
				<h4 class="mt-0"><?= number_format($tongdung) ?></h4>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 col-6">
		<div class="box">
			<div class="box-body text-center">
				<div class="bg-danger-light rounded10 p-20 mx-auto w-100 h-100">
					<img src="../images/respawn/wallet.png" class="" alt="" />
				</div>
				<p class="text-fade mt-15 mb-5">TIỀN HOÀN (VNĐ)</p>
				<h4 class="mt-0"><?= number_format($tonghoan) ?></h4>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 col-6">
		<div class="box">
			<div class="box-body text-center">
				<div class="bg-warning-light rounded10 p-20 mx-auto w-100 h-100">
					<img src="../images/respawn/running.png" class="" alt="" />
				</div>
				<p class="text-fade mt-15 mb-5">ĐƠN CHỜ XỬ LÝ</p>
				<h4 class="mt-0"><?= number_format($tongdonxuly) ?></h4>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-md-6 col-6">
		<div class="box">
			<div class="box-body text-center">
				<div class="bg-info-light rounded10 p-20 mx-auto w-100 h-100">
					<img src="../images/respawn/finish.png" class="" alt="" />
				</div>
				<p class="text-fade mt-15 mb-5">ĐƠN LỖI</p>
				<h4 class="mt-0"><?= number_format($tongdonloi) ?></h4>
			</div>
		</div>
	</div>
</div>