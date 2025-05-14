<?php
session_start();
require 'db_connect.php';

// Nếu đã đăng nhập thì chuyển về dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Biến thông báo
$error_message = "";
$success_message = "";

// Xử lý khi gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Kiểm tra dữ liệu
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = "Vui lòng điền đầy đủ thông tin!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Email không hợp lệ!";
    } elseif ($password !== $confirm_password) {
        $error_message = "Mật khẩu nhập lại không khớp!";
    } else {
        // Kiểm tra email hoặc username đã tồn tại
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email, $username]);
        if ($stmt->fetch()) {
            $error_message = "Email hoặc tên người dùng đã tồn tại!";
        } else {
            // Mã hóa mật khẩu
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, reset_password) VALUES (?, ?, ?, ?)");
            try {
                if ($stmt->execute([$username, $email, $hashed_password, $hashed_password])) {
                    $success_message = "Đăng ký thành công! Vui lòng đăng nhập.";
                    header("Location: login.php?success=Đăng ký thành công. Vui lòng đăng nhập.");
                    exit();
                } else {
                    $error_message = "Đăng ký thất bại. Vui lòng thử lại.";
                }
            } catch (PDOException $e) {
                $error_message = "Lỗi: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('images/anh-duong-tam-lam-hinh-nen-may-tinh.jpg') no-repeat center center/cover;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .container {
            background: white;
            padding: 30px;
            width: 400px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: slideIn 1s ease-in-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .input-group {
            text-align: left;
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
            transform: scale(1.02);
        }

        .btn {
            width: 100%;
            background: linear-gradient(90deg, #4a5ef1, #007bff);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: linear-gradient(90deg, #007bff, #4a5ef1);
            transform: scale(1.05);
            box-shadow: 0px 0px 15px rgba(0, 123, 255, 0.7);
        }

        .links {
            margin-top: 15px;
            font-size: 14px;
        }

        .links a {
            text-decoration: none;
            color: #4a5ef1;
            font-weight: bold;
            transition: 0.3s;
        }

        .links a:hover {
            text-decoration: underline;
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
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
            text-decoration: none;
            background: linear-gradient(to right, rgb(255, 255, 255), rgb(0, 0, 0));
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

        .error-message {
            color: red;
            margin-bottom: 15px;
        }

        .success-message {
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
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

    <div class="container">
        <h2>Đăng Ký</h2>

        <!-- Hiển thị thông báo -->
        <?php if (!empty($error_message)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
            <p class="success-message"><?php echo htmlspecialchars($success_message); ?></p>
        <?php endif; ?>

        <!-- Form đăng ký -->
        <form method="post" action="">
            <div class="input-group">
                <label for="username">Họ và Tên</label>
                <input type="text" id="username" name="username" placeholder="Nhập họ tên" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Xác nhận mật khẩu</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
            </div>
            <button type="submit" class="btn">Đăng Ký</button>
        </form>

        <div class="links">
            Đã có tài khoản? <a href="login.php">Đăng Nhập</a> <br>
            <a href="reset-password.php">Quên mật khẩu?</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>