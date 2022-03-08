<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Camera" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="style.php">
    <title>Trang chủ</title>
</head>
<?php
if (isset($_GET["logout"])) {
    unset($_COOKIE["user"]);
    setcookie("user", null, -1, '/');
    header('location:login.php');
}
?>
<?php
include_once 'admin/connect.php';
foreach (selectAll("SELECT * FROM info WHERE id=1") as $item) {
    $phone = "0" . number_format($item['phone'], 0, ',', '.');
    $address = $item['address'];
    $namee = $item['name'];
    $logo = $item['logo'];
}
?>

<body>
    <div class="container-fluid">
        <header>
            <div class="contact">
                <div class="w-1200 d-flex justify-content-between align-items-center">
                    <ul>
                        <li><a class="fs-6 text-white font-weight-bold" href="tel:0369053052"><i class="mr-5 fas fa-phone"></i>Hotline: <?= $logo ?></a></li>
                    </ul>
                    <ul class="d-flex">
                        <li><a class="fs-13 px-10 font-weight-bold text-white" href=""><i class="mr-5 far fa-bell"></i>Thông báo</a></li>
                        <li><a class="fs-13 px-10 font-weight-bold text-white" href=""><i class="mr-5 fas fa-question-circle"></i>Hỗ trợ</a></li>
                        <?php
                        include_once 'admin/connect.php';
                        if (isset($_COOKIE["user"])) {
                            $sql = "SELECT * FROM user WHERE user='{$_COOKIE["user"]}'";
                            $kq = $conn->query($sql);
                            $result = $kq->fetch();
                            $name = empty($result['name']) ? $result['user'] : $result['name'];
                            if ($result['permission'] == 'khách hàng') {
                                echo "<li><a class=\"fs-13 px-10 font-weight-bold text-white\" href=\"info.php\"><i class=\"mr-5 fas fa-user\"></i>$name</a></li><li><a class=\" fs-13 font-weight-bold text-white\" title=\"Đăng xuất\" href=\"?logout=\"><i class=\"text-white fas fa-sign-out-alt\"></i></a></li>";
                            } else {
                                echo "<li><a class=\"fs-13 px-10 font-weight-bold text-white\" href=\"info.php\"><i class=\"mr-5  fas fa-user\"></i>$name</a></li><li><a class=\" fs-13 font-weight-bold text-white\" title=\"Đăng xuất\" href=\"?logout=\"><i class=\"text-white fas fa-sign-out-alt\"></i></a></li>
                            <li><a class=\"fs-13 px-10 font-weight-bold text-white\" href=\"./admin/index.php\"><i class=\"mr-5 fas fa-key\"></i>Quản trị</a></li>";
                            }
                        } else {
                            echo "<li><a class=\"fs-13 px-10 font-weight-bold text-white\" href=\"login.php\"><i class=\"mr-5 fas fa-user\"></i>Đăng nhập</a></li>
                                <li><a class=\"fs-13 px-10 font-weight-bold text-white\" href=\"signup.php\"><i class=\"mr-5 fas fa-key\"></i>Đăng ký</a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <nav class="d-flex justify-content-between align-items-center">
                    <a href="index.php"><img width="140px" src="images/logo.png" alt=""></a>
                    <form class="search" action="product.php" method="get">
                        <input type="search" placeholder="Tìm kiếm sản phẩm" name="search" id="" required>
                        <button style="border:none;" type="submit" class="btn btn-primary color"><i class="fas fa-search"></i></button>
                    </form>
                    <div class="cart">
                        <a href="" class="cart-product"><i style="font-size: 26px;" class="text-white fa fa-shopping-cart">
                            </i></a>
                        <div class="no-cart">
                            <img src="images/no-product.png" alt="">
                        </div>
                    </div>
                </nav>
                <nav>
                    <ul class="menu d-flex align-items-center py-2">
                        <li style="margin-left: 30px;" class="px-30"><a class="text-white font-weight-bold" href="">Danh mục</a></li>
                        <li style="margin-left: 30px;" class="px-30"><a class="text-white font-weight-bold" href="">Trang chủ</a></li>
                        <li class="px-30"><a class="text-white font-weight-bold" href="">Giới thiệu</a></li>
                        <li class="px-30"><a class="text-white font-weight-bold" href="">Sản phẩm</a></li>
                        <li class="px-30"><a class="text-white font-weight-bold" href="">Tin tức</a></li>
                        <li class="px-30"><a class="text-white font-weight-bold" href="">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
            <!-- End Navigation -->
        </header>
        <!-- End Header -->
        <main>
            <div class="container" style="background:#f5f5f5;">
                <div class="row py-3">
                    <div class="col-3">
                        <div class="col-12 row p-0 before position-relative">
                            <div class="col-3">
                                <img src="images/<?= empty($result['image']) ? 'user.jpg' : $result['image'] ?>" width="50px" height="50px" alt="" class="rounded-circle border" style="object-fit:cover;">
                            </div>
                            <div class="col-9">
                                <p class="m-0 font-weight-bold"><?= $result['user'] ?></p>
                                <p class="m-0 text-secondary" style="font-size: 13px;"><i class="fas fa-edit"></i> Sửa hồ sơ</p>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <a class="d-block mb-2" href="?info"><i class="far fa-user pr-2 text-primary"></i> Hồ sơ</a>
                            <a class="d-block mb-2" href="?password"><i class="fas fa-key pr-2 text-primary"></i> Mật khẩu</a>
                        </div>
                    </div>
                    <?php
                    if (isset($_COOKIE["user"])) {
                        $qr = "SELECT * FROM user WHERE user='{$_COOKIE["user"]}'";
                        $kq = $conn->query($qr);
                        $result2 = $kq->fetch();
                    }
                    if (!isset($_GET["password"])) {
                    ?>
                        <div class="col-9 row p-0 pb-5" style="background:#fff">
                            <div class="col-12 py-2 pl-4">
                                <p style="font-size:20px;font-weight: 450;color:gray;margin-bottom: 0;">Hồ sơ của tôi</p>
                                <p style="font-size:15px;color:gray;" class="pb-3 border-bottom">Quản lý thông tin hồ sơ để bảo mật tài khoản
                                </p>
                            </div>
                            <form class="col-12 pl-4 row" method="post" enctype="multipart/form-data">
                                <div class="col-9 row" style="padding-left: 15px;margin-left: 0;">
                                    <div class="col-3 p-0">
                                        <p>Tên đăng nhập</p>
                                        <p style="margin-bottom: 0;padding-top: 5px;">Tên</p>
                                        <p class="mt-4 pt-2">Địa chỉ</p>
                                    </div>
                                    <div class="col-9 p-0">
                                        <p><?= $result['user'] ?></p>
                                        <input type="text" class="form-control d-block" name="name" id="" aria-describedby="helpId" placeholder="<?= empty($result2['name']) ? 'Chưa cập nhật' : '' ?>" value="<?= empty($result2['name']) ? '' : $result2['name'] ?>" required>
                                        <input type="text" class="form-control d-block mt-3" name="address" id="" aria-describedby="helpId" placeholder="<?= empty($result2['address']) ? 'Chưa cập nhật' : '' ?>" value="<?= empty($result2['address']) ? '' : $result2['address'] ?>" required>
                                        <input type="submit" value="Lưu" name="edit" class="btn btn-primary mt-3">
                                    </div>
                                </div>
                                <div class="col-3 pl-5 row">
                                    <div class="col-10 border-left pl-5">
                                        <img src="images/<?= empty($result2['image']) ? 'user.jpg' : $result2['image'] ?>" width="104px" id="blah5" height="100px" alt="" class="mt-2" style="object-fit:cover;">
                                        <label for="imgInp5" class="btn btn-white border px-1 py-2 mt-2" style="width: 104px;height: 40px;box-sizing:border-box;border-radius:unset">Chọn ảnh</label>
                                        <input type="file" name="image" id="imgInp5" hidden accept=".jpg,.jpeg,.png">
                                    </div>
                                </div>
                                <?php
                                if (isset($_POST["edit"])) {
                                    $name = $_POST["name"];
                                    $address = $_POST["address"];
                                    $image = $_FILES['image']['name'];
                                    $tmp = $_FILES['image']['tmp_name'];
                                    move_uploaded_file($tmp, "images/" . $image);
                                    if (empty($image)) {
                                        exSQL("UPDATE user SET name='$name',address='$address' WHERE user='{$_COOKIE["user"]}'");
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    } else {
                                        exSQL("UPDATE user SET name='$name',address='$address',image='$image' WHERE user='{$_COOKIE["user"]}'");
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    }
                                }
                                ?>
                            </form>
                        </div>
                    <?php
                    } elseif (isset($_GET["password"])) {
                    ?>
                        <div class="col-9 row p-0 pb-5" style="background:#fff">
                            <div class="col-12 py-2 pl-4">
                                <p style="font-size:20px;font-weight: 450;color:gray;margin-bottom: 0;">Đổi Mật Khẩu
                                </p>
                                <p style="font-size:15px;color:gray;" class="pb-3 border-bottom">Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác

                                </p>
                            </div>
                            <?php
                            if (isset($_POST["changepassword"])) {
                                $passold = $_POST["passold"];
                                $passnew = $_POST["passnew"];
                                $repassnew = $_POST["repassnew"];
                                if ($passnew != $repassnew) {
                                    $error = 'Nhập lại mật khẩu không chính xác';
                                } else {
                                    $pass = md5($passold);
                                    $pass1 = md5($passnew);
                                    $sql = "SELECT * FROM user WHERE user='{$_COOKIE["user"]}' AND pass='$pass'";
                                    $count = $conn->prepare($sql);
                                    $count->execute();
                                    if ($count->rowCount() == 1) {
                                        exSQL("UPDATE user SET pass='$pass1' WHERE user='{$_COOKIE["user"]}'");
                                        $error2 = 'Thay đổi mật khẩu thành công';
                                    } else {
                                        $error = 'Mật khẩu cũ không chính xác !';
                                    }
                                }
                            }
                            ?>
                            <form class="col-12 pl-4 row" method="post" enctype="multipart/form-data">
                                <div class="col-9 row mx-auto" style="padding-left: 15px;margin-left: 0;">
                                    <?php
                                    if (isset($error)) {
                                        echo ' <p class="alert alert-danger col-12">
                                                ' . $error . '
                                            </p>';
                                    }
                                    ?>
                                    <?php
                                    if (isset($error2)) {
                                        echo ' <p class="alert alert-success col-12">
                                                ' . $error2 . '
                                            </p>';
                                    }
                                    ?>
                                    <div class="col-4 p-0">
                                        <p style="padding-top: 6px;">Nhập mật khẩu cũ</p>
                                        <p style="padding-top: 15px;">Mật khẩu mới</p>
                                        <p class="mt-2 pt-3">Xác nhận mật khẩu mới</p>
                                    </div>
                                    <div class="col-8 p-0">
                                        <input type="password" class="form-control d-block mb-3" name="passold" id="" aria-describedby="helpId" placeholder="" required>
                                        <input type="password" class="form-control d-block" name="passnew" id="" aria-describedby="helpId" placeholder="" required>
                                        <input type="password" class="form-control d-block mt-3" name="repassnew" id="" aria-describedby="helpId" placeholder="" required>
                                        <input type="submit" value="Lưu" name="changepassword" class="btn btn-primary mt-3">
                                    </div>
                                </div>
                            </form>

                        </div>
                    <?php
                    }
                    ?>
                </div>

            </div>
        </main>
        <!-- End Main -->
        <footer>
            <div class="d-flex justify-content-between my-5">
                <div class="d-flex">
                    <div>
                        <img class="" src="images/7days.png" alt="">
                    </div>
                    <div class="">
                        <p class="">7 ngày miễn phí trả hàng</p>
                        <p class="">Trả hàng miễn phí trong 7 ngày</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <img src="images/authentic.png" alt="" srcset="">
                    </div>
                    <div class="">
                        <p class="">Hàng chính hãng 100%</p>
                        <p class="">Đảm bảo hàng chính hãng hoặc hoàn tiền gấp đôi</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <img src="images/freeship.png" alt="" srcset="">
                    </div>
                    <div class="">
                        <p class="">Miễn phí vận chuyển</p>
                        <p class="">Giao hàng miễn phí toàn quốc</p>
                    </div>
                </div>
            </div>
            <div id="footer" class="d-flex justify-content-between">
                <div>
                    <h2 class="shop mb-30">CAMERA</h2>
                    <p>Một chiếc máy ảnh để biến mọi khoảnh khắc trở nên đáng nhớ</p>
                    <ul>
                        <li class="text-success"><i class="mr-5 fas fa-phone-alt"></i><a class="text-dark" href="tel:0369053052"><?= $phone ?></a></li>
                        <li class="text-dark"><i class="text-info mr-5 fas fa-envelope"></i>nguyenvanlinh.user@gmail.com</li>
                        <li class="text-dark"><i class="text-warning mr-5 fas fa-map-marker-alt"></i><?= $address ?></li>
                        <li class="text-light"><i class="text-primary mr-5 fab fa-facebook-f"></i><i class="mr-5 fab fa-twitter text-primary"></i><i class="mr-5 text-danger fab fa-google-plus-g"></i><i class="fab fa-pinterest-square text-danger"></i></li>
                    </ul>
                </div>
                <div class="mr-5">
                    <div class="mb-40">
                        <h4>Về chúng tôi</h4>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <ul>
                            <li>Giới thiệu</li>
                            <li>Giao hàng</li>
                            <li>Đổi trả</li>
                            <li>CS bảo mật</li>
                            <li>Liên hệ</li>
                            <li>HD mua hàng</li>
                        </ul>
                        <ul>
                            <li>HD thanh toán</li>
                            <li>TK giao dịch</li>
                            <li>CS bảo mật</li>
                            <li>CS đổi trả</li>
                            <li>CS vận chuyển</li>
                            <li>CS thanh toán</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h4 class="mb-40">Sản phẩm</h4>
                    <div class="d-flex justify-content-between mb-10">
                        <div class="mr-5">
                            <img src="images/no1.webp" alt="" width="112px" height="62px" />
                        </div>
                        <p>Đánh giá Fujifilm X-T4 - Bước tiến mới của dòng máy chuyên nghiệp!</p>
                    </div>
                    <div class="d-flex justify-content-between mb-10">
                        <div class="mr-5">
                            <img src="images/no2.webp" alt="" width="112px" height="62px" />
                        </div>
                        <p>Affordable Full Frame Monster - 5 Reasons to Buy - Pentax K-1 in 2019</p>
                    </div>
                    <div class="d-flex justify-content-between mb-10">
                        <div class="mr-5">
                            <img src="images/no3.webp" alt="" width="112px" height="62px" />
                        </div>
                        <p>Sony a7RV & Canon R5S LEAKED! 100+ MEGAPIXELS!</p>
                    </div>
                </div>
                <div>
                    <h4 class="mb-40">THÔNG TIN</h4>
                    <div>
                        <p>Trở thành thành viên của chúng tôi,bạn sẽ được hưởng những ưu đãi cùng nhiều phần quà</p>
                    </div>
                    <form action="">
                        <input type="email" placeholder="Nhập email của bạn *" name="" id="" required>
                        <input type="submit" value="ĐĂNG KÝ NHẬN THÔNG BÁO">
                    </form>
                </div>
            </div>
            <div id="copyright" class="d-flex justify-content-between">
                <p>Copyright &copy; 2016 nguyenvanlinh Designed & Developed by <a href="https://www.facebook.com/NguyenVanLinh.user">Linh</a>
                </p>
                <div id='wave'>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul class="d-flex justify-content-between">
                    <li>Home</li>
                    <li>Help</li>
                    <li>Sitemap</li>
                </ul>
            </div>
            <div class="telephone">
                <a href="tel:0369053052">
                    <div class="border-phone"></div>
                    <div id="phone">
                    </div>
                    <div class="phone">
                    </div>
                    <i class="fas fa-phone-alt"></i>
                </a>
            </div>
            <div class="back-to-top" id="toTop">
                <a href="javascript:void(0);"><i class="fas fa-arrow-right"></i></a>
            </div>
        </footer>
        <!-- End Footer -->
    </div>
    <!-- End Container -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script src="index.js?v=<?php echo time(); ?>"></script>
    <script src="backtop.js?v=<?php echo time(); ?>"></script>
    <script>
        imgInp5.onchange = evt => {
            const [file] = imgInp5.files
            if (file) {
                blah5.src = URL.createObjectURL(file)
            }
        }
    </script>
</body>

</html>