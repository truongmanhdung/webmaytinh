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
        if (isset($_GET['edituser'])) {
        ?>
            <?php
            if (isset($_GET["edituser"])) {
                $id = $_GET["edituser"];
                foreach (selectAll("SELECT * FROM user WHERE id = '$id'") as $row) {
                    $user = isset($row["user"]) ? $row["user"] : '';
                    $address = empty($row["address"]) ? 'Chưa cập nhật' : $row["address"];
                    $name = empty($row["name"]) ? 'Chưa cập nhật' : $row["name"];
                    $avatar = empty($row["image"]) ? '' : $row['image'];
                }
            }
            ?>
            <?php
            if (isset($_POST['edituser'])) {
                $permission = $_POST['permission'];
                exSQL("UPDATE user SET permission='$permission' WHERE id = $id");
                header('location:user.php');
            }
            ?>
            <h3 style="text-align:center">Sửa thông tin</h3>
            <form method="POST" enctype="multipart/form-data">
                <?php if (isset($error)) { ?>
                    <p class="col-xs-6 col-sm-6 col-md-6 col-lg-6 alert alert-danger"><?= $error ?></p>
                <?php
                } ?>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div>
                            <label for="">Tài khoản : <?= $user ?></label><br>
                        </div>
                        <div>
                            <label for="">Họ tên : <?= $name ?></label><br>
                        </div>
                        <div>
                            <label for="">Địa chỉ : <?= $address ?></label><br>
                        </div>
                        <div class="">
                            <label>Phân quyền</label>
                            <select name="permission" id="permission">
                                <?php
                                foreach (selectAll("SELECT * FROM user WHERE id =$id") as $row) {
                                ?>
                                    <option value="<?= $row['permission'] ?>"><?= $row['permission'] ?></option>
                                <?php    }
                                ?>
                                <?php
                                foreach (selectAll("SELECT * FROM user") as $row) {
                                ?>
                                    <option value="<?= $row['permission'] ?>"><?= $row['permission'] ?></option>
                                <?php    }
                                ?>
                            </select>
                        </div>
                        <div class="preview-images">
                            <label for="image">Ảnh đại diện</label>
                            <?php
                            if (empty($avatar)) {
                                echo " : Chưa cập nhật";
                            } else {
                                echo "<label for=\"imgInp\"><img class=\"rounded-circle\" src=\"../images/$avatar\" alt=\"\" width=\"50px\" id=\"blah\" height=\"50px\" style=\"object-fit:cover;\"></label>
                                <input type=\"file\" id=\"imgInp\" name=\"image\" hidden>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                    </div>
                    <div class="mx-auto">
                        <button type="submit" class="btn btn-warning" name="edituser">Cập nhật</button>
                        <a href="user.php" class="btn btn-danger" name="back">Quay lại</a>
                    </div>
                </div>
            </form>
        <?php
        } elseif (isset($_GET["user"])) {
            $id = $_GET["user"];
            selectAll("DELETE FROM user WHERE id = $id");
            header('location:user.php');
        } else {
        ?>
            <h3 style="text-align:center">Quản trị người dùng</h3>
            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Tài khoản</th>
                            <th>Họ và tên</th>
                            <th>Ảnh đại diện</th>
                            <th>Địa chỉ</th>
                            <th>Phân quyền</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 1;
                        foreach (selectAll("SELECT * FROM user") as $row) {
                        ?>
                            <tr>
                                <td><?= $stt++ ?></td>
                                <td><?= $row['user'] ?></td>
                                <td><?= empty($row['name']) ? 'Chưa cập nhật' : $row['name']; ?></td>
                                <td>
                                    <?php
                                    if (empty($row['image'])) {
                                    ?> <p>Chưa cập nhật</p>
                                    <?php    } else { ?> <img style="object-fit: cover;" class="rounded-circle" width="50px" height="50px" src="../images/<?= $row['image'] ?>" alt="">
                                    <?php }
                                    ?>
                                </td>
                                <td>
                                    <p title="<?= empty($row['address']) ? 'Chưa cập nhật' : $row['address']; ?>" style="width:150px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><?= empty($row['address']) ? 'Chưa cập nhật' : $row['address']; ?></p>
                                </td>
                                <td><?= $row['permission'] ?></td>
                                <td><a href="?edituser=<?= $row['id'] ?>" class="btn btn-warning mr-3">Sửa</a><a href="?user=<?= $row['id'] ?>" onclick="return confirm('Bạn có muốn xóa người dùng này khỏi hệ thống không ?')" class="btn btn-danger">Xóa</a></td>
                            </tr>
                        <?php }
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
                var seen = {};
                $('#permission option').each(function() {
                    var txt = $(this).text();
                    if (seen[txt])
                        $(this).remove();
                    else
                        seen[txt] = true;
                });
            </script>
    <?php
    } else {
    }
} ?>