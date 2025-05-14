<?php
session_start();

// Fixed product array with unique IDs
$products = [
    ['id' => 1, 'name' => 'Tiểu Thuyết Tiên Nghịch', 'price' => 200000],
    ['id' => 2, 'name' => 'Tiểu Thuyết Mục Thần Ký', 'price' => 200000],
    ['id' => 3, 'name' => 'Tiểu Thuyết Nhất Niệm Vĩnh Hằng', 'price' => 200000],
    ['id' => 4, 'name' => 'Tiểu Thuyết Đấu Đại Lục', 'price' => 200000],
    ['id' => 5, 'name' => 'Tiểu Thuyết Đấu Phá Thương Khung', 'price' => 200000],
    ['id' => 6, 'name' => 'Tiểu Thuyết Thế Giới Hoàn Mỹ', 'price' => 200000],
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Danh sách sản phẩm truyện tại UIA">
    <title>Danh Sách Sản Phẩm - UIA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arial:wght@400;700&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
            min-height: 100vh;
            padding: 0;
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
            padding: 15px 30px;
            background: rgba(1, 0, 0, 0.36);
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 15px rgba(81, 244, 222, 0.5);
            z-index: 10;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            background: linear-gradient(to right, #ffffff, #000000);
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
            color: white;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease, text-shadow 0.3s ease;
        }

        .menu a:hover {
            color: #00c6ff;
            text-shadow: 0 0 10px rgba(0, 198, 255, 0.8);
        }

        .container {
            max-width: 900px;
            margin: 100px auto 50px;
            background: white;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }

        .btn {
            padding: 10px 14px;
            text-decoration: none;
            margin: 6px;
            display: inline-block;
            border-radius: 6px;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .btn-add { background: #28a745; color: white; }
        .btn-edit { background: #ff9800; color: white; }
        .btn-delete { background: #dc3545; color: white; }
        .btn:hover { transform: scale(1.05); }

        .alert {
            display: none;
            padding: 12px;
            margin: 15px auto;
            width: 70%;
            text-align: center;
            font-weight: bold;
            color: white;
            background: #28a745;
            border-radius: 6px;
            animation: fadeOut 3s forwards;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; display: none; }
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

            .container {
                margin: 80px auto 30px;
                padding: 15px;
                max-width: 95%;
            }

            table, th, td {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
    <script>
        function showAlert(message) {
            const alertBox = document.getElementById("alert-box");
            alertBox.innerText = message;
            alertBox.style.display = "block";
            setTimeout(() => { alertBox.style.display = "none"; }, 3000);
        }

        function confirmDelete(event) {
            if (!confirm("Bạn có chắc muốn xóa sản phẩm này?")) {
                event.preventDefault();
            } else {
                showAlert("Sản phẩm đã được xóa!");
            }
        }
    </script>
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="logo">UIA</a>
        <ul class="menu">
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="gioithieu.php">Giới Thiệu</a></li>
            <li><a href="contact.php">Liên Hệ</a></li>
            <li><a href="products.php">Cửa Hàng</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="logout.php">Đăng Xuất</a></li>
            <?php else: ?>
                <li><a href="login.php">Đăng Nhập</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="container">
        <h1>Danh Sách Sản Phẩm</h1>
        <a href="create.php" class="btn btn-add" onclick="showAlert('Đang chuyển đến trang thêm sản phẩm...')">+ Thêm Sản Phẩm</a>
        <div id="alert-box" class="alert"></div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</td>
                        <td>
                            <a href="update.php?id=<?= $product['id'] ?>" class="btn btn-edit">Sửa</a>
                            <a href="delete.php?id=<?= $product['id'] ?>" class="btn btn-delete" onclick="confirmDelete(event)">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if (file_exists('footer.php')) include 'footer.php'; ?>
</body>
</html>