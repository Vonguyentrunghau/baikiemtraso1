<?php
session_start();

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"] ?? ""));
    $email = filter_var(trim($_POST["email"] ?? ""), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST["subject"] ?? ""));
    $message = htmlspecialchars(trim($_POST["message"] ?? ""));

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $success = "Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.";
        } else {
            $error = "Email không hợp lệ!";
        }
    } else {
        $error = "Vui lòng điền đầy đủ thông tin!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Liên hệ với UIA để được hỗ trợ">
    <title>Liên Hệ - UIA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            animation: fadeIn 1s ease-in-out;
            padding-top: 80px; /* Space for fixed navbar */
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
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

        .wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 90%;
            margin: 0 auto;
            gap: 20px;
        }

        .contact-form {
            width: 55%;
            padding: 30px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            font-size: 26px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
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

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 10px;
            outline: none;
            transition: 0.3s;
        }

        input:focus, textarea:focus {
            border-color: #00c6ff;
            box-shadow: 0 0 10px rgba(0, 198, 255, 0.5);
        }

        textarea {
            height: 120px;
            resize: none;
        }

        .btn {
            width: 100%;
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            background: linear-gradient(90deg, #0072ff, #00c6ff);
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 198, 255, 0.7);
        }

        .btn:focus {
            outline: 2px solid #00c6ff;
            outline-offset: 2px;
        }

        .success, .error {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        .success {
            background: rgba(0, 255, 0, 0.1);
            color: #28a745;
        }

        .error {
            background: rgba(255, 0, 0, 0.1);
            color: #ff4444;
        }

        .terms {
            width: 40%;
            padding: 30px;
            background: #f8f8f8;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-height: 400px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #ddd #f8f8f8;
        }

        .terms::-webkit-scrollbar {
            width: 8px;
        }

        .terms::-webkit-scrollbar-track {
            background: #f8f8f8;
        }

        .terms::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 4px;
        }

        .terms h3 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #444;
        }

        .terms p {
            font-size: 14px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            body {
                padding-top: 120px;
            }

            .wrapper {
                flex-direction: column;
                width: 90%;
            }

            .contact-form, .terms {
                width: 100%;
                margin-bottom: 20px;
            }

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
        }
    </style>
</head>
<body>
    <noscript>
        <p style="color: #ff4444; text-align: center; margin: 1rem;">
            Vui lòng bật JavaScript để sử dụng đầy đủ chức năng của trang.
        </p>
    </noscript>

    <nav class="navbar" role="navigation" aria-label="Main navigation">
        <a href="index.php" class="logo">UIA</a>
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

    <div class="wrapper">
        <!-- Form liên hệ -->
        <div class="contact-form">
            <h2>Liên Hệ Với Chúng Tôi</h2>

            <?php if (!empty($success)): ?>
                <p class="success"><?php echo htmlspecialchars($success); ?></p>
            <?php elseif (!empty($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form action="contact.php" method="POST">
                <div class="input-group">
                    <label for="name">Họ và Tên</label>
                    <input type="text" id="name" name="name" placeholder="Nhập họ tên" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Nhập email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                </div>
                <div class="input-group">
                    <label for="subject">Chủ đề</label>
                    <input type="text" id="subject" name="subject" placeholder="Nhập chủ đề" value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>" required>
                </div>
                <div class="input-group">
                    <label for="message">Nội dung</label>
                    <textarea id="message" name="message" placeholder="Nhập nội dung tin nhắn" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                </div>
                <button type="submit" class="btn">Gửi Tin Nhắn</button>
            </form>
        </div>

        <!-- Điều khoản -->
        <div class="terms">
            <h3>Điều khoản & Điều kiện</h3>
            <p><strong>1. Sử dụng dịch vụ:</strong> Khi sử dụng trang web của chúng tôi, bạn đồng ý tuân theo tất cả các điều khoản được liệt kê.</p>
            <p><strong>2. Bảo mật thông tin:</strong> Chúng tôi cam kết bảo mật thông tin cá nhân của bạn và không chia sẻ với bên thứ ba.</p>
            <p><strong>3. Quyền hạn:</strong> Chúng tôi có quyền thay đổi, cập nhật nội dung mà không cần thông báo trước.</p>
            <p><strong>4. Hỗ trợ:</strong> Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ qua email.</p>
        </div>
    </div>

    <?php if (file_exists('footer.php')) include 'footer.php'; ?>
</body>
</html>