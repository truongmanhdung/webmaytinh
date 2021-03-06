<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    include_once 'admin/connect.php';
    selectAll("UPDATE products SET view = view + 1 WHERE id = $id");
    foreach (selectAll("SELECT * FROM img_product WHERE id_product = $id") as $row) {
        $image1 = isset($row['image1']) ? $row['image1'] : '';
        $image2 = isset($row['image2']) ? $row['image2'] : '';
        $image3 = isset($row['image3']) ? $row['image3'] : '';
    }
    foreach (selectAll("SELECT * FROM products WHERE id = $id") as $row) {
        $image = isset($row['image']) ? $row['image'] : '';
        $name_product = isset($row['name']) ? $row['name'] : '';
        $intro_product = isset($row['intro']) ? $row['intro'] : '';
        $detail_product = isset($row['detail']) ? $row['detail'] : '';
        $price_product = isset($row['price']) ? $row['price'] : '';
        $cate_id = isset($row['cate_id']) ? $row['cate_id'] : '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="style.php">
    <link rel="stylesheet" href="style_detail.php">
    <title><?= $name_product ?></title>
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
                        <li><a class="fs-6 text-white font-weight-bold" href="tel:0369053052"><i class="mr-5 fas fa-phone"></i>Hotline: <?= $phone ?></a></li>
                    </ul>
                    <ul class="d-flex">
                        <li><a class="fs-13 px-10 font-weight-bold text-white" href=""><i class="mr-5 far fa-bell"></i>Th??ng b??o</a></li>
                        <li><a class="fs-13 px-10 font-weight-bold text-white" href=""><i class="mr-5 fas fa-question-circle"></i>H??? tr???</a></li>
                        <?php
                        include_once 'admin/connect.php';
                        if (isset($_COOKIE["user"])) {
                            $sql = "SELECT * FROM user WHERE user='{$_COOKIE["user"]}'";
                            $kq = $conn->query($sql);
                            $result = $kq->fetch();
                            $name = empty($result['name']) ? $result['user'] : $result['name'];
                            $id_nguoidung = $result['id'];
                            if ($result['permission'] == 'kh??ch h??ng') {
                                echo "<li><a class=\"fs-13 px-10 font-weight-bold text-white\" href=\"info.php\"><i class=\"mr-5 fas fa-user\"></i>$name</a></li><li><a class=\" fs-13 font-weight-bold text-white\" title=\"????ng xu???t\" href=\"?logout=\"><i class=\"text-white fas fa-sign-out-alt\"></i></a></li>";
                            } else {
                                echo "<li><a class=\"fs-13 px-10 font-weight-bold text-white\" href=\"info.php\"><i class=\"mr-5  fas fa-user\"></i>$name</a></li><li><a class=\" fs-13 font-weight-bold text-white\" title=\"????ng xu???t\" href=\"?logout=\"><i class=\"text-white fas fa-sign-out-alt\"></i></a></li>
                            <li><a class=\"fs-13 px-10 font-weight-bold text-white\" href=\"./admin/index.php\"><i class=\"mr-5 fas fa-key\"></i>Qu???n tr???</a></li>";
                            }
                        } else {
                            echo "<li><a class=\"fs-13 px-10 font-weight-bold text-white\" href=\"login.php\"><i class=\"mr-5 fas fa-user\"></i>????ng nh???p</a></li>
                                <li><a class=\"fs-13 px-10 font-weight-bold text-white\" href=\"signup.php\"><i class=\"mr-5 fas fa-key\"></i>????ng k??</a></li>";
                        }
                        ?>

                    </ul>
                </div>
                <nav class="d-flex justify-content-between align-items-center">
                    <a href="index.php"><img width="140px" src="images/<?= $logo ?>" alt=""></a>
                    <div id="search" style="position:relative;">
                        <form class="search" action="product.php" method="get" style="z-index: 33;" autocomplete="off">
                            <input type="search" placeholder="T??m ki???m s???n ph???m" name="search" id="inpSearch" onclick="this.form.reset()" required>
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
                                                            <p class="m-0" style="font-size: 12px;">Gi??: <?= number_format($item['price']) ?>??</p>
                                                            </div>
                                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 20px; " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                            <p class="m-0"><?= $row['quantity'] ?></p>
                                                            <a href="?removeproduct=<?= $row['idProduct'] ?>" onclick="return confirm('B???n c?? mu???n x??a s???n ph???m n??y kh???i gi??? h??ng kh??ng ')">
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
                                             <p>T???ng ti???n: </p>
                                             <?php 
                                             $total = 0;
                                             foreach (selectAll("SELECT * FROM cart WHERE idUser='$id_nguoidung' && status=0") as $row) {
                                                 foreach (selectAll("SELECT * FROM products WHERE id={$row['idProduct']}") as $item) {
                                                     $total += $row['quantity'] * $item['price'];
                                                 }
                                             }
                                             echo number_format($total) .'??';
                                             ?>
                                             
                                         </div>
                                         <a href="cart.php"class="btn btn-primary">Xem chi ti???t</a>
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
                        <li style="margin-left: 30px;" class="px-30"><a class="text-white font-weight-bold" href="">Trang ch???</a></li>
                        <li class="px-30"><a class="text-white font-weight-bold" href="">Gi???i thi???u</a></li>
                        <li class="px-30"><a class="text-white font-weight-bold" href="">S???n ph???m</a></li>
                        <li class="px-30"><a class="text-white font-weight-bold" href="">Tin t???c</a></li>
                        <li class="px-30"><a class="text-white font-weight-bold" href="">Li??n h???</a></li>
                    </ul>
                </nav>
            </div>
            <!-- End Navigation -->
            <!-- End Dashboard && Slide Show-->
        </header>
        <!-- End Header -->
        <main class="w-1200">
            <div class="row ">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div>
                        <div class="title ">
                            <li><button type="submit" class=" text-left w-btn-db btn btn-primary color border-color">CH??NH S??CH B??N H??NG</button></li>
                        </div>
                        <div class="d-block">
                            <ul class="text-light ml-10 unset">
                                <li class="fs-14 policy">Giao h??ng TO??N QU???C</li>
                                <li class="fs-14 policy">Thanh to??n khi nh???n h??ng</li>
                                <li class="fs-14 policy">?????i tr??? trong 10 ng??y</li>
                                <li class="fs-14 policy">Ho??n ngay ti???n m???t</li>
                                <li class="fs-14 policy">Ch???t l?????ng ?????m b???o</li>
                                <li class="fs-14 policy">Mi???n ph?? v???n chuy???n</li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div class="title">
                            <li><button type="submit" class="text-left w-btn-db btn btn-primary color border-color">H?????NG D???N MUA H??NG</button></li>
                        </div>
                        <div class="d-block">
                            <ul class="text-light ml-10">
                                <li class="fs-14 policy2">Giao h??ng TO??N QU???C</li>
                                <li class="fs-14 policy2">Thanh to??n khi nh???n h??ng</li>
                                <li class="fs-14 policy2">?????i tr??? trong 10 ng??y</li>
                                <li class="fs-14 policy2">Ho??n ngay ti???n m???t</li>
                                <li class="fs-14 policy2">Ch???t l?????ng ?????m b???o</li>
                                <li class="fs-14 policy2">Mi???n ph?? v???n chuy???n</li>
                            </ul>
                        </div>
                    </div>

                    <div class="title">
                        <li><button type="submit" class="text-left w-btn-db btn btn-primary color border-color">S???N PH???M LI??N QUAN</button></li>
                    </div>
                    <?php
                    foreach (SelectAll("SELECT * FROM products WHERE cate_id = $cate_id AND NOT(id = $id) LIMIT 2") as $item) {
                    ?>
                        <div style="margin-top: 54px;">
                            <div class="">
                                <div>
                                    <img src="images/<?= $item['image'] ?>" title="<?= $item['name'] ?>" alt="" width="90%" class="hover-product">
                                </div>
                                <div class="name text-center">
                                    <a href="" title="<?= $item['name'] ?>"><?= $item['name'] ?></a>
                                    <p class="price text-danger"><?= number_format($item['price'], 0, ',', '.') ?>??</p>
                                    <a href="detail.php?id=<?= $item['id'] ?>"><button type="button" class="btn btn-primary btn-ellipse btn_sp">Mua ngay</button></a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>


                </div>
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="border border-primary p-10 bg-white radius border-color">
                            <div class="text-center">
                                <a href="images/<?= $image ?>" data-fancybox="images">
                                    <img width="328px" height="398px" src="images/<?= $image ?>" />
                                </a>
                            </div>
                            <div class="d-flex border border-primary p-10 border-color">
                                <a class="mr-5" href="images/<?= $image1 ?>" data-fancybox="images">
                                    <img width="106px" height="116px" src="images/<?= $image1 ?>" />
                                </a>
                                <a class="mr-5" href="images/<?= $image2 ?>" data-fancybox="images">
                                    <img width="106px" height="116px" src="images/<?= $image2 ?>" />
                                </a>
                                <a class="" href="images/<?= $image3 ?>" data-fancybox="images">
                                    <img width="106px" height="116px" src="images/<?= $image3 ?>" />
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                            <h3 style="font-size: 24px;font-weight: bold;"><?= $name_product ?></h3>
                            <h3 class="price" style="font-size: 24px;font-weight: bold;padding: 20px 0;border-bottom:2px solid #e0dddd;"><?= number_format($price_product, 0, ',', '.') ?>??</h3>
                            <p class="detail" style="color:var(--color);padding-bottom: 20px;border-bottom:2px solid #e0dddd;"><?= $intro_product ?></p>
                            <p class="quantity" style="padding:5px 0">S??? l?????ng</p>
                            <form action="" method="post">
                                <div class="quantity">
                                    <button type="button" onclick="decreaseValue()" class="btn btn-danger"><i class="fas fa-minus"></i></button>
                                    <input name="quantity123" style="border-radius:5px;border:none;background: white;" type="number" value="1" id="number" min="1">
                                    <button type="button" onclick="increaseValue()" class="btn btn-success"><i class="fas fa-plus"></i></button>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" name="add-to-cart" class="btn btn-danger"><i class="fas fa-shopping-cart mr-5"></i>Th??m v??o gi??? h??ng</button>
                                </div>
                            </form>
                            <div class="mt-3">
                                <h4 style="font-size: 14px;color:var(--color);">????? L???I S??? ??I???N THO???I, CH??NG T??I S??? T?? V???N NGAY SAU T??? 5 ??? 10 PH??T</h4>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="Nh???p s??? ??i???n tho???i" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-danger" type="button" id="button-addon2">G???i l???i cho t??i</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if(isset($_POST['add-to-cart'])){
                            $quantity = +$_POST['quantity123'];
                            // var_dump($quantity);
                            if (rowCount("SELECT * FROM cart WHERE idUser='$id_nguoidung' && idProduct=$id")>0) {
                                exSQL("UPDATE cart SET quantity=quantity+$quantity WHERE idProduct=$id");
                                header("Location:detail.php?id={$id}");
                            }else{
                                selectAll("INSERT INTO cart VALUES (null,'$id','$quantity','$id_nguoidung',0, '$today')");
                            }
                            // echo '<script>
                            //     alert("Th??m gi??? h??ng th??nh c??ng");
                            // </script>';
                        }
                    ?>
                    <div class="">
                        <div class="title" style="margin-left: -15px;margin-top: 10px;" id="detail_product">
                            <li><button type="submit" class="text-left w-btn-db btn btn-primary color border-color">CHI TI???T S???N PH???M</button></li>
                        </div>
                        <div style="color:var(--background);font-size: 15px;padding-bottom: 20px;border-bottom: 3px solid var(--background);">
                            <?= $detail_product ?>
                        </div>
                    </div>

                    <div id="comment" style="margin-top: 30px;">
                        <?php
                        foreach (selectAll("SELECT * FROM comment WHERE id_product = $id") as $row) {
                            foreach (selectAll("SELECT * FROM user WHERE id =" . $row['id_user']) as $item) {
                        ?>
                                <div class="comment" style="margin-bottom: 10px;">
                                    <div class="avatar ">
                                        <img width="53px" height="53px" class="rounded-circle" src="images/<?= empty($item['image']) ? 'user.jpg' : $item['image'] ?>" alt="" style="object-fit: cover;">
                                    </div>
                                    <div class="user">
                                        <p class="name-user text-dark"><span><?= empty($item['name']) ? $item['user'] : $item['name'] ?></span><span><?= $row['date_add'] ?></span></p>
                                        <p style="margin-bottom: 0;"><?= $row['content'] ?></p>
                                        <?php
                                        if (isset($name)) {
                                        ?>
                                            <?php
                                            if ($name == $item['name'] || $name == $item['user']) {
                                            ?> <a style="font-size:12px;" href="?id=<?= $id ?>&xoa=<?= $row['id'] ?>" onclick="return confirm('B???n c?? mu???n x??a b??nh lu???n n??y kh??ng ?')">X??a</a>
                                            <?php
                                            } elseif ($result['permission'] == 'Admin') {
                                            ?> <a style="font-size:12px;" href="?id=<?= $id ?>&xoa=<?= $row['id'] ?>" onclick="return confirm('B???n c?? mu???n x??a b??nh lu???n n??y kh??ng ?')">X??a</a>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                        <?php  }
                        }
                        ?>
                        <?php
                        if (isset($_GET["id"]) && isset($_GET["xoa"])) {
                            $xoa = $_GET["xoa"];
                            selectAll("DELETE FROM comment WHERE id = $xoa");
                            echo "<script>location.href='?id=$id'</script>";
                        }
                        ?>
                        <form class="mb-3 mt-3" method="POST" onsubmit="window.location.reload()">
                            <label for="exampleFormControlTextarea1" class="form-label">Vi???t b??nh lu???n<i class="fas fa-pencil-alt"></i></label>
                            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <button type="submit" name="addcomment" class="btn btn-primary mt-3 color border-color" style="float: right">G???i</button>
                        </form>
                        <?php
                        include_once 'admin/connect.php';
                        if (isset($_POST['addcomment'])) {
                            $comment = $_POST['comment'];
                            if (isset($_COOKIE["user"])) {
                                exSQL("INSERT INTO comment(content,date_add,id_product,id_user) VALUES ('$comment','$today',{$_GET['id']},$id_nguoidung)");
                                echo "<meta http-equiv='refresh' content='0'>";
                            } else {
                                echo '<script>alert("Vui l??ng ????ng nh???p ????? b??nh lu???n")</script>';
                            }
                        }
                        ?>
                        <?php
                        if (isset($message_error)) {
                        ?>
                            <p class="alert alert-danger"><?= $message_error; ?></p>
                        <?php    }
                        ?>

                    </div>
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
                        <p class="">7 ng??y mi???n ph?? tr??? h??ng</p>
                        <p class="">Tr??? h??ng mi???n ph?? trong 7 ng??y</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <img src="images/authentic.png" alt="" srcset="">
                    </div>
                    <div class="">
                        <p class="">H??ng ch??nh h??ng 100%</p>
                        <p class="">?????m b???o h??ng ch??nh h??ng ho???c ho??n ti???n g???p ????i</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <img src="images/freeship.png" alt="" srcset="">
                    </div>
                    <div class="">
                        <p class="">Mi???n ph?? v???n chuy???n</p>
                        <p class="">Giao h??ng mi???n ph?? to??n qu???c</p>
                    </div>
                </div>
            </div>
            <div id="footer" class="d-flex justify-content-between">
                <div>
                    <h2 class="shop mb-30">CAMERA</h2>
                    <p>M???t chi???c m??y ???nh ????? bi???n m???i kho???nh kh???c tr??? n??n ????ng nh???</p>
                    <ul>
                        <li class="text-success"><i class="mr-5 fas fa-phone-alt"></i><a class="text-dark" href="tel:0369053052"><?= $phone ?></a></li>
                        <li class="text-dark"><i class="text-info mr-5 fas fa-envelope"></i>nguyenvanlinh.user@gmail.com</li>
                        <li class="text-dark"><i class="text-warning mr-5 fas fa-map-marker-alt"></i><?= $address ?></li>
                        <li class="text-light"><i class="text-primary mr-5 fab fa-facebook-f"></i><i class="mr-5 fab fa-twitter text-primary"></i><i class="mr-5 text-danger fab fa-google-plus-g"></i><i class="fab fa-pinterest-square text-danger"></i></li>
                    </ul>
                </div>
                <div class="mr-5">
                    <div class="mb-40">
                        <h4>V??? ch??ng t??i</h4>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <ul>
                            <li>Gi???i thi???u</li>
                            <li>Giao h??ng</li>
                            <li>?????i tr???</li>
                            <li>CS b???o m???t</li>
                            <li>Li??n h???</li>
                            <li>HD mua h??ng</li>
                        </ul>
                        <ul>
                            <li>HD thanh to??n</li>
                            <li>TK giao d???ch</li>
                            <li>CS b???o m???t</li>
                            <li>CS ?????i tr???</li>
                            <li>CS v???n chuy???n</li>
                            <li>CS thanh to??n</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h4 class="mb-40">S???n ph???m</h4>
                    <div class="d-flex justify-content-between mb-10">
                        <div class="mr-5">
                            <img src="images/no1.webp" alt="" width="112px" height="62px" />
                        </div>
                        <p>????nh gi?? Fujifilm X-T4 - B?????c ti???n m???i c???a d??ng m??y chuy??n nghi???p!</p>
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
                    <h4 class="mb-40">TH??NG TIN</h4>
                    <div>
                        <p>Tr??? th??nh th??nh vi??n c???a ch??ng t??i,b???n s??? ???????c h?????ng nh???ng ??u ????i c??ng nhi???u ph???n qu??</p>
                    </div>
                    <form action="">
                        <input type="email" placeholder="Nh???p email c???a b???n *" name="" id="" required>
                        <input type="submit" value="????NG K??">
                    </form>
                </div>
            </div>
            <div id="copyright" class="d-flex justify-content-between">
                <p>Copyright &copy; 2016 nguyenvanlinh Designed & Developed by <a target="_blank" href="https://www.facebook.com/NguyenVanLinh.user">Linh</a>
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
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="detail.js?v=<?php echo time(); ?>"></script>
    <script src="search.js?v=<?php echo time(); ?>"></script>
    <script src="backtop.js?v=<?php echo time(); ?>"></script>
    <script>
        const $ = document.querySelector.bind(document);

        function increaseValue() {
            var value = parseInt($('#number').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            $('#number').value = value;
        }

        function decreaseValue() {
            var value = parseInt($('#number').value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            $('#number').value = value;
        }
    </script>
</body>

</html>