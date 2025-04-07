<?php
// Xử lý yêu cầu reset mật khẩu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    
    if (!empty($email)) {
        // Giả lập gửi email reset mật khẩu (thực tế cần triển khai gửi email thực)
        $success = "Một liên kết đặt lại mật khẩu đã được gửi đến email của bạn.";
    } else {
        $error = "Vui lòng nhập email hợp lệ.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Mật Khẩu</title>
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
            background: linear-gradient(to bottom, #e3f2fd, #fff);
            flex-direction: column;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: background 0.3s ease;
        }

        .navbar:hover {
            background: rgba(0, 0, 0, 0.9);
        }

        .navbar .logo {
            font-size: 24px;
            color: white;
            font-weight: bold;
            text-decoration: none;
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

        .container {
            background: white;
            padding: 30px;
            width: 400px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 80px;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
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
            border-color: #4a5ef1;
            box-shadow: 0 0 8px rgba(74, 94, 241, 0.5);
            transform: scale(1.03);
        }

        .btn {
            width: 100%;
            background: #4a5ef1;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .btn:hover {
                    background: linear-gradient(90deg, #0072ff, #00c6ff);
                    transform: scale(1.05);
                    box-shadow: 0px 0px 15px rgba(0, 198, 255, 0.7);
                }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="images/55536772-c460-4374-b64e-f5fc5017bedb.jpg" class="logo">UIA</a>
        <ul class="menu">
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="gioithieu.php">Giới Thiệu</a></li>
            <li><a href="contact.php">Liên Hệ</a></li>
            <li><a href="productsindex.php">Cửa Hàng</a></li>
            <li><a href="login.php">Đăng Nhập</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Đặt Lại Mật Khẩu</h2>
        <?php if (!empty($success)): ?>
            <p class="success" style="color: green; animation: fadeIn 1s;"> <?php echo $success; ?> </p>
        <?php elseif (!empty($error)): ?>
            <p class="error" style="color: red; animation: fadeIn 1s;"> <?php echo $error; ?> </p>
        <?php endif; ?>
        <form action="reset-password.php" method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập email của bạn" required>
            </div>
            <button type="submit" class="btn">Gửi Yêu Cầu</button>
        </form>
    </div>
</body>
</html>
<?php include 'footer.php'; 