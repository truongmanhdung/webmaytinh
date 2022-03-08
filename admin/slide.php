<?php
include 'header.php';
?>
<?php
if (isset($_GET["deletecomment"])) {
    $id_comment = $_GET["deletecomment"];
    selectAll("DELETE FROM comment WHERE id = $id_comment");
    header('location:comment.php');
}
?>

<?php
if (isset($_COOKIE["user"])) {
    $sql = "SELECT * FROM user WHERE user='{$_COOKIE["user"]}'";
    $kq = $conn->query($sql);
    $result = $kq->fetch();
    if ($result['permission'] == 'Admin') {
?>
        <?php
        if (isset($_GET["add"])) {
        ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3 class="text-center">Thêm mới Slide</h3>
                    <?php
                    if (isset($_POST["add"])) {
                        $link = $_POST["link"];
                        $image = $_FILES['image']['name'];
                        $tmp = $_FILES['image']['tmp_name'];
                        $type = $_FILES['image']['type'];
                        move_uploaded_file($tmp, "../images/" . $image);
                        if (empty($image) && empty($link)) {
                            $error = 'Vui lòng không bỏ trống';
                        } elseif (empty($link)) {
                            $error = 'Vui lòng nhập link';
                        } elseif (empty($image)) {
                            $error = 'Vui lòng chọn ảnh';
                        } elseif ($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg') {
                            exSQL("INSERT INTO slideshow(image,link) VALUES('$image','$link')");
                            header('location:slide.php');
                        } else {
                            $error = 'Vui lòng chọn định dạng ảnh JPG/PNG';
                        }
                    }
                    ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php if (isset($error)) { ?>
                            <p class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-danger"><?= $error ?></p>
                        <?php
                        } ?>
                        <div>
                            <label for="">Link sản phẩm</label><br>
                            <input type="text" class="pl-6" placeholder="Link..." name="link">
                        </div>
                        <div class="preview-images">
                            <label for="image">Chọn ảnh</label><br>
                            <label for="imgInp"><img src="../images/click.jpg" alt="" width="393px" id="blah" height="141px"></label>
                            <input type="file" id="imgInp" name="image" hidden>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add">Thêm</button>
                        <a href="slide.php" class="btn btn-danger">Quay lại</a>
                    </form>
                </div>
            </div>

        <?php
        } elseif (isset($_GET["edit"])) {
            $id = $_GET["edit"];
            foreach (selectAll("SELECT * FROM slideshow WHERE id = $id") as $row) {
                $link = $row['link'];
                $image2 = $row['image'];
            }
            if (isset($_POST["edit"])) {
                $link = $_POST["link"];
                $image = $_FILES['image']['name'];
                $tmp = $_FILES['image']['tmp_name'];
                $type = $_FILES['image']['type'];
                move_uploaded_file($tmp, "../images/" . $image);
                if (empty($link)) {
                    $error = 'Vui lòng nhập link';
                } elseif (empty($image)) {
                    exSQL("UPDATE slideshow SET link='$link' WHERE id = $id");
                    header('location:slide.php');
                } elseif ($type == 'image/png' || $type == 'image/jpg' || $type == 'image/jpeg') {
                    exSQL("UPDATE slideshow SET link='$link',image='$image' WHERE id = $id");
                    header('location:slide.php');
                } else {
                    $error = 'Vui lòng chọn định dạng ảnh JPG/PNG';
                }
            }
        ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3 class="text-center">Chỉnh sửa Slide</h3>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php if (isset($error)) { ?>
                            <p class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-danger"><?= $error ?></p>
                        <?php
                        } ?>
                        <div>
                            <label for="">Link sản phẩm</label><br>
                            <input type="text" class="pl-6" value="<?= $link ?>" placeholder="Link..." name="link">
                        </div>
                        <div class="preview-images">
                            <label for="image">Chọn ảnh</label><br>
                            <label for="imgInp"><img src="../images/<?= $image2 ?>" alt="" width="393px" id="blah" height="141px"></label>
                            <input type="file" id="imgInp" name="image" hidden>
                        </div>
                        <button type="submit" name="edit" class="btn btn-primary">Cập nhật</button>
                        <a href="slide.php" class="btn btn-danger">Quay lại</a>
                    </form>
                </div>
            </div>
        <?php
        } elseif (isset($_GET["delete"])) {
            $id = $_GET["delete"];
            selectAll("DELETE FROM slideshow WHERE id = $id");
            header('location:slide.php');
        } else {
        ?>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 style="text-align:center">Slide</h3>
                <a href="?add" class="btn btn-success rounded-0">Thêm Slide</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Ảnh</th>
                        <th>Link</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = 1;
                    foreach (selectAll("SELECT * FROM slideshow") as $row) {
                    ?>
                        <tr>
                            <td><?= $stt++ ?></td>
                            <td><img src="../images/<?= $row['image'] ?>" alt="" height="50px"></td>
                            <td><?= $row['link'] ?></td>
                            <td><a href="?delete=<?= $row['id'] ?>" class="btn btn-danger me-3" onclick="return confirm('Bạn có muốn xóa không ?')">Xóa</a><a href="?edit=<?= $row['id'] ?>" class="btn btn-warning">Sửa</a></td>
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