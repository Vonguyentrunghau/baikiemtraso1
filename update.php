<?php
$product = ['id' => 1, 'name' => 'Áo Thun Đen', 'price' => 200000];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Sản Phẩm</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            transition: all 0.3s ease-in-out;
        }
        body {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h1 {
            font-size: 22px;
            color: #333;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        input, button {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input:focus {
            border-color: #007BFF;
            box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.5);
            transform: scale(1.02);
        }
        button {
            background: #ffc107;
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }
        button:hover {
            background: #e0a800;
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(255, 193, 7, 0.5);
        }
        .btn-back {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-back:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Cập Nhật Sản Phẩm</h1>
    <form action="index.php" method="POST">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <input type="text" name="name" value="<?= $product['name'] ?>" required>
        <input type="number" name="price" value="<?= $product['price'] ?>" required>
        <button type="submit">Cập Nhật</button>
    </form>
    <a href="products.index.php" class="btn-back">← Quay lại danh sách</a>
</div>

</body>
</html>
