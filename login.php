<?php
session_start();
require 'db_connect.php';

$page_title = "Đăng Nhập";

$errors = [];
$success_message = "";

// Redirect logged-in users to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Success message after registration
if (isset($_GET['success'])) {
    $success_message = htmlspecialchars($_GET['success']);
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
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $errors["login"] = "Email hoặc mật khẩu không đúng!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Đăng nhập vào UIA để truy cập các sản phẩm truyện">
    <title>Đăng Nhập - UIA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2); /* Fallback */
            background-image: url('images/cover.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
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
            text-transform: uppercase;
            text-decoration: none;
            background: linear-gradient(to right, #fff, #000);
            -webkit-background-clip: text;
            color: transparent;
        }

        .menu {
            list-style: none;
            display: flex;
            align-items: center;
        }

        .menu li {
            margin: 0 15px;
        }

        .menu a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease, text-shadow 0.3s ease;
        }

        .menu a:hover {
            color: #00c6ff;
            text-shadow: 0 0 10px rgba(0, 198, 255, 0.8);
        }

        .login-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 100px 20px 60px;
            animation: fadeIn 1s ease-out;
        }

        .login-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
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
            color: #00c6ff;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            animation: fadeInText 1s ease-out;
        }

        @keyframes fadeInText {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #b0c4de;
            border-radius: 5px;
            box-sizing: border-box;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #00c6ff;
            box-shadow: 0 0 8px rgba(0, 198, 255, 0.5);
        }

        button {
            width: 100%;
            background: linear-gradient(90deg, rgba(0, 200, 255, 0.14), #0072ff);
            color: #fff;
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
            box-shadow: 0 0 15px rgba(0, 198, 255, 0.7);
        }

        .links {
            text-align: center;
            margin-top: 1rem;
        }

        .signup-link, .forgot-link {
            color: #fff;
            margin: 0.5rem 0;
        }

        .links a {
            color: #00c6ff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .error, .success {
            text-align: center;
            margin-bottom: 1rem;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .error {
            background: rgba(255, 0, 0, 0.2);
            color: #ff4444;
        }

        .success {
            background: rgba(0, 255, 0, 0.2);
            color: #28a745;
        }

        noscript {
            display: block;
            text-align: center;
            color: #ff4444;
            margin: 1rem;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 10px;
            }

            .menu {
                flex-direction: column;
                margin-top: 10px;
            }

            .menu li {
                margin: 10px 0;
            }

            .login-wrapper {
                padding: 80px 15px 40px;
            }

            .login-container {
                padding: 1.5rem;
                max-width: 90%;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <noscript>
        <p>Vui lòng bật JavaScript để sử dụng đầy đủ chức năng của trang.</p>
    </noscript>

    <nav class="navbar">
        <a href="index.php" class="logo">UIA</a>
        <ul class="menu">
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="gioithieu.php">Giới Thiệu</a></li>
            <li><a href="contact.php">Liên Hệ</a></li>
            <li><a href="products.index.php">Cửa Hàng</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">Đăng Xuất</a></li>
            <?php else: ?>
                <li><a href="login.php">Đăng Nhập</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="login-wrapper">
        <div class="login-container">
            <h2>Đăng Nhập</h2>

            <?php if (!empty($errors)) : ?>
                <div class="error">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php elseif (!empty($success_message)) : ?>
                <div class="success">
                    <p><?php echo htmlspecialchars($success_message); ?></p>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="email" id="username" name="username" placeholder="Nhập email" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                
                <button type="submit">Đăng Nhập</button>
            </form>

            <div class="links">
                <p class="signup-link">Chưa có tài khoản? <a href="register_AF.php">Đăng ký ngay</a></p>
                <p class="forgot-link"><a href="reset-password.php">Quên mật khẩu?</a></p>
            </div>
        </div>
    </div>

    <?php if (file_exists('footer.php')) include 'footer.php'; ?>
</body>
</html>