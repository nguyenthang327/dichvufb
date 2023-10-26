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
    // check
    $data = mysqli_fetch_array(mysqli_query($ketnoi, "SELECT * FROM  `history`  WHERE `username` = '".mysqli_real_escape_string($ketnoi,$username)."' ORDER BY id DESC LIMIT 1"));
    $code_oder = floor(microtime(true) * 1000);
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
                                    <li class="breadcrumb-item" aria-current="page">Paypal</li>
                                </ol>
                                <?php
                                    var_dump($data, $code_oder);
                                ?>
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
                            <div class="col-lg-3 col-sm-6 col-12">
								<div class="form-group">
									<label>Nhập số tiền muốn nạp</label>
									<input type="number" id="money" name="money" class="form-control" value="" min="0" step="0.01">
								</div>
							</div>
                            <div id="paypal-button"></div>

                        </div>
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
                                    </tbody>
                                </table>
                            </div>

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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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


    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                sandbox: 'AZIhNx97wNfK2Wzz2sTU4z1y3UlUZJDcZWINIoMf4hSykQ3T5g-_fbMC2YrNELKg07WzknrQM22CUmmd',
                production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'en_US',
            style: {
                size: 'medium',
                color: 'gold',
                shape: 'pill',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {
                var money = $("#money").val() ? $("#money").val() : 0;
                money = Math.round(money * 100) / 100;
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: `${money}`,
                            currency: 'USD'
                        }
                    }]
                });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    // Show a confirmation message to the buyer
                    window.alert('Thank you for your purchase!');
                    var money = $("#money").val() ? $("#money").val() : 0;
                    money = Math.round(money * 100) / 100
                    $.ajax({
                        url: "../respawn/nappaypal.html",
                        method: "POST",
                        data: {
                            tiendo: money,
                        },
                        success: function(response) {
                            console.log(response);
                            $("#trave").html(response);
                        }
                    });
                });
            }
        }, '#paypal-button');
    </script>


<?php
    include('../pages/footer.php');
}
?>