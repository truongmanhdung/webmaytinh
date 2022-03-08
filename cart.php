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
include 'admin/connect.php';
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
                        <li><a class="fs-6 text-white font-weight-bold" href="tel:0369053052"><i class="mr-5 fas fa-phone"></i>Hotline: <?= $phone ?></a></li>
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
                            $id_nguoidung = $result['id'];
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
                    <a href="index.php"><img width="140px" src="images/<?= $logo ?>" alt=""></a>
                    <div id="search" style="position:relative;">
                        <form class="search" action="product.php" method="get" style="z-index: 33;" autocomplete="off">
                            <input type="search" placeholder="Tìm kiếm sản phẩm" name="search" id="inpSearch" required>
                            <button style="border:none;" type="submit" class="btn btn-primary color"><i class="fas fa-search"></i></button>
                        </form>
                        <div id="result" style="position:absolute;background-color:white;width:100%;z-index:30;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;max-height:352px;display:inline-block;overflow-x: hidden">

                        </div>
                    </div>
                    <div class="cart" style="z-index: 333333;">
                        <a href="cart.php"  class="cart-product"><i style="font-size: 26px;" class="text-white fa fa-shopping-cart">
                            </i></a>
                        <div class="no-cart" >
                            
                            <?php 
                                if (isset($_GET["removeproduct"])) {
                                    selectAll("DELETE FROM cart WHERE idUser='$id_nguoidung' && idProduct={$_GET["removeproduct"]}");
                                }
                            ?>
                                <?php
                                if (isset($_COOKIE["user"])) {
                                    
                                    ?>
                                    <div class="cart-item p-3">
                                    <?php
                                    if (rowCount("SELECT * FROM cart WHERE idUser='$id_nguoidung' && status=0")>0) {
                                    
                                    foreach (selectAll("SELECT * FROM cart WHERE idUser='$id_nguoidung' && status=0") as $row) {
                                        ?>
                                        <div class="d-flex image123 align-items-center justify-content-between">
                                            
                                            <?php
                                                    foreach (selectAll("SELECT * FROM products WHERE id={$row['idProduct']}") as $item) {
                                                        ?>
                                                        <img src="images/<?= $item['image'] ?>" alt="">
                                                        <div>
                                                        <p class="m-0" title="<?= $item['name'] ?>" style="font-size: 13px;white-space: nowrap; width: 100px; overflow: hidden;text-overflow: ellipsis; ">
                                                            <?= $item['name'] ?>
                                                            </p>
                                                            <p class="m-0" style="font-size: 12px;">Giá: <?= number_format($item['price']) ?>đ</p>
                                                            </div>
                                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px; " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                            <p class="m-0"><?= $row['quantity'] ?></p>
                                                            <a href="?removeproduct=<?= $row['idProduct'] ?>" onclick="return confirm('Bạn có muốn xóa sản phẩm này khỏi giỏ hàng không ')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px; color: red" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </a>
                                                        <?php
                                                    }
                                                    ?>
                                        </div>
                                        
                                        <?php
                                    }
                                    ?>
                                    <div class="total d-flex justify-content-between align-items-center mt-2">
                                             <p>Tổng tiền: </p>
                                             <?php 
                                             $total = 0;
                                             foreach (selectAll("SELECT * FROM cart WHERE idUser='$id_nguoidung' && status = 0") as $row) {
                                                 foreach (selectAll("SELECT * FROM products WHERE id={$row['idProduct']}") as $item) {
                                                     $total += $row['quantity'] * $item['price'];
                                                 }
                                             }
                                             echo number_format($total) .'đ';
                                             ?>
                                             
                                         </div>
                                         <a href="cart.php"class="btn btn-primary">Xem chi tiết</a>
                                    <?php
                                    }else{
                                        ?>
                                         <img width="100%" src="images/no-product.png" alt="">
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                
                               
                            
                        </div>
                        
                    </div>
                </nav>
                <nav>
                    <ul class="menu d-flex align-items-center py-2">
                        <li style="width: 136px;" class="px-30"><a class="text-white font-weight-bold" href=""></a></li>
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
            <div class="w-1200">
                
                   <?php
                                if (isset($_COOKIE["user"])) {
                                    $stt=1;
                                    ?>
                                    <?php
                                    if (rowCount("SELECT * FROM cart WHERE idUser='$id_nguoidung' && status=0")>0) {
                                        ?>
                                        <h2 style="width: fit-content;margin:20px auto;">Giỏ hàng của bạn</h2>
                                    <table class="table">
                                        <tr>
                                            <th>STT</th>
                                            <th>Sản Phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Thành Tiền</th>
                                        </tr>
                                        <?php
                                    
                                                foreach (selectAll("SELECT * FROM cart WHERE idUser='$id_nguoidung' && status=0") as $row) {
                                                    foreach (selectAll("SELECT * FROM products WHERE id={$row['idProduct']}") as $item) {
                                                        ?>
                                                        <tr>
                                                            <td style="vertical-align:middle"><?= $stt++ ?></td>
                                                            <td>
                                                            <div class="d-flex align-items-center">
                                                            <img width="50" src="images/<?= $item['image'] ?>" alt=""><?= $item['name'] ?>
                                                            <a href="?removeproduct=<?= $row['idProduct'] ?>" onclick="return confirm('Bạn có muốn xóa sản phẩm này khỏi giỏ hàng không ')">
                                                                <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px; color: red" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </a>
                                                            </div>
                                                        </td>
                                                            <td style="vertical-align:middle"><?= $row['quantity'] ?></td>
                                                            <td style="vertical-align:middle"><?= number_format($item['price']) ?>đ</td>
                                                        </tr>
                                                            
                                                        <?php
                                                    }
                                                }
                                            
                                                    ?>
                                             
                                             <tr>
                                                 <th colspan="3">Tổng tiền</th>
                                                 <td>
                                                 <?php 
                                                $total = 0;
                                                foreach (selectAll("SELECT * FROM cart WHERE idUser='$id_nguoidung'") as $row) {
                                                    foreach (selectAll("SELECT * FROM products WHERE id={$row['idProduct']}") as $item) {
                                                        $total += $row['quantity'] * $item['price'];
                                                    }
                                                }
                                                echo number_format($total) .'đ';
                                                ?>
                                                 </td>
                                             </tr>
                                         </table>
                                         <form action="" method="POST">
                                            <button class="btn btn-primary" name="checkout" type="submit">Đặt hàng</button>
                                         </form>
                                         </div>
                                                <?php
                                            }
                                                ?>
                                                
                                        <?php
                                    
                                }else{
                                    ?>
                                    <?php
                                }
                                ?>
            </div>
            <?php 
                if (isset($_POST["checkout"])) {
                    exSQL("UPDATE cart SET status=1 WHERE idUser=$id_nguoidung && status=0");
                    header("Location:cart.php");
                }
            ?>
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="index.js?v=<?php echo time(); ?>"></script>
    <script src="search.js?v=<?php echo time(); ?>"></script>
</body>

</html>