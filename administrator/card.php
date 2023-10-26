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
            <h1 class="m-0"><i class="far fa-credit-card"></i> Cài Đặt Thẻ Cào</h1>
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
                <h3 class="card-title">Cài Đặt Thẻ Cào</h3>
              </div>


              <div>
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" id="idbank" name="idbank" value="<?= $idbank ?>">
                    <label for="disabledInput">Tỷ giá (100 Card = <?= $ratecard ?> VNĐ)</label>
                    <input type="text" class="form-control" id="tygia" name="tygia" placeholder="Ví dụ: 75" value="<?= $ratecard ?>">
                  </div>
                  <div class="form-group">
                    <label for="disabledInput">Partner ID</label>
                    <input type="text" class="form-control" id="partnerid" name="partnerid" placeholder="" value="<?= $partnerid ?>">
                  </div>
                  <div class="form-group">
                    <label for="disabledInput">Partner Key</label>
                    <input type="text" class="form-control" id="partnerkey" name="partnerkey" placeholder="" value="<?= $partnerkey ?>">
                  </div>
                  <p>- Website đấu nối: https://trumthe.vn/ <br>- Phương thức : $_GET <br>- Link callback: <font color="red">https://<?= $domain ?>/system/callbackrsa.php</font><br>
                  </p>

                </div>

                <div class="card-footer">
                  <center><button onclick="submit();" type="submit" id="submit" id="submit" class="btn btn-primary btn-lg"><i class="fas fa-cogs"></i> Cấu hình</button></center>
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
    function submit() {
      if (!$('#tygia')['val']()) {
        swal('ERROR', 'Vui lòng nhập tỷ giá nạp thẻ !', 'error')
      } else {
        if (!$('#partnerid')['val']()) {
          swal('ERROR', 'Vui lòng nhập Partner ID', 'error')
        } else {
          if (!$('#partnerkey')['val']()) {
            swal('ERROR', 'Vui lòng nhập Partner Key', 'error')
          } else {
            nap()
          }
        }
      }
    }

    function nap() {
      $('#submit')['html']('<div class="spinner-border text-warning" role="status"></div>Đang xử lý');
      $['post']('../action/admin.php', {
          tygia: $('#tygia')['val'](),
          partnerid: $('#partnerid')['val'](),
          partnerkey: $('#partnerkey')['val']()
        },
        function(_0xb982x3) {
          swal(_0xb982x3['title'], _0xb982x3['msg'], _0xb982x3['status']);
          $('#submit')['html']('<i class="fas fa-cogs"></i> Cấu hình lại')
        }, 'json')
    }
  </script>
<?php
  include('page/footer.php');
}
?>