<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <br>
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 100%;">	
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">	
			    <?php if($admin =='yes'){ ?>
			    <li>
				  <a href="/administrator">
					<i class="fas fa-cogs"></i>
					<span style="color:red">Trang Quản Trị</span>
				  </a>
				</li>
				<?php } ?>
				<li class="treeview">
				  <a href="#">
					<i class="fas fa-user-cog"></i>
					<span>Trang cá nhân</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li><a href="/clound/infomation.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Thông tin tài khoản</a></li>
					<li><a href="/clound/history.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Biến động số dư</a></li>
					<li><a href="/clound/history-ordes.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lịch sử đơn hàng</a></li>
					<li><a href="/clound/history-clone.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Lịch sử mua Clone</a></li>
				  </ul>
				</li>
				<li class="treeview">
				  <a href="#">
					<i class="fas fa-wallet"></i>
					<span>Nạp Tiền</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li><a href="/clound/card.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Nạp Bằng Thẻ Cào</a></li>
					<li><a href="/clound/bank.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Nạp Bằng ATM</a></li>
					<li><a href="/clound/paypal.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Nạp Bằng Paypal</a></li>
				  </ul>
				</li>
				<li class="treeview">
				  <a href="#">
					<i class="fas fa-code"></i>
					<span>API</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li><a href="/clound/api.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>API DVMXH</a></li>
					<li><a href="/clound/api-clone.htmll"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>API SHOPCLONE</a></li>
				  </ul>
				</li>
				
				<li>
				  <a href="/clound/error.html">
				<i class="fas fa-life-ring"></i>
					<span>Hỗ trợ IT - Báo Lỗi</span>
				  </a>
				</li>
				<li>
				  <a href="/clound/buyclone.html">
				<i class="fas fa-store"></i>
					<span>Mua Clone - Tool FB</span>
				  </a>
				</li>
	<?php                              
$respawn = mysqli_query($ketnoi,"SELECT * FROM `danhmuc` WHERE `webdinhdanh` = '$domain' order by sapxep");
if (mysqli_num_rows($respawn) == 0):
?><p>Không có danh mục</p>
<?php else: while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)):?>
<li class="treeview">
				  <a href="#">
					<?=$row['icon']?></i>
					<span><?=$row['tendichvu']?></span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
				      
<?php                              
$respawn1 = mysqli_query($ketnoi,"SELECT * FROM `danhmuctinhnang` WHERE `webdinhdanh` = '$domain' AND `danhmuc` = '".$row['id']."' order by sapxep");
if (mysqli_num_rows($respawn1) == 0):
?><p>Không có danh mục con</p>
<?php else: while ($row1 = mysqli_fetch_array($respawn1, MYSQLI_ASSOC)):?>
    <li class="treeview">
						<a href="#">
							<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i><?=$row1['tendichvu']?>
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
    <?php                              
$respawn2 = mysqli_query($ketnoi,"SELECT * FROM `danhmuccon` WHERE `webdinhdanh` = '$domain' AND `danhmuctinhnang` = '".$row1['id']."' AND `action` ='on' order by sapxep");
if (mysqli_num_rows($respawn2) == 0):
?><p>Không có tính năng</p>
<?php else: while ($row2 = mysqli_fetch_array($respawn2, MYSQLI_ASSOC)):?>
	<li><a href="/services/<?=$row2['id']?>"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i><?=$row2['tendichvucon']?></a></li>
<?php endwhile; endif; ?> 
	</ul>
					</li>
<?php endwhile; endif; ?>  
 </ul>
				</li>
<?php endwhile; endif; ?> 			

				
			  </ul>
			  
			  <div class="sidebar-widgets">
				  <div class="mx-25 mb-30 pb-20 side-bx bg-primary-light rounded20">
					<div class="text-center">
						<img src="../images/respawn/social.png" class="sideimg p-5" alt="">
						<h4 class="title-bx text-primary">Dịch vụ mạng xã hội</h4>
						<a href="#" class="py-10 fs-14 mb-0 text-primary">
							Giá rẻ chất lượng <i class="mdi mdi-arrow-right"></i>
						</a>
					</div>
				  </div>
				<div class="copyright text-center m-25">
					<p><strong class="d-block">Giao diện độc quyền</strong> © <script>document.write(new Date().getFullYear())</script> <?=$domain?> All Rights Reserved</p>
				</div>
			  </div>
		  </div>
		</div>
    </section>
  </aside>