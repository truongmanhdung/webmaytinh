<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="style_login.php">
    <title>Title</title>
</head>

<?php
include_once 'admin/connect.php';
if (isset($_POST['login'])) {
    if (empty($_POST["taikhoan"]) && empty($_POST["matkhau"])) {
        $error = 'Vui lòng nhập tài khoản và mật khẩu !';
    } elseif (empty($_POST["taikhoan"])) {
        $error = 'Vui lòng nhập tài khoản !';
    } elseif (empty($_POST["matkhau"])) {
        $error = 'Vui lòng nhập mật khẩu !';
    } else {
        $taikhoan = $_POST["taikhoan"];
        $matkhau = md5($_POST["matkhau"]);
        $sql = "SELECT * FROM user WHERE user ='$taikhoan' AND pass='$matkhau'";
        $result = $conn->query($sql);
        $result->execute();
        if ($result->rowCount() == 1) {
            $cookie_name = "user";
            setcookie($cookie_name, $taikhoan, time() + (86400 * 30), "/");
            header('location:index.php');
        } else {
            $error = 'Tài khoản hoặc mật khẩu không chính xác !';
        }
    }
}
?>

<body>
    <div class="wrapper__area" id="wrapper_Area">
        <div class="forms__area">
            <form class="login__form" id="loginForm" method="POST" autocomplete="off">
                <h1 class="form__title">ĐĂNG NHẬP!</h1>
                <?php
                if (isset($error)) {
                ?> <p class="alert alert-danger"><?= $error ?></p>
                <?php }
                ?>
                <?php
                if (isset($error3)) {
                ?> <p class="alert alert-success"><?= $error3 ?></p>
                <?php }
                ?>
                <div class="input__group">
                    <label class="field">
                        <input type="text" name="taikhoan" placeholder="Tài khoản" id="loginUsername">
                    </label>
                    <small class="input__error_message"></small>
                </div>
                <div class="input__group">
                    <label class="field">
                        <input type="password" name="matkhau" placeholder="Mật khẩu" id="loginPassword">
                    </label>
                </div>
                <div class="form__actions">
                    <label for="checkboxInput" class="remeber_me">
                        <input type="checkbox" id="checkboxInput">
                        <span class="checkmark"></span>
                        <span>Nhớ mật khẩu</span>
                    </label>
                    <div class="forgot_password">Quên mật khẩu?</div>
                </div>
                <button type="submit" name="login" class="submit-button" id="loginSubmitBtn">ĐĂNG NHẬP</button>
                <div class="alternate-login">
                    <div class="link">
                        <i class='bx bxl-google'></i>
                        <span>Google</span>
                    </div>
                    <div class="link">
                        <i class='bx bxl-facebook-circle'></i>
                        <span>Facebook</span>
                    </div>
                </div>
            </form>
        </div>
        <div class="aside__area" id="aside_Area">
            <div class="login__aside-info">
                <h4>Hello</h4>
                <img src="https://d.top4top.io/p_1945xjz2y1.png" alt="Image">
                <p>Chưa có tài khoản ? Vui lòng đăng ký</p>
                <button id="aside_signUp_Btn" onclick="dangky()">ĐĂNG KÝ</button>
            </div>
            <div class="sign-up__aside-info">
                <h4>Welcome</h4>
                <img src="https://e.top4top.io/p_1945sidbp2.png" alt="Image">
                <p>Đã có tài khoản ? Vui lòng đăng nhập</p>
                <button id="aside_signIn_Btn">ĐĂNG NHẬP</button>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.min.js"></script>
</body>
<script>
    function dangky() {
        location.href = 'signup.php';
    }
</script>

</html>