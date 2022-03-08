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
if (isset($_POST['signup'])) {
    if (empty($_POST["username"]) && empty($_POST["password"]) && empty($_POST["password1"])) {
        $error2 = 'Vui lòng không bỏ trống';
    } elseif (empty($_POST["username"])) {
        $error2 = 'Vui lòng nhập tài khoản';
    } elseif (empty($_POST["password"])) {
        $error2 = 'Vui lòng nhập mật khẩu';
    } elseif (empty($_POST["password1"])) {
        $error2 = 'Vui lòng nhập lại mật khẩu';
    } elseif ($_POST["password"] != $_POST["password1"]) {
        $error2 = 'Nhập lại mật khẩu không chính xác';
    } else {
        $taikhoan = $_POST["username"];
        $matkhau = md5($_POST["password"]);
        $sql = "SELECT * FROM user WHERE user ='$taikhoan'";
        $result = $conn->query($sql);
        $result->execute();
        if ($result->rowCount() > 0) {
            $error2 = 'Tài khoản đã có người sử dụng';
        } else {
            exSQL("INSERT INTO user(user,pass,permission) VALUES('$taikhoan','$matkhau','khách hàng')");
            $cookie_name = "user";
            setcookie($cookie_name, $taikhoan, time() + (86400 * 30), "/");
            header('location:index.php');
        }
    }
}
?>

<body>
    <div class="wrapper__area sign-up__Mode-active" id="wrapper_Area">
        <div class="forms__area">
            <form class="sign-up__form" id="signUpForm" method="POST" autocomplete="off">
                <h1 class="form__title">ĐĂNG KÝ!</h1>
                <?php
                if (isset($error2)) {
                ?> <p class="alert alert-danger"><?= $error2 ?></p>
                <?php }
                ?>
                <?php
                if (isset($error3)) {
                ?> <p class="alert alert-success"><?= $error3 ?></p>
                <?php }
                ?>
                <div class="input__group">
                    <label class="field">
                        <input type="text" name="username" placeholder="Tài khoản" id="signUpUsername">
                    </label>
                    <span class="input__icon"><i class="bx bx-user"></i></span>
                </div>
                <div class="input__group">
                    <label class="field">
                        <input type="password" name="password" placeholder="Mật khẩu" id="signUpPassword">
                    </label>
                    <span class="input__icon"><i class="bx bx-lock"></i></span>
                    <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
                </div>
                <div class="input__group confirm__group">
                    <label class="field">
                        <input type="password" name="password1" placeholder="Nhập lại mật khẩu" id="signUpConfirmPassword">
                    </label>
                    <span class="input__icon"><i class="bx bx-lock"></i></span>
                    <span class="showHide__Icon"><i class="bx bx-hide"></i></span>
                </div>
                <button type="submit" name="signup" class="submit-button" id="signUpSubmitBtn">ĐĂNG KÝ</button>
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
                <button id="aside_signUp_Btn">ĐĂNG KÝ</button>
            </div>
            <div class="sign-up__aside-info">
                <h4>Welcome</h4>
                <img src="https://e.top4top.io/p_1945sidbp2.png" alt="Image">
                <p>Đã có tài khoản ? Vui lòng đăng nhập</p>
                <button id="aside_signIn_Btn" onclick="dangnhap()">ĐĂNG NHẬP</button>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.min.js"></script>
</body>
<script>
    function dangnhap() {
        location.href = 'login.php';
    }
</script>

</html>