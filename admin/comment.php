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
        if (isset($_GET["product"])) {
        ?>
            <?php
            $name_product = "SELECT * FROM products WHERE id = {$_GET['product']}";
            $result_product = $conn->query($name_product);
            $name_product = $result_product->fetch();
            ?>
            <h3 style="text-align:center"><?= $name_product['name'] ?></h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Người bình luận</th>
                        <th>Nội dung</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <?php
                if (isset($_GET["delete"]) && isset($_GET["product"])) {
                    exSQL("DELETE FROM comment WHERE id = {$_GET['delete']}");
                    header('location:?product=' . $_GET['product']);
                }
                ?>
                <tbody>
                    <?php
                    $stt = 1;
                    foreach (selectAll("SELECT * FROM comment WHERE id_product ={$_GET['product']}") as $row) {
                        foreach (selectAll("SELECT * FROM user WHERE id = {$row['id_user']}") as $user) {
                    ?>
                            <tr>
                                <td><?= $stt++ ?></td>
                                <td><?= empty($user['name']) ? $user['user'] : $user['name'] ?></td>
                                <td><?= $row['content'] ?></td>
                                <td><a href="?product=<?= $_GET['product'] ?>&&delete=<?= $row['id'] ?>" class="btn btn-danger mr-3" onclick="return confirm('Bạn có muốn xóa bình luận này không ?')">Xóa</a><a href="../detail.php?id=<?= $row['id_product'] ?>#comment" class="btn btn-success" target="_blank">Chi tiết</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        <?php
        } else {
        ?>
            <h3 style="text-align:center">Bình luận / Đánh giá về sản phẩm</h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Sản phẩm</th>
                        <th>Tổng số BL</th>
                        <th>Cũ Nhất</th>
                        <th>Mới Nhất</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = 1;
                    foreach (selectAll("SELECT DISTINCT id_product FROM comment") as $row) {
                        foreach (selectAll("SELECT * FROM comment WHERE id_product= {$row['id_product']} ORDER BY id ASC LIMIT 1") as $old) {
                            foreach (selectAll("SELECT * FROM products WHERE id =" . $row['id_product']) as $item) {
                                foreach (selectALL("SELECT * FROM comment WHERE id_product={$item['id']} ORDER BY id DESC LIMIT 1") as $new) {
                    ?>
                                    <?php
                                    $sql = "SELECT * FROM comment WHERE id_product=" . $item['id'];
                                    $result = $conn->query($sql);
                                    $result->execute();
                                    $count = $result->rowCount();
                                    ?>
                                    <tr style="font-size: 14px;" class="row-duplicate">
                                        <td><?= $stt++ ?></td>
                                        <td class="name">
                                            <p class="mx-auto" style="white-space: nowrap;overflow:hidden;text-overflow: ellipsis;width: 200px;" title="<?= $item['name'] ?>"><?= $item['name'] ?></p>
                                        </td>
                                        <td class="text-center">
                                            <p class="mx-auto" style="white-space: nowrap;overflow:hidden;text-overflow: ellipsis;width: 200px;" title="<?= $count ?>"><?= $count ?></p>
                                        </td>
                                        <td><?= $old['date_add'] ?></td>
                                        <td>
                                            <?= $new['date_add'] ?>
                                        </td>
                                        <td><a href="?product=<?= $item['id'] ?>" class="btn btn-success blank">Chi tiết</a></td>
                                    </tr>
                    <?php
                                }
                            }
                        }
                    };
                    ?>

                </tbody>
            </table>
<?php }
    }
    include 'footer.php';
} else {
} ?>