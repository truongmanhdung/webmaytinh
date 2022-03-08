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
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            foreach (selectAll("SELECT * FROM info WHERE id = $id") as $row) {
                $name_old = $row['name'];
                $logo_old = $row['logo'];
                $color_old = $row['color'];
                $address_old = $row['address'];
                $phone_old = $row['phone'];
            }
            if (isset($_POST["edit"])) {
                $name = $_POST["name"];
                $phone = $_POST["phone"];
                $address = $_POST["address"];
                $color = $_POST["color"];
                $image = $_FILES['image']['name'];
                $tmp_image = $_FILES['image']['tmp_name'];
                move_uploaded_file($tmp_image, "../images/" . $image);
                if (empty($name) && empty($phone) && empty($address)) {
                    $error = 'Vui lòng điền đầy đủ các trường';
                } elseif (empty($name)) {
                    $error = 'Vui lòng điền nhập tên';
                } elseif (empty($phone)) {
                    $error = 'Vui lòng điền nhập số điện thoại';
                } elseif (empty($address)) {
                    $error = 'Vui lòng điền nhập địa chỉ';
                } else {
                    if (empty($image)) {
                        exSQL("UPDATE info SET name='$name',phone='$phone',color='$color',address='$address' WHERE id = $id");
                        header('location:setting.php');
                    }else{
                        exSQL("UPDATE info SET name='$name',phone='$phone',color='$color',address='$address',logo='$image' WHERE id = $id");
                        header('location:setting.php');
                    }
                }
            }
        ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3 class="text-center">Chỉnh sửa giao diện</h3>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php if (isset($error)) { ?>
                            <p class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-danger"><?= $error ?></p>
                        <?php
                        } ?>
                        <div>
                            <label for="">Tên</label><br>
                            <input style="width:20%" type="text" class="pl-6" value="<?= $name_old ?>" placeholder="Tên" name="name">
                        </div>
                        <div>
                            <label for="">Số Điện Thoại</label><br>
                            <input style="width:20%" type="text" class="pl-6" value="<?= $phone_old ?>" placeholder="Số Điện Thoại" name="phone">
                        </div>
                        <div>
                            <label for="">Địa chỉ</label><br>
                            <input style="width:35%" type="text" class="pl-6" value="<?= $address_old ?>" placeholder="Địa chỉ" name="address">
                        </div>
                        <div>
                            <label for="">Màu nền</label><br>
                            <input style="border:none;width:33%;" type="color" class="pl-6" value="<?= $color_old ?>" name="color">
                        </div>
                        <div class="preview-images">
                            <label for="image">Chọn ảnh</label><br>
                            <label for="imgInp"><img src="../images/<?= $logo_old ?>" alt="" width="140" id="blah"></label>
                            <input type="file" id="imgInp" name="image" hidden>
                        </div>
                        <button type="submit" name="edit" class="btn btn-primary">Cập nhật</button>
                        <a href="setting.php" class="btn btn-danger">Quay lại</a>
                    </form>
                </div>
            </div>
        <?php
        } else {
        ?>
            <h3 style="text-align:center">Quản trị Giao diện</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Màu nền</th>
                        <th>Tên</th>
                        <th>Số Điện Thoại</th>
                        <th>Địa chỉ</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach (selectAll("SELECT * FROM info") as $row) {
                    ?>
                        <tr>
                            <td><img src="../images/<?= $row['logo'] ?>" width="140" alt=""></td>
                            <td>
                                <div style="margin-left: 10px;;width:50px;height:50px;border-radius:50%;background-color:<?= $row['color'] ?>;"></div>
                            </td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['phone'] ?></td>
                            <td><?= $row['address'] ?></td>
                            <td><a href="?id=<?= $row['id'] ?>" class="btn btn-danger" style="background-color: <?= $row['color'] ?>;border-color: <?= $row['color'] ?>;"> Sửa </a></td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
<?php }
    }
    include 'footer.php';
} else {
} ?>