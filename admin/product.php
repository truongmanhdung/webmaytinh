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
        if (isset($_GET['deleteproduct'])) {
            $id = $_GET['deleteproduct'];
            selectAll("DELETE FROM products WHERE id = $id");
            header("Location:product.php");
        }
        ?>
        <?php
        if (isset($_GET['add'])) {
        ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php
                if (isset($_POST['addproduct'])) {
                    $cateid = $_POST['cateid'];
                    $nameproduct = $_POST['nameproduct'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];
                    $intro = $_POST['intro'];
                    $detail = $_POST['detail'];
                    $sale = isset($_POST['sale']) ? $_POST['sale'] : 0;
                    $image = $_FILES['image']['name'];
                    $tmp = $_FILES['image']['tmp_name'];
                    $type = $_FILES['image']['type'];
                    $dir = "../images/";
                    $view = 1;
                    move_uploaded_file($tmp, $dir . $image);
                    if (empty($nameproduct) && empty($price) && empty($image) && empty($intro) && empty($detail)) {
                        $error = 'Vui lòng không bỏ trống';
                    } elseif (empty($nameproduct)) {
                        $error = 'Vui lòng nhập tên sản phẩm';
                    } elseif (empty($price)) {
                        $error = 'Vui lòng nhập giá sản phẩm';
                    } elseif (empty($quantity)) {
                        $error = 'Vui lòng nhập số lượng';
                    } elseif (empty($image)) {
                        $error = 'Vui lòng chọn ảnh';
                    } elseif (empty($intro)) {
                        $error = 'Vui lòng nhập giới thiệu';
                    } elseif (empty($detail)) {
                        $error = 'Vui lòng nhập chi tiết sản phẩm';
                    } elseif ($type == 'image/png' || $type == 'image/jpeg' || $type == 'image/jpg') {
                        selectAll("INSERT INTO products VALUES (NULL,'$nameproduct','$cateid','$image','$price','$sale','$quantity','$intro','$detail','$view')");
                        header('location:product.php');
                    } else {
                        $error = 'Vui lòng chọn File PNG/JPG';
                    }
                }
                ?>
                <h3 style="text-align:center">Thêm mới sản phẩm</h3>
                <form method="POST" enctype="multipart/form-data">
                    <?php if (isset($error)) { ?>
                        <p class="col-xs-4 col-sm-4 col-md-4 col-lg-4 alert alert-danger"><?= $error ?></p>
                    <?php
                    } ?>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <div>
                                <label>Danh mục</label><br>
                                <select name="cateid">
                                    <?php
                                    foreach (selectAll("SELECT * FROM category") as $row) {
                                    ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="">Tên sản phẩm</label><br>
                                <input type="text" class="pl-6" placeholder="Tên sản phẩm" name="nameproduct">
                            </div>
                            <div>
                                <label for="">Giá sản phẩm</label><br>
                                <input type="number" min="0" placeholder="Đơn vị VNĐ" class="pl-6" name="price">
                            </div>
                            <div>
                                <label for="">Khuyến Mãi</label><br>
                                <input type="number" min="0" placeholder="Đơn vị %" class="pl-6" name="sale">
                            </div>
                            <div>
                                <label for="">Số lượng</label><br>
                                <input type="number" min="0" class="pl-6" name="quantity">
                            </div>
                            <div class="preview-images">
                                <label for="image">Ảnh sản phẩm</label><br>
                                <label for="imgInp"><img src="../images/new.png" alt="" width="200px" id="blah" height="200px"></label>
                                <input type="file" id="imgInp" name="image" hidden>
                            </div>
                        </div>

                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <div>
                                <label for="">Giới thiệu</label><br>
                                <textarea class="w-100" cols="30" rows="10" name="intro" placeholder="Giới thiệu về sản phẩm"></textarea>
                            </div>
                            <div>
                                <label for="">Chi tiết</label><br>
                                <textarea class="w-100" cols="30" rows="10" name="detail" class="detail" placeholder="Chi tiết sản phẩm"></textarea>
                            </div>
                        </div>
                        <div class="mx-auto">
                            <button type="submit" class="btn btn-success" name="addproduct">Thêm mới</button>
                            <a href="product.php" class="btn btn-danger" name="back">Quay lại</a>
                        </div>
                    </div>
                </form>

            </div>
        <?php
        } elseif (isset($_GET['id'])) {
        ?>
            <?php
            if (isset($_GET['id'])) {
                $id_product = $_GET['id'];
                foreach (editCate("SELECT * FROM products WHERE id =" . $id_product) as $row) {
                    $name = isset($row['name']) ? $row['name'] : '';
                    $price = isset($row['price']) ? $row['price'] : '';
                    $quantity = isset($row['quantity']) ? $row['quantity'] : '';
                    $sale = isset($row['sale']) ? $row['sale'] : '0';
                    $intro = isset($row['intro']) ? $row['intro'] : '';
                    $detail = isset($row['detail']) ? $row['detail'] : '';
                    $image = isset($row['image']) ? $row['image'] : '';
                    $cateid = isset($row['cate_id']) ? $row['cate_id'] : '';
                }
            }
            if (isset($_POST['editproduct'])) {
                $cate_id = $_POST['cateid'];
                $new_name = $_POST["new_name"];
                $new_price = $_POST["new_price"];
                $new_quantity = $_POST["new_quantity"];
                $new_intro = $_POST["new_intro"];
                $new_sale = $_POST["new_sale"];
                $new_detail = $_POST["new_detail"];
                $new_image = $_FILES['new_image']['name'];
                $type = $_FILES['new_image']['type'];
                $tmp = $_FILES['new_image']['tmp_name'];
                $dir = "../images/";
                move_uploaded_file($tmp, $dir . $new_image);
                if (empty($new_name)) {
                    $error = 'Vui lòng nhập tên sản phẩm';
                } elseif (empty($new_price)) {
                    $error = 'Vui lòng nhập giá sản phẩm';
                } elseif (empty($new_quantity)) {
                    $error = 'Vui lòng nhập số lượng';
                } elseif (empty($new_intro)) {
                    $error = 'Vui lòng nhập giới thiệu';
                } elseif (empty($new_detail)) {
                    $error = 'Vui lòng nhập chi tiết sản phẩm';
                } elseif (empty($_FILES['new_image']['name'])) {
                    exSQL("UPDATE products SET name='$new_name',
            price='$new_price',quantity='$new_quantity',cate_id='$cate_id',
            intro='$new_intro',detail='$new_detail',sale='$new_sale' WHERE id=$id_product ");
                    header('location:product.php');
                } else {
                    if ($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg') {
                        exSQL("UPDATE products SET name='$new_name',cate_id='$cate_id',
                price='$new_price',quantity='$new_quantity',
                intro='$new_intro',detail='$new_detail',sale='$new_sale',image='$new_image' WHERE id=$id_product ");
                        header('location:product.php');
                    } else {
                        $error = 'Vui lòng chọn File PNG/JPG';
                    }
                }
            }
            ?>
            <div>
                <h3 style="text-align:center">Sửa sản phẩm</h3>
                <form method="POST" enctype="multipart/form-data">
                    <?php if (isset($error)) { ?>
                        <p class="col-xs-4 col-sm-4 col-md-4 col-lg-4 alert alert-danger"><?= $error ?></p>
                    <?php
                    } ?>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <div>
                                <label>Danh mục</label><br>
                                <select name="cateid" id="cateid">
                                    <?php
                                    foreach (selectAll("SELECT * FROM category WHERE id = $cateid") as $item) {
                                    ?> <option value="<?= $cateid ?>"><?= $item['name'] ?></option>
                                    <?php    }
                                    ?>
                                    <?php
                                    foreach (selectAll("SELECT * FROM category") as $row) {
                                    ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="">Tên sản phẩm</label><br>
                                <input type="text" class="pl-6" placeholder="Tên sản phẩm" value="<?= $name ?>" name="new_name">
                            </div>
                            <div>
                                <label for="">Giá sản phẩm</label><br>
                                <input type="number" min="0" placeholder="Đơn vị VNĐ" value="<?= $price ?>" class="pl-6" name="new_price">
                            </div>
                            <div>
                                <label for="">Khuyến Mãi</label><br>
                                <input type="number" min="0" placeholder="Đơn vị %" class="pl-6" value="<?= $sale ?>" name="new_sale">
                            </div>
                            <div>
                                <label for="">Số lượng</label><br>
                                <input type="number" min="0" class="pl-6" name="new_quantity" value="<?= $quantity ?>">
                            </div>
                            <div class="preview-images">
                                <label for="image">Ảnh sản phẩm</label><br>
                                <label for="imgInp"><img src="../images/<?= $image ?>" alt="" width="200px" id="blah" height="200px"></label>
                                <input type="file" id="imgInp" name="new_image" hidden>
                            </div>
                        </div>

                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <div>
                                <label for="">Giới thiệu</label><br>
                                <textarea class="w-100" cols="30" rows="10" name="new_intro"><?= $intro ?></textarea>
                            </div>
                            <div>
                                <label for="">Chi tiết</label><br>
                                <textarea class="w-100" cols="30" rows="10" name="new_detail" class="detail"><?= $detail ?></textarea>
                            </div>
                        </div>
                        <div class="mx-auto">
                            <button type="submit" class="btn btn-success" name="editproduct">Cập nhật</button>
                            <a href="product.php" class="btn btn-danger" name="back">Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        <?php
        } elseif (isset($_GET['deleteproduct'])) {
            $id = $_GET['deleteproduct'];
            selectAll("DELETE FROM products WHERE id = $id");
            header("Location:product.php");
        } else {
        ?>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 style="text-align:center">Sản phẩm</h3>
                <a href="?add" class="btn btn-success rounded-0">Thêm sản phẩm</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Tên</th>
                        <th>Danh mục</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Giảm giá</th>
                        <th>Số lượng</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = 1;
                    foreach (selectAll("SELECT * FROM products ORDER BY cate_id DESC") as $row) {
                        foreach (selectAll("SELECT * FROM category WHERE id =" . $row['cate_id']) as $value) {
                    ?>
                            <tr>
                                <td><?= $stt++ ?></td>
                                <td>
                                    <p style="width:150px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;text-transform: uppercase;" title="<?= $row['name'] ?>"><?= $row['name'] ?></p>
                                </td>
                                <td>
                                    <p style="width:120px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;" title="<?= $value['name'] ?>"><?= $value['name'] ?></p>
                                </td>
                                <td><img width="50px" height="50px" src="../images/<?= $row['image'] ?>" alt=""></td>
                                <td class="text-center"><?= number_format($row['price'], 0, ',', '.') ?> VNĐ</td>
                                <td class="text-center"><?= $row['sale'] . ' %' ?></td>
                                <td class="text-center"><?= $row['quantity'] ?></td>
                                <td><a href="?id=<?= $row['id'] ?>" class="btn btn-warning mr-3">Sửa</a><a href="?deleteproduct=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không ? :D')" class="btn btn-danger">Xóa</a></td>
                            </tr>
                    <?php }
                    }
                    ?>
                </tbody>
            </table>
    <?php }
    } ?>
<?php
    include 'footer.php';
} else {
} ?>