<?php
require_once('system/config.php');
if(isset($_GET['mode'])){
if($_GET['mode'] == 'dark'){
$_SESSION['mode'] = 'dark';    
}else{
$_SESSION['mode'] = 'light';    
}    
}
if(isset($_SESSION['username'])){
header('location:/clound/home.html');
}else{
# không làm gì cả
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $mota ?>">
    <meta name="keywords" content="<?php echo $tukhoa ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dịch Vụ Facebook 24h</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="<?=$favicon?>">
    <!-- Css Styles -->
    <link rel="stylesheet" href="landing/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="landing/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="landing/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="landing/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="landing/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="landing/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="landing/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="/"><img src="<?=$logo?>" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="header__nav__option">
                        <nav class="header__nav__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="/">Trang chủ</a></li>
                                <li><a href="/clients/login.html">Đăng nhập</a></li>
                                <li><a href="/clients/register.html">Đăng ký</a></li>
                                <li><a href="/clients/forgot.html">Khôi phục mật khẩu</a></li>
                            </ul>
                        </nav>
                        <div class="header__nav__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__item set-bg" data-setbg="landing/img/hero/hero2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <u1></u1>
                                <span>Lựa chọn tốt nhất của</span> 
                                <h2>Dịch vụ Facebook 24h</h2><span>Hệ thống chuyên cung cấp các dịch vụ tăng Like, Follow, Share, Comment, View Video,... cho các Mạng xã hội như Facebook, Instagram, Tiktok...</span>
                                <a href="/clients/login.html" class="primary-btn">Bắt đầu ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__item set-bg" data-setbg="landing/img/hero/hero1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <span>Giá rẻ nhất</span>
                                <h2>TỐI ƯU HÓA CHI PHÍ</h2>
                                <a href="/clients/login.html" class="primary-btn">Thử trải nghiệm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__item set-bg" data-setbg="landing/img/hero/hero2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <span>Hoạt động thời gian thực</span>
                                <h2>ĐƠN HÀNG HOẠT ĐỘNG 24/7</h2>
                               <a href="/clients/login.html" class="primary-btn">Hoạt động 24/7</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="services__title">
                        <div class="section-title">
                            <span>Dịch vụ của chúng tôi</span>
                            <h2>Lợi ích mang lại cho bạn ?</h2>
                        </div>
                        <p>Hệ thống chuyên cung cấp các dịch vụ tăng Like, Follow, Share, Comment, View Video,... cho các Mạng xã hội như Facebook, Instagram, Tiktok...</p>
                        <a href="/clients/login.html"class="primary-btn">Bắt
                                đầu ngay</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services__item">
                                <div class="services__item__icon">
                                    <img src="landing/img/icons/si-1.png" alt="">
                                </div>
                                <h4>Công nghệ</h4>
                                <p>Hệ thống được vận hành hoàn toàn tự động 24/24.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services__item">
                                <div class="services__item__icon">
                                    <img src="landing/img/icons/si-2.png" alt="">
                                </div>
                                <h4>Bảo mật</h4>
                                <p>Chúng tôi cam kết sẽ bảo mật thông tin người dùng 1 cách tốt nhất.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services__item">
                                <div class="services__item__icon">
                                    <img src="landing/img/icons/si-3.png" alt="">
                                </div>
                                <h4>Hỗ trợ</h4>
                                <p>Đội ngũ hỗ trợ luôn lắng nghe ý khiến khách hàng để phát triển hệ thống.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services__item">
                                <div class="services__item__icon">
                                    <img src="landing/img/icons/si-4.png" alt="">
                                </div>
                                <h4>Giá thành</h4>
                                <p>Chúng tôi cam kết cung cấp dịch vụ với giá thành rẻ nhất thị trường</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->


    <!-- Counter Section Begin -->
    <section class="counter">
        <div class="container">
            <div class="counter__content">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter__item">
                            <div class="counter__item__text">
                                <img src="landing/img/icons/ci-1.png" alt="">
                                <h2 class="counter_num">6</h2>
                                <p>Cấp bậc ưu đãi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter__item second__item">
                            <div class="counter__item__text">
                                <img src="landing/img/icons/ci-2.png" alt="">
                                <h2 class="counter_num">10</h2>
                                <p>Năm kinh nghiệm</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter__item third__item">
                            <div class="counter__item__text">
                                <img src="landing/img/icons/ci-3.png" alt="">
                                <h2 class="counter_num">9999</h2>
                                <p>Khách hàng tin dùng</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter__item four__item">
                            <div class="counter__item__text">
                                <img src="landing/img/icons/ci-4.png" alt="">
                                <h2 class="counter_num">10000000</h2>
                                <p>Đơn hàng đã xử lý</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Counter Section End -->

    <!-- Team Section Begin -->
    <section class="team spad set-bg" data-setbg="landing/img/team-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title team__title">
                        <span>Khách hàng tiêu biểu</span>
                        <h2>Những người nổi tiếng đã sử dụng</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 p-0">
                    <div class="team__item set-bg" data-setbg="landing/img/team/team-1.jpg">
                        <div class="team__item__text">
                            <h4>AMANDA STONE</h4>
                            <p>Videographer</p>
                            <div class="team__item__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 p-0">
                    <div class="team__item team__item--second set-bg" data-setbg="landing/img/team/team-2.jpg">
                        <div class="team__item__text">
                            <h4>AMANDA STONE</h4>
                            <p>Videographer</p>
                            <div class="team__item__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 p-0">
                    <div class="team__item team__item--third set-bg" data-setbg="landing/img/team/team-3.jpg">
                        <div class="team__item__text">
                            <h4>AMANDA STONE</h4>
                            <p>Videographer</p>
                            <div class="team__item__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 p-0">
                    <div class="team__item team__item--four set-bg" data-setbg="landing/img/team/team-4.jpg">
                        <div class="team__item__text">
                            <h4>AMANDA STONE</h4>
                            <p>Videographer</p>
                            <div class="team__item__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 p-0">
                    <div class="team__btn">
                        <a href="#" class="primary-btn">Tương tác mạng xã hội</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->


    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="footer__top">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="footer__top__logo">
                            <a href="#"><img src="landing/img/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer__top__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__option">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer__option__item">
                            <h5>Thông tin</h5>
                            <p>Mã nguồn được viết bởi ThanhLamNg đến từ dịch vụ thiết kế website Respawn Dev</p>
                            <a href="/clients/register.html" class="read__more">Đăng ký <span class="arrow_right"></span></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3">
                        <div class="footer__option__item">
                            <h5>Bản quyền</h5>
                            <ul>
                                <li><a href="#">Bản quyền được bảo hộ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3">
                        <div class="footer__option__item">
                            <h5>Tính năng</h5>
                            <ul>
                                <li><a href="#">Facebook</a></li>
                                <li><a href="#">Instagram</a></li>
                                <li><a href="#">Tiktok</a></li>
                                <li><a href="#">Youtube</a></li>
                                <li><a href="#">...</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="footer__option__item">
                            <h5>Nhận thông báo</h5>
                            <p>Nhận thông báo mỗi khi hệ thống có sự cập nhật</p>
                            <form action="#">
                                <input type="text" placeholder="Email">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__copyright">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p class="footer__copyright__text">Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved | Mã nguồn được viết bởi <i class="fa fa-heart-o"
                                aria-hidden="true"></i> by <a href="https://zalo.me/0334533860" target="_blank">ThanhLamNg</a>
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="landing/js/jquery-3.3.1.min.js"></script>
    <script src="landing/js/bootstrap.min.js"></script>
    <script src="landing/js/jquery.magnific-popup.min.js"></script>
    <script src="landing/js/mixitup.min.js"></script>
    <script src="landing/js/masonry.pkgd.min.js"></script>
    <script src="landing/js/jquery.slicknav.js"></script>
    <script src="landing/js/owl.carousel.min.js"></script>
    <script src="landing/js/main.js"></script>
</body>

</html>

