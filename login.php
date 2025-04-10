<?php
session_start();
$page_title = "Đăng Nhập";

$errors = [];
$success_message = "";

// Nếu người dùng đã đăng nhập, chuyển hướng tới dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

// Thông báo sau khi đăng ký thành công
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success_message = "Đăng ký thành công! Vui lòng đăng nhập.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST["username"] ?? ""));
    $password = trim($_POST["password"] ?? "");

    if (!$email) {
        $errors["email"] = "Vui lòng nhập email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email không hợp lệ.";
    }

    if (!$password) {
        $errors["password"] = "Vui lòng nhập mật khẩu.";
    }

    if (empty($errors)) {
        if (
            isset($_SESSION['registered_email'], $_SESSION['registered_password'], $_SESSION['registered_username']) &&
            $email === $_SESSION['registered_email'] &&
            $password === $_SESSION['registered_password']
        ) {
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $_SESSION["registered_username"];
            $_SESSION["user"] = true;

            header("Location: dashboard.php");
            exit();
        } else {
            $errors["login"] = "Email hoặc mật khẩu không đúng hoặc chưa đăng ký!";
        }
    }
}
?>

<div class="login-wrapper">
    <div class="login-container">
        <h2>Đăng Nhập</h2>

        <?php if (!empty($errors)) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php elseif (!empty($success_message)) : ?>
            <div class="success">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Tên người dùng</label>
                <input type="text" id="username" name="username" placeholder="Tên người dùng" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <button type="submit">Đăng Nhập</button>
        </form>

        <div class="links">
        <p class="signup-link">Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
        <p class="forgot-link"><a href="forgotpassword.php">Quên mật khẩu?</a></p>
       
        </div>
    </div>
</div>

<nav class="navbar">
    <a href="images/55536772-c460-4374-b64e-f5fc5017bedb.jpg" class="logo">UIA</a>
    <ul class="menu">
        <li><a href="index.php">Trang Chủ</a></li>
        <li><a href="gioithieu.php">Giới Thiệu</a></li>
        <li><a href="contact.php">Liên Hệ</a></li>
        <li><a href="products.index.php">Cửa Hàng</a></li>
        <?php if (isset($_SESSION['user'])): ?>
            <li><a href="logout.php">Đăng Xuất</a></li>
        <?php else: ?>
            <li><a href="login.php">Đăng Nhập</a></li>
        <?php endif; ?> 
    </ul>
</nav>

<?php include 'footer.php'; ?>

<style>
    .signup-link {
    color: white;
}

    body {
        font-family: Arial, sans-serif;
        background-image: url(images/lich-chieu-phim-tien-nghich-4.jpg);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        padding-top: 70px;
    }

    .login-wrapper {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-bottom: 60px;
        animation: fadeIn 1s ease-out;
    }

    .login-container {
        background: rgba(0, 0, 0, 0.7);
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(147, 112, 219, 0.1);
        width: 100%;
        max-width: 400px;
        animation: slideUp 0.6s ease-out;
    }

    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes slideUp {
        0% { transform: translateY(20px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }

    h2 {
        -webkit-background-clip: text;
        background-clip: text;
        color: rgba(0, 123, 255, 1);
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: 2rem;
        animation: fadeInText 1s ease-out;
    }

    @keyframes fadeInText {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .form-group { margin-bottom: 1rem; }

    label { 
        display: block; 
        color: #4682b4;
        margin-bottom: 0.5rem; 
    }

    input {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #b0c4de;
        border-radius: 5px;
        box-sizing: border-box;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus {
        outline: none;
        transform: scale(1.02);
        box-shadow: 0 0 8px rgba(70, 130, 180, 0.5);
    }

    button {
        width: 100%;
        background: #00c6ff;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    button:hover {
        background: linear-gradient(90deg, #0072ff, #00c6ff);
        transform: scale(1.05);
        box-shadow: 0px 0px 15px rgba(0, 198, 255, 0.7);
    }

    .links {
        text-align: center;
        margin-top: 1rem;
    }

    .links a {
        color: #00c6ff;
        text-decoration: none;
        margin: 0 10px;
        transition: color 0.3s ease;
    }

    .links a:hover {
        color: #4682b4;
        text-decoration: underline;
    }

    .error, .success {
        text-align: center;
        margin-bottom: 1rem;
    }

    .error {
        color: red;
    }

    .success {
        color: limegreen;
    }

    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 10px;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        animation: navbarFadeIn 0.5s ease-in;
    }

    @keyframes navbarFadeIn {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .logo {
        font-size: 22px;
        font-weight: bold;
        color: white;
        text-transform: uppercase;
        text-decoration: none;
        background: linear-gradient(to right,rgb(255, 255, 255),rgb(0, 0, 0));
        -webkit-background-clip: text;
        color: transparent;
    }

    .menu {
        list-style: none;
        display: flex;
    }

    .menu li {
        margin: 0 15px;
    }

    .menu li a {
        text-decoration: none;
        color: white;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .menu li a:hover {
        color: #00c6ff;
    }
</style>
