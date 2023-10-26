<?php
include('../system/config.php');
if (!isset($_SESSION['username'])) {
  header('location:/');
  exit();
} elseif ($admin !== 'yes') {
  header('location:/');
  exit();
} else {
  include('../system/thongke.php');
  include('page/header.php');
  include('page/menu.php');
  if (isset($_GET['action']) && isset($_GET['target'])) {
    $action = addslashes($_GET['action']);
    $target = addslashes($_GET['target']);
    if ($action == 'del') {
      mysqli_query($ketnoi, "DELETE FROM `banker` WHERE `id`='$target' AND `webdinhdanh` = '$domain'");
      die('<script type="text/javascript">swal("Thông báo","Xóa thành công !","success"); setTimeout(function(){ location.href = "/administrator/bank.html" },2000);</script>');
    } elseif ($action == 'edit') {
      $databak = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM `banker` WHERE `id` ='$target' AND `webdinhdanh` = '$domain'"));
      $tenbank = $databak['tenbank'];
      $idbank = $databak['id'];
      $chuthe = $databak['chuthe'];
      $stk = $databak['stk'];
      $noidung = $databak['noidung'];
      $toithieu = $databak['toithieu'];
      $urlanh = $databak['urlanh'];
      $userbank = $databak['userbank'];
      $mkbank = $databak['mkbank'];
      $token = $databak['token'];
      $mabank = $databak['mabank'];
      $tygia = $databak['tygia'];
    } else {
      $tenbank = '';
      $idbank = '';
      $chuthe = '';
      $stk = '';
      $noidung = '';
      $toithieu = '';
      $urlanh = '';
      $userbank = 'Không dùng';
      $mkbank = 'Không dùng';
      $token = 'Không dùng';
      $mabank = 'khac';
      $tygia = 100;
    }
  } else {
    $idbank = '';
    $tenbank = '';
    $chuthe = '';
    $stk = '';
    $noidung = '';
    $toithieu = '';
    $urlanh = '';
    $userbank = 'Không dùng';
    $mkbank = 'Không dùng';
    $token = 'Không dùng';
    $mabank = 'khac';
    $tygia = 100;
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
            <h1 class="m-0"><i class="fas fa-university"></i> Cài Đặt Ngân Hàng - Ví Điện Tử</h1>
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
                <h3 class="card-title">Cài Đặt Ngân Hàng - Ví Điện Tử</h3>
              </div>


              <div>
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" id="idbank" name="idbank" value="<?= $idbank ?>">
                    <label for="disabledInput">Tên Bank - Ví điện tử</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Ví dụ: Vietcombank" value="<?= $tenbank ?>">
                  </div>
                  <div class="form-group">
                    <label for="disabledInput">Chủ Thẻ</label>
                    <input type="text" class="form-control" id="chuthe" name="chuthe" placeholder="Tên chủ thẻ" value="<?= $chuthe ?>">
                  </div>
                  <div class="form-group">
                    <label for="disabledInput">Số Tài Khoản</label>
                    <input type="text" class="form-control" id="stk" name="stk" placeholder="" value="<?= $stk ?>">
                  </div>
                  <div class="form-group">
                    <label for="disabledInput">Link Ảnh (Nên dùng ảnh có đuôi là PNG xóa nền)</label>
                    <input type="link" class="form-control" id="link" name="link" placeholder="https://th.bing.com/th/id/OIP.lQKBBxYtNod02vRu2ZA7..." value="<?= $urlanh ?>">
                  </div>
                  <div class="form-group">
                    <label for="disabledInput">Nội dung nạp</label>
                    <input type="text" class="form-control" id="note1" name="note1" placeholder="naptien" value="<?= $noidung ?>">
                  </div>
                  <div class="form-group">
                    <label for="disabledInput">Mốc nạp tối thiểu</label>
                    <input type="number" class="form-control" id="min" name="min" placeholder="10000" value="<?= $toithieu ?>">
                  </div>
                  <div class="form-group">
                    <label for="disabledInput">Tỷ giá nạp (100 ATM = <?= $tygia ?> VNĐ)</label>
                    <input type="number" class="form-control" id="tygia" name="tygia" placeholder="10000" value="<?= $tygia ?>">
                  </div>
                  <p>* Phần này dành cho nạp tự động Nếu Không sử dụng thì không cần sửa ! </p>
                  <div class="form-group">
                    <label for="disabledInput">Tên đăng nhập internet Banking (MOMO nhập SĐT)</label>
                    <input type="text" class="form-control" id="userbank" name="userbank" badge bg value="<?= $userbank ?>">
                  </div>
                  <div class="form-group">
                    <label for="disabledInput">Chọn auto bank - ví</label>
                    <select class="form-control" name="mabank" id="mabank">
                      <option value="mbb" <?php if ($mabank == 'mbb') {
                                            echo 'selected="selected"';
                                          } ?>>MB Bank</option>
                      <option value="vcb" <?php if ($mabank == 'vcb') {
                                            echo 'selected="selected"';
                                          } ?>>Vietcombank</option>
                      <option value="momo" <?php if ($mabank == 'momo') {
                                              echo 'selected="selected"';
                                            } ?>>Ví Momo</option>
                      <option value="acb" <?php if ($mabank == 'acb') {
                                            echo 'selected="selected"';
                                          } ?>>ACB</option>
                      <option value="khac" <?php if ($mabank == 'khac') {
                                              echo 'selected="selected"';
                                            } ?>>Không dùng Auto</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="disabledInput">Mật khẩu internet Banking (MOMO nhập SĐT)</label>
                    <input type="text" class="form-control" id="mkbank" name="mkbank" badge bg value="<?= $mkbank ?>">
                  </div>
                  <div class="form-group">
                    <label for="disabledInput">Token Đối Tác (Web2M)</label>
                    <input type="text" class="form-control" id="tokendoitac" name="tokendoitac" badge bg value="<?= $token ?>">
                  </div>

                </div>

                <div class="card-footer">
                  <center><button onclick="submit();" type="submit" id="submit" id="submit" class="btn btn-primary btn-lg"><i class="fas fa-cogs"></i> Cấu hình</button></center>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ngân Hàng - Ví điện tử đã thêm</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Ngân hàng - ví</th>
                        <th>Chủ thẻ</th>
                        <th>Số tài khoản - ví</th>
                        <th>Nội dung nạp</th>
                        <th>Nạp tối thiểu</th>
                        <th>Tỷ giá</th>
                        <th>Tính năng</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (isset($_GET["page"])) {
                        $page  = $_GET["page"];
                      } else {
                        $page = 1;
                      };
                      $i = 1;
                      $num_rec_per_page = 100;
                      $start_from = ($page - 1) * $num_rec_per_page;
                      $total_records = mysqli_num_rows(mysqli_query($ketnoi, "SELECT * FROM `banker` WHERE `webdinhdanh` = '$domain'"));
                      $total_pages = ceil($total_records / $num_rec_per_page);
                      $respawn = mysqli_query($ketnoi, "SELECT * FROM `banker` WHERE `webdinhdanh` = '$domain' order by id desc LIMIT $start_from, $num_rec_per_page ");
                      if (mysqli_num_rows($respawn) == 0) :
                      ?>
                        <tr>
                          <td valign="top" colspan="100%">Không có dữ liệu để hiển thị !</td>
                        </tr>
                        <?php else : while ($row = mysqli_fetch_array($respawn, MYSQLI_ASSOC)) : ?>
                          <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><img src="<?php echo $row['urlanh'] ?>" width="100px"></td>
                            <td><?php echo $row['chuthe'] ?></td>
                            <td><?php echo $row['stk'] ?></td>
                            <td><?php echo $row['noidung'] ?></td>
                            <td><?php echo number_format($row['toithieu'], '0', '.', '.'); ?> VNĐ</td>
                            <td>100 ATM/Wallet = <?php echo number_format($row['tygia'], '0', '.', '.'); ?> VNĐ</td>
                            <td><a class="badge bg-success" href="/administrator/bank.html?action=edit&target=<?php echo $row['id'] ?>">Edit</a> <a class="badge bg-danger" href="/administrator/bank.html?action=del&target=<?php echo $row['id'] ?>">Xóa</a></td>
                          </tr>
                      <?php $i++;
                        endwhile;
                      endif; ?>
                    </tbody>
                  </table>
                </div>
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

        </div>

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    function submit() {
      if (!$('#name')['val']()) {
        swal('ERROR', 'Tên bank là gì ?', 'error')
      } else {
        if (!$('#chuthe')['val']()) {
          swal('ERROR', 'Chủ thẻ là gì ?', 'error')
        } else {
          if (!$('#stk')['val']()) {
            swal('ERROR', 'Số tài khoản là gì ?', 'error')
          } else {
            if (!$('#link')['val']()) {
              swal('ERROR', 'Link ảnh là gì ?', 'error')
            } else {
              if (!$('#note1')['val']()) {
                swal('ERROR', 'Nội dung là gì ?', 'error')
              } else {
                if (!$('#tygia')['val']()) {
                  swal('ERROR', 'Vui lòng nhập tỷ giá', 'error')
                } else {
                  if (!$('#min')['val']()) {
                    swal('ERROR', 'Tối thiểu bao nhiêu ?', 'error')
                  } else {
                    nap()
                  }
                }
              }
            }
          }
        }
      }
    }

    function nap() {
      $('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
      $['post']('../action/admin.php', {
          name: $('#name')['val'](),
          chuthe: $('#chuthe')['val'](),
          stk: $('#stk')['val'](),
          link: $('#link')['val'](),
          note1: $('#note1')['val'](),
          mabank: $('#mabank')['val'](),
          tygia: $('#tygia')['val'](),
          min: $('#min')['val'](),
          userbank: $('#userbank')['val'](),
          tokendoitac: $('#tokendoitac')['val'](),
          idbank: $('#idbank')['val'](),
          mkbank: $('#mkbank')['val']()
        },
        function(_0xb982x3) {
          swal(_0xb982x3['title'], _0xb982x3['msg'], _0xb982x3['status']);
          $('#submit')['html']('<i class="fas fa-cogs"></i> Cấu hình thêm')
        }, 'json')
    }
  </script>
<?php
  include('page/footer.php');
}
?>