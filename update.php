<?php
session_start();

// Restrict access to logged-in users
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Fetch product data (placeholder for database query)
$product = ['id' => 1, 'name' => 'Áo Thun Đen', 'price_vnd' => 200000, 'price_usd' => 8.00, 'image' => ''];
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    // Replace with actual database query, e.g.:
    // $product = $db->query("SELECT * FROM products WHERE id = ?", [$_GET['id']])->fetch();
    $product['id'] = $_GET['id'];
}

$errors = [];
$success = "";
$name = $_POST['name'] ?? $product['name'];
$price_vnd = $_POST['price_vnd'] ?? $product['price_vnd'];
$price_usd = $_POST['price_usd'] ?? $product['price_usd'];

// Server-side validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $price_vnd = filter_var(trim($_POST['price_vnd']), FILTER_VALIDATE_FLOAT);
    $price_usd = filter_var(trim($_POST['price_usd']), FILTER_VALIDATE_FLOAT);
    $id = filter_var(trim($_POST['id']), FILTER_VALIDATE_INT);
    
    if (empty($name)) {
        $errors[] = "Tên sản phẩm không được để trống.";
    }
    if ($price_vnd === false || $price_vnd <= 0) {
        $errors[] = "Giá VND phải là số dương.";
    }
    if ($price_usd === false || $price_usd <= 0) {
        $errors[] = "Giá USD phải là số dương.";
    }
    if ($id === false || $id <= 0) {
        $errors[] = "ID sản phẩm không hợp lệ.";
    }
    
    // Check price consistency (1 USD = 25,000 VND)
    if ($price_vnd && $price_usd) {
        $expected_usd = $price_vnd / 25000;
        if (abs($price_usd - $expected_usd) / $expected_usd > 0.05) {
            $errors[] = "Giá USD và VND không tương ứng (1 USD ≈ 25,000 VND).";
        }
    }
    
    // Validate image (optional)
    if (!empty($_FILES['image']['name'])) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 2 * 1024 * 1024; // 2MB
        if (!in_array($_FILES['image']['type'], $allowed_types)) {
            $errors[] = "Chỉ chấp nhận file JPEG, PNG hoặc GIF.";
        }
        if ($_FILES['image']['size'] > $max_size) {
            $errors[] = "File ảnh không được vượt quá 2MB.";
        }
    }

    if (empty($errors)) {
        $success = "Sản phẩm đã được gửi để cập nhật.";
        // Placeholder: Update database
        // update_product($id, $name, $price_vnd, $price_usd, $_FILES['image']);
        $name = $price_vnd = $price_usd = "";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cập nhật sản phẩm - UIA">
    <title>Cập Nhật Sản Phẩm - UIA</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6b48ff, #00ddeb);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            padding-top: 100px;
            animation: fadeIn 0.8s ease-in-out;
            position: relative;
            overflow-x: hidden;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
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
            0% { opacity: 0; transform: translateY(-10px); }
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
            transition: color 0.3s ease;
        }

        .menu a:hover {
            color: #00c6ff;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.18);
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 26px;
            color: #fff;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .price-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .price-group .input-group {
            flex: 1;
            min-width: 150px;
        }

        input, button {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 8px rgba(0, 198, 255, 0.4);
            transform: scale(1.01);
        }

        input:valid:not(:placeholder-shown) {
            border-left: 4px solid #28a745;
        }

        input:invalid:not(:placeholder-shown) {
            border-left: 4px solid #ff4444;
            animation: shake 0.3s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(-5px); }
        }

        .image-upload {
            background: rgba(255, 255, 255, 0.15);
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s;
        }

        .image-upload:hover, .image-upload.dragover {
            background: rgba(255, 255, 255, 0.3);
        }

        .image-upload input {
            display: none;
        }

        .image-upload label {
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            display: block;
        }

        .image-preview {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-top: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .image-preview.show {
            display: block;
            opacity: 1;
        }

        button {
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            font-weight: 600;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        button:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 12px rgba(0, 198, 255, 0.4);
        }

        button:focus {
            outline: 2px solid #00c6ff;
            outline-offset: 2px;
        }

        button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.5s, height 0.5s;
        }

        button:hover::after {
            width: 150px;
            height: 150px;
        }

        .btn-back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            font-size: 16px;
            transition: color 0.3s;
        }

        .btn-back:hover {
            color: #00c6ff;
            text-decoration: underline;
        }

        .error, .success {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
        }

        .error {
            background: rgba(255, 0, 0, 0.2);
            color: #ff4444;
        }

        .success {
            background: rgba(0, 255, 0, 0.2);
            color: #28a745;
        }

        @media (max-width: 768px) {
            body {
                padding-top: 140px;
            }

            .container {
                max-width: 90%;
                padding: 20px;
            }

            h1 {
                font-size: 22px;
            }

            input, button {
                font-size: 14px;
                padding: 10px 12px;
            }

            .price-group {
                flex-direction: column;
                gap: 10px;
            }

            .price-group .input-group {
                min-width: 100%;
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

    <div class="container">
        <h1>Cập Nhật Sản Phẩm</h1>

        <?php if (!empty($success)): ?>
            <p class="success"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <?php foreach ($errors as $error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>

        <form action="products.index.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
            <div class="input-group">
                <input type="text" name="name" placeholder="Tên sản phẩm" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="price-group">
                <div class="input-group">
                    <input type="number" id="price_vnd" name="price_vnd" placeholder="Giá (₫)" step="0.01" value="<?php echo htmlspecialchars($price_vnd); ?>" required>
                </div>
                <div class="input-group">
                    <input type="number" id="price_usd" name="price_usd" placeholder="Giá ($)" step="0.01" value="<?php echo htmlspecialchars($price_usd); ?>" required>
                </div>
            </div>
            <div class="input-group image-upload" id="imageUploadArea">
                <label for="imageUpload">Chọn hoặc kéo thả ảnh mới (JPEG, PNG, GIF, tùy chọn)</label>
                <input type="file" id="imageUpload" name="image" accept="image/*">
                <img id="imagePreview" class="image-preview" src="<?php echo htmlspecialchars($product['image'] ?: ''); ?>" alt="Ảnh xem trước" <?php echo $product['image'] ? 'style="display:block;opacity:1;" class="show"' : ''; ?>>
            </div>
            <button type="submit">Cập Nhật Sản Phẩm</button>
        </form>
        <a href="products.index.php" class="btn-back">← Quay lại danh sách</a>
    </div>

    <script>
        const imageUpload = document.getElementById('imageUpload');
        const imageUploadArea = document.getElementById('imageUploadArea');
        const imagePreview = document.getElementById('imagePreview');
        const priceVndInput = document.getElementById('price_vnd');
        const priceUsdInput = document.getElementById('price_usd');
        const exchangeRate = 25000; // 1 USD = 25,000 VND
        let lastEdited = null;

        // Currency conversion
        priceVndInput.addEventListener('input', function() {
            if (lastEdited !== 'usd') {
                lastEdited = 'vnd';
                const vnd = parseFloat(this.value);
                if (!isNaN(vnd) && vnd > 0) {
                    priceUsdInput.value = (vnd / exchangeRate).toFixed(2);
                } else {
                    priceUsdInput.value = '';
                }
            }
        });

        priceUsdInput.addEventListener('input', function() {
            if (lastEdited !== 'vnd') {
                lastEdited = 'usd';
                const usd = parseFloat(this.value);
                if (!isNaN(usd) && usd > 0) {
                    priceVndInput.value = (usd * exchangeRate).toFixed(0);
                } else {
                    priceVndInput.value = '';
                }
            }
        });

        priceVndInput.addEventListener('focus', () => lastEdited = null);
        priceUsdInput.addEventListener('focus', () => lastEdited = null);

        // Image upload handling
        function handleImage(file) {
            if (file) {
                if (!file.type.startsWith('image/')) {
                    alert('Vui lòng chọn một file ảnh.');
                    imageUpload.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    imagePreview.classList.add('show');
                };
                reader.onerror = function() {
                    alert('Không thể đọc file ảnh.');
                    imageUpload.value = '';
                };
                reader.readAsDataURL(file);
            }
        }

        imageUpload.addEventListener('change', function(event) {
            imagePreview.style.display = 'none';
            imagePreview.classList.remove('show');
            handleImage(event.target.files[0]);
        });

        imageUploadArea.addEventListener('dragover', function(event) {
            event.preventDefault();
            imageUploadArea.classList.add('dragover');
        });

        imageUploadArea.addEventListener('dragleave', function() {
            imageUploadArea.classList.remove('dragover');
        });

        imageUploadArea.addEventListener('drop', function(event) {
            event.preventDefault();
            imageUploadArea.classList.remove('dragover');
            const file = event.dataTransfer.files[0];
            imageUpload.files = event.dataTransfer.files;
            handleImage(file);
        });
    </script>

    <?php if (file_exists('footer.php')) include 'footer.php'; ?>
</body>
</html>