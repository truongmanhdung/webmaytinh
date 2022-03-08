<?php
include 'header.php';
?>
<?php
if (isset($_COOKIE["user"])) {
    $sql = "SELECT * FROM user WHERE user='{$_COOKIE["user"]}'";
    $kq = $conn->query($sql);
    $result = $kq->fetch();
    if ($result['permission'] == 'Admin') {
?>
        <?php
        if (isset($_GET['add'])) {
        ?>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                <h3 style="text-align:center">Bổ sung ảnh chi tiết sản phẩm</h3>
                <?php
                if (isset($_POST['addimage'])) {
                    $image1 = $_FILES['image1']['name'];
                    $tmp1 = $_FILES['image1']['tmp_name'];
                    $type1 = $_FILES['image1']['type'];
                    $image2 = $_FILES['image2']['name'];
                    $tmp2 = $_FILES['image2']['tmp_name'];
                    $type2 = $_FILES['image2']['type'];
                    $image3 = $_FILES['image3']['name'];
                    $tmp3 = $_FILES['image3']['tmp_name'];
                    $type3 = $_FILES['image3']['type'];
                    $id_product = $_POST["id_product"];
                    $dir = '../images/';
                    move_uploaded_file($tmp1, $dir . $image1);
                    move_uploaded_file($tmp2, $dir . $image2);
                    move_uploaded_file($tmp3, $dir . $image3);
                    if (empty($image1) || empty($image2) || empty($image3)) {
                        $error = 'Vui lòng chọn đầy đủ cả 3 ảnh';
                    } else {
                        if (($type1 == 'image/png' || $type1 == 'image/jpeg' || $type1 == 'image/jpg')
                            && ($type2 == 'image/png' || $type2 == 'image/jpeg' || $type2 == 'image/jpg')
                            && ($type3 == 'image/png' || $type3 == 'image/jpeg' || $type3 == 'image/jpg')
                        ) {
                            $sql = "SELECT * FROM img_product WHERE id_product = $id_product";
                            $connect = $conn->prepare($sql);
                            $connect->execute();
                            if ($connect->rowCount() > 0) {
                                $error = 'Sản phẩm này đã cập nhật ảnh !';
                            } else {
                                exSQL("INSERT INTO img_product VALUES(NULL,'$image1','$image2','$image3','$id_product')");
                                header('location:detail.php');
                            }
                        } else {
                            $error = 'Vui lòng chọn định dạng File Ảnh JPG / PNG';
                        }
                    }
                }
                ?>
                <form method="POST" enctype="multipart/form-data">
                    <?php if (isset($error)) { ?>
                        <p class="col-xs-4 col-sm-4 col-md-4 col-lg-4 alert alert-danger"><?= $error ?></p>
                    <?php
                    } ?>
                    <div class="row">
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            <div>
                                <label for="">Tên sản phẩm</label>
                                <select name="id_product" id="" class="mb-5" style="text-transform: uppercase;">
                                    <?php
                                    foreach (selectAll("SELECT * FROM products ORDER BY id DESC") as $row) {
                                    ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="d-flex mb-5 justify-content-between">
                                <div class="preview-images me-3">
                                    <label for="image">Ảnh 1</label><br>
                                    <label for="imgInp1"><img src="../images/new.png" alt="" width="200px" id="blah1" height="200px"></label>
                                    <input type="file" id="imgInp1" name="image1" hidden>
                                </div>
                                <div class="preview-images me-3">
                                    <label for="image">Ảnh 2</label><br>
                                    <label for="imgInp2"><img src="../images/new.png" alt="" width="200px" id="blah2" height="200px"></label>
                                    <input type="file" id="imgInp2" name="image2" hidden>
                                </div>
                                <div class="preview-images me-3">
                                    <label for="image">Ảnh 3</label><br>
                                    <label for="imgInp3"><img src="../images/new.png" alt="" width="200px" id="blah3" height="200px"></label>
                                    <input type="file" id="imgInp3" name="image3" hidden>
                                </div>
                            </div>
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-success" name="addimage">Thêm mới</button>
                                <a href="detail.php" class="btn btn-danger" name="back">Quay lại</a>
                            </div>
                        </div>
                </form>

            </div>
        <?php
        } elseif (isset($_GET['id'])) {
        ?>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                foreach (editCate("SELECT * FROM img_product WHERE id_product = '$id'") as $row) {
                    $image_old1 = isset($row['image1']) ? $row['image1'] : '';
                    $image_old2 = isset($row['image2']) ? $row['image2'] : '';
                    $image_old3 = isset($row['image3']) ? $row['image3'] : '';
                }
            }
            ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 style="text-align:center">Bổ sung ảnh chi tiết sản phẩm</h3>
                <?php
                if (isset($_POST['editimage'])) {
                    $image1 = $_FILES['image1']['name'];
                    $tmp1 = $_FILES['image1']['tmp_name'];
                    $type1 = $_FILES['image1']['type'];
                    $image2 = $_FILES['image2']['name'];
                    $tmp2 = $_FILES['image2']['tmp_name'];
                    $type2 = $_FILES['image2']['type'];
                    $image3 = $_FILES['image3']['name'];
                    $tmp3 = $_FILES['image3']['tmp_name'];
                    $type3 = $_FILES['image3']['type'];
                    $name_product = $_POST["name_product"];
                    $dir = '../images/';
                    move_uploaded_file($tmp1, $dir . $image1);
                    move_uploaded_file($tmp2, $dir . $image2);
                    move_uploaded_file($tmp3, $dir . $image3);
                    if (empty($image1) && empty($image2) && empty($image3)) {
                        header('location:detail.php');
                    } elseif (empty($image1) && !empty($image2) && !empty($image3)) {
                        exSQL("UPDATE img_product SET image2='$image2',image3='$image3' WHERE id_product = $id");
                        header('location:detail.php');
                    } elseif (!empty($image1) && empty($image2) && !empty($image3)) {
                        exSQL("UPDATE img_product SET image1='$image1',image3='$image3' WHERE id_product = $id");
                        header('location:detail.php');
                    } elseif (!empty($image1) && !empty($image2) && empty($image3)) {
                        exSQL("UPDATE img_product SET image1='$image1',image2='$image2' WHERE id_product = $id");
                        header('location:detail.php');
                    } elseif (empty($image1) && empty($image2) && !empty($image3)) {
                        exSQL("UPDATE img_product SET image3='$image3' WHERE id_product = $id");
                        header('location:detail.php');
                    } elseif (!empty($image1) && empty($image2) && empty($image3)) {
                        exSQL("UPDATE img_product SET image1='$image1' WHERE id_product = $id");
                        header('location:detail.php');
                    } elseif (empty($image1) && !empty($image2) && empty($image3)) {
                        exSQL("UPDATE img_product SET image2='$image2' WHERE id_product = $id");
                        header('location:detail.php');
                    } else {
                        if (($type1 == 'image/png' || $type1 == 'image/jpeg' || $type1 == 'image/jpg')
                            && ($type2 == 'image/png' || $type2 == 'image/jpeg' || $type2 == 'image/jpg')
                            && ($type3 == 'image/png' || $type3 == 'image/jpeg' || $type3 == 'image/jpg')
                        ) {
                            exSQL("UPDATE img_product SET image1='$image1', image2='$image2', image3='$image3' WHERE id_product =$id");
                            header('location:detail.php');
                        } else {
                            $error = 'Vui lòng chọn định dạng File Ảnh JPG / PNG';
                        }
                    }
                }
                ?>
                <form method="POST" enctype="multipart/form-data">
                    <?php if (isset($error)) { ?>
                        <p class="col-xs-4 col-sm-4 col-md-4 col-lg-4 alert alert-danger"><?= $error ?></p>
                    <?php
                    } ?>
                    <div class="row">
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            <div>
                                <label for="">Tên sản phẩm :
                                    <?php
                                    foreach (selectAll("SELECT * FROM products WHERE id =$id") as $sp) {
                                    ?>
                                        <?= $sp['name'] ?>
                                    <?php }
                                    ?></label>

                            </div>
                            <div class="d-flex mb-5 justify-content-between">
                                <div class="preview-images me-3">
                                    <label for="image">Ảnh 1</label><br>
                                    <label for="imgInp1"><img src="../images/<?= $image_old1 ?>" alt="" width="200px" id="blah1" height="200px"></label>
                                    <input type="file" id="imgInp1" name="image1" hidden>
                                </div>
                                <div class="preview-images me-3">
                                    <label for="image">Ảnh 2</label><br>
                                    <label for="imgInp2"><img src="../images/<?= $image_old2 ?>" alt="" width="200px" id="blah2" height="200px"></label>
                                    <input type="file" id="imgInp2" name="image2" hidden>
                                </div>
                                <div class="preview-images me-3">
                                    <label for="image">Ảnh 3</label><br>
                                    <label for="imgInp3"><img src="../images/<?= $image_old3 ?>" alt="" width="200px" id="blah3" height="200px"></label>
                                    <input type="file" id="imgInp3" name="image3" hidden>
                                </div>
                            </div>
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-warning" name="editimage">Cập nhật</button>
                                <a href="detail.php" class="btn btn-danger" name="back">Quay lại</a>
                            </div>
                        </div>
                </form>

            </div>
        <?php
        } else {
        ?>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 style="text-align:center">Ảnh chi tiết </h3>
                <a href="?add" class="btn btn-success rounded-0">Thêm ảnh sản phẩm</a>
            </div>
            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Tên Sản phẩm</th>
                            <th>Ảnh hiển thị</th>
                            <th>Ảnh chi tiết</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $stt = 1;
                        foreach (selectAll("SELECT * FROM img_product") as $row) {
                            foreach (editCate("SELECT * FROM products WHERE id =" . $row["id_product"]) as $item) {
                        ?> <tr style="vertical-align: baseline;">
                                    <td><?= $stt++ ?></td>
                                    <td>
                                        <p class="mx-auto" title="<?= $item['name'] ?>" style="text-transform: uppercase;width:150px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><?= $item['name'] ?></p>
                                    </td>
                                    <td><img title="<?= $item['name'] ?>" width="50px" height="50px" src="../images/<?= $item['image'] ?>" a></td>
                                    <td><img width="50px" height="50px" src="../images/<?= $row['image1'] ?>"><img width="50px" height="50px" src="../images/<?= $row['image2'] ?>"><img width="50px" height="50px" src="../images/<?= $row['image3'] ?>"></td>
                                    <td><a href="?id=<?= $item['id'] ?>" class="btn btn-danger">Cập nhật</a></td>
                                </tr>
                        <?php }
                        }
                        ?>

                    </tbody>
                </table>
            <?php
        }
            ?>
            <?php
            include 'footer.php';
            ?>
            <script>
                imgInp1.onchange = evt => {
                    const [file] = imgInp1.files
                    if (file) {
                        blah1.src = URL.createObjectURL(file)
                    }
                }
                imgInp2.onchange = evt => {
                    const [file] = imgInp2.files
                    if (file) {
                        blah2.src = URL.createObjectURL(file)
                    }
                }
                imgInp3.onchange = evt => {
                    const [file] = imgInp3.files
                    if (file) {
                        blah3.src = URL.createObjectURL(file)
                    }
                }
            </script>
    <?php
    } else {
    }
} ?>