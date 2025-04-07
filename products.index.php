<?php
$products = [
    ['id' => 1, 'name' => 'Tiểu Thuyết Tiên Nghịch', 'price' => 200000],
    ['id' => 2, 'name' => 'Tiểu Thuyết Mục Thần Ký', 'price' => 200000],
    ['id' => 3, 'name' => 'Tiểu Thuyết Nhất Niệm Vĩnh Hằng', 'price' => 200000],
    ['id' => 1, 'name' => 'Tiểu Thuyết Đấu Đại Lục', 'price' => 200000],
    ['id' => 2, 'name' => 'Tiểu Thuyết Đấu Phá Thương Khung ', 'price' => 200000],
    ['id' => 3, 'name' => 'Tiểu Thuyết Thế Giới Hoàn Mỹ', 'price' => 200000],
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
            margin: 0;
            padding: 0;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 1350px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: rgba(1, 0, 0, 0.36);
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 15px rgb(81, 244, 222);
            border-radius: 10px;
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
            padding: 0;
        }
        .menu li {
            margin: 0 15px;
        }
        .menu a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s ease;
        }
        .menu a:hover {
            color: #00c6ff;
            text-shadow: 0px 0px 10px rgba(0, 198, 255, 0.8);
        }
        .container {
            max-width: 900px;
            margin: 100px auto 50px;
            background: white;
            padding: 25px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
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
    </style>
    <script>
        function showAlert(message) {
            var alertBox = document.getElementById("alert-box");
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
        <a href="images/55536772-c460-4374-b64e-f5fc5017bedb.jpg" class="logo">UIA</a>
        <ul class="menu">
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="gioithieu.php">Giới Thiệu</a></li>
            <li><a href="contact.php">Liên Hệ</a></li>
          <li><a href="logout.php">Đăng Xuất</a></li>
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
                            <a href="#" class="btn btn-delete" onclick="confirmDelete(event)">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php include 'footer.php'; 