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
if (isset($_GET['deletecate'])) {
    $id = $_GET['deletecate'];
    selectAll("DELETE FROM category WHERE id = $id");
    header("Location:index.php");
}
if (isset($_POST["addCate"])) {
    $name = $_POST['category'];
    $check = "SELECT * FROM category WHERE name='$name'";
    $cout = $conn->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        $error = "Danh mục đã tồn tại";
    } else {
        selectAll("INSERT INTO category(name) VALUES('$name')");
        header("Location:index.php");
    }
}
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 style="text-align:center">Danh mục</h3>
    <a href="?add" class="btn btn-success rounded-0">Thêm danh mục</a>
</div>
<?php
if (isset($_GET['add'])) {
?>
    <?php if (isset($error)) { ?>
        <p class="alert alert-danger"><?= $error ?></p>
    <?php

    } ?>
    <form method="POST" action="">
        <input type="text" name="category" placeholder="Danh mục" style="width:100%;height:30px;border-radius:5px;border:1px solid #cdcdcd;padding-left: 10px;" required> <br><br>
        <a href="index.php" class="btn btn-success">Quay lại</a>
        <button type="submit" name="addCate" class="btn btn-primary">Thêm mới</button>
    </form>
<?php
} else if (isset($_GET['id'])) {
?>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        foreach (editCate("SELECT * FROM category WHERE id = $id") as $row) {
            $name = isset($row['name']) ? $row['name'] : '';
        }
        if (isset($_POST['updateCate'])) {
            $name_new = $_POST['category'];
            if (empty($name_new)) {
                $error = 'Vui lòng không bỏ trống danh mục !';
            } else {
                $check = "SELECT * FROM category WHERE name='$name_new'";
                $cout = $conn->prepare($check);
                $cout->execute();
                if ($cout->rowCount() > 0) {
                    $error2 = "Danh mục đã tồn tại trong hệ thống, vui lòng quay lại !";
                } else {
                    exSQL("UPDATE category SET name = '$name_new' WHERE id = '$id'");
                    header("Location:index.php");
                }
            }
        }
    } else {
        header("Location:index.php");
    }
    ?>
    <div class="">
        <?php if (isset($error)) { ?>
            <p class="alert alert-danger"><?= $error ?></p>
        <?php
        } ?>
        <?php if (isset($error2)) { ?>
            <p class="alert alert-primary"><?= $error2 ?></p>
        <?php

        } ?>
        <form method="POST">
            <label for="category">Danh mục</label> <br>
            <input type="text" name="category" placeholder="Danh mục" style="width:100%;padding-left: 10px;height:30px;border-radius:5px;border:1px solid #cdcdcd" value="<?= $name ?>"> <br><br>
            <button type="submit" name="updateCate" class="btn btn-primary">Cập nhật</button>
            <a href="index.php" class="btn btn-danger">Quay lại</a>
        </form>
    </div>
<?php
} else {
?>
    <table class="table table-hover" border="0.5">
        <thead>
            <tr>
                <th>Stt</th>
                <th>Tên sản phẩm</th>
                <th>Thời gian đặt</th>
                <th>Tên người mua</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 1;
            foreach (selectAll("SELECT * FROM cart") as $row) {
            ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td>
                        <?php 
                            foreach (selectAll("SELECT * FROM products WHERE id={$row['idProduct']}")as $item) {
                               ?>
                                <p><?= $item['name'] ?></p>
                               <?php
                            }
                        ?>
                    </td>
                    <td>
                        <?= $row['time'] ?>
                    </td>
                    <td>
                      <?php 
                        foreach (selectAll("SELECT * FROM user WHERE id={$row['idUser']}") as $item) {
                            echo $item['name'];
                        }
                      ?>
                    </td>
                    <td>
                        <?php 
                            if($row['status'] === 0){
                                echo '
                                <button type="button" disabled class="btn btn-danger">Chưa xác nhận</button>
                                ';
                            }else{
                                echo '
                                <button type="button" disabled class="btn btn-primary">Đã đặt hàng</button>
                                ';
                            }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php }
include 'footer.php';
}?>
<?php
} else {
} ?>